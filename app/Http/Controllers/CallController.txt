<?php

namespace App\Http\Controllers;

use App\Models\Call;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Call::all();
    }
    public function duration()
    {
        return DB::table("calls")->select("duration")->orderBy("duration")->get();
    }
    public function clientes()
    {
        return DB::table("calls")->select("collaborator")->groupBy("collaborator")->get();
    }
    public function satisfaction_score()
    {
        return [
            DB::table('calls')->select('satisfaction_score')->where('satisfaction_score',1)->get()->count(),
            DB::table('calls')->select('satisfaction_score')->where('satisfaction_score',2)->get()->count(),
        ];
    }
    public function somaDuration()
    {
        return DB::table("calls")->get()->sum("duration");
    }
    public function somaReplyTime()
    {
        return DB::table("calls")->get()->sum("reply_time");
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
     * @param  \App\Models\Call  $call
     * @return \Illuminate\Http\Response
     */
    public function show(Call $call)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Call  $call
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Call $call)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Call  $call
     * @return \Illuminate\Http\Response
     */
    public function destroy(Call $call)
    {
        //
    }
}
