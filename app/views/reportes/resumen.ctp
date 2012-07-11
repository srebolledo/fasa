<table>
		<tr><th>Filial</th><th>Emsefor</th><th>Número de trabajadores</th><th>Capacitacion 1.0</th><th>Capacitacion 2.0</th><th>Numero de TE</th><th>Numero de trabajadores participantes</th><th>%NTP/NT</th><th>total ideas</th><th>meta 6 ideas (si, no)</th><th>Nro rechazadas</th><th>Nro aprobadas</th><th>Total proyectos</th><th>Meta 1 proyecto</th><th>Pendiente</th><th>En preparacion</th><th>Proyecto en evaluacion</th><th>Aprobadas</th><th>Rechazadas</th><th>% proyectos sancionados</th></tr>
	<?php
	$i=0;
	foreach($onereport as $o){
		$i++;
		if($i%20==0 && $paginacion != 0){
		echo "<tr><th>Filial</th><th>Emsefor</th><th>Número de trabajadores</th><th>Capacitacion 1.0</th><th>Capacitacion 2.0</th><th>Numero de TE</th><th>Numero de trabajadores participantes</th><th>%NTP/NT</th><th>total ideas</th><th>meta 6 ideas (si, no)</th><th>Nro rechazadas</th><th>Nro aprobadas</th><th>Total proyectos</th><th>Meta 1 proyecto</th><th>Pendiente</th><th>En preparacion</th><th>Proyecto en evaluacion</th><th>Aprobadas</th><th>Rechazadas</th><th>% proyectos sancionados</th></tr>";
		
		
		}
		echo '<tr>';
		echo '<td>'.$filiales[$o['Emsefor']['filial_id']].'</td>';
		echo '<td>'.$o['Emsefor']['nombre'].'</td>';
		echo '<td>'.$trabajadores[$o['Onereport']['emsefor_id']][0]['Emsefor']['trabajadores'].'</td>'; //Total trabajadores
		echo '<td>-</td> <td>-</td> <td>-</td> <td>-</td> <td>-</td> ';
		echo '<td>'.$ideas[$o['Onereport']['emsefor_id']]['total'].'</td>';
		echo '<td>'.$ideas[$o['Onereport']['emsefor_id']]['meta'].'</td>';
		echo '<td>'.$ideas[$o['Onereport']['emsefor_id']]['rechazado'].'</td>';
		echo '<td>'.$ideas[$o['Onereport']['emsefor_id']]['aprobadas'].'</td>';
		echo '<td>'.$proyectos[$o['Onereport']['emsefor_id']]['total'].'</td>';
		echo '<td>'.$proyectos[$o['Onereport']['emsefor_id']]['meta'].'</td>';
		echo '<td>'.$proyectos[$o['Onereport']['emsefor_id']]['pendiente'].'</td>';
		echo '<td>'.$proyectos[$o['Onereport']['emsefor_id']]['preparacion'].'</td>';
		echo '<td>'.$proyectos[$o['Onereport']['emsefor_id']]['evaluacion'].'</td>';		
		echo '<td>'.$proyectos[$o['Onereport']['emsefor_id']]['aprobado'].'</td>';
		echo '<td>'.$proyectos[$o['Onereport']['emsefor_id']]['rechazado'].'</td>';
		if($proyectos[$o['Onereport']['emsefor_id']]['evaluacion']!=0){
			$porcentaje = ($proyectos[$o['Onereport']['emsefor_id']]['aprobado']+$proyectos[$o['Onereport']['emsefor_id']]['rechazado']/	$proyectos[$o['Onereport']['emsefor_id']]['evaluacion'])*100;
		}
		else{
			$porcentaje=0;
		}
		echo '<td>'.$porcentaje.'%</td>';
		echo '</tr>';
	
	}
	?>
	<?php
		echo '<tr>';
		echo '<td> </td>';
		echo '<td>Totales</td>';
		echo '<td>'.$total_trabajadores.'</td>'; //Total trabajadores
		echo '<td>-</td> <td>-</td> <td>-</td> <td>-</td> <td>-</td> ';
		echo '<td>'.$total_ideas['total'].'</td>';
		echo '<td>'.$total_ideas['meta'].'</td>';
		echo '<td>'.$total_ideas['rechazado'].'</td>';
		echo '<td>'.$total_ideas['aprobadas'].'</td>';
		echo '<td>'.$total_proyectos['total'].'</td>';
		echo '<td>'.$total_proyectos['meta'].'</td>';
		echo '<td>'.$total_proyectos['pendiente'].'</td>';
		echo '<td>'.$total_proyectos['preparacion'].'</td>';
		echo '<td>'.$total_proyectos['evaluacion'].'</td>';		
		echo '<td>'.$total_proyectos['aprobado'].'</td>';
		echo '<td>'.$total_proyectos['rechazado'].'</td>';
		echo '<td>'.round((($total_proyectos['aprobado']+$total_proyectos['rechazado'])/$total_proyectos['evaluacion'])*100,0)."%";
		echo '</tr>';
	
		
	if($paginacion!=0){
	?>
	<tr><th>Filial</th><th>Emsefor</th><th>Número de trabajadores</th><th>Capacitacion 1.0</th><th>Capacitacion 2.0</th><th>Numero de TE</th><th>Numero de trabajadores participantes</th><th>%NTP/NT</th><th>total ideas</th><th>meta 6 ideas (si, no)</th><th>Nro rechazadas</th><th>Nro aprobadas</th><th>Total proyectos</th><th>Meta 1 proyecto</th><th>Pendiente</th><th>En preparacion</th><th>Proyecto en evaluacion</th><th>Aprobadas</th><th>Rechazadas</th><th>% proyectos sancionados</th></tr>
<?php
	}
?>
	</table>

