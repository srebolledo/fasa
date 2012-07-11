<?php 	if(!$download){	

		$usuario = $this->Session->read("Auth.User");
?>
<div class= "index">
<?php
		
		echo "<br>";

			
			$keys = $this->requestAction("/engineers/getList");
			$ideasTotalesPendientes=0;
			$ideasTotalesAprobadas=0;
			$ideasTotalesRechazadas=0;
			$ideasTotalesReproceso=0;
			$proyectosTotalesPendientes=0;
				$proyectosTotalesAprobados=0;
				$proyectosTotalesRechazados=0;
				$proyectosTotalesEvaluacion=0;
			
			foreach ($keys as $key => $value){

				$nombre = $this->requestAction("/engineers/getName/".$key);

				$stats = $this->requestAction("/tworeports/setStats/".$key."/".$key);
				$porPlanificaciones = $stats["planificaciones"]*100/$stats["tplanificaciones"];
				$porAbiertas = $stats["abiertas"]*100/$stats["planificaciones"];
				$porRealizadas = $stats["realizadas"]*100/$stats["planificaciones"];
				$porNoRealizadas = $stats["nrealizadas"]*100/$stats["planificaciones"];
				$porReplanificadas = $stats["replanificadas"]*100/$stats["planificaciones"];
				
				
				$tporAbiertas = $stats["abiertas"]*100/$stats["tabiertas"];
				$tporRealizadas = $stats["realizadas"]*100/$stats["trealizadas"];
				$tporNoRealizadas = $stats["nrealizadas"]*100/$stats["tnorealizadas"];
				$tporReplanificadas = $stats["replanificadas"]*100/$stats["treplanificadas"];
				$nombre = $this->requestAction("/engineers/getName/".$key);
				?>
				<h3>Estado de: <?php echo $nombre;?></h3>
				<ul>
				
					<li>Planificaciones: <?php echo $stats["planificaciones"]." (".round($porPlanificaciones,2)."%)";?></li>
					<li>Planificaciones abiertas: <?php echo $stats["abiertas"]." (".round($porAbiertas,2)."%) (".round($tporAbiertas,2)."% del total)";?></li>
					<li>Reuniones realizadas : <?php echo $stats["realizadas"]." (".round($porRealizadas,2)."%) (".round($tporRealizadas,2)."% del total)";?></li>
					<li>Reuniones no realizadas: <?php echo $stats["nrealizadas"]." (".round($porNoRealizadas,2)."%) (".round($tporNoRealizadas,2)."% del total)";?></li>
					<li>Reuniones replanificadas: <?php echo $stats["replanificadas"]." (".round($porReplanificadas,2)."%) (".round($tporReplanificadas,2)."% del total)";?></li>
					<ul>
						<li>Planificación: <?php echo $stats["reunionPlanificacion"];?></li>
						<li>Reunión equipo de mejora: <?php echo $stats["reunionEM"];?><li>
						<li>Reunión grupo evaluador: <?php echo $stats["reunionGE"];?></li>			
						<li>Taller: <?php echo $stats["reunionTaller"];?></li>			
					
					</ul>
				


	<?php
			
				//REPORTE 1;
				$stats = $this->requestAction("/onereports/setStats/".$key."/".$key);
								
				$ideasTotalesPendientes+=$stats["ideasPendientes"];
				$ideasTotalesAprobadas+=$stats["ideasAprobadas"];
				$ideasTotalesRechazadas+=$stats["ideasRechazadas"];
				$ideasTotalesReproceso+=$stats["ideasReproceso"];
				$proyectosTotalesPendientes+=$stats["proyectoPendiente"];
				$proyectosTotalesAprobados+=$stats["proyectoAprobado"];
				$proyectosTotalesRechazados+=$stats["proyectoRechazado"];
				$proyectosTotalesEvaluacion+=$stats["proyectoEvaluacion"];
				
				$porIA = $stats["ideasAprobadas"] *100 / $stats["ideas"];
				$porIR = $stats["ideasRechazadas"] *100 / $stats["ideas"];
				$porIP = $stats["ideasPendientes"] *100 / $stats["ideas"];
				$porIRe = $stats["ideasReproceso"] *100 / $stats["ideas"];
				$porPP = $stats["proyectoPendiente"] * 100 /$stats["ideas"];
				$porPR = $stats["proyectoRechazado"] * 100 /$stats["ideas"];
				$porPE = $stats["proyectoEvaluacion"] * 100 /$stats["ideas"];
				$porPA = $stats["proyectoAprobado"] * 100 /$stats["ideas"];
			
			?>

			<li>Ideas: <?php echo $stats["ideas"];?></li>
			<li>Ideas aprobadas: <?php echo $stats["ideasAprobadas"]." (".round($porIA,2)."%)";?></li>
			<li>Ideas rechazadas: <?php echo $stats["ideasRechazadas"]." (".round($porIR,2)."%)";?></li>
			<li>Ideas pendientes: <?php echo $stats["ideasPendientes"]." (".round($porIP,2)."%)";?></li>
			<li>Ideas en reproceso: <?php echo $stats["ideasReproceso"]." (".round($porIRe,2)."%)";?></li>
			<li>Proyectos pendientes: <?php echo $stats["proyectoPendiente"]." (".round($porPP,2)."%)";?></li>
			<li>Proyectos rechazados: <?php echo $stats["proyectoRechazado"]." (".round($porPR,2)."%)";?></li>
			<li>Proyectos en evaluación: <?php echo $stats["proyectoEvaluacion"]." (".round($porPE,2)."%)";?></li>
			<li>Proyectos aprobados: <?php echo $stats["proyectoAprobado"]." (".round($porPA,2)."%)";?></li>
			</ul> 
				<br>
		<?php
			}
			?>

			<h3>Totales</h3>
			<ul>
				<li>Total de ideas: <?php echo $ideasTotalesPendientes+$ideasTotalesAprobadas+$ideasTotalesRechazadas+$ideasTotalesReproceso;?></li>
				<li>Total de ideas pendientes: <?php echo $ideasTotalesPendientes;?></li>
				<li>Total de ideas aprobadas: <?php echo $ideasTotalesAprobadas;?></li>
				<li>Total de ideas rechazadas: <?php echo $ideasTotalesRechazadas;?></li>
				<li>Total de ideas reproceso: <?php echo $ideasTotalesReproceso;?></li>
				<li>Proyectos
					<ul>
						<li>Proyectos totales pendientes: <?php echo $proyectosTotalesPendientes;?></li>
						<li>Proyectos totales aprobados: <?php echo $proyectosTotalesAprobados;?></li>
						<li>Proyectos totales rechazados: <?php echo $proyectosTotalesRechazados;?></li>
						<li>Proyectos totales en evaluación: <?php echo $proyectosTotalesEvaluacion;?></li>
					</ul>
				</li>
			</ul>

		<?php
			
	
	?>



<?php 
	
	echo "<h3>Reporte de planificación</h3>";
	echo $this->Form->create('Reporte',array("controller"=>"reportes","action"=>"reporte1"));
	echo $this->Form->input('tworeports',array("label"=>"Seleccione semana"));

	if($usuario["group_id"] != 2){
		echo $this->Form->input('engineers',array("label"=>"Seleccione Ingeniero"));
		echo $this->Form->input('filials',array("label"=>"Seleccione Filial"));
	}
	else{
		echo $this->Form->hidden('engineers',array("default"=>$this->requestAction("/engineers/getId/".$usuario["id"])));
		echo $this->Form->hidden('filials',array("default"=>0));
	}

	echo $this->Form->end("Obtener reporte de planificación");
	if($usuario["group_id"]!= 2){
	echo $this->Html->link("Reporte KyK",array("controller"=>"reportes","action"=>"kyk"))."<br>";
	
	}
echo "Las condiciones sirven para ver algún reporte en específico. Si quiere obtener todas las planificaciones, no seleccione nada y aprete el botón obtener.";
	?>
</div>
	<div class="actions">
	<?php
		$usuario = $this->Session->read("Auth.User");

	?>
	<h3><?php __('Acciones'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Volver', true), "/"); ?> </li>


	</ul>
</div>


<?php


	}
else{	


	?>
	<table>
	

	<?php
	echo "<tr><th>Correlativo</th><th>Filial</th><th>Ingeniero</th><th>Semana</th><th>Fecha</th><th>Actividad</th><th>EMSEFOR</th><th>SAP</th><th>Cuadrilla</th><th>Unidad</th><th>Contacto</th><th>Lugar</th><th>Estado</th><th>Observaciones</th></tr>";
	
	foreach($tworeports as $tworeport){

	echo "<tr><td>".$tworeport["Tworeport"]["id"]."</td><td>".$filials[$tworeport["Engineer"]["filial_id"]]."</td><td>".utf8_decode($tworeport["Engineer"]["nombre"])." ".utf8_decode($tworeport["Engineer"]["apellido"])."</td><td>";
	echo $tworeport["Tworeport"]["semana"]."</td><td>".$tworeport["Tworeport"]["fecha"]."</td><td>".utf8_decode($tworeport["Activity"]["nombre"])."</td><td>".utf8_decode($tworeport["Emsefor"]["nombre"])."</td><td>".$tworeport['Emsefor']['lugar']."</td><td>".utf8_decode($tworeport["Tworeport"]["cuadrilla"])."</td><td>";
	echo utf8_decode($tworeport["Unity"]["nombre"])."</td><td>".$tworeport["Tworeport"]["contacto"]."</td><td>".utf8_decode($tworeport["Tworeport"]["lugar"])."</td><td>".$tworeport["State"]["nombre"]."</td><td>".$tworeport["Tworeport"]["tema"]."</td></tr>";
	}

}
?>

