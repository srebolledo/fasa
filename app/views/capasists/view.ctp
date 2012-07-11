<div class="capasists view">
<h2><?php  __('Capasist');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $capasist['Capasist']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Emsefor'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($capasist['Emsefor']['nombre'], array('controller' => 'emsefors', 'action' => 'view', $capasist['Emsefor']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Total'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $capasist['Capasist']['total']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Capacitation'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($capasist['Capacitation']['id'], array('controller' => 'capacitations', 'action' => 'view', $capasist['Capacitation']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Capasist', true), array('action' => 'edit', $capasist['Capasist']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Capasist', true), array('action' => 'delete', $capasist['Capasist']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $capasist['Capasist']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Capasists', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Capasist', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Emsefors', true), array('controller' => 'emsefors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Emsefor', true), array('controller' => 'emsefors', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Capacitations', true), array('controller' => 'capacitations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Capacitation', true), array('controller' => 'capacitations', 'action' => 'add')); ?> </li>
	</ul>
</div>
