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
    if(publi == 0)
      $("<div id='publicaciones'><div id='trueque'>Trueques</div></div>").appendTo("#contenedorPubli");
    else
      $("<div id='publicaciones'><div id='trueque'>Pérdidas</div></div>").appendTo("#contenedorPubli");
  });
