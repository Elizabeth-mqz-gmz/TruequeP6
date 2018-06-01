
$(document).ready(function(){
    $('.contrasena').change(function(){
    	var pass = $(this).val();
        var regis = $('#regis');
    	// console.log(pass);

    	$.ajax({
    			url: 'controlador/PHP/validarPass.php',
    			data:{
    				"pass":	pass,
    			},
    			type:'POST',
    			success: function(response){
    				if (response != '1'){
    					// console.log(response);
    					 res = response;
    					if (res == 'F'){
                            alert('Su contraseña es invalida');
                            regis[0].reset();
    					}
    					// else{
    					// 	console.log(res);
    					// }
    				}
    				// else{
    				// 	console.log('sin resultados');
    				// }
    			}
    	});
    });
});
