
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

var publi = 0; //Saber en que html está, al inicio se encuentra en Trueque
  $('.cambio').on('click',()=>{
    boton = (publi == 0)? 1 : 0;
    $(".cambio").removeClass( "boton"+ publi.toString());
    $(".cambio").addClass("boton"+ boton.toString());
    publi = boton;
    $("#publicaciones").remove();
    if(publi == 0){
      $("<div id='publicaciones'><div id='trueque'>Trueques</div></div>").appendTo("#contenedorPubli");
      $("#contenedorPubli").html("");
      saca_publi("trueque");//IMPORTANTE saca eventos en index necesita funciones.js
    }
    else{
      $("<div id='publicaciones'><div id='trueque'>Pérdidas</div></div>").appendTo("#contenedorPubli");
      $("#contenedorPubli").html("");
      saca_publi("perdida");//IMPORTANTE saca eventos en index necesita funciones.js
    }
  });


  $("#buscar").on("click",()=>{
     var usuBuscado = $("#buscado").val();
     if ( usuBuscado != ""){
        let valida = new RegExp (/^(31)[6789][0-9]{6}/);
        if ( valida.test(usuBuscado) == true) {
             $.ajax({
                 url:"../../modelo/PHP/busca.php",
                 data:{
                  usuario : usuBuscado
                 },
                 type: "POST",
                 success: function(response){
                   if (response != "false"){
                      if (response == "existe"){
                        document.cookie = "usuBuscado="+usuBuscado+";max-age=2";
                        // setTimeout(()=>{
                          location.href ="perfil_usuario.php";
                        // },200);
                      }
                      else
                        alert("Lo siento, tu amigo no está registrado en esta plataforma");
                   }
                   else
                      alert("Ingresa un usuario válido");
                 }
             });
         }
        else
          alert("Ingresa un usuario válido");
      }
      else
        alert("Ingresa un número de cuenta para buscar");
  });
