<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Caregiver;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Invoice;
use PhpParser\Node\Stmt\TryCatch;
use Spatie\Permission\Models\Role;

class InvoiceController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:invoices-list|invoices-create|invoices-edit|invoices-delete', ['only' => ['index','show']]);
         $this->middleware('permission:invoices-create', ['only' => ['create','store']]);
         $this->middleware('permission:invoices-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:invoices-delete', ['only' => ['destroy']]);
    }
    public function index() : View
    {
        $title = 'Invoices';
        $dataTable = true;
        $data = Invoice::with('products')->get();
        return view('invoices.index',compact('data','title', 'dataTable'));
    }
    public function create() : View {
        $title = 'Create New Invoice';
        $caregivers = Caregiver::all();
        $customers  = Customer::all();
        $products = Product::all();

        $homecaretypes = [
            "" => "Select caretype",
            "livein" => "livein",
            "liveout" => "liveout",
            "session" => "session",
            "reliever" => "reliever",

        ];
        return view('invoices.create',compact('title','homecaretypes','products', 'customers','caregivers'));
    }

    public function store(Request $request) : RedirectResponse
    {
       

        try {
            DB::beginTransaction();
            $input = $request->all();
            Invoice::create($input);
            DB::commit();
            return redirect()->route('invoices.index')
                            ->with('success','Invoice created successfully');

        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }
    public function show(string $id)
    {
        $invoice = Invoice::with('products','caregiver','customer')->find($id);
        $title = "Show Invoice";
        return view('invoices.show',compact('invoice', 'title'));
    }

    public function destroy(string $id)
    {
        Invoice::find($id)->delete();
        return redirect()->route('invoices.index')
                        ->with('success','Invoice deleted successfully');
    }

    public function edit(string $id) : View
    {
        $invoices = Invoice::with('products','caregiver','customer')->find($id);
        // $invoices = Invoice::find($id);
        $title = 'Create New Invoice';
        $products = Product::all();
        $caregivers = Caregiver::all();
        $customers = Customer::all();

        $care_type = [
            "" => "Select caretype",
            "livein" => "livein",
            "liveout" => "liveout",
            "session" => "session",
            "reliever" => "reliever",

        ];
        $title = "Edit Invoice";
        return view('invoices.edit',compact('invoices','care_type','products','title','caregivers','customers'));
    }
    
    public function update(Request $request, string $id): RedirectResponse
    {

        $input = $request->all();

        $user = Invoice::find($id);
        $user->update($input);
        return redirect()->route('invoices.index')
                        ->with('success','Invoice updated successfully');
    }
}
