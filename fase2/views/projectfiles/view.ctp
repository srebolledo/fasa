<div class="projectfiles view">
<h2><?php  __('Projectfile');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $projectfile['Projectfile']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Project'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($projectfile['Project']['id'], array('controller' => 'projects', 'action' => 'view', $projectfile['Project']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Filename'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $projectfile['Projectfile']['filename']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Projectfile', true), array('action' => 'edit', $projectfile['Projectfile']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Projectfile', true), array('action' => 'delete', $projectfile['Projectfile']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $projectfile['Projectfile']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Projectfiles', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Projectfile', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Projects', true), array('controller' => 'projects', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Project', true), array('controller' => 'projects', 'action' => 'add')); ?> </li>
	</ul>
</div>
