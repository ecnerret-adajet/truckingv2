<template>

<div class="driver_data">


<div class="col-md-12">
<div class="form-group">
<input type="text" name="search" v-model="search"  placeholder="Enter your search" class="form-control border-input">
</div>
</div>


<table class="table">
<thead>

<tr>
<th>Action</th>
<th>Name</th>
<th>Phone Number</th>
<th>Substitute</th>
<th>Operator</th>
</tr>

</thead>
<tbody>

<tr v-for="driver in drivers | searchQuery" >
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
props: ['data'],
data() {
	return {
    searchQuery: '',
    drivers: [],
    url: 'getDrivers'
  }
},

created() {
	axios.get('http://localhost/truckingv2/public/getDrivers')
	.then(response => this.drivers = response.data);
},
  
methods: {
  fechDataDriver(){

  }
}



}// end export default
</script>