<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TermsController extends Controller
{
    public function index()
    {
//        DB::enableQueryLog();
        $data = Setting::where('option', 'terms')->where('user_id',Auth::user()->id)->first();
//        dd(DB::getQueryLog());
        return view('admin.terms.index', compact('data'));
    }


    public function update(Request $request)
    {
        $data = $request->all();
        $current = Setting::where('option', 'terms')->first();
        if (!empty($current)) {
            $current->value = $data['terms'];
            $current->user_id = Auth::user()->id;
            $current->save();
        }else{
            $create['option']='terms';
            $create['value']= $data['terms'];
            $create['user_id'] = Auth::user()->id;
            Setting::create($create);
        }

        return redirect('admin/terms')->with('message', 'Data Saved');
    }


}
