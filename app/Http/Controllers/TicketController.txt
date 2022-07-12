<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    public function index($search){
        if($search=='*'){
            return Ticket::orderBy('changed','DESC')->paginate(20);
        }
        return Ticket::where('title','LIKE','%'.$search.'%')->orderBy('changed','DESC')->paginate(20);
    }

    // retorna os tickets dependendo do parametro state e state_type
    public function getQueueState($queue,$state_type){ 
        if($queue == 'total'){
            return DB::table('tickets')->select('queue')->groupBy('queue')->where('state_type',$state_type)->count();
        }
        return DB::table('tickets')->select('queue')->groupBy('queue')->where('queue',$queue)->where('state_type',$state_type)->count();
    }
    public function ResolutionScore($queue)
    {
        if($queue == 'total'){
            return [
                DB::table('tickets')->select('state_type')->where('state_type',"open")->count(),
                DB::table('tickets')->select('state_type')->where('state_type',"closed")->count(),
                DB::table('tickets')->select('state_type')->where('state_type',"new")->count(),
                DB::table('tickets')->select('state_type')->where('state_type',"pending reminder")->count(),
            ];
        }
        return [
            DB::table('tickets')->select('state_type')->where('queue',$queue)->where('state_type',"open")->count(),
            DB::table('tickets')->select('state_type')->where('queue',$queue)->where('state_type',"closed")->count(),
            DB::table('tickets')->select('state_type')->where('queue',$queue)->where('state_type',"new")->count(),
            DB::table('tickets')->select('state_type')->where('queue',$queue)->where('state_type',"pending reminder")->count(),

        ];
    }
    public function TicketQueue($state_type)
    {   
        return DB::table('tickets')->select('queue', DB::raw('count(*) as total'))->where('state_type',$state_type)->groupBy('queue')->get();
    }
    public function getQueueTotal($queue){
        if($queue == 'total'){
            return DB::table('tickets')->select('queue')->count();
        }
        return DB::table('tickets')->select('queue')->where('queue',$queue)->count();
    }
    public function getQueues(){
        return DB::table('tickets')->select('queue')->groupBy('queue')->get()->pluck('queue');
    }
    public function getStateTypes(){
        return DB::table('tickets')->select('state_type')->groupBy('state_type')->get()->pluck('state_type');
    }
    public function getID($ticket_id){
        return DB::table('tickets')->select('*')->where('ticket_id',$ticket_id)->get()->first();
    }
    public function DatasCount($ano){
        return[
            DB::table('tickets')->select('changed')->where('state_type',"closed")->where('changed','LIKE',$ano.'-01-%')->get()->count(),
            DB::table('tickets')->select('changed')->where('state_type',"closed")->where('changed','LIKE',$ano.'-02-%')->get()->count(),
            DB::table('tickets')->select('changed')->where('state_type',"closed")->where('changed','LIKE',$ano.'-03-%')->get()->count(),
            DB::table('tickets')->select('changed')->where('state_type',"closed")->where('changed','LIKE',$ano.'-04-%')->get()->count(),
            DB::table('tickets')->select('changed')->where('state_type',"closed")->where('changed','LIKE',$ano.'-05-%')->get()->count(),
            DB::table('tickets')->select('changed')->where('state_type',"closed")->where('changed','LIKE',$ano.'-06-%')->get()->count(),
            DB::table('tickets')->select('changed')->where('state_type',"closed")->where('changed','LIKE',$ano.'-07-%')->get()->count(),
            DB::table('tickets')->select('changed')->where('state_type',"closed")->where('changed','LIKE',$ano.'-08-%')->get()->count(),
            DB::table('tickets')->select('changed')->where('state_type',"closed")->where('changed','LIKE',$ano.'-09-%')->get()->count(),
            DB::table('tickets')->select('changed')->where('state_type',"closed")->where('changed','LIKE',$ano.'-10-%')->get()->count(),
            DB::table('tickets')->select('changed')->where('state_type',"closed")->where('changed','LIKE',$ano.'-11-%')->get()->count(),
            DB::table('tickets')->select('changed')->where('state_type',"closed")->where('changed','LIKE',$ano.'-12-%')->get()->count(),
        ];   
    }
    
    public function Datas(){
        return[
            'Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'
        ];     
    }
    public function index2(){
        return Ticket::all();
    }
}