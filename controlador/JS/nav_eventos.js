var click = 0;
  $('#botonEvento').on('click',()=>{
    if(click==0){
      obtener_calendario("../../controlador/PHP/calendario.php");
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
