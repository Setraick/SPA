<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FullCalenderController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\DetailsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\SeachController;
use App\Http\Controllers\CallController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Details
Route::get('/details/{id}',[TicketController::class,'getID'])->name('details.getID');

// search
Route::get('/search1',[SeachController::class,'getallTickets'])->name('SeachController.getallTickets');
// Rotas tickets
Route::get('/ticket2',[TicketController::class,'index'])->name('ticket.getAllTicketsNew2');
Route::get('/ticket3',[TicketController::class,'index'])->name('ticket.getAllTicketsNew3');
// Route::get('/ticket/{state}',[TicketController::class,'getState'])->name('ticket.getState');
// Route::get('/ticket/{QueueIDs}/{state}',[TicketController::class,'getQueueStatee'])->name('ticket.getQueueStatee');

Route::get('/ticket/{search}',[TicketController::class,'index'])->name('ticket.getAllTicketsNew');
Route::get('/queueSate/{queue}/{state_type}',[TicketController::class,'getQueueState']);
Route::get('/queueTotal/{queue}',[TicketController::class,'getQueueTotal']);
Route::get('/queues',[TicketController::class,'getQueues']);
Route::get('/stateTypes',[TicketController::class,'getStateTypes']);
Route::get('/calls',[CallController::class,'index'])->name('call.id');
Route::get('/collaborator',[CallController::class,'clientes'])->name('call.clientes');
Route::get('/duration',[CallController::class,'duration'])->name('call.duration');
Route::get('/ResolutionScore/{queue2}',[TicketController::class,'ResolutionScore'])->name('ticket.ResolutionScore');
Route::get('/TicketQueue/{state_type}',[TicketController::class,'TicketQueue'])->name('ticket.TicketQueue');
Route::get('/satisfaction_score',[CallController::class,'satisfaction_score'])->name('call.satisfaction_score');
Route::get('/duration',[CallController::class,'duration'])->name('call.duration');
Route::get('/somaDuration',[CallController::class,'somaDuration'])->name('call.somad');
Route::get('/somaReplyTime',[CallController::class,'somaReplyTime'])->name('call.somar');
Route::get('/allowed',[UserController::class,'allowed']);
Route::get('/dataCount/{ano}',[TicketController::class,'DatasCount']);
Route::get('/tickets',[TicketController::class,'index2']);

Route::prefix('admin')->middleware('auth')->name('admin.')->group(function(){
    Route::resource('/users',UserController::class);
    
});



//Pagina inicial
Route::get('/', function () {
    if (Auth::check()) {
     return view('dashboard');
    }
    return view('welcome');
});

Route::get('register', [RegisteredUserController::class, 'create']);

// Rotas calendario
Route::get('/full-calender', [FullCalenderController::class, 'index']);
Route::post('/full-calender/action', [FullCalenderController::class, 'action']);

require __DIR__.'/auth.php';

Route::get('{any}', function(){
    return view('dashboard');
})
    ->where('any', '.*')
    ->middleware('auth')
    ->name('dashboard');


