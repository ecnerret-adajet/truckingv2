<template>

<div class="row">
<div class="col-md-12">
<!-- <h2 style="margin-top: 0">Dashboard</h2> -->
                <section>
                <div class="tabs tabs-style-line">
                    <nav>
                        <ul>
                            <li><a href="#dashboard-line-1"><span>Latest Logs</span></a></li>
                            <li><a href="#dashboard-line-2"><span>In plant trucks</span></a></li>
                            <li><a href="#dashboard-line-3"><span>In transit trucks</span></a></li>
                        </ul>
                    </nav>
                    <div class="content-wrap">
                    <section id="dashboard-line-1">
                                <div class="row text-left">


                            <div class="col-md-12">

                              <div class="list-group tab-content">

                              <a href="#" v-for="log in logs" class="list-group-item">
                                <div class="row">
                                <div class="col-md-1">

                                </div>

                                <div class="col-md-10">
                                    <div class="row">
                                    <div class="col-md-3 text-left" v-for="driver in log.drivers">
                                     <span>Driver Name </span><br/>
                                            {{driver.name}}
                                    </div>
                                    <div class="col-md-3">
                                    <span>Plate Number</span><br/>
                                    <div v-for="driver in log.drivers">
                                        <div v-for="truck in driver.trucks">
                                        {{truck.plate_number}}
                                        </div>
                                    </div>
                                    </div><!-- end col-md-3-->
                                    <div class="col-md-3">
                                    <span>OPERATOR</span><br/>
                               
                                    <div v-for="driver in log.drivers">
                                        <div v-for="hauler in driver.haulers">
                                        {{hauler.name}}
                                        </div>
                                    </div>

                                    </div><!-- end col-md-3 -->
                                    <div class="col-md-3">
                                    <span>Customer</span><br/>
                                    
                                    <div v-for="customer in log.customers">
                                        {{customer.name}}
                                    </div>


                                    </div>
                                    </div><!-- end row -->


                                    <div class="row" style="margin-top: 10px;">
                                    <div class="col-md-3">
                                     <span>TIME IN </span><br/>



                                    </div>
                                    <div class="col-md-3">
                                    <span>TIME OUT</span><br/>
                             



                                    </div>
                                  <div class="col-md-3">
                                    <span>TIME BETWEEN</span><br/>
                             


                                    </div>

                                        <div class="col-md-3">
                                    <span>Customer Address</span><br/>
                                


                                    </div>
                                    </div><!-- end row -->

                                </div>
                                </div>
                              </a>
                      
                            </div>


                                </div>

                                </div>                            
                        </section>
                        <section id="dashboard-line-2">
                        <div class="row text-left">
                            <div class="col-md-12">
                         
                              <div class="list-group tab-content">
                            


                              <a href="#" class="list-group-item">
                                <div class="row">
                                <div class="col-md-1">


                              


                                </div>

                                <div class="col-md-8">
                                    <div class="row">
                                    <div class="col-md-3">
                                     <span>Driver Name </span><br/>
                                            


                                    </div>
                                    <div class="col-md-3">
                                    <span>Plate Number</span><br/>
                                       
                                    </div>
                                    <div class="col-md-3">
                                    <span>OPERATOR</span><br/>
                                     

                                    </div>
                                    <div class="col-md-3">
                                    <span>Customer</span><br/>
                                       CUSTOMER NAME
                                    </div>
                                    </div><!-- end row -->


                                    <div class="row" style="margin-top: 10px;">
                                    <div class="col-md-3">
                                     <span>TIME IN </span><br/>
                                                     


                                    </div>
                                    <div class="col-md-3">
                                    <span>TIME OUT</span><br/>
                               


                                    </div>
                                  <div class="col-md-3">
                                    <span>TIME BETWEEN</span><br/>
                            


                                    </div>
                                    </div><!-- end row -->

                                </div>
                                </div>
                              </a>
                            


                            </div>
                              </div><!--- end col-md-12 -->
                        </div><!-- end row -->
                        </section>
                        <section id="dashboard-line-3">
                              <div class="row text-left">
                            <div class="col-md-12">
                         
                              <div class="list-group tab-content">
                           



                              <a href="#" class="list-group-item">
                                <div class="row">
                                <div class="col-md-1">


                             

                                </div>

                                <div class="col-md-8">
                                    <div class="row">
                                    <div class="col-md-3">
                                     <span>Driver Name </span><br/>
                                        


                                    </div>
                                    <div class="col-md-3">
                                    <span>Plate Number</span><br/>
                                        

                                    </div>
                                    <div class="col-md-3">
                                    <span>OPERATOR</span><br/>
                                         


                                    </div>
                                    <div class="col-md-3">
                                    <span>Customer</span><br/>
                                       CUSTOMER NAME
                                    </div>
                                    </div><!-- end row -->


                                    <div class="row" style="margin-top: 10px;">
                                    <div class="col-md-3">
                                     <span>TIME IN </span><br/>
                                         
                                     <div v-for="timein in all_in">
                                        <div v-if="timein.LogID === log.LogID">
                                        {{timein.LocalTime}}
                                        </div>
                                     </div>

                                    </div>
                                    <div class="col-md-3">
                                    <span>TIME OUT</span><br/>
                             


                                    </div>
                                  <div class="col-md-3">
                                    <span>TIME BETWEEN</span><br/>
                            

                                    </div>
                                    </div><!-- end row -->

                                </div>
                                </div>
                              </a>
                           
                            </div>
                              </div><!--- end col-md-12 -->
                        </div><!-- end row -->
                        </section>
                    </div><!-- /content -->
                </div><!-- /tabs -->
            </section>



</div>
</div>
</template>

<script>
import moment from 'moment';
export default{
    data(){
        return {
            logs: [],
            all_in: []
        };
    },

    created(){
        axios.get('http://localhost/truckingv2/public/testLogs')
        .then(({data}) => this.logs = data);
        axios.get('http://localhost/truckingv2/public/getTimeIn')
        .then(({data}) => this.all_in = data);
    },

    computed: {
        getTimeIn(){
             return this.logs.filter(log => log.Direction == 1);
        },
        getTimeOut(){
         return this.logs.filter(log => log.Direction == 2);
        }
    },

    filters: {
        moment: function (date) {
            return moment(date).format('Y-MM-DD hh:mm:ss A');
        }
    }



}
</script>