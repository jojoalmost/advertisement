<?php

namespace App\Http\Controllers;

use App\BillingEntries;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class BillingEntriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = BillingEntries::with('customers')->get();
        return view('admin.billing_entries.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $modal = User::where('role', 2)->get();
        return view('admin.billing_entries.insert', compact('modal'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $status = $data['amount_used_status'];
        unset($data['amount_used_status']);

        $data['amount'] = 0;
        $billing = BillingEntries::where('user_id', $data['user_id'])->orderby('created_at', 'desc')->get();
        $count = $billing->count();
        if ($count > 0) {
            $data['amount'] = $billing->first()->amount_left;
        }
        if ($status == 'reduce') {
            $data['amount_used'] = $data['amount_used'] * (-1);
        }
        $data['amount_left'] = $data['amount'] + $data['amount_used'];
        if ($data['amount_left'] < 0) {
            $data['amount_left'] = 0;
        }
        BillingEntries::create($data);

        return redirect('admin/billing_entries');

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
