<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:settings', ['only' => ['index','show']]);
        // $this->middleware('permission:scheduling-create', ['only' => ['create','store']]);
        // $this->middleware('permission:scheduling-edit', ['only' => ['edit','update']]);
        // $this->middleware('permission:scheduling-delete', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] = "System Settings";
        $data['settings'] = Setting::all();
        return view('settings.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'key' => 'required',
            'value' => 'required',
        ]);
        try {
            DB::beginTransaction();
            $key = strtolower(str_replace(' ', '_', trim($request->key)));
            // check key if exists;
            $key_exist = Setting::where(['key' => $key])->first();
            if($key_exist) {
                $key_exist->value = $request->value;
                $key_exist->save();
            }else{
                Setting::create(['key' => $key, 'value' => $request->value, 'type' => 'textarea']);
            }
            DB::commit();
            return redirect()->route('settings.index')->with('success', 'Settings updated successfully!');
        } catch (\Throwable $th) {
            //throw $th;
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
