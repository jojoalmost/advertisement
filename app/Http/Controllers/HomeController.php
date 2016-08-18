<?php

namespace App\Http\Controllers;

use App\Advertisement;
use App\AdsLog;
use App\Setting;
use Illuminate\Support\Facades\Session;
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
        $parameter = Session::get('cloudtrax');
        $this->mac = $parameter['mac'];

        DB::enableQueryLog();
        $this->maxPlayed = AdsLog::where('log.ip_address', $this->ip)
            ->where('log.mac', $this->mac)
            ->max('played');
//        dd(DB::getQueryLog());
        if ($this->maxPlayed === null) {
            $this->maxPlayed = 1;
        } else {
            DB::enableQueryLog();
            $data = Advertisement::whereHas('log', function ($q) {
                $q->where('log.ip_address', $this->ip)
                    ->where('log.mac', $this->mac)
                    ->where('log.played', $this->maxPlayed);
            }, '=', 0)->whereHas('user', function ($test) {
                $test->where('key', Session::get('apikey'));
            });
            $count = $data->count();
//            dd($count);
            if ($count == 0) {
                $this->maxPlayed = $this->maxPlayed + 1;

            }
        }

        DB::enableQueryLog();
        $data = Advertisement::whereHas('log', function ($q) {
            $q->where('log.ip_address', $this->ip)
                ->where('log.mac', $this->mac)
                ->where('log.played', $this->maxPlayed);
        }, '=', 0)
            ->whereHas('user', function ($test) {
            $test->where('key', Session::get('apikey'));
        })
            ->where('advertisement.active', 'yes')
            ->get()
            ->first();


        if (empty($data)) {
            dd(DB::getQueryLog(), $data);
//            return redirect('cloudtraxauth');
        }

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

    public function termsOfUse()
    {
        $data = Setting::whereHas('user', function ($test) {
            $test->where('key', Session::get('apikey'));
        })->where('option', 'terms')->get()->first();
        return view('terms-of-use', compact('data'));
    }

    public function apiKey($key)
    {
        if (!empty($key)) {
            Session::put('apikey', $key);
        }
        $cloudtrax = Request::all();
        if (!empty($cloudtrax)) {
            Session::put(compact('cloudtrax'));
            switch ($cloudtrax['res']) {
                case "logoff":
                    $data = "logoff";
                    return view('response', compact('data'));
                    break;
                case "success":
                    return redirect($cloudtrax['userurl']);
                    break;
                case "failed":
                    $data = "failed";
                    return view('response', compact('data'));
                    break;
                case "notyet":
                    return redirect('/');
                    break;
                default:
                    http_response_code(400);
                    exit();
            }
        } else {
            return view('errors/503request');
        }

    }
//    public function fetch(Request $request)
//    {
//        $this->ip = $request->ip();
//        $data = Advertisement::with(['log' => function ($query) {
//            $query->where('log.ip_address', $this->ip);
//        }])
//            ->where('played','<','max_played')
//            ->has('log', '=', 0)
//            ->get()
//            ->first();
//    }
}
