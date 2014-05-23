<?php
session_start();
if(!isset($_SESSION['user']) || $_SESSION['tipo_usu'] != 1) {
	header("location: index.php");
}
require "conexion.php";
include_once "funciones.php";

$id=$_GET['id'];

if(!empty($id)) {
	$sql="SELECT * FROM temas WHERE idtemas='$id'";
	$rs = $conn->query($sql);
	$row = $rs->fetch_assoc();

	$idtemas = $row['idtemas'];
	$idcategorias = $row['idcategorias'];
	$titulo = $row['titulo'];
	$temporada = $row['temporada'];
	$sipnosis = $row['sipnosis'];
	$ano = $row['ano'];
	$pagoficial = $row['pagoficial'];
	$trailer = $row['trailer'];
	$formato = $row['formato'];
	$operacion=1;

	$sql="select * from generostemas WHERE idtemas='$id'";
	$rs = $conn->query($sql);
	while ($row = $rs->fetch_assoc()){
		$idgeneros[] .=$row['idgeneros'];
	}

	$sql="select * from puntajes WHERE idtemas='$id' and idusuarios='".$_SESSION['idusuarios']."'";
	$rs = $conn->query($sql);
	$row = $rs->fetch_assoc();
	$puntaje=$row['puntaje'];

}else{
	$operacion=2;
}
?>
<div class="row">
	<div class="col-md-10"><h1 style="margin-top: 0;">Tema</h1></div>
	<div class="col-md-2 text-right"><a alt="cancelar1" id="cancelar1" class="btn btn-default">Cancelar</a></div>
</div>

