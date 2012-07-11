<div class="onereports index">
	<h2><?php __('Onereports');?></h2>

<?php echo $this->Form->create('Onereport');?>
	<fieldset>
 		<legend><?php __('Filtrar'); ?></legend>
	<?php
		echo $this->Form->input("engineers",array("label"=>"Asignar a:"));
		echo $this->Form->hidden("onereport_id",array("default"=>$onereport_id));

	?>
	</fieldset>
<?php echo $this->Form->end(__('Asignar', true));?>	

	

	<table cellpadding="0" cellspacing="0">
	<tr>
			

			<th><?php echo 'Ingeniero';?></th>
			<th><?php echo 'Fecha';?></th>
			<th><?php echo 'Unidad';?></th>
			<th><?php echo 'EMSEFOR';?></th>
			<th><?php echo 'Indicador';?></th>
			<th><?php echo 'Resumen idea';?></th>

	</tr>
	<?php
	$i = 0;

		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>

		<td><?php echo $this->requestAction("/engineers/getName/".$onereport['Onereport']['engineer_id']); ?>&nbsp;</td>
		<td><?php echo $onereport['Onereport']['fecha']; ?>&nbsp;</td>
		<td><?php echo $onereport['Unity']['nombre']; ?>&nbsp;</td>

		<td><?php echo $onereport['Emsefor']['nombre']; ?>&nbsp;</td>

		<td>
			<?php echo $onereport['Indicator']['nombre']; ?>
		</td>
		<td><?php echo $onereport['Onereport']['resumen']; ?>&nbsp;</td>
		
	</tr>

	</table>

</div>
