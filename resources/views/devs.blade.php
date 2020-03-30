@extends('layouts.admin')
@section('content')
<head>
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
</head>
<div class="content">
    Devs 
    <?php print_r($developers); ?>
</div>
@endsection
@section('scripts')