<div class="row">
	<div class="col-md-12">
		<form id="form-nuevo" class="form-horizontal" method="post" enctype="multipart/form-data">

			<div class="panel panel-default" >
				<div class="panel-body">
					<br/>
					<div class="form-group">
						<label class="col-md-3 control-label" >Categoría</label>
						<div class="col-md-7">
							<select class="form-control" name="categoria" id="categoria">
								<?php
								$sql="select * from categorias order by 2";
								$rs = $conn->query($sql);
								while ($row = $rs->fetch_assoc()) {
									if ($idcategorias == $row['idcategorias']){
										$selected="selected";
									}else{
										$selected="";
									}
									echo "<option value='".$row['idcategorias']."' $selected>".$row['nombre']."</option>";
								}
								?>
							</select>
							<p id="error"></p>
						</div>		
					</div>

					<div class="form-group">
						<label class="col-md-3 control-label" >Género</label>
						<div class="col-md-7">
							<!-- Multiple Checkboxes (inline) -->
							<div class="form-group">
								<div class="col-md-12">
									<?php
									$sql="select * from generos order by 2";
									$rs = $conn->query($sql);
									$i=0;
									while ($row = $rs->fetch_assoc()) {
										if ($idgeneros[$i] == $row['idgeneros']){
											$checked="checked";
											$i++;
										}else{
											$checked="";
										}
										echo "<label class='checkbox-inline'>";
										echo "<input type='checkbox' name='generos[]' value='".$row['idgeneros']."' $checked>";
										echo $row['nombre'];
										echo "</label>";


									}
									?>
								</div>
							</div>
							<p id="error1"></p>
						</div>		
					</div>

					<div class="form-group">
						<label class="col-md-3 control-label">Título</label>
						<div class="col-md-7">
							<input id="titulo" name="titulo" type="text" placeholder="Título" 
							class="form-control input-md" value="<?php echo $titulo?>"/>
							<p id="error2"></p>
						</div>

					</div>

					<div class="form-group" id="temp">
						<label class="col-md-3 control-label">Temporada</label>
						<div class="col-md-7">
							<input id="temporada" name="temporada" type="number"  min="1" placeholder="Temporada" 
							class="form-control input-md" value="<?php echo $temporada?>"/>
							<p id="error3"></p>
						</div>

					</div>

					<div class="form-group">
						<label class="col-md-3 control-label" >Sipnosis</label>
						<div class="col-md-7">
							<textarea name="sipnosis" id="sipnosis" class="form-control" rows="10"><?php echo $sipnosis?></textarea>
							<p id="error4"></p>
						</div>

					</div>

					<div class="form-group">
						<label class="col-md-3 control-label">Año</label>
						<div class="col-md-7">
							<select class="form-control" id="ano" name="ano">
								<?php
								for($i=date("Y");$i>=date("Y")-30;$i--){
									if ($ano==$i){
										$selected="selected";
									}else{
										$selected="";
									}
									echo "<option value='$i' $selected>$i</option>";
								}
								?>
							</select>
							<p id="error5"></p>
						</div>

					</div>

					<div class="form-group">
						<label class="col-md-3 control-label">Pág. oficial</label>
						<div class="col-md-7">
							<input id="pag" name="pag" type="text" placeholder="Pág. oficial" 
							class="form-control input-md" value="<?php echo $pagoficial?>"/>
							<p id="error6"></p>
						</div>

					</div>

					<div class="form-group">
						<label class="col-md-3 control-label">URL Trailer</label>
						<div class="col-md-7">
							<input id="trailer" name="trailer" type="text" placeholder="URL Trailer" 
							class="form-control input-md" value="<?php echo $trailer?>"/>
							<p id="error7"></p>
						</div>

					</div>

					<div class="form-group">
						<label class="col-md-3 control-label">Formato</label>
						<div class="col-md-7">
							<input id="formato" name="formato" type="text" placeholder="Formato" 
							class="form-control input-md" value="<?php echo $formato?>"/>
							<p id="error8"></p>
						</div>

					</div>

					<div class="form-group">
						<label class="col-md-3 control-label">Puntaje</label>
						<div class="col-md-7">
							<select class="form-control" id="puntaje" name="puntaje">
								<option></option>
								<?php
								for ($i=1; $i <=10; $i++) { 
									if ($puntaje==$i){
										$selected="selected";
									}else{
										$selected="";
									}
									echo "<option value='$i' $selected>$i</option>";
								}
								?>
							</select>
							<p id="error9"></p>
						</div>

					</div>


					<div class="form-group" style="margin-top: 35px;">
						<div class="col-md-12 text-center">
							<div class="btn-group">
								<button id="cancelar" type="button" class="btn btn-default" style="width: 150px;">Cancelar</button>
								<input type="submit" id="btnnuevo" name="btnnuevo" 
								class="btn btn-primary col-md-3" style="width: 150px;" value="Guardar"/>
							</div>
						</div>
					</div>

					<input type="hidden" name="operacion" id="operacion" value="<?php echo $operacion?>"/>
					<input type="hidden" name="idtemas" id="idtemas" value="<?php echo $idtemas?>"/>

				</div>
			</div>

		</form>

	</div>

	<div class="col-md-12" id="lepisodios">
		<h3>Artículo</h3>

		<p id="generalt"></p>

		<table id='larticulos' class="table table-striped table-hover table-responsive" style="font-size: 12px" >
			<thead>
				<tr>
					<th>#</th>
					<th>Episodio</th>
					<th>Nombre del Episodio</th>
					<th class='text-center' width="20%">URLS</th>
					<th class='text-center'>Opciones</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$sql="select * from articulos where idtemas='$idtemas' order by episodio";
				$rs=$conn->query($sql);

				if ($rs->num_rows == 0) {
					echo "<tr><td colspan='5'>No existe Información</td></tr>";
				}
				$i=1;
				while ($row=$rs->fetch_assoc()){
					echo "<tr>";
					echo "<td>".$i++."</td>";
					echo "<td>".$row['episodio']."</td>";
					echo "<td width='60%'>".$row['nombre']."</td>";
					echo "<td class='text-left'>";

					$sql="select urls.url, ifnull(servidores.logo,'servidores/sinlogo.png') logo, servidores.nombre
					from urls inner join servidores
					on urls.idservidores = servidores.idservidores
					where urls.idarticulos = '".$row['idarticulos']."'";
					$rsu=$conn->query($sql);
					while ($rw=$rsu->fetch_assoc()){

						echo "<a href='".$rw['url']."' target='_blank' title='".$rw['nombre']."'><img width='10%' src='img/".$rw['logo']."' alt='".$rw['nombre']."'/></a>";
					}

					echo "</td>
					<td class='text-left'>";
						?>
						<a href="<?php echo $row['idarticulos']; ?>" class="glyphicon glyphicon-pencil text-success toolti" alt="editar" data-toggle="tooltip" data-placement="bottom" title="Editar Artículo"></a>

						<?php if ($idcategorias==2){?>
						<a href="<?php echo $row['idarticulos']; ?>" class="glyphicon glyphicon-remove text-danger toolti" alt="eliminar" data-toggle="tooltip" data-placement="bottom" title="Eliminar Artículo"></a>

						<?php
						}
						echo "  </td>";
						echo "</tr>";
					}
					echo "<tr><td colspan='5'>Total de Registros: ".$rs->num_rows."</td></tr>"; 
					?>
				</tbody>
			</table>
		</div>
	</div>

	<!-- editar-->
	<div class="modal fade" id="modalArticulo" tabindex="-1" role="dialog" aria-labelledby="Editar Artículo" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Editar Artículo</h4>
				</div>
				<div id="editarContenido" class="modal-body">

				</div>
			</div>
		</div>
	</div>

	<!-- eliminar-->
	<div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="Eliminar Artículo" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Eliminar Artículo</h4>
				</div>
				<div id="eliminarContenido" class="modal-body">

				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		if ($("#idtemas").val().length){
			$("#lepisodios").show();
		}else{
			$("#lepisodios").hide();
		}

		$("#categoria").change(function(){
			$("#error").html("");
		});
		$("input[type=checkbox]").click(function(){
			if ($("input[type=checkbox]").is(':checked')){
				$("#error1").html("");
			}
		});
		$("#titulo").keyup(function(){
			$("#error2").html("");
		});
		$("#temporada").keyup(function(){
			$("#error3").html("");
		});
		$("#sipnosis").keyup(function(){
			$("#error4").html("");
		});
		$("#ano").keyup(function(){
			$("#error5").html("");
		});
		$("#pag").keyup(function(){
			$("#error6").html("");
		});
		$("#trailer").keyup(function(){
			$("#error7").html("");
		});
		$("#formato").keyup(function(){
			$("#error8").html("");
		});

		$("#form-nuevo").submit( function( e ) {
			e.preventDefault();
			var error=false;

			if (!$("#categoria").val().length){
				$("#error").html("<?php echo mensajeError('Debe ingresar una categoria valida'); ?>");
				error=true;
			}
			if (!$("input[type=checkbox]").is(':checked')){
				$("#error1").html("<?php echo mensajeError('Debe marcar al menos un género'); ?>");
				error=true;
			}else{
				$("#error1").html("");
			}
			if (!$("#titulo").val().length){
				$("#error2").html("<?php echo mensajeError('Debe ingresar un titulo valido'); ?>");
				error=true;
			}
		/*if (!$("#temporada").val().length){
			$("#error3").html("<?php echo mensajeError('Debe ingresar una temporada valida'); ?>");
			error=true;
		}*/
		if (!$("#sipnosis").val().length){
			$("#error4").html("<?php echo mensajeError('Debe ingresar una sipnosis valida'); ?>");
			error=true;
		}
		if (!$("#ano").val().length){
			$("#error5").html("<?php echo mensajeError('Debe ingresar un año valido'); ?>");
			error=true;
		}

		var urlRegex = new RegExp('(http|https)://[a-z0-9\-_]+(\.[a-z0-9\-_]+)+([a-z0-9\-\.,@\?^=%&;:/~\+#]*[a-z0-9\-@\?^=%&;/~\+#])?', 'i');
		
		if ($("#pag").val().length){	
			if (!urlRegex.test($("#pag").val())) {
				$("#error6").html("<?php echo mensajeError('Debe ingresar una Pag. oficial valida'); ?>");
				error=true;
			}			
		}
		if ($("#trailer").val().length){
			if (!urlRegex.test($("#trailer").val())) {
				$("#error7").html("<?php echo mensajeError('Debe ingresar una URL Trailer valida'); ?>");
				error=true;		
			}
		}
		if (!$("#formato").val().length){
			$("#error8").html("<?php echo mensajeError('Debe ingresar un formato valida'); ?>");
			error=true;			
		}
		if (!error){
			$.ajax( {
				url: 'configtemas.php',
				type: 'POST',
				data: new FormData(this),
				processData: false,
				contentType: false,
				success: function(data) {
					$('.modal').modal('hide');

					$.ajax({  
						url: "adminpeliculas.php",
						success: function(contenido) {
							$('#contenido').html(contenido);
							$('#generalt').html(data);

						}  
					});
				}  
			});
		}
	});

$(".btn-default").click(function(){
	$.ajax({  
		url: "adminpeliculas.php",
		success: function(contenido) {
			$('#contenido').html(contenido);

		}  
	});
});

$("#larticulos > tbody > tr > td > a[alt='editar']").click(function(e){
	e.preventDefault();
	var id = $(this).attr('href');
	pagina_a_cargar = "articulo.php?id=" + id + "&mod=1";

	$.ajax({  
		url: pagina_a_cargar,  
		success: function(data) {
			$('#editarContenido').html(data);
			$("#modalArticulo").modal("show");
		}  
	});
});

$("#larticulos > tbody > tr > td > a[alt='eliminar']").click(function(e){
	e.preventDefault();
	var id = $(this).attr('href');
	pagina_a_cargar = "eliminararticulos.php?id=" + id;

	$.ajax({  
		url: pagina_a_cargar,  
		success: function(data) {
			$('#eliminarContenido').html(data);
			$("#modalEliminar").modal("show");
		}  
	});
});

</script>