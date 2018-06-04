$(document).ready(()=>{
  n = document.cookie;
  jQuery.ajax({
      url:"modelo/PHP/cookie.php",
      type: "POST",
      data:{
        val : "1"
      },
      success: function(response){
          // console.log(response);
          if(response == "cookie")
            window.location="vista/maquetado/main.php";
        }
  });
});
