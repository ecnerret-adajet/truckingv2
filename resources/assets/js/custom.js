$(function () {

$(".select").select2({
placeholder: "Assign a RFID",
allowClear: true
});


$(".multiple").select2();


$(":file").filestyle({size: "sm", buttonName: "btn-primary", buttonBefore: true, buttonText: "Choose file"});

});//end