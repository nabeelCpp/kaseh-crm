<?php

namespace App\Http\Controllers;

use App\Models\Caregiver;
use App\Models\Customer;
use App\Models\Payslip;
use App\Models\Product;
use App\Models\Setting;
use App\Models\SalesOrder;
use App\Models\SalesOrderProduct;
use App\Models\SalesOrderScheduledDay;
use App\Models\ScheduledDay;
use App\Models\Scheduling;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Console\Scheduling\Schedule;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Carbon;

class SalesOrderController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:salesorder-list|salesorder-create|salesorder-edit|salesorder-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:salesorder-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:salesorder-edit', ['only' => ['edit', 'update']]);
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
        return view('salesorders.index', compact('data', 'title', 'dataTable'));
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
        return view('salesorders.create', compact('title', 'products', 'customers', 'caregivers', 'salesAgents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'user_id' => isset($request->user_id) ? 'required' : '',
            'customer_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required|numeric|min:1',
            // 'start_date' => 'required',
            // 'end_date' => 'required'
        ]);
        try {
            DB::beginTransaction();
            $input = $request->all();
            $input['user_id'] = $request->user_id ?? Auth()->user()->id;
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
        $dataTable = true;
        $order = SalesOrder::findOrFail($id);
        $data['order'] = $order;
        $start_date = $order->start_date;
        $end_date = $order->end_date ?? $order->start_date;
        $data['status'] = ['assign', 'failed', 'approve'];

        $available_caregivers = Caregiver::whereDoesntHave('sales_orders', function ($query) use ($start_date, $end_date, $id) {
            $query->where(function ($query) use ($start_date, $end_date, $id) {
                $query->where('start_date', '<=', $start_date)
                    ->where('end_date', '>=', $start_date)
                    ->where('id', '!=', $id);
            })->orWhere(function ($query) use ($start_date, $end_date, $id) {
                $query->where('start_date', '<=', $end_date)
                    ->where('end_date', '>=', $end_date)
                    ->where('id', '!=', $id);
            })->orWhere(function ($query) use ($start_date, $end_date, $id) {
                $query->where('start_date', '>=', $start_date)
                    ->where('end_date', '<=', $end_date)
                    ->where('id', '!=', $id);
            });
        })->get();
        $caregivers = [];
        for ($i = 0; $i < count($available_caregivers); $i++) {
            $caregivers[$available_caregivers[$i]->id] = $available_caregivers[$i]->first_name . ' ' . $available_caregivers[$i]->last_name;
        }
        $data['caregivers'] = $caregivers;
        $data['title'] = 'Sales Order #' . $data['order']->order_no;
        return view('salesorders.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $order = SalesOrder::find($id);
        $title = 'Edit Sales Order #' . $order->order_no;
        $caregivers = Caregiver::all();
        $customers  = Customer::all();
        $products = Product::all();
        return view('salesorders.edit', compact('title', 'products', 'customers', 'caregivers', 'order'));
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
        $order = SalesOrder::find($id);
        if ($order->products[0]->product->treatment_type === 'weekly') {
            $this->validate($request, [
                'caregiver_id' => 'required',
                'start_date' => ['required', 'array', 'min:1'],
                'start_date.*' => ['required'],
                'caregiver' => ['required', 'array', 'min:1'],
                'caregiver.*' => ['required'],
                'days_scheduled' => ['required', 'array', 'min:' . $order->products[0]->product->no_of_days_per_week, 'max:' . $order->products[0]->product->no_of_days_per_week],
                'days' => ['required', 'array'],
                'days.*' => ['required', 'array', 'min:' . $order->products[0]->product->no_of_days_per_week, 'max:' . $order->products[0]->product->no_of_days_per_week],
            ]);
        } else {
            $this->validate($request, [
                'caregiver_id' => 'required',
                'start_date' => ['required', 'array', 'min:1'],
                'start_date.*' => ['required'],
                'caregiver' => ['required', 'array', 'min:1'],
                'caregiver.*' => ['required'],
                // 'days_scheduled' => ['required', 'array', 'min:'.$order->products[0]->product->no_of_days_per_week, 'max:'.$order->products[0]->product->no_of_days_per_week],
                // 'days' => ['required', 'array'],
                // 'days.*' => ['required', 'array', 'min:'.$order->products[0]->product->no_of_days_per_week, 'max:'.$order->products[0]->product->no_of_days_per_week],
            ]);
        }
        try {
            DB::beginTransaction();
            $input = $request->all();
            $order->caregiver_id = $input['caregiver_id'];
            $order->remarks = $input['remarks'] ?? null;
            $order->save();

            //remove old schedules days
            SalesOrderScheduledDay::where(['sales_order_id' => $id])->delete();

            // add scheduled_days to table
            if (isset($request->days_scheduled)) {
                foreach ($request->days_scheduled as $key => $value) {
                    SalesOrderScheduledDay::create(['sales_order_id' => $id, 'day' => $value, 'time' => $request->time]);
                }
            }


            //remove old schedulings if any
            Scheduling::where(['sales_order_id' => $id])->delete();

            // remove old scheduling days of schedules

            ScheduledDay::where(['sales_order_id' => $id])->delete();

            // Scheduling here
            for ($i = 0; $i < count($request->start_date); $i++) {
                $schedule_arr = [
                    'start_date' => $request->start_date[$i],
                    'end_date' => $request->end_date[$i] ?? null,
                    'caregiver_id' => $request->caregiver[$i],
                    'sales_order_id' => $id,
                    'scheduled_by' => Auth()->user()->id,
                ];
                $schedule = Scheduling::create($schedule_arr);
                //save all the schedulings days for each schedule.
                if (isset($request->days[$i])) {
                    foreach ($request->days[$i] as $key => $value) {
                        $date = Carbon::parse($value);
                        ScheduledDay::create([
                            'sales_order_id' => $id,
                            'scheduling_id' => $schedule->id,
                            'day' => $date->format('l'),
                            'date' => $value
                        ]);
                    }
                }

                // if product typ is daily
                if($order->products[0]->product->treatment_type === 'daily') {
                    $date = Carbon::parse($request->start_date[$i]);
                    ScheduledDay::create([
                        'sales_order_id' => $id,
                        'scheduling_id' => $schedule->id,
                        'day' => $date->format('l'),
                        'date' => $request->start_date[$i]
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('orders.index')->with('success', 'Caregiver Scheduling done successfully!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function updateScheduling(Request $request, $id)
    {
        $schedule = ScheduledDay::findOrFail($id);
        $schedule->remarks = $request->remarks ?? null;
        $schedule->reviewed_by = Auth()->user()->id;
        $schedule->reason_for_refuse = $request->reason_for_refuse ?? null;
        $schedule->status = $request->status;
        if($request->status === 'approve') {
            // check if pay slip is generated for this caregiver or not
            $payslip = Payslip::where(['status' => 'pending', 'caregiver_id' => $schedule->scheduling->caregiver_id])->first();
            if($payslip) {
                $schedule->payslip_id = $payslip->id;
            }else{
                $newpayslip = Payslip::create([
                    'caregiver_id' => $schedule->scheduling->caregiver_id,
                    'invoice_no' => env('INVOICE_PREFIX').'-'.date('YmdHis')
                ]);
                $schedule->payslip_id = $newpayslip->id;
            }
        }
        $schedule->save();

        return response()->json(['success' => true, 'status' => ucfirst($schedule->status)]);
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
            if (count($order->products)) {
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

    public function downloadSalesOrder($order_no)
    {
        // Generate the PDF content (replace this with your invoice generation logic)
        $content = Setting::where(['key' => 'invoice_footer'])->first();
        $data['content'] = $content->value ?? null;
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
        $filename = 'sales_order_invoice_' . $data['order']['order_no'] . '_' . date('YmdHis') . '.pdf';

        // Stream the PDF to the browser for download
        return $dompdf->stream($filename);
    }
}
