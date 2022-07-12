<?php

namespace App\Console\Commands;

use App\Models\Trip;
use Illuminate\Console\Command;
use  Illuminate\Support\Facades\Http;

class FetchTrips extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'trip:fetch';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Command description';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return int
	 */
	public function handle()
	{
		$this->getAllTripsNew();
	}
	// retorna o trip number, age e title dos trips new
	public function getAllTripsNew(){
		Trip::truncate();
		$response = Http::get('driver.jmvalente.pt/index.php/trip/viagem?iduser=1');
		$trip = $response->json()['Trip'][0];
		return [
			'TripID' => $trip['TripID'],
			'Title' => $trip ['Title'],
			'Age' => $trip['Age'],
			'TripNumber' => $trip['TripNumber'],
			'StateType' => $trip['StateType'],
			'Created' => $trip['Created'],
			'Owner' => $trip['Owner'],
			'Priority' => $trip['Priority'],
			'Changed' => $trip['Changed'],
			'Lock' => $trip['Lock'],
			'Queue' => $trip['Queue'],
			'Responsible' => $trip['Responsible'],
		];;
		for ($i=0; $i <count($res['TripID']); $i++) {

			$trip->each(function($trip){
				$t= new Trip();
				$t-> trip_id = $trip["TripID"];
				$t-> title = $trip["Title"];
				$t-> age = $trip["Age"];
				$t-> trip_number = $trip["TripNumber"];
				$t-> state_type = $trip["StateType"];
				$t-> created = $trip["Created"];
				$t-> owner = $trip["Owner"];
				$t-> priority = $trip["Priority"];
				$t-> changed = $trip["Changed"];
				$t-> lock = $trip["Lock"];
				$t-> queue = $trip["Queue"];
				$t-> responsible = $trip["Responsible"];
				$t-> save();
			});
		}
	}

}
