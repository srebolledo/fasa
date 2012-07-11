<script type="text/javascript">
	var chart1; // globally available
$(document).ready(function() {
      reunionesPorIngeniero = new Highcharts.Chart({
         chart: {
            renderTo: 'reunionesIngeniero',
            type: 'column'
         },
         title: {
            text: 'Reuniones por ingeniero efectivamente realizadas'
         },
         xAxis: {
            categories: ['Planificación', 'Talleres', 'Grupo evaluador','Equipo de mejora']
         },
         yAxis: {
            title: {
               text: 'Reuniones realizadas'
            }
         },
         series: [
         <?php
         	$numero = count($reporte2);
         	$i=1;
         	foreach($reporte2 as $k=>$v){
         			if($k != 24){
							echo "{\nname: '".$v[0]."',\n";
							echo "data: [".$v[6].",".$v[11].",".$v[9].",".$v[10]."]\n},";
							}
					}
         ?>
          ]
      });
      
      reunionesPorFilial = new Highcharts.Chart({
         chart: {
            renderTo: 'reunionesFilial',
            type: 'column'
         },
         title: {
            text: 'Reuniones por Filial efectivamente realizadas'
         },
         xAxis: {
            categories: ['Planificación', 'Talleres', 'Grupo evaluador','Equipo de mejora']
         },
         yAxis: {
            title: {
               text: 'Reuniones realizadas'
            }
         },
         series: [
         <?php
         	$numero = count($reporte2);
         	$i=1;
         	foreach($ingFilialReportes as $k=>$v){
  	   			if($k != 3){
							echo "{\nname: '".$v[0]."',\n";
							echo "data: [".$v[1].",".$v[2].",".$v[3].",".$v[4]."]\n},";
						}
					}
         ?>
          ]
      });
         
      ideasIngenieros = new Highcharts.Chart({
         chart: {
            renderTo: 'ideasIngeniero',
            type: 'column'
         },
         title: {
            text: '	Ideas por ingeniero'
         },
         xAxis: {
            categories: ['Pendiente', 'Aprobadas', 'Rechazadas','Reproceso']
         },
         yAxis: {
            title: {
               text: 'Número de ideas'
            }
         },
         series: [
         <?php
         	foreach($ingIdeas as $k=>$v){
  	   			if($k != 9){
							echo "{\nname: '".$v[0]."',\n";
							echo "data: [".$v[1].",".$v[2].",".$v[3].",".$v[4]."]\n},";
						}
					}
         ?>
          ]
      });
      
      ideasFilial = new Highcharts.Chart({
         chart: {
            renderTo: 'ideasFilial',
            type: 'column'
         },
         title: {
            text: '	Ideas por filial'
         },
         xAxis: {
            categories: ['Pendiente', 'Aprobadas', 'Rechazadas','Reproceso']
         },
         yAxis: {
            title: {
               text: 'Número de ideas'
            }
         },
         series: [
         <?php
         	foreach($filialIdeas as $k=>$v){
  	   			if($k != 4){
							echo "{\nname: '".$v[0]."',\n";
							echo "data: [".$v[1].",".$v[2].",".$v[3].",".$v[4]."]\n},";
						}
					}
         ?>
          ]
      });
      
      estadoProyectos = new Highcharts.Chart({
         chart: {
            renderTo: 'estadoProyectosFilial',
            type: 'column'
         },
         title: {
            text: '	Ideas por filial'
         },
         xAxis: {
            categories: ['Pendiente', 'En preparación', 'En evaluación','Aprobado','Rechazado']
         },
         yAxis: {
            title: {
               text: 'Número de proyectos'
            }
         },
         series: [
         <?php
         	foreach($eProyecto as $k=>$v){
  	   			if($k != 4){
							echo "{\nname: '".$v[0]."',\n";
							echo "data: [".$v[1].",".$v[2].",".$v[3].",".$v[4].",".$v[5]."]\n},";
						}
					}
         ?>
          ]
      }); 
      
      estadoProyectosIngeniero = new Highcharts.Chart({
         chart: {
            renderTo: 'estadoProyectosIngeniero',
            type: 'column'
         },
         title: {
            text: '	Ideas por ingeniero'
         },
         xAxis: {
            categories: ['Pendiente', 'En preparación', 'En evaluación','Aprobado','Rechazado']
         },
         yAxis: {
            title: {
               text: 'Número de proyectos'
            }
         },
         series: [
         <?php
         	foreach($proyectoIngeniero as $k=>$v){
  	   			if($k != 24){
							echo "{\nname: '".$v[0]."',\n";
							echo "data: [".$v[1].",".$v[2].",".$v[3].",".$v[4].",".$v[5]."]\n},";
						}
					}
         ?>
          ]
      });      
      
   });	
   
   </script>
