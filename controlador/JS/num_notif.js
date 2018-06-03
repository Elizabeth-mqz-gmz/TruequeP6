$(document).ready(function(){
	$("#navbarDropdownNotif").on("click",function(){
		console.log("entré");
		$.ajax({
			    url: "../../modelo/PHP/num_notif.php",
			    data: {
			    },
			    type: "POST",
		            success: function(response){
						// console.log(response);
		                let notifNum = response;
		                $("#navbarDropdownNotif").html("Notificaciones<span class='badge badge-light'>"
							+notifNum+"</span>");
					}
		});
	});
});
