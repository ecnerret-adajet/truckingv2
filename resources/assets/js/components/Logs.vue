<template>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Plate Number</th>
                <th>Operator</th>
                <th>IN</th>
                <th>OUT</th>
  
            </tr>
        </thead>
        <tbody>
                <tr v-for="log in logs">
                    <td v-for="driver in log.drivers">
                    <img class="img-responsive img-circle" :src=" 'http:/truckingv2/storage/app/' + driver.avatar  " style="display:block; margin: 10px auto; width: 50px; height: auto;">

                    </td> 

                    <td v-for="driver in log.drivers">
                        {{driver.name}}
                    </td>

                    <td v-for="driver in log.drivers">
                        <span v-for="ter in drivers">
                             <span v-if="ter.id == driver.id">
                                <span v-for="truck in ter.trucks">
                                    {{truck.plate_number}}
                                </span>
                             </span>
                        </span>
                    </td>

                    <td v-for="driver in log.drivers">
                        <span v-for="ter in drivers">
                             <span v-if="ter.id == driver.id">
                                <span v-for="hauler in ter.haulers">
                                    {{hauler.name}}
                                </span>
                             </span>
                        </span>
                    </td>



                    <td>
                        <span  v-for="time_in in ins"  v-if="log.CardholderID === time_in.CardholderID">
                            <span class="label label-success">
                                    {{ time_in.LocalTime | moment }}                            
                            </span>
                        </span>
                    </td>


                    <td>
                        <span  v-for="time_out in outs"  v-if="log.CardholderID === time_out.CardholderID">
                            <span class="label label-warning">
                                    {{ time_out.LocalTime | moment  }}                            
                            </span>
                        </span>
                    </td>

       






            </tr>
        </tbody>
    </table>


</template>


<script type="text/javascript">
export default{
    data() {
        return {
            logs: [],
            ins: [],
            outs: [],
            drivers: []
        };
    },

    filters: {
        moment: function (date) {
            return moment(date).format('Y-MM-DD hh:mm:ss A');
        }
    },

    created(){

    axios.get('http://localhost/truckingv2/public/getLogs')
    .then(response => this.logs = response.data);

    axios.get('http://localhost/truckingv2/public/getIns')
    .then(response => this.ins = response.data);

    axios.get('http://localhost/truckingv2/public/getOuts')
    .then(response => this.outs = response.data);

    axios.get('http://localhost/truckingv2/public/getDrivers')
    .then(response => this.drivers = response.data);    


    Echo.join('feedtruck')
            .listen('FeedTruck', (e) => {
                this.logs.push({

                });
            });

    
    }

}

	
</script>