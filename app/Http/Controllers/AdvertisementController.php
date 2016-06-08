<?php

namespace App\Http\Controllers;

use App\Advertisement;
use App\Setting;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdvertisementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Advertisement::orderBy('sorting', 'asc')->get();
        $skipduration = Setting::where('option', 'skipduration')->first();
        $skipduration = json_decode($skipduration['value']);
        return view('admin.advertisement.index', compact('data', 'skipduration'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.advertisement.insert');
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
        $data['skipped'] = isset($data['skipped']) ? 'yes' : 'no';
        $data['active'] = isset($data['skipped']) ? 'yes' : 'no';
        $sorting = Advertisement::all()->count();
        $data['sorting'] = $sorting + 1;

        $destinationPath = 'uploads/video';

        if ($request->hasFile('video_mp4')) {
            $video_mp4 = $request->file('video_mp4')->getClientOriginalName();
            $data['video_mp4'] = $video_mp4;
            $request->file('video_mp4')->move($destinationPath, $video_mp4);
        }
        if ($request->hasFile('video_ogg')) {
            $video_ogg = $request->file('video_ogg')->getClientOriginalName();
            $data['video_ogg'] = $video_ogg;
            $request->file('video_ogg')->move($destinationPath, $video_ogg);
        }
        if ($request->hasFile('video_webm')) {
            $video_webm = $request->file('video_webm')->getClientOriginalName();
            $data['video_webm'] = $video_webm;
            $request->file('video_webm')->move($destinationPath, $video_webm);
        }
        Advertisement::create($data);

        return redirect('admin/advertisement');

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
        $data = Advertisement::query()->findOrFail($id);
        return view('admin.advertisement.edit', compact('data'));
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
        $data = $request->all();
        $data['skipped'] = isset($data['skipped']) ? 'yes' : 'no';
        $data['active'] = isset($data['skipped']) ? 'yes' : 'no';
        $existing = Advertisement::query()->findOrFail($id);

        $destinationPath = 'uploads/video';

        if ($request->hasFile('video_mp4')) {
            $video_mp4 = $request->file('video_mp4')->getClientOriginalName();
            $data['video_mp4'] = $video_mp4;
            $request->file('video_mp4')->move($destinationPath, $video_mp4);
        }
        if ($request->hasFile('video_ogg')) {
            $video_ogg = $request->file('video_ogg')->getClientOriginalName();
            $data['video_ogg'] = $video_ogg;
            $request->file('video_ogg')->move($destinationPath, $video_ogg);
        }
        if ($request->hasFile('video_webm')) {
            $video_webm = $request->file('video_webm')->getClientOriginalName();
            $data['video_webm'] = $video_webm;
            $request->file('video_webm')->move($destinationPath, $video_webm);
        }

        $existing->fill($data);
        $existing->save();
        return redirect('admin/advertisement');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Advertisement::query()->findOrFail($id);
        $data->delete();
        $sorting = Advertisement::all();
        $sort = 1;
        foreach ($sorting as $val) {
            $val->sorting = $sort++;
            $val->save();
        }
    }

    public function sorting(Request $request)
    {
        $data = $request->get('data');
        $data = json_decode($data);
        $sort = 1;
        foreach ($data as $key => $value) {
            $table = Advertisement::query()->findOrFail($value->id);
            $table->sorting = $sort++;
            $table->save();
        }

    }

    public function skipDuration(Request $request)
    {
        $data = $request->all();
        unset($data['_token'], $data['_method']);
        $data['skip_duration'] = isset($data['skip_duration']) ? 'yes' : 'no';
        $data = json_encode($data);
        $current = Setting::where('option', 'skipduration')->first();
        if (!empty($current)) {
            $current->value = $data;
            $current->save();
        } else {
            $create['option'] = 'skipduration';
            $create['value'] = $data;
            Setting::create($create);
        }
    }
}
