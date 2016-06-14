<?php

namespace App\Http\Controllers;

use App\AdsLog;
use App\Advertisement;
use App\Setting;
use Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class CloudtraxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $radius = Setting::where('option', 'radius')->first();
        $radius = json_decode($radius['value']);
        $uam_secret = $radius->secret;
        function encode_password($plain, $challenge, $secret)
        {
            if ((strlen($challenge) % 2) != 0 ||
                strlen($challenge) == 0
            )
                return FALSE;
            $hexchall = hex2bin($challenge);
            if ($hexchall === FALSE)
                return FALSE;
            if (strlen($secret) > 0) {
                $crypt_secret = md5($hexchall . $secret, TRUE);
                $len_secret = 16;
            } else {
                $crypt_secret = $hexchall;
                $len_secret = strlen($hexchall);
            }
            /* simulate C style \0 terminated string */
            $plain .= "\x00";
            $crypted = '';
            for ($i = 0; $i < strlen($plain); $i++)
                $crypted .= $plain[$i] ^ $crypt_secret[$i % $len_secret];
            $extra_bytes = 0;//rand(0, 16);
            for ($i = 0; $i < $extra_bytes; $i++)
                $crypted .= chr(rand(0, 255));
            return bin2hex($crypted);
        }

        $parameter = Session::get('cloudtrax');
        $username = $radius->username;
        $password = $radius->password;
        $uamip = $parameter["uamip"];
        $uamport = $parameter["uamport"];
        $challenge = $parameter["challenge"];
        $encoded_password = encode_password($password, $challenge, $uam_secret);
        $redirect_url = "http://$uamip:$uamport/logon?" .
            "username=" . urlencode($username) .
            "&password=" . urlencode($encoded_password);

        $method = Request::all();
        dd($method);
        if (isset($method['pressed'])) {
            return redirect($method['url']);
        } else {
            return redirect($redirect_url);
        }
//            $http= curl_init($redirect_url);
//            curl_setopt($http, CURLOPT_RETURNTRANSFER, TRUE);
//            $http_result = curl_exec($http);
//            $http_status = curl_getinfo($http, CURLINFO_HTTP_CODE);
//            curl_close($http);
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
        $this->ip = $request->ip();
        $this->maxPlayed = AdsLog::where('advertisement_id', $data['advertisement_id'])
            ->where('log.ip_address', $this->ip)
            ->max('played');

        if ($this->maxPlayed === null) {
            $this->maxPlayed = 1;
        }
        $vidPlayedCount = Advertisement::whereHas('log', function ($q) use ($data) {
            $q->where('log.ip_address', $this->ip)
                ->where('log.advertisement_id', $data['advertisement_id'])
                ->where('log.played', $this->maxPlayed);
        }, '=', 0)
            ->where('id', $data['advertisement_id'])
            ->count();

        $played = $this->maxPlayed;

        if ($this->maxPlayed >= 1 && $vidPlayedCount == 0)
            $played = $played + 1;

        $parameter = Session::get('cloudtrax');

        $data['mac'] = $parameter['mac'];
        $data['ip_address'] = $request->ip();
        $data['user_agent'] = $request->header('User-Agent');
        $data['played'] = $played;


        AdsLog::create($data);

        $ads = Advertisement::query()->findOrFail($data['advertisement_id']);
        $ads->played++;
        $ads->save();

        $redirect_url = $ads['redirect_url'];
        if ($data['method'] == 'pressed') {
            return redirect("cloudtraxauth?url=$redirect_url&method={$data['method']}");
        } else {
            return redirect('cloudtraxauth');
        }
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
