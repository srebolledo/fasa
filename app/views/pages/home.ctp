<?php
		$usuario = $this->Session->read("Auth.User");
?>

<div class = "index">
	<div id="box">
		<label>El sistema todavía se encuentra en desarrollo, por lo tanto todas las sugerencias son bienvenidas</label>
		<label>Manual de uso:</label>
			<ul>
			<li>Para agregar una planificación, oprima Planificación en el menú de la izquierda y luego haga click en Agregar. Rellene toda la información pedida y luego haga click en guardar.</li>
			<li>Puede buscar una planificación ya guardada por el estado en el menú desplegable. Las opciones son:
				<ul>
					<li>Planificadas</li>
					<li>Realizadas</li>
					<li>No realizadas</li>
					<li>Replanificadas</li>
				</ul>
			</li>
			<li>Para agregar una nueva idea, oprima en Ideas en el menú de la izquierda y luego haga click en Agregar. Rellene toda la información pedida y luego haga click en guardar</li>
			<li>Puede buscar una planificación ya guardada por el estado en el menú desplegable. Las opciones son:</li>
			<ul>
				<li>Todas</li>
				<li>Pendiente</li>
				<li>Aprobada</li>				
				<li>Rechazada</li>
				<li>Reproceso</li>				
				
								
			</ul>
			<li>También puede ver los reportes hechos por todos los ingenieros en el menú reportes en la opción ver.</li>
			
			
		</ul>
	Si tiene alguna duda, comentario o sugerencia consulte al mail srebolledo@gmail.com . 
	</div>



	<?php
if($usuario["group_id"]==2){

			$key = $this->requestAction("/engineers/getId/".$usuario["id"]);
			$stats = $this->requestAction("/tworeports/setStats/".$key);

			$porPlanificaciones = $stats["planificaciones"]*100/$stats["tplanificaciones"];
			$porAbiertas = $stats["abiertas"]*100/$stats["planificaciones"];
			$porRealizadas = $stats["realizadas"]*100/$stats["planificaciones"];
			$porNoRealizadas = $stats["nrealizadas"]*100/$stats["planificaciones"];
			$porReplanificadas = $stats["replanificadas"]*100/$stats["planificaciones"];

			?>
			<h1>Estado</h1>
			<ul>
				
				<li>Planificaciones: <?php echo $stats["planificaciones"];?></li>
				<li>Planificaciones abiertas: <?php echo $stats["abiertas"]." (".round($porAbiertas,2)."%)";?></li>
				<li>Reuniones realizadas : <?php echo $stats["realizadas"]." (".round($porRealizadas,2)."%)";?></li>
				<li>Reuniones no realizadas: <?php echo $stats["nrealizadas"]." (".round($porNoRealizadas,2)."%)";?></li>
				<li>Reuniones replanificadas: <?php echo $stats["replanificadas"]." (".round($porReplanificadas,2)."%)";?></li>
			</ul>
		<?php
		}
		echo "<br>";
?>
</div>


