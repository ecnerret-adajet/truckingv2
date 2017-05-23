<template>

<div class="wrap-element">


          <div class="row">
                    <div class="col-lg-6 col-sm-6">
                        <div class="card">
                            <div class="content">
                                <div class="row"> 
                                    <div class="col-md-12 text-center">
                                    <i style="font-size: 70px;
                                            color: #a9a9a9;
                                             " class="pe-7s-helm"></i>
                                        <p>{{trucks.length}} Total Trucks</p>

                                        <a class="btn btn-primary btn-sm" href="#">
                                        Back to dashboard
                                        </a>
               
                                    </div>
                                </div>
                                <div class="footer text-center" style="padding-top: 20px;">
                                <hr/>
                                   <small class="stats" style="text-transform: uppercase; font-size: 10px;">
                                        <i class="ti-timer"></i> As of today
                                  </small>
                                </div>
                            </div>
                        </div>
                    </div>




                    <div class="col-lg-6 col-sm-6">
                        <div class="card">
                            <div class="content">
                                <div class="row"> 
                                     <div class="col-md-6 text-center">
                                    <i style="font-size: 70px;
                                            color: #a9a9a9;
                                             " class="pe-7s-check"></i>
                                        <p>{{getActive.length}} Active Trucks</p>


                                        <button class="btn btn-success btn-sm">
                                        ACTIVE
                                        </button>
               
                                    </div>
                                     <div class="col-md-6 text-center">
                                    <i style="font-size: 70px;
                                            color: #a9a9a9;
                                             " class="pe-7s-close-circle"></i>
                                     <p>{{getInactive.length}} Inactive Trucks</p>
                                              
                                         <button class="btn btn-warning btn-sm">
                                        INACTIVE
                                        </button>

                                    </div>
                                    </div>
                                </div>
                                <div class="footer text-center" style="padding-top: 20px;">
                                <hr/>
                                <a href="#">
                                   <small  style="text-transform: uppercase; font-size: 10px;">
                                         View all
                                  </small>
                                  </a>
                                </div>
                            </div>
                        </div>
                    </div>     




<div class="row">                
                <!-- table  -->
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Trucks Master List
                                <a class="btn btn-primary btn-sm pull-right" href="#">
                                Add New Truck
                                </a>
                                </h4>
                                <p class="category">Total Hauler registered in the system</p>
                                
                            </div>
                            <div class="content table-responsive table-full-width" id="feed">
                     

                        
                            <hr/>

                              <table class="table table-striped">
                                    <thead>
                                    <tr>
                                           <th>Plate Number</th>
                                        <th>Vehicle Type</th>
                                        <th>Capacity</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="truck in trucks">
                                            <td>
                                              {{truck.plate_number}}                                    
                                            </td>
    
                                            <td>
                                            {{truck.vehicle_type}}                                          
                                            </td>
                                            <td>
                                            {{truck.capacity}}
                                            </td>
                                        
                                        </tr>
                                    </tbody>
                                </table>




                            </div>
                        </div>
                    </div>


                </div><!-- end row -->


</div><!-- end wrap element -->
</template>
<script>
export default{
	data(){
		return {
			trucks: []
		}
	},

	created(){
		axios.get('http://localhost/truckingv2/public/getTrucks')
		.then(({data}) => this.trucks = data);
	},

    computed: {
        getActive(){
            return this.trucks.filter(truck => truck.availability == 1);
        },
        getInactive(){
            return this.trucks.filter(truck => truck.availability == 0);
        }  
    }

}
</script>