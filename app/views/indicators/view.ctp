<div class="indicators view">
<h2><?php  __('Indicator');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $indicator['Indicator']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nombre'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $indicator['Indicator']['nombre']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Indicator', true), array('action' => 'edit', $indicator['Indicator']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Indicator', true), array('action' => 'delete', $indicator['Indicator']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $indicator['Indicator']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Indicators', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Indicator', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Onereports', true), array('controller' => 'onereports', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Onereport', true), array('controller' => 'onereports', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Onereports');?></h3>
	<?php if (!empty($indicator['Onereport'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Engineer Id'); ?></th>
		<th><?php __('Folio'); ?></th>
		<th><?php __('Fecha'); ?></th>
		<th><?php __('Emsefor Id'); ?></th>
		<th><?php __('Unity Id'); ?></th>
		<th><?php __('Sap'); ?></th>
		<th><?php __('Participant Id'); ?></th>
		<th><?php __('Indicator Id'); ?></th>
		<th><?php __('Resumen'); ?></th>
		<th><?php __('State Id'); ?></th>
		<th><?php __('Cartastate Id'); ?></th>
		<th><?php __('Proyectostate Id'); ?></th>
		<th><?php __('Proyectofecha'); ?></th>
		<th><?php __('Observacion'); ?></th>
		<th><?php __('Projecttype Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($indicator['Onereport'] as $onereport):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $onereport['id'];?></td>
			<td><?php echo $onereport['engineer_id'];?></td>
			<td><?php echo $onereport['folio'];?></td>
			<td><?php echo $onereport['fecha'];?></td>
			<td><?php echo $onereport['emsefor_id'];?></td>
			<td><?php echo $onereport['unity_id'];?></td>
			<td><?php echo $onereport['sap'];?></td>
			<td><?php echo $onereport['participant_id'];?></td>
			<td><?php echo $onereport['indicator_id'];?></td>
			<td><?php echo $onereport['resumen'];?></td>
			<td><?php echo $onereport['state_id'];?></td>
			<td><?php echo $onereport['cartastate_id'];?></td>
			<td><?php echo $onereport['proyectostate_id'];?></td>
			<td><?php echo $onereport['proyectofecha'];?></td>
			<td><?php echo $onereport['observacion'];?></td>
			<td><?php echo $onereport['projecttype_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'onereports', 'action' => 'view', $onereport['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'onereports', 'action' => 'edit', $onereport['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'onereports', 'action' => 'delete', $onereport['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $onereport['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Onereport', true), array('controller' => 'onereports', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
