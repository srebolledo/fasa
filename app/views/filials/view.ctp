<div class="filials view">
<h2><?php  __('Filial');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $filial['Filial']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nombre'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $filial['Filial']['nombre']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Lugar'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $filial['Filial']['lugar']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Filial', true), array('action' => 'edit', $filial['Filial']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Filial', true), array('action' => 'delete', $filial['Filial']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $filial['Filial']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Filials', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Filial', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Engineers', true), array('controller' => 'engineers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Engineer', true), array('controller' => 'engineers', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Engineers');?></h3>
	<?php if (!empty($filial['Engineer'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Nombre'); ?></th>
		<th><?php __('Apellido'); ?></th>
		<th><?php __('Filial Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($filial['Engineer'] as $engineer):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $engineer['id'];?></td>
			<td><?php echo $engineer['nombre'];?></td>
			<td><?php echo $engineer['apellido'];?></td>
			<td><?php echo $engineer['filial_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'engineers', 'action' => 'view', $engineer['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'engineers', 'action' => 'edit', $engineer['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'engineers', 'action' => 'delete', $engineer['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $engineer['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Engineer', true), array('controller' => 'engineers', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
