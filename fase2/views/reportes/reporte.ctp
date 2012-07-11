<?php
		$usuario = $this->Session->read("Auth.User");	
		$base = $this->base;		
		echo $this->element('graphs');
	?>
	<script type="text/javascript">
		$(document).ready(function(){

			$("#tabs").tabs({selected: 0});
		});
	</script>
	<div class="index">
	
	<div id="tabs">
	<ul>
		<li><a href="#tabs-1">Reuniones</a></li>
		<li><a href="#tabs-2">Ideas</a></li>
		<li><a href="#tabs-3">Proyectos</a></li>
	</ul>

		<!--<div id='titulo'><h3>Informe al <?php echo date("d-m-Y");?></h3></div>-->


	<div id="tabs-1">
		<h2> Reuniones por ingeniero efectivamente realizadas</h2>
		<table>
		<?php echo $html->tableHeaders(array("Nombre de Ingeniero","Planificacion","Talleres","Grupo Evaluador","Equipo de mejora","Total ingeniero"));?>	

		
		<?php 
			foreach($reporte2 as $k=>$r){
				foreach($r as &$v){
					if(is_numeric($v)){
						$v = number_format($v, 0, ',', '.');
					}

				}
				echo $html->tableCells($r);
			}	

		?>


		</table>
	  <div id="reunionesIngeniero">
	  </div>
		<!--<center><img src="<?php echo $base;  ?>/tworeports/reunionesporingeniero"></img></center>-->
		
	<!--	<h2>Rendimiento en reuniones por ingeniero</h2>
<center>
		<img src="<?php echo $base;?>/tworeports/radial/1">
		<img src="<?php echo $base;?>/tworeports/radial/2">
		<img src="<?php echo $base;?>/tworeports/radial/3">
		<img src="<?php echo $base;?>/tworeports/radial/4">
		<img src="<?php echo $base;?>/tworeports/radial/5">
		<img src="<?php echo $base;?>/tworeports/radial/6">
</center>
-->




	
		<h2> Reuniones por filial</h2>
		<table>
			<?php  echo $html->tableHeaders(array("Nombre Filial","Planificacion","Talleres","Grupo Evaluador","Equipo de mejora","Total"));?>	
			<?php
				//pr($ingFilialReportes);
				
				foreach($ingFilialReportes as $k=>$r){
					foreach($r as &$v){
					if(is_numeric($v)){
						$v = number_format($v, 0, ',', '.');
					}

				}
				echo $html->tableCells($r);
			}	

			?>
		</table>
		<div id="reunionesFilial">
		</div>
		<!--<center><img src="<?php echo $base;  ?>/tworeports/reunionesporfilial"></img></center>-->

<div style="page-break-before: always;"> </div>

		<h2> Estado de reuniones por ingeniero</h2>
		<table>
			<?php  echo $html->tableHeaders(array("Nombre Ingeniero","Programadas","Realizadas","No Realizadas","Replanificadas",'Efectividad <br>(Realizadas/Programadas))'));?>	
			<?php

				foreach($planificacionesEstadoIngenieros as $k=>$r){
					foreach($r as $d){
						foreach($r as &$v){
					if(is_numeric($v)){
						$v = number_format($v, 0, ',', '.');
					}

				}
						echo $html->tableCells($d);
				}

			}	

			?>
		</table>
		<div style="page-break-before: always;"> </div>

		</div>
		<div id="tabs-2">
		<h2> Ideas por ingeniero</h2>
		<table>
			<?php  echo $html->tableHeaders(array("Nombre ingeniero","Pendiente","Aprobadas","Rechazadas","Reproceso","Total"));?>

			<?php

				foreach($ingIdeas as $k => $r){
					foreach($r as &$v){
					if(is_numeric($v)){
						$v = number_format($v, 0, ',', '.');
					}

				}
					echo $html->tableCells($r);

				}

			?>
			


		</table>
		<div id="ideasIngeniero">
		</div>
		
		<!--<center><img src="<?php echo $base;  ?>/onereports/estadoideasingeniero"></img></center>-->

	
		<h2> Ideas por filial</h2>
		<table>
			<?php  echo $html->tableHeaders(array("Nombre Filial","Pendiente","Aprobadas","Rechazadas","Reproceso","Total"));?>

			<?php

				foreach($filialIdeas as $k => $r){
					foreach($r as &$v){
					if(is_numeric($v)){
						$v = number_format($v, 0, ',', '.');
					}

				}
					echo $html->tableCells($r);

				}

			?>
			


		</table>
		<div id="ideasFilial">
		</div>
		
		<!--<center><img src="<?php echo $base;  ?>/onereports/estadoideasfilial"></img></center>-->
		
