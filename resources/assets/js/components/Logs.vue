<template>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Plate Number</th>
  
            </tr>
        </thead>
        <tbody>
            <tr v-for="log in logs">
                    <td v-for="driver in log.drivers">
                        {{driver.name}}
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
            drivers: []
        };
    },

    filters: {
        moment: function (date) {
            return moment(date).format('Y-MM-DD h:m:s A');
        }
    },

    created(){
    axios.get('http://localhost/truckingv2/public/stream').then(response => this.logs = response.data);
    axios.get('http://localhost/truckingv2/public/get-drivers').then(response => this.drivers = response.data);
    }

}

	
</script>