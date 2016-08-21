<?php

namespace App\Http\Controllers;

use App\User;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::all();
        return view('admin.user_manager.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user_manager.insert');
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
        $data['password']= bcrypt($data['password']);
        $data['key']=  uniqid();
        $data['active']=  'yes';
        $id =  User::create($data)->id;
        $path = 'video/'.$id;
        File::makeDirectory($path, $mode = 0777, true, true);

        return redirect('admin/user_manager');
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
        $data = User::query()->findOrFail($id);
        return view('admin.user_manager.edit', compact('data'));
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
        $user = User::query()->findOrFail($id);
        $data = $request->all();
        $data['password']= isset($data['password'])? bcrypt($data['password']): $user->password;
        $existing = User::query()->findOrFail($id);
        $existing->fill($data);
        $existing->save();
        return redirect('admin/user_manager');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = User::query()->findOrFail($id);
        $data->delete();
        $path = 'video/'.$id;
        File::deleteDirectory($path);
    }

    public function setactive($status,$id){
        $data = User::query()->findOrFail($id);
        if($status == 'active'){
            $data->active = 'yes';
        }else{
            $data->active = 'no';
        }
        $data->save();
    }
}
