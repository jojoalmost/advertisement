<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RadiusController extends Controller
{
    public function index()
    {
//        DB::enableQueryLog();
        $data = Setting::where('option', 'radius')->first();
//        dd(DB::getQueryLog());
        $data = json_decode($data['value']);
        return view('admin.radius.index', compact('data'));
    }


    public function update(Request $request)
    {
        $data = $request->all();
        unset($data['_token'], $data['_method']);
        $data = json_encode($data);
        $current = Setting::where('option', 'radius')->first();
        if (!empty($current)) {
            $current->value = $data;
            $current->user_id = Auth::user()->id;
            $current->save();
        } else {
            $create['option'] = 'radius';
            $create['value'] = $data;
            $create['user_id'] = Auth::user()->id;
            Setting::create($create);
        }
        return redirect('admin/radius')->with('message', 'Data Updated');
    }


}
