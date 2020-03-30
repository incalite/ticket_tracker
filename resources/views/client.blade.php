@extends('layouts.admin')
@section('content')
<head>
<style>
h6 { margin-top: 5px; }
</style>
</head>
<div class="content">
    <div class="row">
        <div class="col-lg-4">
            <div class="card" style="padding: 20px;">
                <h4>Manage Client Details</h4>
                <form action="{{ URL::to('client/edit') }}">
                    <h6>Client Fullname</h6>
                    <input type="hidden" name="id" value="<?php print_r($current[0]['client_id']) ?>">
                    <input type="text" name="fullname" value="<?php print_r($current[0]['client_fullname']) ?>" class="form-control">
                    <h6>Client Email Address</h6>
                    <input type="text" name="email" value="<?php print_r($current[0]['client_email']) ?>" class="form-control">
                    <h6>Client Phone</h6>
                    <input type="text" name="phone" value="<?php print_r($current[0]['client_phone']) ?>" class="form-control">
                    <h6>Client Since</h6>
                    <input type="text" name="since" value="<?php print_r($current[0]['client_registration']) ?>" class="form-control">
                    <h6>Client Deletion</h6>
                    <input type="text" name="status" value="<?php print_r($current[0]['client_deletion']) ?>" class="form-control">
                    <input type="submit" value="Save Changes" class="btn btn-outline-dark pull-right" style="margin-top: 20px; ">
                </form>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card" style="padding:20px;">
                <h4>All Tickets</h4>
                <table class="table text-center">
                    <tr>
                        <th>Ticket</th>
                        <th>Description</th>
                        <th>Assigned</th>
                        <th>Deadline</th>
                        <th>Status</th>
                    </tr>
                    <?php foreach($current_tickets as $ticket){ ?> 
                        <tr>
                            <td><a href="/ticket/edit/{{ $ticket['ticket_id'] }}" class="btn btn-dark" style="padding: 2px 10px;"
                                target="_blank">{{ $ticket['ticket_title'] }}</a></td>
                            <td>{{ $ticket['ticket_desc'] }}</td>
                            <td>{{ $ticket['ticket_assign'] }}</td>
                            <td>{{ $ticket['ticket_deadline'] }}</td>
                            <td style="color:<?php 
                                if ($ticket['ticket_status'] == 'open'){
                                    echo "green;background:#eee;font-weight:600;";
                                } else if ($ticket['ticket_status'] == 'closed' || $ticket['ticket_status'] == 'dropped'){
                                    echo "red;background:#eee;";
                                } else if ($ticket['ticket_status'] == 'delayed'){
                                    echo "orange;background:#eee;";
                                }
                            ?>;">{{ $ticket['ticket_status'] }}</td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')