<div style="page-break-before: always;"> </div>

	<!--	<h2> Ideas por unidad</h2>
		<center><img src="<?php echo $base;  ?>/onereports/ideasUnidad/1"></img></center>
		<center><img src="<?php echo $base;  ?>/onereports/ideasUnidad/2"></img></center>
		<center><img src="<?php echo $base;  ?>/onereports/ideasUnidad/3"></img></center>-->

<div style="page-break-before: always;"> </div>
	
		</div>
		<div id="tabs-3">
		<h2>Estado de proyectos</h2>

		<table>
			<?php  echo $html->tableHeaders(array("Filial","Pendiente",'En preparación',"En Evaluación","Aprobado","Rechazado","Total"));?>
			<?php
				foreach($eProyecto as $k => $r){
					foreach($r as &$v){
					if(is_numeric($v)){
						$v = number_format($v, 0, ',', '.');
					}

				}
					echo $html->tableCells($r);
				}
			
			?>
			

		</table>
		<div id="estadoProyectosFilial">
		</div>
		



		<h2>Rendimiento de ideas de ingenieros</h2>

		<table>
			<?php  echo $html->tableHeaders(array("Nombre","Ideas sancionadas","Aprobadas","Porcentaje de aprobación"));?>
			<?php

				foreach($ideasIng as $r1){
				foreach($r1 as $k => $r){
					foreach($r as &$v){
					if(is_numeric($v)){
						$v = number_format($v, 0, ',', '.');
					}

				}
					echo $html->tableCells($r);
					}
				}
			
			?>
			

		</table>



		<h2>Estado de proyectos por ingeniero</h2>

		<table>
			<?php  echo $html->tableHeaders(array("Nombre","Pendiente",'En preparación',"En Evaluación","Aprobado","Rechazado","Total"));?>
			<?php
				foreach($proyectoIngeniero as $k => $r){
					foreach($r as &$v){
					if(is_numeric($v)){
						$v = number_format($v, 0, ',', '.');
					}

				}
					echo $html->tableCells($r);
				}
			
			?>
			

		</table>
		<div id="estadoProyectosIngeniero">

		</div>
		
		<h2>Ideas por Emsefor</h2>

		<table>
			<?php  echo $html->tableHeaders(array("Filial",'Total de empresas',"Empresas con más de 6 ideas",'Cumplimiento de meta',"Empresas con más de un proyecto"));?>
			<?php
				foreach($ideasProyectosPorEmsefor as $k => $r){
					foreach($r as &$v){
					if(is_numeric($v)){
						$v = number_format($v, 0, ',', '.');
					}

				}
					echo $html->tableCells($r);
				}
			
			?>
		</table>
		<div style="page-break-before: always;"> </div>
		</div>
	</div>

		<!--<h2>Proyectos por EMSEFOR</h2>
		<center><img src="<?php echo $base;  ?>/onereports/proyectosEmsefor/1"></img></center>
		<center><img src="<?php echo $base;  ?>/onereports/proyectosEmsefor/2"></img></center>
		<center><img src="<?php echo $base;  ?>/onereports/proyectosEmsefor/3"></img></center>
<div style="page-break-before: always;"> </div>

		<h2> Proyectos por Unidad</h2>
		<center><img src="<?php echo $base;  ?>/onereports/proyectosEvaluacionUnidadEmsefor/1"></img></center>
		<center><img src="<?php echo $base;  ?>/onereports/proyectosEvaluacionUnidadEmsefor/2"></img></center>
		<center><img src="<?php echo $base;  ?>/onereports/proyectosEvaluacionUnidadEmsefor/3"></img></center>

<div style="page-break-before: always;"> </div>

	<h2>Ideas por filial</h2>
		<h1>FCEL</h1>
			<center><img src="<?php echo $base;  ?>/onereports/topEmsefors/1"></img></center>
		<h1>BASA</h1>
			<center><img src="<?php echo $base;  ?>/onereports/topEmsefors/2"></img></center>
		<h1>FVAL</h1>
			<center><img src="<?php echo $base;  ?>/onereports/topEmsefors/3"></img></center>
-->
			


<!--<div id="descarga_reportes">

<?php 
	
	echo "<h3>Descargar reportes</h3>";
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
	echo $this->Html->link("Tabla de resumen",array("controller"=>"reportes","action"=>"resumen"),array('target'=>'_blank'))."<br>";
	echo $this->Html->link("Descargar tabla de resumen",array("controller"=>"reportes","action"=>"resumen",1))."<br>";
	if($usuario["group_id"]!= 2){

	echo $this->Html->link("Reporte KyK",array("controller"=>"reportes","action"=>"kyk"))."<br>";
	echo $this->Html->link("Reporte 1",array("controller"=>"reportes","action"=>"reporte1descarga"))."<br>";
	
	
	}
echo "Las condiciones sirven para ver algún reporte en específico. Si quiere obtener todas las planificaciones, no seleccione nada y aprete el botón obtener.";
	?>

</div>

-->
	</div>
