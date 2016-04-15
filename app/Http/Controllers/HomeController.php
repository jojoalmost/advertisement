<?php

namespace App\Http\Controllers;

use App\Advertisement;
use App\AdsLog;
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
		$this->maxPlayed = AdsLog::where('log.ip_address', $this->ip)
				->max('played');
		if($this->maxPlayed===null) {
			$this->maxPlayed = 1;
		}else{
			
			$data = Advertisement::whereHas('log', function($q){
					$q->where('log.ip_address', $this->ip)
						->where('log.played', $this->maxPlayed);
				},'=',0)
				->where('played','<',DB::raw('max_played'));
			$count = $data->count();
			if($count==0 && $this->maxPlayed>1){
				$this->maxPlayed=$this->maxPlayed+1;
				
			}
		}
        

		DB::enableQueryLog();
        $data = Advertisement::whereHas('log', function($q){
				$q->where('log.ip_address', $this->ip)
					->where('log.played', $this->maxPlayed);
			},'=',0)
			->where('advertisement.played','<',DB::raw('max_played'))
			
			->get()
			->first();
				
		
        if (empty($data)){
//            return view('errors.503');
            return redirect('cloudtraxauth');
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

    public function termsOfUse(){
        $cloudtrax=Request::all();
        Session::put(compact('cloudtrax'));
        switch($cloudtrax['res']) {
            case "logoff":
                echo "Goodbye";
                break;
            case "success":
                return redirect($cloudtrax['userurl']);
                break;
            case "failed":
                echo "Authentication Failed";
                break;
            case "notyet":
                return view('terms-of-use');
                break;
            default:
                http_response_code(400);
                exit();
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
