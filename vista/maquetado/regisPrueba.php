<html>
	<head>
		<title>Registro</title>
		<?php include "head.html"?>
	</head>
	<body>
		<section id='registro'>
			<div class="card">
				<div class="card-header"><h2>Registro</h2></div>
				<div class="card-body">
					<form id='regis' action='../../modelo/PHP/regis.php' method='POST'>
						<div class="container">
							<div class="form-group">
								<label>Número de cuenta:</label>
								<input type='text' class="form-control" name='num_cta' pattern='^(31)[678][1-9]{6}' required/>
							</div>
							<div class="form-group">
								<label>Nombre de usuario:</label>
								<input type='text' class="form-control" name='user' pattern='[A-Za-z\d]{6,20}$' required/>
							</div>
							<div class="form-group">
								<label>Nombre:</label>
								<input type='text' class="form-control" name='nom' pattern='^[A-Z][a-záéíóú]+' required/>
							</div>
							<div class="form-group">
								<div class="form-row">
									<div class="col-md-4 mb-3">
										<label>Apellido paterno:</label>
										<input type='text' class="form-control" name='ape_pat' pattern='^[A-Z][a-záéíóú]+' required/>
									</div>
									<div class="col-md-4 mb-3">
										<label>Apellido materno:</label>
										<input type='text' class="form-control" name='ape_mat' pattern='^[A-Z][a-záéíóú]+' required/>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="form-inline">
									<label class="col-sm-2 col-form-label">Contraseña :</label>
									<input class="form-control mx-sm-3" type='text' class="form-control" name='contra' class='contrasena' id='pass1' required/>
									<small class="text-muted">
      							Must be 8-20 characters long.
    							</small>
								</div>
							</div>
							<div class="form-group">
								<div class="form-inline">
									<label class="col-sm-2 col-form-label">Confirma contraseña :</label>
									<input class="form-control mx-sm-3" type='text' class="form-control" name='contra2' class='contrasena' id='pass2' required/>
									<small class="text-muted">
      							Must be 8-20 characters long.
    							</small>
								</div>
							</div>
							<script>
							    $("#pass2").on("change",function(){
							        if($("#pass1").val() == $("#pass2").val()){
										$("#msj").html("<input class='btn btn-primary' class='btn btn-primary btn-l' type='submit'>");
									}
							        else{
										$("#msj").html("Las contraseñas no coinciden");
									}
							    });
							</script>
							<div id='msj'>
							</div>
						</div>
					</form>
				</div>
			</div>
		</section>
	</body>
	<script src='revisa.js'></script>
</html>
<script type= 'text/javascript' src='../../controlador/JS/nav_eventos.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js' integrity='sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49' crossorigin='anonymous'></script>
<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js' integrity='sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T' crossorigin='anonymous'></script>
