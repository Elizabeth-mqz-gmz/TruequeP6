<script type='text/javascript' src='../../librerias/jquery-3.3.1.min.js'></script>

<section id='registro'>
	<div class="card ">
		<div class="card-body">
			<form id='regis' action='modelo/PHP/regis.php' method='POST' enctype='multipart/form-data'>
				<div class="container">
					<div class="form-group">
						<label class="formtexto">Número de cuenta:</label>
						<input id='num_cta' type='text' class="form-control" name='num_cta' pattern='^(31)[6789][0-9]{6}' required/>
						<div></div>
					</div>
					<div class="form-group">
						<label class="formtexto">Nombre de usuario:</label>
						<input id='user' type='text' class="form-control" name='user' pattern='[A-Za-z\d]{6,30}$' required/>
						<div></div>
						<small class="text-muted">
							Debe comenzar con mayúsculas, mínimo 6 caracteres.
						</small>
					</div>
					<div class="form-group">
						<label class="formtexto">Nombre:</label>
						<input id='nom' type='text' class="form-control" name='nom' pattern='^[A-Z][a-záéíóú]{3,30}$' required/>
						<div></div>
						<small class="text-muted">
							Debe comenzar con mayúsculas.
						</small>
					</div>
					<div class="form-group">
						<label class="formtexto">Apellido paterno:</label>
						<input id='ape_pat' type='text' class="form-control" name='ape_pat' pattern='^[A-Z][a-záéíóú]{3,30}$' required/>
						<div></div>
						<small class="text-muted">
							Debe comenzar con mayúsculas.
						</small>
					</div>
					<div class="form-group">
						<label class="formtexto">Apellido materno:</label>
						<input id='ape_mat' type='text' class="form-control" name='ape_mat' pattern='^[A-Z][a-záéíóú]{3,30}$' />
						<div></div>
						<small class="text-muted">
							Debe comenzar con mayúsculas.
						</small>
					</div>
					<div class="custom-file">
						<input type="file" name='imagen' accept='image/png' class="custom-file-input" id="validatedCustomFile">
						<label class="custom-file-label" for="validatedCustomFile">Elige una imagen</label>
					</div>
					<div class="form-group">
						<label class="formtexto">Contraseña :</label>
						<input class="form-control mx-sm-3" type='password' class="form-control contrasena" name='contra' id='pass1' required/>
						<div></div>
						<small class="text-muted">
							De 8-20 caracteres, al menos una mayúscula, una minúscula, un número y un caracter especial.
						</small>
					</div>
					<div class="form-group">
						<label class="formtexto">Confirma contraseña :</label>
						<input class="form-control mx-sm-3" type='password' class="form-control contrasena" name='contra2'  id='pass2' required/>
						<div></div>
					</div>
					<div id='msj'>
						<input class='btn btn-success' id='enviarRegis' class='btn btn-primary btn-l' type='submit'>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>
<script>'../../controlador/JS/revisa.js'</script>
