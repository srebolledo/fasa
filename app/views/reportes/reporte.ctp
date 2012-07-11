<?php
		$usuario = $this->Session->read("Auth.User");	
		$base = $this->base;		
		echo $this->element('graphs');
	?>
	<script type="text/javascript">
	var chartOptions = {
lang: {
downloadPNG: 'Bajar como PNG',
downloadJPEG: 'Bajar como JPG',
downloadPDF: 'Bajar como PDF',
downloadSVG: 'Bajar como SVG',
exportButtonTitle: 'Exportar como imagen',
printButtonTitle: 'Imprimir',
resetZoom: 'Reiniciar Zoom',
resetZoomTitle: 'Reiniciar Zoom a 1:1'
}
}; 
Highcharts.setOptions( chartOptions );
		$(document).ready(function(){
		$("a[href='/fasa/fase2/reportes/reporte']").
				attr({
		    	target: "_blank", 
    			title: "Se abrirá en una nueva ventana"
  		});
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

	<h3 >Informe al <?php echo date("d-m-Y H:i:s")." ".$title_for_layout;?> </h3>


	<div id="tabs-1">
		<h2> Reuniones por ingeniero efectivamente realizadas</h2>
		<table>
		<?php echo $html->tableHeaders(array("Nombre de Ingeniero","Planificacion","Talleres","Grupo Evaluador","Equipo de mejora","Total ingeniero"));?>	

		
		<?php 
			foreach($reporte2 as $k=>$r)
			{
				foreach($r as &$v)
				{
					if(is_numeric($v))
					{
						$v = number_format($v, 0, ',', '.');
					}

				}
				if($r[0] == 'Totales') foreach($r as &$v) $v = "<b>".$v."</b>";
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
				if($r[0] == 'Totales') foreach($r as &$v) $v = "<b>".$v."</b>";
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
				$i=0;
				$j=0;
				$k=0;
				foreach($planificacionesEstadoIngenieros as $k=>$r)
				{
					foreach($r as $d)
					{
						foreach($r as &$v)
						{
							if(is_numeric($v))
							{
								$v = number_format($v, 0, ',', '.');
							}
						}
						if($d[0] == 'Subtotal' or $d[0] == 'Total')
						{
							foreach($d as &$l)
								$l = "<b>".$l."</b>";
						}
						echo $html->tableCells($d);
					}
				}
			?>
		</table>
		<h2>Reuniones por unidad</h2>
		<h3>FCEL</h3>
		<table>
			<?php
				echo $html->tableHeaders(array('Unidad','Planificación','Taller','Grupo Evaluador','Equipo de mejora','Total'));
				$totales = array();
				$i=0;
				$totales[0] = 'Totales';
				$totales[1] =0;
				$totales[2] =0;
				$totales[3] =0;
				$totales[4] =0;
				$totales[5] =0;
				foreach($planificationUnities[1] as $key=>$value){
					if($value[0]=='Subtotal de mantención' or $value[0]=="Subtotal de expansión")
					{
						
						foreach($value as &$k)
						{
							$k= "<b>".$k."</b>"; 
						}
					}
					echo $html->tableCells($value);
				}
				$totales[1] = $planificationUnities[1][5][6] + $planificationUnities[1][14][6]; //Mantencion y Expansion
				$totales[2] = $planificationUnities[1][5][11] + $planificationUnities[1][14][11];
				$totales[3] = $planificationUnities[1][5][9] + $planificationUnities[1][14][9];
				$totales[4] = $planificationUnities[1][5][10] + $planificationUnities[1][14][10];
				$totales[5] = $planificationUnities[1][5][1000] + $planificationUnities[1][14][1000];
	
				for($i=0;$i<6;$i++) $totales[$i] = "<b>".$totales[$i]."</b>";
				echo $html->tableCells($totales);
			?>
		
		</table>
		<div id="planificationUnitiesFCEL"></div>
		<h3>BASA</h3>
		<table>
			<?php
				echo $html->tableHeaders(array('Unidad','Planificación','Taller','Grupo Evaluador','Equipo de mejora','Total'));				$totales = array();
				$i=0;
				$totales[0] = 'Totales';
				$totales[1] =0;
				$totales[2] =0;
				$totales[3] =0;
				$totales[4] =0;
				$totales[5] =0;
				foreach($planificationUnities[2] as $key=>$value)
				{
					if($value[0]=='Subtotal de mantención' or $value[0]=="Subtotal de expansión")
					{
						
						foreach($value as &$k)
						{
							$k= "<b>".$k."</b>"; 
						}
					}
					echo $html->tableCells($value);
				}
				$totales[1] = $planificationUnities[2][5][6] + $planificationUnities[2][14][6];
				$totales[2] = $planificationUnities[2][5][11] + $planificationUnities[2][14][11];
				$totales[3] = $planificationUnities[2][5][9] + $planificationUnities[2][14][9];
				$totales[4] = $planificationUnities[2][5][10] + $planificationUnities[2][14][10];
				$totales[5] = $planificationUnities[2][5][1000] + $planificationUnities[2][14][1000];

				for($i=0;$i<6;$i++) $totales[$i] = "<b>".$totales[$i]."</b>";
				echo $html->tableCells($totales);
			
			?>
		
		</table>

		<div id="planificationUnitiesBASA"></div>

		<h3>FVAL</h3>
		<table>
			<?php
				echo $html->tableHeaders(array('Unidad','Planificación','Taller','Grupo Evaluador','Equipo de mejora','Total'));				$totales = array();
				$i=0;
				$totales[0] = 'Totales';
				$totales[1] =0;
				$totales[2] =0;
				$totales[3] =0;
				$totales[4] =0;
				$totales[5] =0;
				foreach($planificationUnities[3] as $key=>$value){
					if($value[0]=='Subtotal de mantención' or $value[0]=="Subtotal de expansión")
					{
						
						foreach($value as &$k)
						{
							$k= "<b>".$k."</b>"; 
						}
					}

					echo $html->tableCells($value);
				}
				$totales[1] = $planificationUnities[3][5][6] + $planificationUnities[3][14][6];
				$totales[2] = $planificationUnities[3][5][11] + $planificationUnities[3][14][11];
				$totales[3] = $planificationUnities[3][5][9] + $planificationUnities[3][14][9];
				$totales[4] = $planificationUnities[3][5][10] + $planificationUnities[3][14][10];
				$totales[5] = $planificationUnities[3][5][1000] + $planificationUnities[3][14][1000];
				
				for($i=0;$i<6;$i++) $totales[$i] = "<b>".$totales[$i]."</b>";
				echo $html->tableCells($totales);
			
			?>
		
		</table>
		<div id="planificationUnitiesFVAL"></div>

		
		<?php
			if(isset($trabajadores)):
			
		?>
		<h2>Trabajadores entrenados</h2>
		<table>
			<?php
				echo $html->tableHeaders(array('Filial','Total de trabajadores','Trabajadores entrenados','Porcentaje'));
				$totales = array();
				foreach($trabajadores as $key=>$value)
				{
					foreach($value as &$v)
					{
						if(is_numeric($v) == true)
						{ 
							$v = number_format($v,0,',','.');
						}
					}
					if($value[0] == "Total")
					foreach($value as &$v) $v = "<b>".$v."</b>";
					echo $html->tableCells($value);
				}

			
			?>
		
		</table>
		<?php
			endif;
		?>
		
		
		<div style="page-break-before: always;"> </div>

		</div>
		<div id="tabs-2">
		<h2> Ideas por ingeniero</h2>
		<table>
			<?php  echo $html->tableHeaders(array("Nombre ingeniero","Pendiente","Aprobadas","Rechazadas","Reproceso","Total","Porcentaje de <br>aprobación"));?>

			<?php
				foreach($ingIdeas as $k => $r)
				{
					foreach($r as &$v)
					{
						if(is_numeric($v))
						{
							$v = number_format($v, 0, ',', '.');
						}
	
					}
					if($r[0] == "Total")
					{
						foreach($r as &$v) $v = "<b>".$v."</b>";
					}
					echo $html->tableCells($r);
				}

			?>
			


		</table>
		<div id="ideasIngeniero">
		</div>
			
		<h2> Ideas por filial</h2>
		<table>
			<?php  echo $html->tableHeaders(array("Nombre Filial","Pendiente","Aprobadas","Rechazadas","Reproceso","Total"));?>

			<?php

				foreach($filialIdeas as $k => $r)
				{
					foreach($r as &$v)
					{
						if(is_numeric($v))
						{
							$v = number_format($v, 0, ',', '.');
						}

					}
					if($r[0] == "Total")
					{
						foreach($r as &$v) $v = "<b>".$v."</b>";
					}
					echo $html->tableCells($r);
				}
			?>
			


		</table>
		<div id="ideasFilial"></div>
		<div id="ideasFilialUnidad" style="height:500px;"></div>
		<!--<center><img src="<?php echo $base;  ?>/onereports/estadoideasfilial"></img></center>-->
		
<div style="page-break-before: always;"> </div>

	<!--	<h2> Ideas por unidad</h2>
		<center><img src="<?php echo $base;  ?>/onereports/ideasUnidad/1"></img></center>
		<center><img src="<?php echo $base;  ?>/onereports/ideasUnidad/2"></img></center>
		<center><img src="<?php echo $base;  ?>/onereports/ideasUnidad/3"></img></center>-->

<div style="page-break-before: always;"> </div>

		<h2>Ideas por unidad</h2>
			<h3>FCEL</h3>
			<table>
				<?php
					echo $html->tableHeaders(array('Unidad','Pendientes','Aprobadas','Rechazadas','Reproceso','Total'));
					$totales = array();
					$totales[0] = 'Totales';
					$totales[1] = 0;
					$totales[2] = 0;
					$totales[3] = 0;
					$totales[4] = 0;					
					$totales[5] = 0;
					$i=0;			
					foreach($ideasUnities[1] as $key=>$value){
						if($i == 5){}
						else if( $i == 14){}
						else{
							$totales[1] += $value[1];
							$totales[2] += $value[2];
							$totales[3] += $value[3];
							$totales[4] += $value[4];
							$totales[5] += $value[1000];
						}
						$i++;
						if($value[0]=='Subtotal de mantención' or $value[0]=="Subtotal de expansión")
						{	
							foreach($value as &$k)
							{
								$k= "<b>".$k."</b>"; 
							}
						}
						echo $html->tableCells($value);				
					}
					for($i=0;$i<6;$i++) $totales[$i] = "<b>".$totales[$i]."</b>";
					echo $html->tableCells($totales);
				
				?>
			</table>

			<div id="ideasUnitiesFCEL"></div>
			<h3>BASA</h3>
			<table>
				<?php
					echo $html->tableHeaders(array('Unidad','Pendientes','Aprobadas','Rechazadas','Reproceso','Total'));
					$totales = array();
					$totales[0] = 'Totales';
					$totales[1] = 0;
					$totales[2] = 0;
					$totales[3] = 0;
					$totales[4] = 0;					
					$totales[5] = 0;
					$i=0;			
					foreach($ideasUnities[2] as $key=>$value){
						if($i == 5){}
						else if( $i == 14){}
						else{
							$totales[1] += $value[1];
							$totales[2] += $value[2];
							$totales[3] += $value[3];
							$totales[4] += $value[4];
							$totales[5] += $value[1000];
						}
						$i++;
						if($value[0]=='Subtotal de mantención' or $value[0]=="Subtotal de expansión")
						{
							foreach($value as &$k)
							{
								$k= "<b>".$k."</b>"; 
							}
						}
						echo $html->tableCells($value);				
					}
					for($i=0;$i<6;$i++) $totales[$i] = "<b>".$totales[$i]."</b>";
					echo $html->tableCells($totales);
				
				?>
			</table>

			<div id="ideasUnitiesBASA"></div>
			<h3>FVAL</h3>
			<table>
				<?php
					echo $html->tableHeaders(array('Unidad','Pendientes','Aprobadas','Rechazadas','Reproceso','Total'));
					$totales = array();
					$totales[0] = 'Totales';
					$totales[1] = 0;
					$totales[2] = 0;
					$totales[3] = 0;
					$totales[4] = 0;					
					$totales[5] = 0;
					$i=0;			
					foreach($ideasUnities[3] as $key=>$value){
					if($i == 5){}
						else if( $i == 14){}
						else{
							$totales[1] += $value[1];
							$totales[2] += $value[2];
							$totales[3] += $value[3];
							$totales[4] += $value[4];
							$totales[5] += $value[1000];
						}
						$i++;
						if($value[0]=='Subtotal de mantención' or $value[0]=="Subtotal de expansión")
						{	
							foreach($value as &$k)
							{
								$k= "<b>".$k."</b>"; 
							}
						}
						echo $html->tableCells($value);				
					}
					for($i=0;$i<6;$i++) $totales[$i] = "<b>".$totales[$i]."</b>";
					echo $html->tableCells($totales);
				
				?>
			</table>

			<div id="ideasUnitiesFVAL"></div>
	
	
	<h2> Ideas por EMSEFOR</h2>
		<h3>FCEL</h3>
		<table>
			<?php  echo $html->tableHeaders(array("Nombre EMSEFOR","SAP","Pendiente","Aprobadas","Rechazadas","Reproceso","Total"));?>

			<?php

				foreach($ideasEmsefor[1] as $k => $r)
				{
					foreach($r as $kk=>&$v)
					{
						if(is_numeric($v)&& $kk!=1)
						{
							$v = number_format($v, 0, ',', '.');
						}

					}
					if($r[0] == "Total")
					{
						foreach($r as &$v) $v = "<b>".$v."</b>";
					}
					echo $html->tableCells($r);

				}

			?>
			


		</table>
	
	
	<h3>BASA</h3>
		<table>
			<?php  echo $html->tableHeaders(array("Nombre EMSEFOR","SAP","Pendiente","Aprobadas","Rechazadas","Reproceso","Total"));?>

			<?php

				foreach($ideasEmsefor[2] as $k => $r)
				{
					foreach($r as $kk=>&$v)
					{
						if(is_numeric($v)&& $kk!=1)
						{
							$v = number_format($v, 0, ',', '.');
						}

					}
					if($r[0] == "Total")
					{
						foreach($r as &$v) $v = "<b>".$v."</b>";
					}
					echo $html->tableCells($r);
				}

			?>
			


		</table>
	
	
	<h3>FVAL</h3>
		<table>
			<?php  echo $html->tableHeaders(array("Nombre EMSEFOR","SAP","Pendiente","Aprobadas","Rechazadas","Reproceso","Total"));?>

			<?php

				foreach($ideasEmsefor[3] as $k => $r)
				{
					foreach($r as $kk=>&$v)
					{
						if(is_numeric($v) && $kk!=1)
						{
							$v = number_format($v, 0, ',', '.');
						}

					}
					if($r[0] == "Total")
					{
						foreach($r as &$v) $v = "<b>".$v."</b>";
					}
					echo $html->tableCells($r);
				}
			?>
			


		</table>
	
	
	
		</div>
		<div id="tabs-3">
		<h2>Estado de proyectos</h2>

		<table>
			<?php  echo $html->tableHeaders(array("Filial","Pendiente",'En preparación',"En revisión","Aprobado","Rechazado","Total"));?>
			<?php
				foreach($eProyecto as $k => $r)
				{
					foreach($r as $kk=>&$v)
					{
						if(is_numeric($v) )
						{
							$v = number_format($v, 0, ',', '.');
						}
					}
					if($r[0] == "Total")
					{
						foreach($r as &$v) $v = "<b>".$v."</b>";
					}
					echo $html->tableCells($r);
				}
			
			?>
			

		</table>
		<div id="estadoProyectosFilial">
		</div>
		
		<h2>Estado de proyectos por ingeniero</h2>

		<table>
			<?php  echo $html->tableHeaders(array("Nombre","Pendiente",'En preparación',"En revisión","Aprobado","Rechazado","Total"));?>
			<?php
				foreach($proyectoIngeniero as $k => $r)
				{
					foreach($r as &$v)
					{
						if(is_numeric($v))
						{
							$v = number_format($v, 0, ',', '.');
						}
					}
					if($r[0] == "Total")
					{
						foreach($r as &$v) $v = "<b>".$v."</b>";
					}
					echo $html->tableCells($r);
				}
			
			?>
			

		</table>
		<div id="estadoProyectosIngeniero">

		</div>
		
		<h2>Proyectos e ideas por EMSEFOR</h2>

		<table>
			<?php  echo $html->tableHeaders(array("Filial",'Total de empresas',"Empresas con 1 idea o más",'Cumplimiento de meta de ideas',"Empresas con 1 proyecto o más",'Cumplimiento de meta de proyectos'));?>
			<?php
				foreach($ideasProyectosPorEmsefor as $k => $r)
				{
					foreach($r as &$v)
					{
						if(is_numeric($v))
						{
							$v = number_format($v, 0, ',', '.');
						}
					}
					if($r[0] == "Total")
					{
						foreach($r as &$v) $v = "<b>".$v."</b>";
					}
					echo $html->tableCells($r);
				}
			
			?>
		</table>
		<div id="proyectosFilialUnidad">
		</div>
		
		<h2>Proyectos por unidad</h2>
			<h3>FCEL</h3>
			<table>
				<?php
					echo $html->tableHeaders(array('Unidad','Pendientes','En preparación','En revisión','Aprobados','Rechazados','Total'));
					$totales = array();
					$totales[0] = 'Totales';
					$totales[1] = 0;
					$totales[2] = 0;
					$totales[3] = 0;
					$totales[4] = 0;					
					$totales[5] = 0;
					$totales[6] = 0;
 					$i=0;
					foreach($projectsUnities[1] as $key=>$value){
						if($value[0]=='Subtotal de mantención' or $value[0]=="Subtotal de expansión")
						{
							foreach($value as &$k)
							{
								$k= "<b>".$k."</b>"; 
							}
						}
						echo $html->tableCells($value);	
					}
					$totales[1] = $projectsUnities[1][5][1]+$projectsUnities[1][14][1];
					$totales[2] = $projectsUnities[1][5][2]+$projectsUnities[1][14][2];
					$totales[3] = $projectsUnities[1][5][3]+$projectsUnities[1][14][3];
					$totales[4] = $projectsUnities[1][5][4]+$projectsUnities[1][14][4];
					$totales[5] = $projectsUnities[1][5][6]+$projectsUnities[1][14][6];
					
					$totales[6] = $projectsUnities[1][5][1000]+$projectsUnities[1][14][1000];
					for($i=0;$i<7;$i++) $totales[$i] = "<b>".$totales[$i]."</b>";
					echo $html->tableCells($totales);
				
				?>
			</table>

			<div id="projectsUnitiesFCEL"></div>
			<h3>BASA</h3>
			<table>
				<?php
					echo $html->tableHeaders(array('Unidad','Pendientes','En preparación','En revisión','Aprobados','Rechazados','Total'));
					$totales = array();
					$totales[0] = 'Totales';
					$totales[1] = 0;
					$totales[2] = 0;
					$totales[3] = 0;
					$totales[4] = 0;					
					$totales[5] = 0;
					$totales[6] = 0;
 					$i=1;			
					foreach($projectsUnities[2] as $key=>$value){
						if($value[0]=='Subtotal de mantención' or $value[0]=="Subtotal de expansión")
						{
							foreach($value as &$k)
							{
								$k= "<b>".$k."</b>"; 
							}
						}
						echo $html->tableCells($value);	
					}
					$totales[1] = $projectsUnities[2][5][1]+$projectsUnities[2][14][1];
					$totales[2] = $projectsUnities[2][5][2]+$projectsUnities[2][14][2];
					$totales[3] = $projectsUnities[2][5][3]+$projectsUnities[2][14][3];
					$totales[4] = $projectsUnities[2][5][4]+$projectsUnities[2][14][4];
					$totales[5] = $projectsUnities[2][5][6]+$projectsUnities[2][14][6];
					$totales[6] = $projectsUnities[2][5][1000]+$projectsUnities[2][14][1000];

					for($i=0;$i<7;$i++) $totales[$i] = "<b>".$totales[$i]."</b>";
					echo $html->tableCells($totales);
				
				?>
			</table>

			<div id="projectsUnitiesBASA"></div>
			<h3>FVAL</h3>
			<table>
				<?php
					echo $html->tableHeaders(array('Unidad','Pendientes','En preparación','En revisión','Aprobados','Rechazados','Total'));
					$totales = array();
					$totales[0] = 'Totales';
					$totales[1] = 0;
					$totales[2] = 0;
					$totales[3] = 0;
					$totales[4] = 0;					
					$totales[5] = 0;
					$totales[6] = 0;
 					$i=1;			
					foreach($projectsUnities[3] as $key=>$value){
						if($value[0]=='Subtotal de mantención' or $value[0]=="Subtotal de expansión")
						{
							foreach($value as &$k)
							{
								$k= "<b>".$k."</b>"; 
							}
						}
						echo $html->tableCells($value);							
					}
					$totales[1] = $projectsUnities[3][5][1]+$projectsUnities[3][14][1];
					$totales[2] = $projectsUnities[3][5][2]+$projectsUnities[3][14][2];
					$totales[3] = $projectsUnities[3][5][3]+$projectsUnities[3][14][3];
					$totales[4] = $projectsUnities[3][5][4]+$projectsUnities[3][14][4];
					$totales[5] = $projectsUnities[3][5][6]+$projectsUnities[3][14][6];
					$totales[6] = $projectsUnities[3][5][1000]+$projectsUnities[3][14][1000];
					
					for($i=0;$i<7;$i++) $totales[$i] = "<b>".$totales[$i]."</b>";
					echo $html->tableCells($totales);
				
				?>
			</table>

			<div id="projectsUnitiesFVAL"></div>
			
		<h2> Proyectos por EMSEFOR</h2>
		<h3> FCEL </h3>
		<table>
			<?php  echo $html->tableHeaders(array("Nombre EMSEFOR","SAP","Pendiente","En preparación","En revisión","Aprobados","Rechazados",'Total'));?>

			<?php
				foreach($projectsEmsefor[1] as $k => $r)
				{
					foreach($r as $kk=>&$v)
					{
						if(is_numeric($v)  && $kk != 1)
						{
							$v = number_format($v, 0, ',', '.');
						}

					}
					if($r[0] == "Total")
					{
						foreach($r as &$v) $v = "<b>".$v."</b>";
					}	
					echo $html->tableCells($r);

				}

			?>
			


		</table>
		<h3>BASA</h3>
		<table>
			<?php  echo $html->tableHeaders(array("Nombre EMSEFOR","SAP","Pendiente","En preparación","En revisión","Aprobados","Rechazados",'Total'));?>

			<?php

				foreach($projectsEmsefor[2] as $k => $r)
				{
					foreach($r as $kk=>&$v)
					{
						if(is_numeric($v) && $kk != 1)
						{
							$v = number_format($v, 0, ',', '.');
						}

					}
					if($r[0] == "Total")
					{
						foreach($r as &$v) $v = "<b>".$v."</b>";
					}
					echo $html->tableCells($r);
				}

			?>
			


		</table>
		<h3>FVAL</h3>
		<table>
			<?php  echo $html->tableHeaders(array("Nombre EMSEFOR","SAP","Pendiente","En preparación","En revisión","Aprobados","Rechazados",'Total'));?>

			<?php

				foreach($projectsEmsefor[3] as $k => $r){
					foreach($r as $kk=>&$v ){
					if(is_numeric($v)&& $kk != 1){
						$v = number_format($v, 0, ',', '.');
					}

				}if($r[0] == "Total")
					{
						foreach($r as &$v) $v = "<b>".$v."</b>";
					}
					echo $html->tableCells($r);

				}

			?>
			


		</table>
		<div style="page-break-before: always;"> </div>
		</div>
	</div>
	</div>
