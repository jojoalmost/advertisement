<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class BandwithController extends Controller
{
    public function index()
    {
//        DB::enableQueryLog();
        $data = Setting::where('option', 'bandwith')->firstOrFail();
//        dd(DB::getQueryLog());
        $data=json_decode($data['value']);
        return view('admin.bandwith.index',compact('data'));
    }


    public function update(Request $request)
    {
        $data = $request->all();
        $data['up_active']= isset($data['up_active'])? 'yes' : 'no';
        $data['down_active']= isset($data['down_active'])? 'yes' : 'no';
        $data['timeout_active']= isset($data['timeout_active'])? 'yes' : 'no';
        unset($data['_token'],$data['_method']);
        $data = json_encode($data);
        $current = Setting::where('option', 'bandwith')->firstOrFail();
        $current->value=$data;
        $current->save();
        return redirect('admin/bandwith')->with('message', 'Data Updated');
    }
}
