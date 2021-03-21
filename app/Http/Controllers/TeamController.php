<?php

namespace App\Http\Controllers;

use App\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    
    public function index()
    {
        $teams = Team::with(['designation'=>function($query){
            $query->orderBy('order_priority','asc');
        }])->published()->get();
        return view('team', compact('teams'));
    }

}
