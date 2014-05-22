<?php
session_start();
if(!isset($_SESSION['user']) || $_SESSION['tipo_usu'] != 1) {
	header("location: index.php");
}
include_once "funciones.php";
?>
<form id="form-nuevo" class="form-horizontal" method="post" enctype="multipart/form-data">

	<!-- Select Basic -->
	<div class="form-group">
		<label class="col-md-4 control-label" for="tipo_usu">Nombre de la Categoría</label>
		<div class="col-md-6">
			<input id="nombre" name="nombre" type="text" placeholder="Nombre de la Categoría" 
			class="form-control input-md" value=""/>
			<p id="error"></p>
		</div>
		
	</div>

	<div class="form-group" style="margin-top: 35px;">
		<div class="col-md-12 text-center">
			<div class="btn-group">
				<button type="button" class="btn btn-default" style="width: 150px;" data-dismiss="modal">Cancelar</button>
				<input type="submit" id="btnnuevoServidor" name="btnnuevoServidor" 
				class="btn btn-primary col-md-3" style="width: 150px;" value="Guardar"/>
			</div>
		</div>
	</div>

	<input type="hidden" name="operacion" id="operacion" value="2"/>
	
</form>

<script type="text/javascript">

	$("#nombre").keyup(function(){
		$("#error").html("");
	});

	$("#form-nuevo").submit( function( e ) {
		e.preventDefault();

		if (!$("#nombre").val().length){
			$("#error").html("<?php echo mensajeError('Debe ingresar un nombre valido'); ?>");
		}else{
			$.ajax( {
				url: 'configCategorias.php',
				type: 'POST',
				data: new FormData(this),
				processData: false,
				contentType: false,
				success: function(data) {
					$('.modal').modal('hide');

					$.ajax({  
						url: "categorias.php",
						success: function(contenido) {
							$('#contenido').html(contenido);
							$('#generalc').html(data);

						}  
					});
				}  
			});
		}
	});
</script>