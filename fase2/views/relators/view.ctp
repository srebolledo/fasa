<div class="relators view">
<h2><?php  __('Relator');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $relator['Relator']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nombre'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $relator['Relator']['nombre']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Apellido'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $relator['Relator']['apellido']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Capacitation'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($relator['Capacitation']['id'], array('controller' => 'capacitations', 'action' => 'view', $relator['Capacitation']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Relator', true), array('action' => 'edit', $relator['Relator']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Relator', true), array('action' => 'delete', $relator['Relator']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $relator['Relator']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Relators', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Relator', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Capacitations', true), array('controller' => 'capacitations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Capacitation', true), array('controller' => 'capacitations', 'action' => 'add')); ?> </li>
	</ul>
</div>
