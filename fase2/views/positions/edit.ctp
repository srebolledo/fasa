<div class="positions form">
<?php echo $this->Form->create('Position');?>
	<fieldset>
 		<legend><?php __('Edit Position'); ?></legend>
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

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Position.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Position.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Positions', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Participants', true), array('controller' => 'participants', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Participant', true), array('controller' => 'participants', 'action' => 'add')); ?> </li>
	</ul>
</div>