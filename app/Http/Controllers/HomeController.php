<?php

namespace App\Http\Controllers;

use App\Advertisement;
use Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $this->ip = Request::ip();
        $data = Advertisement::with(['log' => function ($query) {
            $query->where('log.ip_address', $this->ip);
        }])
            ->where('played','<','max_played')
            ->has('log', '=', 0)
            ->get()
            ->first();
        if (empty($data)) return view('errors.503');
        return view('index', compact('data'));
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
        $data = $request->all();
        $tokens = explode('/', $data['url']);
        $filename = $tokens[sizeof($tokens) - 1];
        $data = Advertisement::query()->where('video', '=', $filename)->first();
        $data->played++;
        $data->save();
        return $data->played > $data->max_played ? 'refresh' : 'no';
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

    public function fetch(Request $request)
    {
        $this->ip = $request->ip();
        $data = Advertisement::with(['log' => function ($query) {
            $query->where('log.ip_address', $this->ip);
        }])
            ->where('played','<','max_played')
            ->has('log', '=', 0)
            ->get()
            ->first();
    }
}
