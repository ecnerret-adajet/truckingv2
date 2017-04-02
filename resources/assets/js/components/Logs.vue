<template>

              <table class="table table-striped">
                <thead>
                    <th>Cardholder ID</th>
                    <th>CardCode</th>
                    <th>Direction</th>
                </thead>
                <tbody>
                    <tr v-for="log in logs" :log="log">
                        <td>{{ log.CardholderID}}</td>
                        <td>{{ log.CardCode}}</td>
                        <td>{{ $log.Direction }}</td>
                    </tr>
                </tbody>
            </table>

</template>


<script type="text/javascript">
	export default{
		props: ['log']
	}
</script>