<?php

namespace App\Console\Commands;

use App\Models\Ticket;
use Illuminate\Console\Command;
use  Illuminate\Support\Facades\Http;

class FetchTickets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ticket:fetch';

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
        $this->getAllTicketsNew();
    }
    // retorna o ticket number, age e title dos tickets new
    public function getAllTicketsNew(){
        Ticket::truncate();
        $response = Http::get('http://10.175.146.2/otrs/nph-genericinterface.pl/Webservice/GenericTicketConnectorREST/Ticket?UserLogin=sluis&Password=Szb6gwzEaEUAzsGj');
        $res = $response->json();
        for ($i=0; $i <count($res['TicketID']); $i++) { 

            $tickets=collect($res['TicketID'])->skip($i)->take(1)->map(function($id){
                $response = Http::get('http://10.175.146.2/otrs/nph-genericinterface.pl/Webservice/GenericTicketConnectorREST/Ticket/'.$id.'?UserLogin=sluis&Password=Szb6gwzEaEUAzsGj&AllArticles=1&DynamicFields=1');
                $ticket = $response->json()['Ticket'][0];           
                return [
                    'TicketID' => $ticket['TicketID'],
                    'Title' => $ticket ['Title'],                
                    'Age' => $ticket['Age'],
                    'TicketNumber' => $ticket['TicketNumber'],
                    'StateType' => $ticket['StateType'],
                    'Created' => $ticket['Created'],
                    'Owner' => $ticket['Owner'],
                    'Priority' => $ticket['Priority'],
                    'Changed' => $ticket['Changed'],
                    'Lock' => $ticket['Lock'],
                    'Queue' => $ticket['Queue'],
                    'Responsible' => $ticket['Responsible'],
                ];
            });
            $tickets->each(function($ticket){
                $t= new Ticket();
                $t-> ticket_id = $ticket["TicketID"];
                $t-> title = $ticket["Title"];
                $t-> age = $ticket["Age"];
                $t-> ticket_number = $ticket["TicketNumber"];
                $t-> state_type = $ticket["StateType"];
                $t-> created = $ticket["Created"];
                $t-> owner = $ticket["Owner"];
                $t-> priority = $ticket["Priority"];
                $t-> changed = $ticket["Changed"];
                $t-> lock = $ticket["Lock"];
                $t-> queue = $ticket["Queue"];
                $t-> responsible = $ticket["Responsible"];
                $t-> save();
            });
        }
    }
    
}
