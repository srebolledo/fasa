<div class="places form">
<?php echo $this->Form->create('Place');?>
	<fieldset>
 		<legend><?php __('Edit Place'); ?></legend>
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

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Place.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Place.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Places', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Tworeports', true), array('controller' => 'tworeports', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tworeport', true), array('controller' => 'tworeports', 'action' => 'add')); ?> </li>
	</ul>
</div>