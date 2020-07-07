<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = "persons";
    protected $guarded = [];
    public $timestamps = false;



  public static function getLocationDetails($lat, $lng)
  {
    $GeoInfo  = "https://maps.googleapis.com/maps/api/geocode/json?latlng=".$lat.",".$lng."&sensor=true&key=AIzaSyDqET1nIDZzMGEieGANkEF_xB1RSCkJTjk";
    
    //  Initiate curl
    $ch = curl_init();

    // Set the url
    curl_setopt($ch, CURLOPT_URL,$GeoInfo);

    // Execute
    $info = json_decode(curl_exec($ch) , true);

    return $info;
  }
}
