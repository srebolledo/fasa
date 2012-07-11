<div class="activities form">
<?php echo $this->Form->create('Activity');?>
	<fieldset>
 		<legend><?php __('Edit Activity'); ?></legend>
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

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Activity.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Activity.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Activities', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Tworeports', true), array('controller' => 'tworeports', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tworeport', true), array('controller' => 'tworeports', 'action' => 'add')); ?> </li>
	</ul>
</div>