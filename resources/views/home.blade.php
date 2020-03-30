@extends('layouts.admin')
@section('content')
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<div class="content">
    <div class="row">
        <div class="col-lg-4">
            <div class="card" style="padding: 20px;">       
                <!-- TICKET CREATION -->
                <form action="{{ URL::to('/ticket/new') }}">
                    <h4>Create Ticket</h4>
                    <h6 style="margin-top:5px">Ticket Title</h6>
                    <input type="text" name="ticket_title" placeholder="e.g T498"
                    class="form-control" required style="display: block; margin-top: 5px;">
                    <h6 style="margin-top:5px;">Ticket Author</h6>
                    <input type="text" name="ticket_author" placeholder="e.g John Doe"
                    class="form-control" required style="display: block; margin-top: 5px;">
                    <h6 style="margin-top:5px">Ticket Description</h6>
                    <input type="text" name="ticket_desc" class="form-control" placeholder="e.g Need a new feature for the UI"
                     style="margin-top: 5px; resize: none;">
                    <h6 style="margin-top: 5px;">Ticket Client</h6>
                    <select name="ticket_client" class="form-control">
                        @foreach($clients as $cli)
                            <option value="{{ $cli->client_id }}">{{ $cli->client_fullname }}</option>
                        @endforeach
                    </select>
                    <h6 style="margin-top:5px">Ticket Assignment</h6>
                    <select name="ticket_assign" class="form-control">
                        @foreach($developers as $dev)
                            <option value="{{ $dev->dev_name }}">{{ $dev->dev_name }}</option>                                       
                        @endforeach
                    </select>
                    <h6 style="margin-top: 5px;">Ticket Deadline</h6>
                    <input id="deadline" type="date"name="ticket_deadline" class="form-control">
                    <h6 style="margin-top: 5px;">Ticket Priority</h6>
                    <select name="ticket_type" class="form-control">
                        <option value="fair">Fair</option>
                        <option value="normal">Normal</option>
                        <option value="urgent">Urgent</option>
                    </select>
                    <h6 style="margin-top:5px;">Ticket Status</h6>
                    <select name="ticket_status" class="form-control">
                        <option value="open">Open</option>
                        <option value="closed">Closed</option>
                        <option value="delayed">Delayed</option>
                        <option value="dropped">Canceled</option>
                    </select>
                    <input type="submit" value="Generate Ticket" class="btn btn-outline-dark pull-right"
                    style="margin-top: 5px;">
                </form>
                <!-- END OF TICKET CREATION -->
            </div>
        </div>
        
        <div class="col-lg-8">
            <div class="card" style="padding:20px">
                <h4>Search for Ticket</h4>
                <div id="search">
                    <input type="text" id="query" class="form-control" placeholder="e.g T939, t342, George Zafiris">
                    <button class="btn btn-dark pull-right" id="find" style="margin-top: 10px;">Search</button>
                </div>
                <table id="result" class="table table-striped" style="margin-top: 10px;">
                </table>
                <script>
                    $()
                    $('#find').on('click', () => {
                        $('#result').html("");
                        var query = $('#query').val();
                        query = query.toLowerCase();
                        var regex = /^\s*$/;
                        if (query.match(regex) != null){
                            $('#result').html("<tr><td>Not a valid query. Try again.</td></tr>");                
                        } else {
                            var result = [];
                            $.ajax({
                                method: 'get',
                                url: 'ticket/fetch',
                                success: (data) => {
                                    data.forEach(e => {
                                        var assign = e.ticket_assign.toLowerCase();
                                        var title = e.ticket_title.toLowerCase();
                                        if (assign.includes(query) || title == query || title.includes(query)){
                                            result.push({
                                                id: e.ticket_id, 
                                                author: e.ticket_author,
                                                deadline: e.ticket_deadline, 
                                                assign: e.ticket_assign,
                                                title: e.ticket_title,
                                                desc: e.ticket_desc
                                            });
                                        }
                                    });
                                    if (result.length == 0){
                                        $('#result').html("<tr><td>Not a valid query. Try again.</td></tr>");
                                        return;
                                    }
                                    result.forEach(elem => {
                                        $('#result').append("<tr><td>" + elem.title + "</td><td>" + elem.deadline + "</td><td>" + elem.assign + "</td><td>" + elem.author + "</td><td><a href='/ticket/edit/" + elem.id + "' class='btn btn-dark form-control' target='_blank'>View</td></tr>");
                                    });
                                    
                                }
                            });
                        } 
                    });
                </script>
            </div>

            <div class="card" style="padding: 20px;">
                <table class="table table-striped text-center">
                    <h4>All Tickets</h4>
                    <thead>
                        <th>Ticket</th>
                        <th>Deadline</th>
                        <th>Assigned To</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Operation</th>
                    </thead>

                    <tbody>
                        <?php if (count($tickets) != 0){ ?>
                        @foreach($tickets as $ticket)
                            <tr class="text-center">
                                <td style="font-weight: 600;">{{ $ticket->ticket_title }}</td>
                                <td>{{ $ticket->ticket_deadline }}</td>
                                <td>{{ $ticket->ticket_assign }}</td>
                                <td style="background-color: <?php 
                                    if ($ticket->ticket_priority == 'urgent'){
                                        echo '#ffaaaa;';
                                    } else if ($ticket->ticket_priority == 'fair'){
                                        echo '#ffc04d;';
                                    } else if ($ticket->ticket_priority == 'normal') {
                                        echo '#aaffaa;';
                                    } else {
                                        echo 'none;';
                                    }?>">
                                {{ $ticket->ticket_priority }}</td>
                                <td>{{ $ticket->ticket_status }}</td>
                                <td><a class="form-control btn btn-dark" style="text-decoration: none;" href="/ticket/edit/{{ $ticket->ticket_id }}">View</a></td>
                               
                            </tr>
                        @endforeach
                        <?php } else { ?>
                            <h5>No active tickets.</h5>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>


     
    </div>
</div>
@endsection
@section('scripts')
@parent

@endsection