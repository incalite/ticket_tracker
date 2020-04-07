@extends('layouts.admin')
@section('content')
<head>
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
</head>
<div class="content">
    <h3>Developers' Information</h3>
    <div class="card" style="padding: 20px;">
    <table class="table table-striped">
        <tr>
            <th>Fullname</th>
            <th>Email</th>
            <th>Ticket Counter</th>
        </tr>
        <?php foreach($developers as $dev){ ?>
            <tr>
                <td><?= $dev['dev_name']; ?></td>
                <td><?= $dev['dev_email']; ?></td>
                <td><?= $dev['dev_tickets']; ?> &times; tickets</td>
            </tr>
        <?php } ?>
    </table>
    </div>
</div>
@endsection
@section('scripts')
