<?php

namespace App\Http\Controllers;

use App\Models\Caregiver;
use App\Models\Customer;
use App\Models\Product;
use App\Models\SalesOrder;
use App\Models\SalesOrderProduct;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Dompdf\Dompdf;
use Dompdf\Options;
use Spatie\Permission\Models\Role;

class SalesOrderController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:salesorder-list|salesorder-create|salesorder-edit|salesorder-delete', ['only' => ['index','show']]);
         $this->middleware('permission:salesorder-create', ['only' => ['create','store']]);
         $this->middleware('permission:salesorder-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:salesorder-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Sales Orders";
        $dataTable = true;
        $data = SalesOrder::all();
        return view('salesorders.index',compact('data','title', 'dataTable'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $role = Role::where(['name' => 'Sales Agent'])->first();
        $salesAgents = [];
        foreach ($role->users as $key => $value) {
            $salesAgents[$value->id] = $value->name;
        }
        $title = 'Create Sales Order';
        $caregivers = Caregiver::all();
        $customers  = Customer::all();
        $products = Product::all();
        return view('salesorders.create',compact('title','products', 'customers','caregivers', 'salesAgents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            // 'caregiver_id' => 'required',
            'customer_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required|numeric|min:1',
            // 'start_date' => 'required',
            // 'end_date' => 'required'
        ]);
        try {
            DB::beginTransaction();
            $input = $request->all();
            $input['user_id'] = Auth()->user()->id;
            $order = SalesOrder::create($input);
            SalesOrderProduct::create([
                'sales_order_id' => $order->id,
                'product_id' => $request->product_id,
                'qty' => $request->quantity,
                'unit_price' => $request->unit_price,
                'total' => $request->total_invoiced
            ]);
            DB::commit();
            return redirect()->route('orders.index')->with('success', 'Sales order created successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = SalesOrder::findOrFail($id);
        $data['order'] = $order;
        $start_date = $order->start_date;
        $end_date = $order->end_date;

        $available_caregivers = Caregiver::whereDoesntHave('sales_orders', function ($query) use ($start_date, $end_date) {
            $query->where(function ($query) use ($start_date, $end_date) {
                $query->where('start_date', '<=', $start_date)
                      ->where('end_date', '>=', $start_date);
            })->orWhere(function ($query) use ($start_date, $end_date) {
                $query->where('start_date', '<=', $end_date)
                      ->where('end_date', '>=', $end_date);
            })->orWhere(function ($query) use ($start_date, $end_date) {
                $query->where('start_date', '>=', $start_date)
                      ->where('end_date', '<=', $end_date);
            });
        })->get();
        $data['caregivers'] = $available_caregivers;
        $data['title'] = 'Sales Order #'.$data['order']->order_no;
        return view('salesorders.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        dd(request()->has('role'));
        $order = SalesOrder::find($id);
        $title = 'Edit Sales Order #'.$order->order_no;
        $caregivers = Caregiver::all();
        $customers  = Customer::all();
        $products = Product::all();
        return view('salesorders.edit',compact('title','products', 'customers','caregivers', 'order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            // 'caregiver_id' => 'required',
            'customer_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required|numeric|min:1',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);
        try {
            DB::beginTransaction();
            $input = $request->all();
            $order = SalesOrder::find($id);
            $order->caregiver_id = $input['caregiver_id'];
            $order->customer_id = $input['customer_id'];
            $order->start_date = $input['start_date'];
            $order->end_date = $input['end_date'];
            $order->total_invoiced = $input['total_invoiced'];
            $order->remarks = $input['remarks'] ?? null;
            $order->save();

            $products = SalesOrderProduct::where(['sales_order_id' => $id])->get();
            foreach ($products as $key => $product) {
                SalesOrderProduct::where(['id' => $product->id])->update([
                    'product_id' => $request->product_id,
                    'qty' => $request->quantity,
                    'unit_price' => $request->unit_price,
                    'total' => $request->total_invoiced
                ]);
            }
            DB::commit();
            return redirect()->route('orders.index')->with('success', 'Sales order updated successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }


    public function schedule(Request $request, string $id)
    {
        $this->validate($request, [
            'caregiver_id' => 'required',
        ]);
        try {
            DB::beginTransaction();
            $input = $request->all();
            $order = SalesOrder::find($id);
            $order->caregiver_id = $input['caregiver_id'];
            $order->remarks = $input['remarks'] ?? null;
            $order->save();
            DB::commit();
            return redirect()->route('orders.index')->with('success', 'Caregiver Scheduling done successfully!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();
            $order = SalesOrder::find($id);
            if (!$order) {
                throw new \Exception("Sales Order not found");
            }
            if(count($order->products)){
                // Delete associated products
                foreach ($order->products as $key => $product) {
                    $product->delete();
                }
            }
            // Delete the sales order
            $order->delete();
            DB::commit();
            return redirect()->route('orders.index')
                            ->with('success', 'Sales Order deleted successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('orders.index')
                            ->with('error', 'Failed to delete Sales Order: ' . $e->getMessage());
        }
    }

    public function downloadSalesOrder($order_no) {
        // Generate the PDF content (replace this with your invoice generation logic)
        $id = (int)$order_no;
        $data['order'] = SalesOrder::find($id);
        $imageUrl = public_path('logo.png');
        $base64Image = base64_encode(file_get_contents($imageUrl));
        $data['base64Image'] = $base64Image;
        $pdfContent = view('salesorders.invoice', $data)->render();

        // Set up the PDF options
        $options = new Options();
        // $options->set('defaultFont', 'Arial');

        // Create a new Dompdf instance
        $dompdf = new Dompdf($options);

        // Load HTML content into Dompdf
        $dompdf->loadHtml($pdfContent);

        // Render the PDF
        $dompdf->render();

        // Generate the PDF file name (you can customize this as needed)
        $filename = 'sales_order_invoice_'.$data['order']['order_no'] .'_'. date('YmdHis') . '.pdf';

        // Stream the PDF to the browser for download
        return $dompdf->stream($filename);
    }
}
