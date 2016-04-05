<?php

namespace App\Http\Controllers;

use App\AdsLog;
use App\Advertisement;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CloudtraxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        include 'example_server.php';
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
		$this->ip = $request->ip();
		$this->maxPlayed = AdsLog::where('advertisement_id',$data['advertisement_id'])
				->where('log.ip_address', $this->ip)
				->max('played');
				
		if($this->maxPlayed===null) {
			$this->maxPlayed = 1;
		}
		$vidPlayedCount = Advertisement::whereHas('log', function($q) use ($data){
				$q->where('log.ip_address', $this->ip)
				->where('log.advertisement_id',$data['advertisement_id'])
				->where('log.played', $this->maxPlayed);
			},'=',0)
			->where('id',$data['advertisement_id'])
			->count();
		
		$played = $this->maxPlayed;
		
		if($this->maxPlayed>=1 && $vidPlayedCount == 0)
			$played=$played+1;
		
        $data['ip_address'] = $request->ip();
        $data['user_agent'] = $request->header('User-Agent');
		$data['played'] = $played;
		
		
        AdsLog::create($data);		
		
        $ads = Advertisement::query()->findOrFail($data['advertisement_id']);
        $ads->played++;
        $ads->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
