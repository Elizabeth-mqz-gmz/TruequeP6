var notifis;
$(document).ready(function(){
	$("#navbarDropdownNotif").on("click",function(){
		$("#notifis").children(".estoNo").empty();
			$.ajax({
				    url: "../../modelo/PHP/despliega_notif.php",
				    data: {
				    },
				    type: "POST",
			        success: function(response){
							// console.log(response);
			            notifis = JSON.parse(response);
			            // console.log(notifis);
			            let numNotifis = notifis.length;
			            for(let count=0; count<numNotifis; count++){
											// Para las notificaciones de reacción
											let pubReac  = ''+notifis[count].men_not+'';
											let chekReac = pubReac.split(" ");
											let patt = new RegExp("^31"); //revisa que sea un # de cuenta
											// console.log(chekReac);
										    let res = patt.test(chekReac[0]);
											if(res == true){
												chekReac.pop();
												// console.log(chekReac);
												var i = 0;
												var text = "";
												for (;chekReac[i];) {
					    							text += chekReac[i] + " ";
					    							i++;
												}
												// console.log(text);
												notifis[count].men_not = text;
											}
											if(notifis[count].visto == 0) //checa si ya la vió
												$("<div class='estoNo'><span class='navbar-text' id="+notifis[count].id_not+" style='cursor: pointer; background: #FBF8F7; color: #E98836; padding: 4%; text-align: left;'>"+notifis[count].men_not+"</span><div class='dropdown-divider'></div></div>").prependTo("#notifis");
											else
												$("<div class='estoNo'><span class='navbar-text' id="+notifis[count].id_not+" style='cursor: pointer; background: #FBF8F7; color: #19BEBE; padding: 4%; text-align: left;'>"+notifis[count].men_not+"</span><div class='dropdown-divider'></div></div>").prependTo("#notifis");
									}
					}
			});
	});
   $("nav #notifis").on("click", "span", function(){
          let idNotif = $(this).attr('id');
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
	$("nav #notifis").on("click", "span", function(){
      let tipoNotif = $(this).attr('id'); //obtiene el ID de la publicación
		   // console.log(tipoNotif);
		   let todoNotif = notifis.length;
		   for(let count=0; count<todoNotif; count++){ //revisa todas las notif, hasta encontrar la del ID
				if(notifis[count].id_not == tipoNotif)
					var menNotif = ''+notifis[count].men_not+''; //extrae el mensaje de la notif
			}
			let linkNotif = menNotif.split(" "); //lo hace array
			// console.log(linkNotif);
        	// console.log(linkNotif[2]);
	    let patt = new RegExp("^31"); //revisa que sea un # de cuenta
	    let res = patt.test(linkNotif[2]);
			if(res == true){
				document.cookie = "usuBuscado="+linkNotif[2]+";max-age=5"; //Hacer la cookie con el número de cuenta del usuario para perfil
		        location.href ="../../vista/maquetado/perfil_usuario.php";
			}

			//Para publicaciones
			let pubVal = patt.test(linkNotif[0]);
			if(pubVal == true){
				// console.log(linkNotif[8]);
				let patt = new RegExp("[0-9]"); //revisa que sea un # de cuenta
			  let res = patt.test(linkNotif[8]);
				if(res == true){
					document.cookie = "pub="+linkNotif[8]+";max-age=60";
					location.href ="../../vista/maquetado/publicacion.php";
				}
				let res2 = patt.test(linkNotif[9]);
				if(res2 == true){
					document.cookie = "pub="+linkNotif[9]+";max-age=60";
					location.href ="../../vista/maquetado/publicacion.php";
				}
			}
 	});
});
