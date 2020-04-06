@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-6">
            <div class="card" style="padding: 20px;">
                <h4>Ticket Overview  <form style="display: inline-block; vertical-align:middle;" action="{{ URL::to('ticket/drop') }}">
                <input type="hidden" name="id" value="{{ $current[0]['ticket_id'] }}">
                    <input type="submit" value="Drop Ticket (Can't be undone)" 
                    style="padding: 5px;" class="btn btn-outline-dark pull-right">
                </form></h4>
                <form action="{{ URL::to('ticket/update') }}">
                    <input type="hidden" name="id" value="{{ $current[0]['ticket_id'] }}">
                    <h6>Ticket Title</h6>
                    <input type="text" name="title" class="form-control" value="{{ $current[0]['ticket_title'] }}">
                    <h6>Ticket Description</h6>
                    <input type="text" name="desc" class="form-control" value="{{ $current[0]['ticket_desc'] }}">
                    <h6>Ticket Price</h6>
                    <label style="font-weight: 600; margin:0 10px;">Estimated price: $<?= $estimate ?></label>
                    <input type="number" name="price" class="form-control" value="{{ $current[0]['ticket_price'] }}">
                    <h6>Ticket Author</h6>
                    <input type="text" name="author" class="form-control" value="{{ $current[0]['ticket_author'] }}">
                    <h6>Ticket Assignment</h6>
                    <h6 style="padding-left: 10px;"><b><?= $current[0]['ticket_assign'] ?></b></h6> 
                    <h6>Ticket Deadline</h6>
                    <input type="text" name="deadline" class="form-control" value="{{ $current[0]['ticket_deadline'] }}">
                    <h6>Ticket Priority</h6>
                    <select name="priority" class="form-control">
                        <option value="<?= $current[0]['ticket_priority'] ?>"><?= ucfirst($current[0]['ticket_priority']) ?></option>
                        <?php if ($current[0]['ticket_priority'] == 'fair') { ?>
                            <option value="normal">Normal</option>
                            <option value="urgent">Urgent</option>
                        <?php } else if ($current[0]['ticket_priority'] == 'normal'){ ?>
                            <option value="fair">Fair</option>
                            <option value="urgent">Urgent</option>
                        <?php } else { ?>
                            <option value="fair">Fair</option>
                            <option value="normal">Normal</option>
                        <?php } ?>
                    </select>

                    <h6>Ticket Status</h6>
                    <select name="status" class="form-control">
                        <option value="<?= $current[0]['ticket_status'] ?>"><?= ucfirst($current[0]['ticket_status']) ?></option>
                        <?php if ($current[0]['ticket_status'] == 'open') { ?>
                            <option value="closed">Closed</option>
                            <option value="delayed">Delayed</option>
                            <option value="dropped">Canceled</option>
                        <?php } else if ($current[0]['ticket_status'] == 'closed'){ ?>
                            <option value="open">Open</option>
                            <option value="delayed">Delayed</option>
                            <option value="dropped">Canceled</option>
                        <?php } else if ($current[0]['ticket_status'] == 'delayed'){ ?>
                            <option value="open">Open</option>
                            <option value="closed">Closed</option>
                            <option value="dropped">Canceled</option>
                        <?php } else { ?> 
                            <option value="open">Open</option>
                            <option value="closed">Closed</option>
                            <option value="delayed">Delayed</option>
                        <?php } ?>
                    </select>
                    <input type="submit" value="Save Changes" 
                    style="margin-top: 20px;" class="btn btn-success pull-right">
                </form>
              
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card" style="padding: 20px;">
            <h4>Client Overview</h4>
            <?php if (count($client) > 0){ ?>
               <table class="table table-striped">
                    <tr>
                        <td>Client Fullname</td>
                        <td><?= $client[0]['client_fullname'] ?></td>
                    </tr>
                    <tr>
                        <td>Client Email</td>
                        <td><?= $client[0]['client_email'] ?></td>
                    </tr>
                    <tr>
                        <td>Client Phone</td>
                        <td><?= $client[0]['client_phone'] ?></td>
                    </tr>
                    <tr>
                        <td>Client Since</td>
                        <td><?= $client[0]['client_registration'] ?></td>
                    </tr>
            
               </table>
            <?php } ?>
        </div>
    </div>
</div>
@endsection
@section('scripts')