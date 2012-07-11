<div class="capacitations view">
<h2><?php  __('Capacitation');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $capacitation['Capacitation']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Fecha'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $capacitation['Capacitation']['fecha']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Filial'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($capacitation['Filial']['nombre'], array('controller' => 'filials', 'action' => 'view', $capacitation['Filial']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $capacitation['Capacitation']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $capacitation['Capacitation']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Capacitation', true), array('action' => 'edit', $capacitation['Capacitation']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Capacitation', true), array('action' => 'delete', $capacitation['Capacitation']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $capacitation['Capacitation']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Capacitations', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Capacitation', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Filials', true), array('controller' => 'filials', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Filial', true), array('controller' => 'filials', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Capasists', true), array('controller' => 'capasists', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Capasist', true), array('controller' => 'capasists', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Relators', true), array('controller' => 'relators', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Relator', true), array('controller' => 'relators', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Capasists');?></h3>
	<?php if (!empty($capacitation['Capasist'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Emsefor Id'); ?></th>
		<th><?php __('Total'); ?></th>
		<th><?php __('Capacitation Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($capacitation['Capasist'] as $capasist):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $capasist['id'];?></td>
			<td><?php echo $capasist['emsefor_id'];?></td>
			<td><?php echo $capasist['total'];?></td>
			<td><?php echo $capasist['capacitation_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'capasists', 'action' => 'view', $capasist['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'capasists', 'action' => 'edit', $capasist['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'capasists', 'action' => 'delete', $capasist['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $capasist['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Capasist', true), array('controller' => 'capasists', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Relators');?></h3>
	<?php if (!empty($capacitation['Relator'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Nombre'); ?></th>
		<th><?php __('Apellido'); ?></th>
		<th><?php __('Capacitation Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($capacitation['Relator'] as $relator):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $relator['id'];?></td>
			<td><?php echo $relator['nombre'];?></td>
			<td><?php echo $relator['apellido'];?></td>
			<td><?php echo $relator['capacitation_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'relators', 'action' => 'view', $relator['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'relators', 'action' => 'edit', $relator['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'relators', 'action' => 'delete', $relator['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $relator['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Relator', true), array('controller' => 'relators', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
