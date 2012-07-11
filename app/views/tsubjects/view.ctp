<div class="tsubjects view">
<h2><?php  __('Tsubject');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tsubject['Tsubject']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Descripcion'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tsubject['Tsubject']['descripcion']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Tiempo'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tsubject['Tsubject']['tiempo']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Tsubject', true), array('action' => 'edit', $tsubject['Tsubject']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Tsubject', true), array('action' => 'delete', $tsubject['Tsubject']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $tsubject['Tsubject']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Tsubjects', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tsubject', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
