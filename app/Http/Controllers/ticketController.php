<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ticketController extends Controller
{
    public function getTicket($id){
        $ticket = DB::select('SELECT * FROM tickets WHERE ticket_id = ' . $id);
        $current = json_decode(json_encode($ticket), true);
        $client = $current[0]['client_id'];
        $info = DB::select('SELECT * FROM clients WHERE client_id = ' . $client);
        $clientInfo = json_decode(json_encode($info), true);
        return view('ticket')->with([
            'current' => $current,
            'client' => $clientInfo
        ]);
    }

    public function update(Request $req){
        $data = $req->all();
        $id = $data['id'];
        DB::table('tickets')->where('ticket_id', $id)->update([
            'ticket_title' => $data['title'],
            'ticket_desc' => $data['description'],
            'ticket_author' => $data['author'],
            'ticket_deadline' => $data['deadline'],
            'ticket_priority' => $data['priority'],
            'ticket_status' => $data['status']
        ]);
        
        return redirect('/ticket/edit/'.$id); 
    }

    public function drop(Request $req){
        $data = $req->all();
        $ticketID = $data['id'];
        $ticketInfo = DB::select('SELECT * FROM tickets WHERE ticket_id = ' . $ticketID);
        $ticketInfo = json_decode(json_encode($ticketInfo), true);
        print_r($ticketInfo);
        $exists = DB::select('SELECT ticket_id FROM ticket_logs WHERE ticket_id = '. $ticketID);
        if (empty($exists)){
            DB::table('ticket_logs')->insert([
                'ticket_developer' => $ticketInfo[0]['ticket_assign'],
                'ticket_deadline' => $ticketInfo[0]['ticket_deadline'],
                'ticket_title' => $ticketInfo[0]['ticket_title'],
                'ticket_client' => $ticketInfo[0]['client_id'],
                'ticket_id' => $ticketInfo[0]['ticket_id']
            ]);
        }
        $present = DB::select('SELECT * FROM tickets WHERE ticket_id = '. $ticketID);
        if (!empty($present)){
            DB::select('DELETE FROM tickets WHERE ticket_id = ' . $ticketID);
        }
        return redirect('home');
        
    }

    public function add(Request $req){
        $data = $req->all();
        $ticket[] = array(
            'title' => (!empty($data['ticket_title'])) ? $data['ticket_title'] : '',
            'author' => (!empty($data['ticket_author'])) ? $data['ticket_author'] : '',
            'description' => (!empty($data['ticket_desc'])) ? $data['ticket_desc'] : '',
            'assigned' => (!empty($data['ticket_assign'])) ? $data['ticket_assign'] : '',
            'deadline' => (!empty($data['ticket_deadline'])) ? $data['ticket_deadline'] : '',
            'type' => (!empty($data['ticket_type'])) ? $data['ticket_type'] : '',
            'status' => (!empty($data['ticket_status'])) ? $data['ticket_status'] : '',
            'client' => (!empty($data['ticket_client'])) ? $data['ticket_client'] : 0
        );

        if (!empty($ticket[0]['title']) && !empty($ticket[0]['author']) && !empty($ticket[0]['description']) &&
            !empty($ticket[0]['assigned']) && !empty($ticket[0]['type']) && !empty($ticket[0]['status'])){
            DB::table('tickets')->insert([
                'ticket_title' => $ticket[0]['title'],
                'ticket_desc' => $ticket[0]['description'],    
                'ticket_author' => $ticket[0]['author'],
                'ticket_assign' => $ticket[0]['assigned'],
                'ticket_deadline' => $ticket[0]['deadline'],
                'ticket_priority' => $ticket[0]['type'],
                'ticket_status' => $ticket[0]['status'],
                'client_id' => $ticket[0]['client']
            ]);
        }
        return redirect('home');
   }


   public function findTicket(){
        $all = $this->getTickets();
        $all = json_decode(json_encode($all), true);
        return $all;
   }

   public function getTickets(){
        $data = DB::select("SELECT * FROM tickets ORDER BY ticket_id DESC");
        return $data;     
   }

   public function getDevelopers(){
       $data = DB::select("SELECT * FROM developers");
       return $data;
   }

   public function getClients(){
       $data = DB::select("SELECT * FROM clients");
       return $data;
   }
  
}
