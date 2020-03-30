@extends('layouts.admin')
@section('content')
<head>
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
</head>
<div class="content">
    <h3>Manage Clients</h3>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <table class="table table-striped text-center" style="border: 1px solid #eee">
                    <thead>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Client Since</th>
                        <th>Client Deletion</th>
                        <th>Operation</th>
                    </thead>
                    <tbody>
                        <tr class="bg bg-dark">
                            <form action="{{ URL::to('client/new') }}">   
                                <td><input type="text" name="in_name" class="form-control" placeholder="Client Fullname"></td>
                                <td><input type="text" name="in_email" class="form-control" placeholder="Client Email"></td>
                                <td><input type="text" name="in_phone" class="form-control" placeholder="Phone"></td>
                                <td><input type="date" name="in_register" class="form-control" placeholder="Date"></td>
                                <td><input type="text" name="in_deletion" class="form-control" placeholder="Date"></td>
                                       <td><input type="submit" value="Add" style="background: #eee; color: #222;"class="btn form-control"></td>
                            </form>
                        </tr>
                        @foreach($clients as $client)
                            <tr>
                                <td><?php print_r($client['client_fullname']); ?></td>
                                <td><?php print_r($client['client_email']); ?></td>
                                <td><?php print_r($client['client_phone']); ?></td>
                                <td><?php print_r($client['client_registration']); ?></td>
                                <td><?php 
                                    if (empty($client['client_deletion'])){
                                        echo "- active -";
                                    } else {
                                        print_r($client['client_deletion']);
                                    }
                                ?></td>
                                <td><a href="client/view/<?php print_r($client['client_id']); ?>"
                                    style="text-decoration: none; color: #fff; background: #222; font-weight: 500;" class="btn form-control">View</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

</div>
@endsection
@section('scripts')
