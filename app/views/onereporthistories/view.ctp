<div class="onereporthistories view">
<h2><?php  __('Onereporthistory');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $onereporthistory['Onereporthistory']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Onereport Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $onereporthistory['Onereporthistory']['onereport_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Indicador'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $onereporthistory['Onereporthistory']['indicador']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Eanterior'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $onereporthistory['Onereporthistory']['eanterior']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Esiguiente'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $onereporthistory['Onereporthistory']['esiguiente']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $onereporthistory['Onereporthistory']['created']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Onereporthistory', true), array('action' => 'edit', $onereporthistory['Onereporthistory']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Onereporthistory', true), array('action' => 'delete', $onereporthistory['Onereporthistory']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $onereporthistory['Onereporthistory']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Onereporthistories', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Onereporthistory', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
