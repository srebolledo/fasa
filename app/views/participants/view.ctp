<div class="participants view">
<h2><?php  __('Participant');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $participant['Participant']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nombre'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $participant['Participant']['nombre']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Apellido'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $participant['Participant']['apellido']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Position'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($participant['Position']['nombre'], array('controller' => 'positions', 'action' => 'view', $participant['Position']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Participant', true), array('action' => 'edit', $participant['Participant']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Participant', true), array('action' => 'delete', $participant['Participant']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $participant['Participant']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Participants', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Participant', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Positions', true), array('controller' => 'positions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Position', true), array('controller' => 'positions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Onereports', true), array('controller' => 'onereports', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Onereport', true), array('controller' => 'onereports', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Minutas', true), array('controller' => 'minutas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Minuta', true), array('controller' => 'minutas', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Onereports');?></h3>
	<?php if (!empty($participant['Onereport'])):?>
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
		foreach ($participant['Onereport'] as $onereport):
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
<div class="related">
	<h3><?php __('Related Minutas');?></h3>
	<?php if (!empty($participant['Minuta'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Tworeport Id'); ?></th>
		<th><?php __('Fecha'); ?></th>
		<th><?php __('Observaciones'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($participant['Minuta'] as $minuta):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $minuta['tworeport_id'];?></td>
			<td><?php echo $minuta['fecha'];?></td>
			<td><?php echo $minuta['observaciones'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'minutas', 'action' => 'view', $minuta['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'minutas', 'action' => 'edit', $minuta['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'minutas', 'action' => 'delete', $minuta['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $minuta['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Minuta', true), array('controller' => 'minutas', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
