<div class="tdsubjects view">
<h2><?php  __('Tdsubject');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tdsubject['Tdsubject']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Descripcion'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tdsubject['Tdsubject']['descripcion']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Tdsubject', true), array('action' => 'edit', $tdsubject['Tdsubject']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Tdsubject', true), array('action' => 'delete', $tdsubject['Tdsubject']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $tdsubject['Tdsubject']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Tdsubjects', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tdsubject', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
