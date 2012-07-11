<div class="onereports index">
	<h2><?php __('Mis ideas asignadas');?></h2>

<?php echo $this->Form->create('Onereport');?>
	<!--<fieldset>
 		<legend><?php __('Filtrar'); ?></legend>
	<?php
		echo $this->Form->input("ingeniero",array("options"=>$engineer,"default"=>0));
		echo $this->Form->input("indicator",array("options"=>$indicator,"default"=>0));
		echo $this->Form->input("idea",array("options"=>$idea,"default"=>0));
		echo $this->Form->input("carta",array("options"=>$carta,"default"=>0));
		echo $this->Form->input("proyecto",array("options"=>$proyecto,"default"=>0));
		echo $this->Form->input("emsefor",array("type"=>"text","id"=>"search"));
		echo $this->Form->hidden("emsefor_id",array("id"=>"emsefor_id"));

	?>
	</fieldset>
<?php echo $this->Form->end(__('Filtrar', true));?>	
-->
	

	<table cellpadding="0" cellspacing="0">
	<tr>
		

			<th><?php echo 'Ingeniero';?></th>
			<th><?php echo 'Fecha';?></th>
			<th><?php echo 'Unidad';?></th>
			<th><?php echo 'EMSEFOR';?></th>
			<th><?php echo 'Indicador';?></th>
			<th><?php echo 'Resumen idea';?></th>
			<th><?php echo 'Archivos';?></th>
			<th class="actions"><?php __('Acciones');?></th>
	

	</tr>
	<?php
	$i = 0;
	foreach ($onereports as $onereport):
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
		<td>
			<?php
				if(!empty($onereport['Projectfile'])){
						echo "<ul>";
						foreach($onereport['Projectfile'] as $projectfile){
							$pizza  = explode("-",$projectfile["Projectfile"]["filename"]);

							echo "<li>".$this->Html->link($projectfile["Projectfile"]["filename"], '/projects/'.$projectfile["Projectfile"]["filename"], array('escape' => false))."</li><br>";

					}
						echo "</ul>";	
				}

	
			?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Ver', true), array('action' => 'view', $onereport['Onereport']['id'])); ?>
			<?php echo $this->Html->link("Agregar corrección",array("controller"=>"projects","action"=>"add",$onereport["Onereport"]["id"],$onereport["Project"]['id']) );?>
			
		</td>
	</tr>
<?php endforeach; ?>
	</table>

