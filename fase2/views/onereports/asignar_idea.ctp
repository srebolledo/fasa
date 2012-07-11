<div class="onereports index">
	<h2><?php __('Onereports');?></h2>

	<table cellpadding="0" cellspacing="0">
	<tr>

			<th><?php echo $this->Paginator->sort('Ingeniero','engineer_id');?></th>
			<th><?php echo $this->Paginator->sort('fecha');?></th>
			<th><?php echo $this->Paginator->sort('Unidad','unity_id');?></th>
			<th><?php echo $this->Paginator->sort('EMSEFOR','emsefor_id');?></th>
			<th><?php echo $this->Paginator->sort('Indicador','indicator_id');?></th>
			<th>Título</th>
			<th><?php echo $this->Paginator->sort('resumen');?></th>
			<th>Archivos</th>
			<th>Revisor</th>
			<th class="actions"><?php __('Acciones');?></th>

	</tr>
	<?php
	$i = 0;
	foreach ($onereports as $onereport):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
		if($onereport['Onereport']['encargado_id'] != 0){
			$class = ' class ="planificada"';
			
		}
	?>
	<tr<?php echo $class;?>>

		<td><?php echo $this->requestAction("/engineers/getName/".$onereport['Onereport']['engineer_id']); ?>&nbsp;</td>
		<td><?php echo $onereport['Onereport']['proyectofecha']; ?>&nbsp;</td>
		<td><?php echo $onereport['Unity']['nombre']; ?>&nbsp;</td>

		<td><?php echo $onereport['Emsefor']['nombre']; ?>&nbsp;</td>

		<td>
			<?php echo $onereport['Indicator']['nombre']; ?>
		</td>
		<td><?php echo $onereport['Project']['nombre']; ?>&nbsp;</td>
		<td><?php echo $onereport['Onereport']['resumen']; ?>&nbsp;</td>
		<?php if(!empty($onereport['Projectfile'])){
			echo "<td>";
			foreach($onereport['Projectfile'] as $projectfile){
				echo "<li>".$this->Html->link($projectfile["Projectfile"]["filename"], '/projects/'.$projectfile["Projectfile"]["filename"].'', array('escape' => false))."</li><br>";
		}
			echo "</td>";
		}
			
		else{
		?>
		<td> </td>
		<?php
			}
		?>
		<td><?php echo $this->requestAction("/engineers/getName/".$onereport['Onereport']['encargado_id']);?>
		<td class="actions">
			<?php echo $this->Html->link(__('Ver', true), array('action' => 'view', $onereport['Onereport']['id'])); ?>
			<?php echo $this->Html->link(__('Asignar', true), array('action' => 'asignar', $onereport['Onereport']['id'])); ?>
			<?php //echo $this->Html->link(__('Borrar', true), array('action' => 'delete', $onereport['Onereport']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $onereport['Onereport']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
