<template>

<div id="donut-example"></div>

</template>


<script>
export default{

mounted(){

 new Morris.Donut({
  element: 'donut-example',
  data: [
    {label: "Download Sales", value: 12},
    {label: "In-Store Sales", value: 30},
    {label: "Mail-Order Sales", value: 20}
  ]
});

},

created(){
    axios.get('http://172.17.2.88/rfidtrucking/public/getTop')
    .then(response => this.donutData = response.data);

}



} // end export default


</script>