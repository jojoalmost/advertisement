<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PortalModeController extends Controller
{
    public function index()
    {
//        DB::enableQueryLog();
        $data = Setting::where('option', 'portal_mode')->first();
//        dd(DB::getQueryLog());
        return view('admin.portal_mode.index', compact('data'));
    }


    public function update(Request $request)
    {
        $data = $request->all();
        $current = Setting::where('option', 'portal_mode')->firstOrFail();
        if (!empty($current)) {
            $current->value = $data['portal_mode'];
            $current->save();
        } else {
            $create['option'] = 'portal_mode';
            $create['value'] = $data['portal_mode'];
            Setting::create($create);
        }
        return redirect('admin/portal_mode')->with('message', 'Data Updated');
    }
}
