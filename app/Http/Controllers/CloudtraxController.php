<?php

namespace App\Http\Controllers;

use App\AdsLog;
use App\Advertisement;
use App\BillingEntries;
use App\Setting;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
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
//        $redirect_setting = Setting::where('option', 'portal_mode')->first();
//        $redirect_setting = $redirect_setting['value'];
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

        return redirect($redirect_url);
    }

    public function redirect()
    {
        $ads = Session::get('ads');
        return redirect()->to($ads['redirect_url']);
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
        Session::put(compact('ads'));

        //calculate amount
        $user_id = Session::get('user_id');
        $file_size = File::size('video/' . $user_id . '/' . $ads['video_mp4']);//byte
        $megabyte = $file_size / 1000000;
        $duration = round($data['video_duration'], 2);//sec
        $watched = round($data['video_watched'], 2);//sec
        $bandwidth = round(($watched / $duration) * $megabyte, 2);

        $packages = DefaultPackages::where('user_id', Session::get('user_id'))->first();
        $airtimePckg = $packages->air_time_rate;
        $bandwithPckg = $packages->bandwidth_rates;

        $airTimeSum = $bandwidth * $airtimePckg;
        $bandwithSum = round(($bandwidth / 1000) * $bandwithPckg, 2);


        $data['amount'] = 0;
        $data['amount_used'] = 0;
        $data['amount_left'] = 0;
        $billing = BillingEntries::where('user_id', $data['user_id'])->orderby('created_at', 'desc')->get();
        $data['user_id'] = $billing->user_id;
        $data['doc_ref_no'] = 'bandwith use';
        $data['notes'] = '';
        $data['type'] = 'automatic';
        $count = $billing->count();
        if ($count > 0) {
            $data['amount'] = $billing->first()->amount_left;
        }
        $data['amount_used'] = $bandwithSum * (-1);
        $data['amount_left'] = $data['amount'] + $data['amount_used'];
        if ($data['amount_left'] < 0) {
            $data['amount_left'] = 0;
        }
        BillingEntries::create($data);

        $data['doc_ref_no'] = 'airtime use';
        $data['amount'] = $data['amount_left'];
        $data['amount_used'] = $airTimeSum * (-1);
        $data['amount_left'] = $data['amount'] + $data['amount_used'];
        if ($data['amount_left'] < 0) {
            $data['amount_left'] = 0;
        }
        BillingEntries::create($data);
        return redirect("cloudtraxauth");
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
