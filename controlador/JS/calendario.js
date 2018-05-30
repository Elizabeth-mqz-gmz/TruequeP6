function ordenar_eventos(respuesta){
  let ayu= [], ayu2=[];
  for (i in respuesta){
    respuesta[i].fecha = new Date (respuesta[i].fecha).getTime();//convertir la fecha para poder hacer una comparación
    ayu[i] = respuesta[i].fecha;
    }
  ayu=ayu.sort(function(a,b){return a+b});
  for (i in ayu){
    for (ind in respuesta){
      if (ayu[i] == evento[ind].fecha)
        ayu2[i] = evento[ind];
      }
    }
  evento = ayu2;
}

function hacer_calendario (respuesta) {
  for ( i in respuesta){
    let fecha = '<p>El día '+new Date(respuesta[i].fecha)+'</p>';//mientras no está súper definido como se mostrará el calendario, así no está todo muy amontonado
    let personas = '<p>asistirán '+respuesta[i].id_em+' y '+respuesta[i].id_rec+'</p>';
    let evento = '<h2>'+respuesta[i].tipo_even+'</h2>';
    let lugar = '<p> En '+respuesta[i].lugar+'</p>';
    $('<div>'+ evento + fecha + personas +  lugar +'</div>').appendTo('#calendario');

  }
}

function obtener_calendario (ruta){
  let request = new XMLHttpRequest();
  request.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
      evento = JSON.parse(this.response);
      ordenar_eventos(evento);
      hacer_calendario(evento);
    }
  };
  request.open('POST', ruta , true);
  request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  request.send();
}

obtener_calendario('../../controlador/PHP/calendario.php');
