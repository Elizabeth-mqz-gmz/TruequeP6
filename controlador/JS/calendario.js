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
  $("<div id='calendario'>").appendTo("#evento");

  for ( i in respuesta){
    respuesta[i].fecha = new Date(respuesta[i].fecha);
    mes = parseInt(respuesta[i].fecha.getMonth());
    mes ++;
    dia = respuesta[i].fecha.getDate() +"/"+ mes.toString() + "/"+ respuesta[i].fecha.getFullYear();
    hora = respuesta[i].fecha.getHours() + ":" + respuesta[i].fecha.getMinutes();
    let fecha = "<div >El día "+dia+" en el horario "+hora;//mientras no está súper definido como se mostrará el calendario, así no está todo muy amontonado
    let personas = " se encontrarán "+respuesta[i].id_em+" y "+respuesta[i].id_rec;
    let evento = "<h4>"+respuesta[i].tipo_even+"</h4>";
    let lugar = " en "+respuesta[i].lugar+"</div>";
    $("<div class='dropdown-item disabled'>"+ evento + fecha + personas +  lugar +"</div>").appendTo("#calendario");
    $("<div class='dropdown-divider'></div>").appendTo("#calendario");
  }
  $("</div>").appendTo("#evento");
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
  request.open("POST", ruta , true);
  request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  request.send();
}

function eliminar_eventos(){
  $(document).ready(function(){
    $("#calendario").remove();
  });
}
