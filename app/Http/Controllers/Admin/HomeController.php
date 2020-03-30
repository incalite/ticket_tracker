<?php

namespace App\Http\Controllers\Admin;

class HomeController
{
    public function index()
    {
        $tickets = app('App\Http\Controllers\ticketController')->getTickets();
        $devs = app('App\Http\Controllers\ticketController')->getDevelopers();
        $clients = app('App\Http\Controllers\ticketController')->getClients();

        return view('home')->with([
            'tickets'       => $tickets,
            'developers'    => $devs,
            'clients'       => $clients
        ]);

        
    }
}
