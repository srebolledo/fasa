<div class="onereports view">
	<div id="box">
		<div id="leftside">
			<label>Ingeniero: </label>
				<?php echo $engineer[$onereport['Onereport']['engineer_id']]; ?>
			<label>Folio:</label>
				<?php echo $onereport['Onereport']['folio']; ?>
			<label>Fecha:</label>
			<?php echo $onereport['Onereport']['fecha']; ?>					
			<label>Unidad:</label>
				<?php echo $onereport['Unity']['nombre']; ?>
			<label>Cuadrilla:</label>
			<?php echo $onereport['Onereport']['cuadrilla']; ?>												
			<label>EMSEFOR:</label>
				<?php echo $onereport['Emsefor']['nombre']; ?>												
			<label>Código SAP:</label>
				<?php echo $onereport['Emsefor']['lugar']; ?>																		
			<label>Cargo:</label>
				<?php echo $onereport['Position']['nombre']; ?>
			<label>Nombre del trabajador:</label>
				<?php echo $onereport['Onereport']['trabajador']; ?>
		</div>
	
		<div id="rightside">
		<label>Indicador:</label>
				<?php echo $onereport['Indicator']['nombre'];?>
			<label>Estado de la idea:</label>
				<?php echo $onereport['Ideasstate']['nombre']; ?>
			<label>Estado de la carta:</label>
				<?php echo $onereport['Cartastate']['nombre']; ?>
			<label>Estado del proyecto:</label>
				<?php echo $onereport['Proyectostate']['nombre']; ?>
			<label>Fecha de inicio del proyecto:</label>
				
				<?php 
					if(strtotime($onereport['Onereport']['proyectofecha']) > 0){
						echo $onereport['Onereport']['proyectofecha']; 	
					}
					else{
						echo "-";
					}
					
				?>
			<label>Fecha de finalización del proyecto:</label>
				<?php 
					if(strtotime($onereport['Onereport']['proyectofechafin']) > 0){
						echo $onereport['Onereport']['proyectofechafin'];		
						
					}
					else{
						echo "-";
					
					}
				?>

		</div>
		<div id="box">
			<div id="leftside">
		<label>Resumen:</label>
				<?php echo $onereport['Onereport']['resumen']; ?>
			</div>
			<div id="rightside">	
		<label>Observaciones:</label>			
				<?php echo $onereport['Onereport']['observacion']; ?>
			</div>
	</div>
	<?php
		if(count($onereporthistory)>0):
	?>
	<div id="box">
		<label>Historia</label>
		<table>
			<tr>
				<th>Cambio</th>
			</tr>
			<?php
				foreach($onereporthistory as $history){
					$fechas = explode(' ',$history['Onereporthistory']['created']);
					$fecha = explode('-',$fechas[0]);
					$fecha = $fecha[2]."/".$fecha[1]."/".$fecha[0];
					$fechas = $fecha." ".$fechas[1];
					echo "<tr><td>";
					
					if(strcmp($history['Onereporthistory']['indicador'],"Idea") == 0){
						$msg = "La idea ha cambiado de ".$ideasstate[$history['Onereporthistory']['eanterior']]." a ".$ideasstate[$history['Onereporthistory']['esiguiente']]." en la fecha: ".$fechas;
						
					}
					
					if(strcmp($history['Onereporthistory']['indicador'],'Carta') == 0){
						$msg = "La carta ha cambiado de ".$cartastate[$history['Onereporthistory']['eanterior']]." a ".$cartastate[$history['Onereporthistory']['esiguiente']]." en la fecha: ".$fechas;
					}
					
					if(strcmp($history['Onereporthistory']['indicador'], 'Negocio') == 0){
						$msg = "El indicador de negocio ha cambiado de ".$businessstate[$history['Onereporthistory']['eanterior']]." a ".$businessstate[$history['Onereporthistory']['esiguiente']]." en la fecha: ".$fechas;
						
					}
					
					if(strcmp($history['Onereporthistory']['indicador'], 'Proyecto') == 0){
						$msg = "El proyecto ha cambiado de ".$proyectostate[$history['Onereporthistory']['eanterior']]." a ".$proyectostate[$history['Onereporthistory']['esiguiente']]." en la fecha: ".$fechas;
						
					}
					echo $msg;
					echo "</td></tr>";
				}
			?>
		</table>
	</div>
	<?php endif;?>
</div>

