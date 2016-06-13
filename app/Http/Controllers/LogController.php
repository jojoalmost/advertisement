<?php

namespace App\Http\Controllers;

use App\AdsLog;
use App\Advertisement;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = AdsLog::with('advertisement')->get();
        return view('admin.log.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function report()
    {
        DB::enableQueryLog();
//        $data = Advertisement::leftJoin(DB::raw('(SELECT sum(played) as coba from log GROUP BY advertisement_id) as v'),'v.advertisement_id', '=', 'advertisement.id')->get();
//        dd(DB::getQueryLog());
        $data = Advertisement::orderBy('sorting', 'asc')->get();
        return view('admin.report.index', compact('data'));
    }

    public function viewreport($id)
    {
        $data = AdsLog::where('advertisement_id', $id);
        return view('admin.report.view', compact('data'));
    }
}
