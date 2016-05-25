<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class TermsController extends Controller
{
    public function index()
    {
//        DB::enableQueryLog();
        $data = Setting::where('option', 'terms')->firstOrFail();
//        dd(DB::getQueryLog());
        return view('admin.terms.index',compact('data'));
    }


    public function update(Request $request)
    {
        $data = $request->all();
        unset($data['_token'],$data['_method']);
        $current = Setting::where('option', 'terms')->firstOrFail();
        $current->value=$data['terms'];
        $current->save();
        return redirect('admin/terms')->with('message', 'Data Updated');
    }


}
