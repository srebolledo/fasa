<div class="businessstates view">
<h2><?php  __('Businessstate');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $businessstate['Businessstate']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nombre'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $businessstate['Businessstate']['nombre']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Acronimo'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $businessstate['Businessstate']['acronimo']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Businessstate', true), array('action' => 'edit', $businessstate['Businessstate']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Businessstate', true), array('action' => 'delete', $businessstate['Businessstate']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $businessstate['Businessstate']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Businessstates', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Businessstate', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
