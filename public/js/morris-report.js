$.ajax({
type: "GET",
contentType: "application/json; charset=utf-8",
url: "http://localhost/truckingv2/public/getTop",
data: "",
dataType: "json",


success: function(data) {
    Morris.Donut({             
        element: 'donut-example',
        data:data
    });
}


});
 


