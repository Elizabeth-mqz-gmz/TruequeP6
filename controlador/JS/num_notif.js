$(document).ready(function(){
	$("#navbarDropdownNotif").on("click",function(){
		// console.log("entré");
		$.ajax({
			    url: "../../modelo/PHP/num_notif.php",
			    data: {
			    },
			    type: "POST",
		            success: function(response){
						// console.log(response);
		                let notifNum = response;
		                $("#navbarDropdownNotif").html("<i class='fa fa-bell-o' style='font-size:24px;color:#3D343F'></i><span class='badge badge-light'>"
							+notifNum+"</span>");
					}
		});
	});
});
