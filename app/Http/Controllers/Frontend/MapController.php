<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;


class MapController extends Controller
{


    public function url()
    {
        return env('Api_Address');
    }


    public function GetAllAlertDetails()
    {
        $getallUserAlerts = file_get_contents($this->url().'alerts/getAreabyAlerts');
        return $getallUserAlerts;

    }

    public function GetDisasterDetials()
    {
        $DisasterType = file_get_contents($this->url().'alerts/getDisasterbyAlerts');
        return $DisasterType;
    }

   // public  function

    public function GetAllAlertDetailsByID()
    {
        $ID=Input::get('id');
        $response = \Guzzle::get($this->url().'alerts/findUserAlerts/'.$ID);
        return $response;
    }
}
