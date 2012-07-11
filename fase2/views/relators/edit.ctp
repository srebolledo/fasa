<div class="relators form">
<?php echo $this->Form->create('Relator');?>
	<fieldset>
 		<legend><?php __('Edit Relator'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('nombre');
		echo $this->Form->input('apellido');
		echo $this->Form->input('capacitation_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Relator.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Relator.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Relators', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Capacitations', true), array('controller' => 'capacitations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Capacitation', true), array('controller' => 'capacitations', 'action' => 'add')); ?> </li>
	</ul>
</div>