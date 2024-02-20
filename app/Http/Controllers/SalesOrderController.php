<?php

namespace App\Http\Controllers;

use App\Models\Caregiver;
use App\Models\Customer;
use App\Models\Product;
use App\Models\SalesOrder;
use App\Models\SalesOrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Dompdf\Dompdf;
use Dompdf\Options;
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
        $title = 'Create Sales Order';
        $caregivers = Caregiver::all();
        $customers  = Customer::all();
        $products = Product::all();
        return view('salesorders.create',compact('title','products', 'customers','caregivers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'caregiver_id' => 'required',
            'customer_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required|numeric|min:1',
            'start_date' => 'required',
            'end_date' => 'required'
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function downloadSalesOrder($order_no) {
        // Generate the PDF content (replace this with your invoice generation logic)
        $id = (int)$order_no;
        $data['order'] = SalesOrder::find($id);

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
