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
}
