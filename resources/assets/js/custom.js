$(function () {

$(".select").select2({
placeholder: "Assign a RFID",
allowClear: true
});

$(":file").filestyle({size: "sm", buttonName: "btn-primary", buttonBefore: true, buttonText: "Choose file"});

});//end