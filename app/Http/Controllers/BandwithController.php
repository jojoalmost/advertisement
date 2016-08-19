<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BandwithController extends Controller
{
    public function index()
    {
//        DB::enableQueryLog();
        $data = Setting::where('option', 'bandwith')->where('user_id',Auth::user()->id)->first();
//        dd(DB::getQueryLog());
        $data = json_decode($data['value']);
        return view('admin.bandwith.index', compact('data'));
    }


    public function update(Request $request)
    {
        $data = $request->all();
        $data['up_active'] = isset($data['up_active']) ? 'yes' : 'no';
        $data['down_active'] = isset($data['down_active']) ? 'yes' : 'no';
        $data['timeout_active'] = isset($data['timeout_active']) ? 'yes' : 'no';
        unset($data['_token'], $data['_method']);
        $data = json_encode($data);
        $current = Setting::where('option', 'bandwith')->firstOrFail();
        if (!empty($current)) {
            $current->value = $data;
            $current->user_id = Auth::user()->id;
            $current->save();
        } else {
            $create['option'] = 'bandwith';
            $create['value'] = $data;
            $create['user_id'] = Auth::user()->id;
            Setting::create($create);
        }
        return redirect('admin/bandwith')->with('message', 'Data Updated');
    }
}
