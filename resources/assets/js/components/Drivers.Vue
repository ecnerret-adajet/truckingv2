<template>


<div>

    <div class="row" style="padding: 15px;">
        <div class="col-md-12">
                <div class="form-group">
                <input type="text" name="search" class="form-control border-input" placeholder="Search Driver" v-model="search" @keyup="fetchDataEmployee()">
            </div>
        </div>
    </div>


    <table class="table">
<thead>

<tr>
<th>Action</th>
<th>Name</th>

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


</tr>
</tbody>
</table>




</div>  

</template>

<script>
export default{

  data(){
    return {
        drivers: {},
        search: ''
    }
  },

  created() {
    this.fetchDataEmployee()
  },

  methods: {
    fetchDataEmployee() {
      if(this.seach == ''){
          axios.get(`http://localhost/truckingv2/public/search/drivers?search=${this.search}`)
         .then(response => this.drivers = response.data);
      }else {
          axios.get(`http://localhost/truckingv2/public/search/drivers?search=${this.search}`)
         .then(response => this.drivers = response.data);
      }

    }
  }



}
</script>
