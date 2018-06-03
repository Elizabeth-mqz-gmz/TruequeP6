$(document).ready(function(){
	$("#navbarDropdownNotif").on("click",function(){
		$("#notifis").children("li").empty();
			$.ajax({
				    url: "../../modelo/PHP/despliega_notif.php",
				    data: {
				    },
				    type: "POST",
			            success: function(response){
							// console.log(response);
			            var notifis = JSON.parse(response);
			            // console.log(notifis);
			            let numNotifis = notifis.length;
			            for(let count=0; count<numNotifis; count++){
							$("<li id="+notifis[count].id_not+" style=padding: 4%; text-align: left; border-top: gray;>"+notifis[count].men_not+"</li>").appendTo("#notifis");
						}
					}
			});
	});
});
 $(document).ready(function(){
     $("nav #notifis").on("click", "li", function(){
            let idNotif = $(this).attr('id');
			// $(idNotif).children("li").css("cursor", "pointer");
            // console.log(idNotif);
            $.ajax({
        			url: '../../modelo/PHP/visto.php',
        			data:{
        				notif : idNotif
        			},
        			type:'POST',
        			success: function(response){
        					// console.log(response);
        			}
        	});
 	});
});
