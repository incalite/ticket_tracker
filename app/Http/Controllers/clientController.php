<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class clientController extends Controller
{
    public function clients(){
        $activeClients = $this->getAllClients();
        return view('clients')->with([
            'clients' => $activeClients
        ]);
    }

    public function getAllClients(){
        $sql = DB::select('SELECT * FROM clients');
        $clients = json_decode(json_encode($sql), true);
        return $clients;
    }

    public function viewClient($id){
        $sql = DB::select('SELECT * FROM clients WHERE client_id = ' . $id);
        $client = json_decode(json_encode($sql), true);
        $tickets = $this->getTicketsOfClient($id);
        return view('client')->with([
            'current' => $client,
            'current_tickets' => $tickets
        ]);
    }

    public function editClient(Request $req){
        $id = htmlspecialchars($req->all()['id']);
        $name = htmlspecialchars($req->all()['fullname']);
        $email = htmlspecialchars($req->all()['email']);
        $phone = htmlspecialchars($req->all()['phone']);
        $since = htmlspecialchars($req->all()['since']);
        $status = htmlspecialchars($req->all()['status']);
        DB::table('clients')->where('client_id', $id)->update([
            'client_fullname' => $name, 
            'client_email' => $email, 
            'client_phone' => $phone, 
            'client_registration' => $since, 
            'client_deletion' => $status
        ]);

        return redirect('/client/view/'.$id);
    }

    public function new(Request $req){
        $name = htmlspecialchars($req->all()['in_name']);
        $email = htmlspecialchars($req->all()['in_email']);
        $phone = htmlspecialchars($req->all()['in_phone']);
        $date = htmlspecialchars($req->all()['in_register']);
        $deletion = htmlspecialchars($req->all()['in_deletion']);
        $exists = DB::select('SELECT * FROM clients WHERE client_email = "' . $email . '"');
        if (empty($exists)){
            DB::table('clients')->insert([
                'client_fullname' => $name,
                'client_email' => $email, 
                'client_phone' => $phone, 
                'client_registration' => $date,
                'client_deletion' => $deletion
            ]);
            $data = DB::select('SELECT * FROM clients WHERE client_email = "' . $email  . '"');
            $data = json_decode(json_encode($data), true);
            return redirect('/client/view/'.$data[0]['client_id']);
        } else {
            return redirect('clients');
        }
        
    }

    public function getTicketsOfClient($id){
        $data = DB::select('SELECT * FROM tickets WHERE client_id = ' . $id);
        $data = json_decode(json_encode($data), true);
        return $data;
    }

}
