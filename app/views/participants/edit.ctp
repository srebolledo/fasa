<div class="participants form">
<?php echo $this->Form->create('Participant');?>
	<fieldset>
 		<legend><?php __('Edit Participant'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('nombre');
		echo $this->Form->input('apellido');
		echo $this->Form->input('position_id');
		echo $this->Form->input('Minuta');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Participant.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Participant.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Participants', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Positions', true), array('controller' => 'positions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Position', true), array('controller' => 'positions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Onereports', true), array('controller' => 'onereports', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Onereport', true), array('controller' => 'onereports', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Minutas', true), array('controller' => 'minutas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Minuta', true), array('controller' => 'minutas', 'action' => 'add')); ?> </li>
	</ul>
</div>