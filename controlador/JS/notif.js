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
            for(let count=0; count<numNotifis; count++)
				$("<li id="+notifis[count].id_not+">"+notifis[count].men_not+"</li><li class='divider'></li>").appendTo("#notifis");
		}
});
 $(document).ready(function(){
     $("nav #notifis").on("click", "li", function(){
			 			// console.log("Eres feo");
            let esteCoso = $(this).attr('id');
            // console.log(esteCoso);
            $.ajax({
        			url: '../../modelo/PHP/visto.php',
        			data:{
        				notif : esteCoso
        			},
        			type:'POST',
        			success: function(response){
        					// console.log(response);
        			}
        	});
 		});
    });
