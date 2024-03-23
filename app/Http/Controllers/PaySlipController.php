<?php

namespace App\Http\Controllers;

use App\Models\Payslip;
use Illuminate\Http\Request;

class PaySlipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:payslip-list|payslip-create|payslip-edit|payslip-delete', ['only' => ['index','show']]);
         $this->middleware('permission:payslip-create', ['only' => ['create','store']]);
         $this->middleware('permission:payslip-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:payslip-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Pay Slips";
        $data = Payslip::all();
        return view('payslips.index', compact('data', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Payslip::findOrFail($id);
        $title = "Payslip Details ".$data->invoice_no;
        return view('payslips.show', compact('data', 'title'));
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
        $data = Payslip::findOrFail($id);
        $data->status = $request->status;
        $data->paid_at = date('Y-m-d H:i:s');
        $data->save();
        return redirect()->back()->with('success', 'Payslip status changed to paid successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
