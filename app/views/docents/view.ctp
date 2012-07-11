<div class="docents view">
<h2><?php  __('Docent');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $docent['Docent']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nombre'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $docent['Docent']['nombre']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Apellido'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $docent['Docent']['apellido']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Emsefor'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($docent['Emsefor']['nombre'], array('controller' => 'emsefors', 'action' => 'view', $docent['Emsefor']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Docent', true), array('action' => 'edit', $docent['Docent']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Docent', true), array('action' => 'delete', $docent['Docent']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $docent['Docent']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Docents', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Docent', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Emsefors', true), array('controller' => 'emsefors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Emsefor', true), array('controller' => 'emsefors', 'action' => 'add')); ?> </li>
	</ul>
</div>
