<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use Illuminate\Http\Request;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Trip::truncate();
        $response = Http::get('https://driver.jmvalente.pt/index.php/trip/listaruser?iduser=1');
        $trip = $response->json()['Trip'][0];
        return [
            'id_trip' => $trip['TripID'],
            //'user_id_user' => $trip ['user_id_user'],
            //'SensorTimestamp' => $trip['SensorTimestamp'],
            'timestamp_API' => $trip['timestamp_API'],
            'current_speed' => $trip['Statcurrent_speedeType'],
            'weather_description' => $trip['weather_description'],
            'temperature' => $trip['temperature'],
            'humidity' => $trip['humidity'],
            'visibility' => $trip['visibility'],
            'road_type' => $trip['road_type'],
            'latitude' => $trip['latitude'],
            'longitude' => $trip['longitude'],
            'altitude' => $trip['altitude'],
            'accelerometerX' => $trip['accelerometerX'],
            'accelerometerY' => $trip['accelerometerY'],
            'accelerometerZ' => $trip['accelerometerZ'],
            'name' => $trip['name'],
            //'gender_name' => $trip['gender_name'],
            'model_name' => $trip['model_name'],
        ];;
        for ($i=0; $i <count($res['TripID']); $i++) {

            $trip->each(function($trip){
                $t= new Trip();
                $sD= new SensorData();
                $t-> trip_id = $trip["TripID"];
                //$t-> user_id_user = $trip["user_id_user"];
                //$t-> sensorTimestamp = $trip["SensorTimestamp"];
                $sD-> timestamp_API = $trip["timestamp_API"];
                $sD-> current_speed = $trip["current_speed"];
                $sD-> weather_description = $trip["weather_description"];
                $sD-> temperature = $trip["temperature"];
                $sD-> humidity = $trip["humidity"];
                $sD-> visibility = $trip["visibility"];
                $sD-> road_type = $trip["road_type"];
                $sD-> latitude = $trip["latitude"];
                $sD-> longitude = $trip["longitude"];
                $sD-> altitude = $trip["altitude"];
                $sD-> accelerometerX = $trip["accelerometerX"];
                $sD-> accelerometerY = $trip["accelerometerY"];
                $sD-> accelerometerZ = $trip["accelerometerZ"];
                $t-> name = $trip["name"];
                //$t-> gender_name = $trip["gender_name"];
                $t-> model_name = $trip["model_name"];
                $t-> save();
                $sD-> save();
            });
        }
    
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function show(Trip $trip)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function edit(Trip $trip)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trip $trip)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trip $trip)
    {
        //
    }
}
