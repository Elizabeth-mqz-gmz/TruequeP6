// console.log("Estoy en nav eventos");
var click = 0;
  $('#botonEvento').on('click',()=>{
    if(click==0){
      obtener_calendario("../../modelo/PHP/calendario.php");
      click = 1;
    }
    else {
      click = 0;
      eliminar_eventos();
    }
  });
  $('#evento').on('click',()=>{
    click = 0;
    eliminar_eventos();
  });

  $(document).ready(()=>{
    jQuery.ajax({
        url:"../../modelo/PHP/cookie.php",
        type: "POST",
        data:{
          val : "0"
        },
        success: function(response){
          if(response != ""){
            document.getElementsByTagName("nav")[0].setAttribute("style","background-color:#8FCED0");
            res = JSON.parse(response);
            BotonAdmi = $("<li class='nav-item active'><a class='nav-link' id='mensajes' href='"+res.ruta+"'>Administrador</a></li>");
            BotonAdmi.appendTo("#navbar");
          }
        }
    });
  });


  var publi = 0; //Saber en que html está, al inicio se encuentra en Trueque
    $('.cambio').on('click',()=>{
      boton = (publi == 0)? 1 : 0;
      $(".cambio").removeClass( "boton"+ publi.toString());
      $(".cambio").addClass("boton"+ boton.toString());
      publi = boton;
      $("#publicaciones").remove();
      if(publi == 0){
        $(".cambio").html("TRUEQUE");
        $("<div id='publicaciones'><div id='trueque'>Trueques</div></div>").appendTo("#contenedorPubli");
        $("#contenedorPubli").html("");
        saca_publi("trueque");//IMPORTANTE saca eventos en index necesita funciones.js
      }
      else{
        $(".cambio").html("PÉRDIDAS");
        $("<div id='publicaciones'><div id='trueque'>Pérdidas</div></div>").appendTo("#contenedorPubli");
        $("#contenedorPubli").html("");
        saca_publi("perdida");//IMPORTANTE saca eventos en index necesita funciones.js
      }
    });


  $("#buscar").on("click",()=>{
    // console.log("Estoy en buscar");
     var usuBuscado = $("#buscado").val(); //Tomar el valor del input
     if ( usuBuscado != ""){
        let valida = new RegExp (/^(31)[6789][0-9]{6}/); //Checar que meta un usuario válido
        if ( valida.test(usuBuscado) == true) {
             busca_usu(usuBuscado);
         }
        else
          ModalGlobal("Búsqueda","Ingresa un usuario válido");
      }
      else
        ModalGlobal("Búsqueda","Ingresa un número de cuenta para buscar");
  });

  $("#navbarDropdownChat").on("click",function(){ //Muestra todos los chats de la persona
    $.ajax({
        url:"../../modelo/PHP/todosLosChats.php",
        data:{ //Aquí no mando nada porque lo toma de la cookie con la que estamos trabajando, en php
        },
        type: "POST",
        success: function(response){ //response son los nombres de usuario de las personas con quienes ha chateado
            mostrar_chats(response);
        }
    });
	});
