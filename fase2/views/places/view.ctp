<div class="places view">
<h2><?php  __('Place');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $place['Place']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nombre'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $place['Place']['nombre']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Place', true), array('action' => 'edit', $place['Place']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Place', true), array('action' => 'delete', $place['Place']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $place['Place']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Places', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Place', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tworeports', true), array('controller' => 'tworeports', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tworeport', true), array('controller' => 'tworeports', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Tworeports');?></h3>
	<?php if (!empty($place['Tworeport'])):?>
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
		<th><?php __('Place Id'); ?></th>
		<th><?php __('State Id'); ?></th>
		<th><?php __('Tema'); ?></th>
		<th><?php __('Parent'); ?></th>
		<th><?php __('Order'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($place['Tworeport'] as $tworeport):
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
			<td><?php echo $tworeport['place_id'];?></td>
			<td><?php echo $tworeport['state_id'];?></td>
			<td><?php echo $tworeport['tema'];?></td>
			<td><?php echo $tworeport['parent'];?></td>
			<td><?php echo $tworeport['order'];?></td>
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
