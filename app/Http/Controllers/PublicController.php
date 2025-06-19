<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flight;
use Illuminate\Support\Facades\DB;

class PublicController extends Controller
{
    public function index()
    {
        $flights = Flight::orderBy('schedule', 'asc')->paginate(7);
        $runningText = DB::table('runningtexts')->where('key', 'running_text')->value('value');

        return view('public.jadwal', compact('flights', 'runningText'));
    }
}
