@extends('layouts.app')

@section('content')
<div class="container-fluid">
<div class="row">

<div class="col-lg-7 col-sm-7">



<div class="panel panel-primary">
<div class="panel-heading">
<p>Driver change truck logs </p>
</div>



<div class="row"> 
<div class="col-md-12">

<table class="table">
<thead>
<tr>
<th>Name</th>
<th>FROM</th>
<th>TO</th>
<th>RETURN</th>
<th>#</th>
</tr>
</thead>
<tbody>
@forelse($transfers->where('availability',1) as $transfer)
<tr>
<td>{{$transfer->driver->name}}</td>
<td>
{{$transfer->from_truck}}
</td>
<td class="danger">
{{$transfer->to_truck}}
</td>
<td>
{{ date('m-d-Y', strtotime($transfer->return_date)) }}
</td>
<td>
<a data-toggle="modal" data-target=".bs-mark{{$transfer->id}}" class="btn btn-primary btn-xs" href="">
MARK DONE
</a>
</td>
</tr> 
@empty
<tr>
<td colspan="5" class="text-center">
<span style="color: #c5c5c5; text-transform: uppercase; font-size: 14px;"><em>No transfer logs</em></span>
</td>
</tr>


@endforelse
</tbody>
</table>               
</div>
</div>

</div>



</div><!-- first panel -->



<div class="col-lg-5 col-sm-5">
<div class="panel panel-primary">
<div class="panel-heading">
<p> Top Drivers per trip: 2017</p>
</div>



<div class="row" style="padding: 20px;"> 
<div class="col-md-12">



<chart :labels="{{ $labels }}" 
:values="{{ $values }}"
></chart>

<!--  <table class="table">
<thead>
<tr>
<th>Driver Name</th>
<th>Number of trips</th>
</tr>
</thead>
@foreach($top_driver as $log)
<tr>
<td>                    
@foreach($log->drivers as $driver)
{{$driver->name}}
@endforeach
</td>
<td>
{{ $logs->where('CardholderID', $log->CardholderID)->count() }}
</td>



</tr>
@endforeach
</table>  -->

</div>
</div>


</div>
</div>


</div>












<div class="row">                
<!-- table  -->
<div class="col-md-12">
<div class="panel panel-default" >
<div class="panel-heading">
<h4 class="title">All Drivers

<a href="{{ url('/drivers/create') }}"  class="btn btn-primary btn-sm pull-right">
Add New Driver
</a>
</h4>
<p class="category">Total driver registered in the system</p>



</div>
<div class="content table-responsive table-full-width" id="feed">
<table class="table table-striped">

<thead>

<th></th>
<th>Driver Name</th>
<th>Plate Number</th>
<th>Phone Number</th>
<th>Substitute</th>
<th>Operator</th>
<th>Driver #</th>
<th></th>

</thead>
<tbody>
@foreach($drivers as $driver)


<tr>



<td>                                           
<img class="img-responsive img-circle" src="{{ str_replace( 'public/','', asset('/storage/app/'.$driver->avatar))}}" style="width: auto; height: 40px;">
</td>

<td>
{{$driver->name}}                                    
</td>

<td>
@foreach($driver->trucks as $truck)
{{$truck->plate_number}}
@endforeach

</td>

<td>
{{$driver->phone_number}}                                          
</td>
<td>
{{$driver->substitute}}
</td>
<td>
@foreach($driver->haulers as $hauler)
{{$hauler->name}}
@endforeach
</td>
<td>
{{$driver->cardholder->Name}}                                            
</td>

<td>
<div class="dropdown pull-right">
<button class="btn dropdown-toggle btn-sm" type="button" id="dropdownMenu1" data-toggle="dropdown">                                                        
<i class="fa fa-ellipsis-v"></i>                                                       
</button>
<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">    
<li role="presentation"><a role="menuitem" tabindex="-1" href="{{url('/drivers/'.$driver->id)}}"><i class="fa fa-file-o" aria-hidden="true"></i> <span class="hidden-xs">View Details</span></a></li>
<li role="presentation"><a role="menuitem" tabindex="-1" href="{{url('/drivers/'.$driver->id.'/edit')}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> <span class="hidden-xs">Edit Driver</span></a></li>                                                        
<li role="presentation"><a role="menuitem" tabindex="-1" href="{{ url('/transfers/create/'.$driver->id) }}"><i class="fa fa-share-square-o" aria-hidden="true"></i> <span class="hidden-xs">Re-assign Driver</span></a></li>                                                        
<li role="presentation" class="divider"></li>                                                        
<li role="presentation"><a data-toggle="modal" data-target=".bs-delete{{$driver->id}}-modal-lg" href=""><i class="fa fa-ban" aria-hidden="true"></i> <span class="hidden-xs">Deactivate Driver</span></a></li>
</ul>                                                        
</div>
</td>    

</tr>
@endforeach
</tbody>
</table>




</div>
</div>
</div>


</div><!-- end row -->
</div><!-- end containe-fluid-->

@foreach($transfers as $transfer)
<!-- Mark as don in transfer truck log -->
<div class="modal fade bs-mark{{$transfer->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style="display: none;">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title">Transfer Return</h4>
</div>
<div class="modal-body">
<div class="row">
<div class="col-md-12">
<div class="panel-body text-center"> 
<p>  
Please confirm to apply changes
</p>                        


</div>
</div>
</div>
</div>
<div class="modal-footer">

<form method="POST" action="{{ url('/transfers/remove/'.$transfer->id) }}">
{!! csrf_field() !!}

<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>

{!! Form::submit('Confirm', ['class' => 'btn  btn-primary'])  !!}


</form> 

</div>



</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->   

@endforeach

@foreach($drivers as $driver)


<!-- Document move to trash modal -->
<div class="modal fade bs-delete{{$driver->id}}-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title">Deactivate Driver</h4>
</div>
<div class="modal-body">
<div class="row">
<div class="col-md-12">
<div class="panel-body text-center"> 

<em>  
Are you sure you want to set this driver to inactive
</em>

</div>
</div>
</div>
</div>

<div class="modal-footer">
{!! Form::open(['method' => 'DELETE', 'route' => ['drivers.destroy', $driver->id]]) !!}
{!! csrf_field() !!}
<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
{!! Form::submit('Confirm', ['class' => 'btn  btn-primary'])  !!}                
{!! Form::close() !!}
</div>

</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->   


@endforeach


@endsection
