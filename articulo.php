<?php
session_start();
if(!isset($_SESSION['user']) || $_SESSION['tipo_usu'] != 1) {
	header("location: index.php");
}
require "conexion.php";
include_once "funciones.php";

$id=$_GET['id'];
$mod=$_GET['mod'];

if (!empty($mod)){
	$sql="select * from articulos where idarticulos='$id'";
	$rs=$conn->query($sql);
	$row=$rs->fetch_assoc();
	$nombre=$row['nombre'];
	$episodio=$row['episodio'];
	$idtemas=$row['idtemas'];

	$operacion=4;

}else{
	$operacion=3;

}
?>

<form id="form-arti" class="form-horizontal" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label class="col-md-3 control-label">Título</label>
		<div class="col-md-7">
			<input id="nombre" name="nombre" type="text" placeholder="Título" 
			class="form-control input-md" value="<?php echo $nombre?>"/>
			<p id="aerror1"></p>
		</div>

	</div>

	<div class="form-group" id="temp">
		<label class="col-md-3 control-label">Episodio</label>
		<div class="col-md-7">
			<input id="episodio" name="episodio" type="number"  min="0" placeholder="Episodio" 
			class="form-control input-md" value="<?php echo $episodio?>"/>
			<p id="aerror2"></p>
		</div>

	</div>	

	<hr  />

	<h3>Servidores de Descarga</h3>
	<br/>

	<?php
	$sql="select * from servidores";
	$rs = $conn->query($sql);
	while ($row = $rs->fetch_assoc()){

		$sql1="select * from urls where idarticulos='$id' and idservidores='".$row['idservidores']."'";
		$rs1=$conn->query($sql1);
		$row1=$rs1->fetch_assoc();

		if (!empty($row1['url'])){
			$url=trim($row1['url']);
		}else{
			$url="";
		}

		echo "<div class='form-group' >";
		echo "<label class='col-md-3 control-label'>".$row['nombre']."</label>";
		echo "<div class='col-md-7'>";
		echo "<input type='hidden' value='".$row['idservidores']."' name='servidores[]'/>";
		echo "<input name='url[]' placeholder='URL de Descarga'
		class='form-control input-md' value='$url'/>";
		echo "</div>";
		echo "</div>";
	}

	?>
	<div class="col-md-3"></div>
	<div id="aerror3" class="col-md-7"></div>

	<br/>
	<div class="form-group" style="margin-top: 35px;">
		<div class="col-md-12 text-center">
			<div class="btn-group">
				<button id="cancelar" type="button" class="btn btn-default" style="width: 150px;" data-dismiss="modal">Cancelar</button>
				<input type="submit" id="btnnuevo" name="btnnuevo" 
				class="btn btn-primary col-md-3" style="width: 150px;" value="Guardar"/>
			</div>
		</div>
	</div>

	<input type="hidden" name="operacion" id="operacion" value="<?php echo $operacion?>"/>
	<input type="hidden" name="idtemas" id="idtemas" value="<?php echo $id?>"/>

</form>


<script type="text/javascript">
	$("#nombre").keyup(function(){
		$("#aerror1").html("");
	});
	$("#episodio").keyup(function(){
		$("#aerror2").html("");
	});
	$("input[name='url[]']").keyup(function(){
		$("#aerror3").html("");
	});

	$("#form-arti").submit( function( e ) {
		e.preventDefault();
		var error=false;

		if (!$("#nombre").val().length){
			$("#aerror1").html("<?php echo mensajeError('Debe ingresar un titulo valido'); ?>");
			error=true;
		}
		if (!$("#episodio").val().length){
			$("#aerror2").html("<?php echo mensajeError('Debe ingresar un episodio valido'); ?>");
			error=true;
		}

		var url = [];

		$("input[name='url[]']").each(function() {
			var value = $(this).val();
			if (value) {
				url.push(value);
			}
		});

		if (!url.length) {
			$("#aerror3").html("<?php echo mensajeError('Debe ingresar un url valido'); ?>");
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
					var band=<?php echo $operacion;?>;
					var pag ="";

					if (band==4){
						pag = "nuevapelicula.php?id=<?php echo $idtemas;?>";
					}else{
						pag = "adminpeliculas.php";
					}

					$('.modal').modal('hide');

					$.ajax({  
						url: pag,
						success: function(contenido) {
							$('#contenido').html(contenido);
							$('#generalt').html(data);

						}  
					});
				}  
			});
		}
	}); 
</script>