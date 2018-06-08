$.ajax({
  url:"../../modelo/PHP/todas_las_publis.php",
  data:{ //No puse nada porque devuelve tooodas las publicaciones
  },
  type: "POST",
  success:function(response){
      if(response!="null"){ //creo que nunca sería null, pero por si las moscas jaja
          var publis = [];
          publis = response.split(",");
          // console.log(publis);
          publis.pop(); publis.shift(); //Había un problema raro, no sé qué pasaba, pero ésto lo soluciona :), creo que era por las , que mandamos en php
          for (let v of publis)
              publicacion(v,false,()=>{ //Hacer las publicaciones
                  $("#"+v+" .btn").one("click",()=>{
                      document.cookie = "pub="+v+";max-age=60";
                  });
              });
      }
  }
});
