// console.log("Estoy en nav eventos");

var todosLosUsuariosOf;
$.ajax({ //Este ajax es para traer todos los usuarios registrados y trabajar con eso
  url:"../../modelo/PHP/todos_los_ususs.php",
  data:{
  },
  type: "POST",
  success:function(response){
      // console.log(res);
      if(response!="null") //creo que nunca sería null, pero por si las moscas jaja
          todosLosUsuariosOf = JSON.parse(response);
      for (let i in todosLosUsuariosOf)
          if (todosLosUsuariosOf[i].usuario == "usuarioOf"){
              nombreUsuarioOf = todosLosUsuariosOf[i].nomus;
              comentario(n); //Aquí manda un error de que n no está definida, pero no causa problemas
          }
  }
});

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
    $('.cambio').on('click',(ev)=>{
      largo = window.innerWidth -140;
      boton = (publi == 0)? 1 : 0;//quitar o colocar clase para que se esté en la izquierda o la derecha
      // $(".cambio").removeClass( "boton"+ publi.toString());
      //$(ev.target).attr("style","background-color:pink;") //Amiga ya lo cambié, pero se descompone):
      publi = boton;
      if (publi == 1){
        $("#cambio").animate({ "left": "+="+largo+"px" }, 3000 , "linear", function(){botones(publi);});
        $("#izquierda").animate({"width" : "+="+largo+"px" }, 3000 , "linear", function(){$("#izquierda").attr("style","width:0;")})
      }
      else if (publi == 0){
        $("#cambio").animate({ "left": "-="+largo+"px" }, 3000 , "linear", function(){botones(publi);});
        $("#derecha").animate({"width" : "+="+largo+"px", "left": "-="+largo+"px" }, 3000 , "linear", function(){$("#derecha").attr("style","width:0;")})
      }
      // $(".cambio").addClass("boton"+ boton.toString());
      // $(".cambio").addClass("boton"+ boton.toString());
      $("html").stop().animate({scrollTop:0}, 500, 'swing');
      // $(ev.target).attr("style","background-color:#E98836;");
       // $( ".block" ).animate({ "left": "+=50px" }, "slow" );
      // $("html").animate({scrollTop:0}, 500, 'swing');
    });

    //BUSQUEDA DE USUARIO
$("#buscado").keydown(()=>{
      let hay = false;
      let buscado = $("#buscado").val();
        // console.log(buscado);
      if (buscado != ""){

          $("#buscadillo").children("li").remove(); //Para que sólo los muestre una vez
          let reg = new RegExp ("^("+buscado+")","i");
          // console.log(reg);
          for (let i in todosLosUsuariosOf)
            if( (reg.test(todosLosUsuariosOf[i].nomus) || reg.test(todosLosUsuariosOf[i].usuario)) && todosLosUsuariosOf[i].usuario != "usuarioOf" ){
              $("#buscadillo").append("<li class='despliega des-bus' id='"+i+"' style=padding: 4%; text-align: left; border-top: gray;>"+todosLosUsuariosOf[i].nomus+"</li>");
              hay = true;
            }
          if (!hay) //No se encontró nada en la búsqueda
              $("#buscadillo").append("<li class='despliega des-bus' style=padding: 4%; text-align: left; border-top: gray;>No se encontró usuario</li>");
          // $("#buscadillo").append("<li class='despliega des-bus' style=padding: 4%; text-align: left; border-top: gray;></li>"); //Para que alcance a agarrar todo jsjsj

      }
    });

  $("#buscadillo").mouseleave(()=>{
    $("#buscadillo").children("li").empty();
  });

  $("#buscadillo").click(()=>{
      // console.log("Hola mundo");
      var ind = event.target.id;
      document.cookie = "usuBuscado="+todosLosUsuariosOf[ind].usuario+";max-age=5"; //Hacer la cookie con el número de cuenta del usuario con el que quiere
      location.href ="../../vista/maquetado/perfil_usuario.php";
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

  $("#nuevoChat").click(()=>{
    chat_nuevo();
  });

//footer
$(" .icono").on("mouseover",()=>{
  let Perfil = event.target.getAttribute("perfil");
  $("<h5 class='remover'>"+Perfil+"</h5>").appendTo("#PerfilFacebook");
});
$(" .icono").on("mouseout",()=>{
  $(".remover").remove();
});
