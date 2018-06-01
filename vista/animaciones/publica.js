$("#perd").hide();
$("#numCred").hide();

$("#radioPerd").on("focus",()=>{
    $("#perd").show();
});

$("#radioCred").on("focus",()=>{
    $("#numCred").show();
});

$(".radioNoCred").on("focus",()=>{
    $("#numCred").hide();
});

$(".radioTrue").on("focus",()=>{
    $("#perd").hide();
});
