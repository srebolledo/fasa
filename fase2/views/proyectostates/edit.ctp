<div class="proyectostates form">
<?php echo $this->Form->create('Proyectostate');?>
	<fieldset>
 		<legend><?php __('Edit Proyectostate'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('nombre');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Proyectostate.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Proyectostate.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Proyectostates', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Onereports', true), array('controller' => 'onereports', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Onereport', true), array('controller' => 'onereports', 'action' => 'add')); ?> </li>
	</ul>
</div>