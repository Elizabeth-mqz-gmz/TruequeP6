function colores(elemento){
  var lienzo = elemento.getContext("2d");
  lienzo.lineWidth=1;
  lienzo.lineCap="round";
  var inicio;
  var colores =["#FBF8F7","#8FCED0","#E98836","#1919BEBE","#3D343F"]
  var aux = 0;

  var x=0;
  var z=0;
  function animacion(timer,color){
    if(aux<5)
      aux++;
    else
      aux = 0;

    if(!inicio)
      inicio=timer;
    var progreso = timer-inicio;
    x+=20;
    if (progreso<10000){
      lienzo.strokeStyle=colores[aux];
      if(x>155)
        x=0;
      x++;
      z+=20;
      if(z>1500)
        z=6;
      linea(0,0,x);
      lienzo.rotate(2*(Math.PI/180));
      lienzo.scale(3,1);
      requestAnimationFrame(animacion,color++);
    }
  }
  function linea(x,y,rax){
    var a=setInterval(()=>{
      lienzo.beginPath();
      lienzo.moveTo(-250,0);
      lienzo.lineTo(100,0);
      lienzo.moveTo(x,y);
      lienzo.arc(x,y-rax,rax,0,2*Math.PI,true);
      lienzo.stroke();
      lienzo.closePath();
    });
  }
  function anima(){
    requestAnimationFrame(animacion,0);
  }
  lienzo.translate(370,300);
    anima();
}
