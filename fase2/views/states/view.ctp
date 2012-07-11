<div class="states view">
<h2><?php  __('State');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $state['State']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nombre'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $state['State']['nombre']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit State', true), array('action' => 'edit', $state['State']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete State', true), array('action' => 'delete', $state['State']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $state['State']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List States', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New State', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Onereports', true), array('controller' => 'onereports', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Onereport', true), array('controller' => 'onereports', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tworeports', true), array('controller' => 'tworeports', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tworeport', true), array('controller' => 'tworeports', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Onereports');?></h3>
	<?php if (!empty($state['Onereport'])):?>
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
		foreach ($state['Onereport'] as $onereport):
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
	<h3><?php __('Related Tworeports');?></h3>
	<?php if (!empty($state['Tworeport'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Engineer Id'); ?></th>
		<th><?php __('Semana'); ?></th>
		<th><?php __('Fecha'); ?></th>
		<th><?php __('Activity Id'); ?></th>
		<th><?php __('Emsefor Id'); ?></th>
		<th><?php __('Cuadrilla'); ?></th>
		<th><?php __('Unity Id'); ?></th>
		<th><?php __('Contacto'); ?></th>
		<th><?php __('Lugar'); ?></th>
		<th><?php __('State Id'); ?></th>
		<th><?php __('Tema'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($state['Tworeport'] as $tworeport):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $tworeport['id'];?></td>
			<td><?php echo $tworeport['engineer_id'];?></td>
			<td><?php echo $tworeport['semana'];?></td>
			<td><?php echo $tworeport['fecha'];?></td>
			<td><?php echo $tworeport['activity_id'];?></td>
			<td><?php echo $tworeport['emsefor_id'];?></td>
			<td><?php echo $tworeport['cuadrilla'];?></td>
			<td><?php echo $tworeport['unity_id'];?></td>
			<td><?php echo $tworeport['contacto'];?></td>
			<td><?php echo $tworeport['lugar'];?></td>
			<td><?php echo $tworeport['state_id'];?></td>
			<td><?php echo $tworeport['tema'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'tworeports', 'action' => 'view', $tworeport['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'tworeports', 'action' => 'edit', $tworeport['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'tworeports', 'action' => 'delete', $tworeport['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $tworeport['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Tworeport', true), array('controller' => 'tworeports', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
