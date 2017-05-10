<template>

<div class="search">

<div class="row">
<div class="col-md-12">
<div class="form-group{{ $errors->has('driver_number') ? ' has-error' : '' }}">
<label>Driver Number</label>
{!! Form::text('driver_number', null,  ['class' => 'form-control border-input','placeholder' => 'Driver Number']) !!}

</div>
</div>

</div>

<table class="table">
<thead>
<tr>
<th></th>
<th>Driver Name</th>
<th>Phone Number</th>
<th>Substitute</th>
<th>Operation</th>
</tr>

</thead>
<tbody>
<tr v-for="driver in drivers">
<td>
            <div class="dropdown">
              <button class="btn dropdown-toggle btn-sm" type="button" id="dropdownMenu1" data-toggle="dropdown">                                                        
                Option
                <span class="caret"></span>                                                        
              </button>
              <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">                                                        
                <li role="presentation"><a role="menuitem" tabindex="-1" >View Details</a></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" >Edit Driver</a></li>                                                        
                <li role="presentation" class="divider"></li>                                                        
                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Delete Driver</a></li>
              </ul>                                                        
            </div>
</td> 
<td>
{{driver.name}}
</td>
<td>
{{driver.phone_number}}
</td>
<td>
{{driver.substitute}}
</td>
<td v-for="hauler in driver.haulers">
{{hauler.name}}
</td>


</tr>
</tbody>
</table>


</div>

</template>

<script>
export default{

props: ['data','columns','filterKey'],

data() {
	return {
		drivers: [],
		gridColumns: ['name','power'],
		searchQuery: ''
	}
},

created(){
	axios.get('http://localhost/truckingv2/public/getDrivers')
	.then(response => this.drivers = response.data);
}



}// end export default
</script>