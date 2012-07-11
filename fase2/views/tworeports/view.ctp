<div class="tworeports view">

	<div id="box">
		<div id="leftside">
			<label>Ingeniero</label>
				<?php echo $tworeport['Engineer']['nombre']." ".$tworeport['Engineer']['apellido'];?>
			<label>Fecha: </label>
			<?php echo $tworeport['Tworeport']['fecha']; ?>
			<label>Actividad: </label>
			<?php echo $tworeport['Activity']['nombre'];?>
			<label>EMSEFOR: </label>
			<?php echo $tworeport['Emsefor']['nombre'];?>
			<label>Tema a tratar: </label>
			<?php echo $tworeport['Tworeport']['tema'];?>
		</div>
		
		<div id="rightside">
		<label>Cuadrilla: </label>
		<?php echo $tworeport['Tworeport']['cuadrilla']; ?>
			<label>Unidad: </label>
				<?php echo $tworeport['Unity']['nombre'];?>			
			<label>Contacto: </label>
			<?php echo $tworeport['Tworeport']['contacto'];?>
			<label>Lugar de la reunión: </label>
			<?php echo $tworeport['Place']['nombre'];?>
			<label>Estado de la planificación:</label>
			<?php echo $tworeport['State']['nombre'];?>
		</div>
	
	</div>
	<div id="box actions">
		<?php
			if($tworeport["State"]["id"] == 1){
					echo $this->Html->link("Realizada",array("action"=>"realizada",$tworeport['Tworeport']['id']));
					echo $this->Html->link("No realizada",array("controller"=>"tworeports","action"=>"norealizada",$tworeport["Tworeport"]["id"]))."<br><br>";
					
				}
				if($tworeport["State"]["id"] == 2){
					//echo $this->Html->link("Agregar idea",array("controller"=>"onereports","action"=>"add"));
				}
				else if(($tworeport["State"]["id"] == 1 && strtotime("now") <= strtotime($tworeport["Tworeport"]["fecha"])) || ($tworeport["State"]["id"] == 3 )){

					echo $this->Html->link("Replanificar", array("controller"=>"tworeports","action"=>"replanificar",$tworeport["Tworeport"]["id"]));
				}
			?>
			
			<?php echo $this->Html->link(__('Editar', true), array('action' => 'edit', $tworeport['Tworeport']['id'])); ?>
			<?php echo $this->Html->link(__('Borrar', true), array('action' => 'delete', $tworeport['Tworeport']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $tworeport['Tworeport']['id'])); ?>

	</div>
	
	
	<!--
			<?php echo $tworeport['Tworeport']['parent']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Order'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tworeport['Tworeport']['order']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Acciones'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Volver',true), "/"); ?> </li>

	</ul>
</div>
<div class="related">
	<h3><?php __('Minuta');?></h3>
	<?php if (!empty($tworeport['Minuta'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Fecha'); ?></th>
		<th><?php __('Observaciones'); ?></th>
		<th><?php __('Tworeport Id'); ?></th>
		<th><?php __('Opened'); ?></th>
		<th><?php __('Participantes'); ?></th>
		<th><?php __('Temas A Tratar'); ?></th>
		<th><?php __('Acuerdos'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($tworeport['Minuta'] as $minuta):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $minuta['id'];?></td>
			<td><?php echo $minuta['fecha'];?></td>
			<td><?php echo $minuta['observaciones'];?></td>
			<td><?php echo $minuta['tworeport_id'];?></td>
			<td><?php echo $minuta['opened'];?></td>
			<td><?php echo $minuta['participantes'];?></td>
			<td><?php echo $minuta['temas_a_tratar'];?></td>
			<td><?php echo $minuta['acuerdos'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'minutas', 'action' => 'view', $minuta['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'minutas', 'action' => 'edit', $minuta['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'minutas', 'action' => 'delete', $minuta['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $minuta['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

<h3><?php __('Reporte de Ideas');?></h3>
	<?php if (!empty($tworeport['Onereport'])):?>

	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Folio'); ?></th>
		<th><?php __('Fecha'); ?></th>
		<th><?php __('Sap'); ?></th>
		<th><?php __('Trabajador'); ?></th>
		<th><?php __('Rut'); ?></th>
		<th><?php __('Indicador'); ?></th>
		<th><?php __('Resumen'); ?></th>
		<th><?php __('Estado de la idea'); ?></th>
		<th><?php __('Estado de la carta'); ?></th>
		<th><?php __('Estado del proyecto'); ?></th>
		<th><?php __('Fecha del proyecto'); ?></th>
		<th><?php __('Observaciones'); ?></th>
		<th><?php __('Tipo de proyecto'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($tworeport['Onereport'] as $onereport):

			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $onereport['id'];?></td>
			<td><?php echo $onereport['folio'];?></td>
			<td><?php echo $onereport['fecha'];?></td>
			<td><?php echo $onereport['sap'];?></td>
			<td><?php echo $onereport['trabajador'];?></td>
			<td><?php echo $onereport['rut'];?></td>
			<td><?php echo $onereport['indicator_id'];?></td>
			<td><?php echo $onereport['resumen'];?></td>
			<td><?php echo $onereport['ideasstate_id'];?></td>
			<td><?php echo $onereport['cartastate_id'];?></td>
			<td><?php echo $onereport['proyectostate_id'];?></td>
			<td><?php echo $onereport['proyectofecha'];?></td>
			<td><?php echo $onereport['observacion'];?></td>
			<td><?php echo $onereport['projecttype_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('Ver', true), array('controller' => 'onereports', 'action' => 'view', $onereport['id'])); ?>
			
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>-->


</div>
