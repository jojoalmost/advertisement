<?php

namespace App\Http\Controllers;

use App\CustomerSettings;
use App\DefaultPackages;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CustomerSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        DB::enableQueryLog();
        $data = CustomerSettings::with('customer')->get();
//        dd(DB::getQueryLog());
//        dd($data);
        return view('admin.customer_settings.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $modal = DefaultPackages::all();
        DB::enableQueryLog();
        $modal2 = User::where('role',2)->get();
        return view('admin.customer_settings.insert',compact('modal','modal2'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['active'] = isset($data['active']) ? 'yes' : 'no';
        CustomerSettings::create($data);

        return redirect('admin/customer_settings');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = CustomerSettings::query()->findOrFail($id);
        $modal = DefaultPackages::all();
        $modal2 = User::where('role',2)->get();
        return view('admin.customer_settings.edit', compact('data','modal','modal2'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $data['active'] = isset($data['active']) ? 'yes' : 'no';
        $existing = CustomerSettings::query()->findOrFail($id);
        $existing->fill($data);
        $existing->save();
        return redirect('admin/advertisement');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = CustomerSettings::query()->findOrFail($id);
        $data->delete();
    }
}
