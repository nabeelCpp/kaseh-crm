<?php

namespace App\Http\Controllers;
use App\Models\Invoice;
use App\Models\Caregiver;
use App\Models\Customer;
use App\Models\sub_quotation;
use App\Models\Product;
use App\Models\Quotation;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class QuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:quotation-list|quotation-create|quotation-edit|quotation-delete', ['only' => ['index','show']]);
         $this->middleware('permission:quotation-create', ['only' => ['create','store']]);
         $this->middleware('permission:quotation-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:quotation-delete', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Quotations';
        $dataTable = true;
        $data = Quotation::with('customer','caregiver')->get();
        return view('quotations.index',compact('data','title', 'dataTable'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Quotations';
        $caregivers = Caregiver::all();
        $customers  = Customer::all();
        $products = Product::all();
        return view('quotations.create',compact('title','products', 'customers','caregivers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $input = $request->all();
            $parentInput = [
                'customer_id' => $input['customer_id'],
                'caregiver_id' => $input['caregiver_id'],
                'sales_person' => $input['sales_person'],
                'date'         => $input['date'],
                'refrence_description' => $input['refrence_description']
            ];
            $quotation = Quotation::create($parentInput);
            $quotationId = $quotation->id;
            $price = $request->price * $request->quantity;
            $childInput = [
                'quotation_id' => $quotationId,
                'product_id'  =>$request->product_id,
                'description' => $request->description,
                'service_from' => $request->service_from,
                'service_to' => $request->service_to,
                'quantity'  => $request->quantity,
                'price'    => $price,
            ];
            sub_quotation::create($childInput);
        
            DB::commit();
            return redirect()->route('quotations.index')->with('success', 'Quotation created successfully');
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
        $quotation = Quotation::with('sub_quotations','caregiver','customer')->find($id);
        $title = "Show Quotation";
        if($quotation->sub_quotations[0]->product_id)
        {
            $quotation->product = Product::find($quotation->sub_quotations[0]->product_id);
        
        }
        return view('quotations.show',compact('quotation', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $quotation = Quotation::with('sub_quotations','caregiver','customer')->find($id);
        $title = "Show Quotation";
        if($quotation->sub_quotations[0]->product_id)
        {
            $quotation->product = Product::find($quotation->sub_quotations[0]->product_id);
        
        }
        return view('quotations.edit',compact('quotation', 'title'));
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
