<?php 
session_start();
$caru=true; 
include("header.php");
require "conexion.php";
?>
<div class="container" style="margin: 70px auto;">

	<?php
	$sql="SELECT temas.*, categorias.nombre, ifnull(MAX(articulos.episodio),0) capitulo
	FROM 
	temas 
	INNER JOIN 
	categorias 
	ON temas.idcategorias = categorias.idcategorias 
	LEFT JOIN 
	articulos
	ON articulos.idtemas = temas.idtemas
	GROUP BY temas.idtemas
	ORDER BY temas.fechahora desc
	LIMIT 0,10";
	$rs = $conn->query($sql);
	while ($row = $rs->fetch_assoc()) {

		$capitulo=($row['capitulo']==0)?"":", Capitulo ".$row['capitulo'];

		echo "<div class='row featurette'>";

		echo "<div class='col-md-7'>";
		echo "<h2 class='featurette-heading'>".$row['titulo'].". <span class='text-muted'>".$row['temporada']." Temporada ".$capitulo."</span></h2>";
		echo "<blockquote>";
		echo "<p>Sinopsis</p>";
		echo "<footer>".$row['sipnosis']."</footer>";
		echo "</blockquote>";
		echo "</div>";

		echo "<div class='col-md-5'>";
		echo "<img class='featurette-image img-responsive' src='img/".$row['imagen']."' alt='".$row['titulo']."'>";
		echo "</div>";

		echo "</div>";

		echo "<hr class='featurette-divider'>";

	}
	?>

<!--
	<div class="row featurette">
		<div class="col-md-7">
			<h2 class="featurette-heading">True Detective. <span class="text-muted">1ª Temporada, Capitulo 04</span></h2>
			<blockquote>
				<p>Sinopsis</p>
				<footer>"True Detective" sigue a varios detectives en sus investigaciones -en cada temporada dos conocidas estrellas interpretarán a una pareja de detectives diferente intentando resolver un caso-. En la primera temporada, de 8 episodios, se narra el lapso de 17 años en el que dos detectives, Rust Cohle y Martin Hart, tratan de dar caza a un asesino en serie de Louisiana. Los detectives Cohle y Hart del Departamento de Policía de Louisiana deben volver a investigar el retorcido caso de una serie de asesinatos en el que habían trabajado 17 años atrás. Ambos narran desde nuestros días sus investigaciones paralelas, sucesos que reabren heridas aún no cicatrizadas y les sumergen de nuevo en los bizarros rituales que envolvían los asesinatos. Cuando son obligados a volver a un mundo que creían haber dejado en el pasado, el avance en la investigación y el mayor conocimiento mutuo les enseñan que la oscuridad reside a ambos lados de la ley.</footer>
			</blockquote>
		</div>
		<div class="col-md-5">
			<img class="featurette-image img-responsive" src="img/posters/true_detective.jpg" alt="True Detective Poster">
		</div>
	</div>

	<hr class="featurette-divider">

	<div class="row featurette">
		<div class="col-md-5">
			<img class="featurette-image img-responsive" src="img/posters/the_after.jpg" alt="The After Poster">
		</div>
		<div class="col-md-7">
			<h2 class="featurette-heading">The After. <span class="text-muted">1ª Temporada, </span><span class="text-warning">Capitulo Extreno</span></h2>
			<blockquote>
				<p>Sinopsis</p>
				<footer>Thriller apocalíptico creado cor Chris Carter (X Files) que mezcla ciencia ficción y suspenso en un mundo dominado por el miedo y la paranoia. Ocho extraños reunidos por fuerzas misteriosas que deben ayudarse entre sí para sobrevivir en un mundo violento que desafía toda explicación.</footer>
			</blockquote>
		</div>
	</div>

	<hr class="featurette-divider">

	<div class="row featurette">
		<div class="col-md-7">
			<h2 class="featurette-heading">The Walking Dead. <span class="text-muted">4ª Temporada, Capitulo 09</span></h2>
			<blockquote>
				<p>Sinopsis</p>
				<footer>Basada en un cómic homónimo, éste narra la historia de un grupo de supervivientes durante un apocalipsis zombie. Este grupo gira en torno a Rick Grimes, un policía que estuvo en estado comatoso durante la irrupción de la plaga. Aunque el leit motiv sea este apocalipsis zombie, la serie se centra más en las relaciones entre los personajes, su evolución y comportamiento en las situaciones críticas.</footer>
			</blockquote>
		</div>
		<div class="col-md-5">
			<img class="featurette-image img-responsive" src="img/posters/the_walking_dead_4.jpg" alt="The Walking Dead Poster">
		</div>
	</div>

	<hr class="featurette-divider">

	<div class="row featurette">
		<div class="col-md-5">
			<img class="featurette-image img-responsive" src="img/posters/black_sails_1.jpg" alt="The Black Sails Poster">
		</div>
		<div class="col-md-7">
			<h2 class="featurette-heading">The Black Sails. <span class="text-muted">1ª Temporada, Capitulo 03</span></h2>
			<blockquote>
				<p>Sinopsis</p>
				<footer>Basada en la famosa novela de Robert Louis Stevenson 'La isla del tesoro', 'Black Sails' es un drama de aventuras ambientado veinte años antes de los hechos narrados en el libro. Michael Bay ('Transformers') es el creador de esta serie rodada en su totalidad en exteriores. Plagada de sangre, sexo y violencia, 'Black Sails' sigue las aventuras del capitán Flint, el famoso pirata que según la novela depositó el tesoro en su isla. Flint estará acompañado del joven grumete Long John Silver, así como por sus bucaneros, mientras escapan de la justicia. En su viaje llegarán a la isla de New Providence, un lugar plagado de prostitutas, ladrones y timadores en el que reina la violencia más brutal. Allí, Flint y sus piratas tratarán de ganarse la vida y buscar fortuna, aunque para ello tengo que golpear, amenazar y extorsionar a cualquier que se entrometa en sus planes.</footer>
			</blockquote>
		</div>
	</div>

	<hr class="featurette-divider">

	<div class="row featurette">
		<div class="col-md-7">
			<h2 class="featurette-heading">Helix. <span class="text-muted">1ª Temporada, Capitulo 07</span></h2>
			<blockquote>
				<p>Sinopsis</p>
				<footer>‘Helix’ seguirá a un grupo de científicos del Centro de Control de Enfermedades que se desplazan a una base de investigación de alta tecnología en el Ártico para investigar lo que parece un brote de una enfermedad. Por supuesto, enseguida acaban envueltos en algo mucho más serio y que tiene el potencial de acabar con toda la raza humana.</footer>
			</blockquote>
		</div>
		<div class="col-md-5">
			<img class="featurette-image img-responsive" src="img/posters/helix_1.jpg" alt="Helix Poster">
		</div>
	</div>
-->
</div>
<?php include("footer.php"); ?>