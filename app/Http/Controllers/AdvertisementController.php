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
        return view('admin.advertisement.index', compact('data','skipduration'));
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
        $filename = $request->file('video')->getClientOriginalName();
        $data['video'] = $filename;
        $sorting = Advertisement::all()->count();
        $data['sorting'] = $sorting + 1;
        Advertisement::create($data);
        if ($request->hasFile('video')) {
            $destinationPath = 'uploads/video';
            $request->file('video')->move($destinationPath, $filename);
        }
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
        $existing = Advertisement::query()->findOrFail($id);
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
