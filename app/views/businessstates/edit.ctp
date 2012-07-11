<div class="businessstates form">
<?php echo $this->Form->create('Businessstate');?>
	<fieldset>
 		<legend><?php __('Edit Businessstate'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('nombre');
		echo $this->Form->input('acronimo');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Businessstate.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Businessstate.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Businessstates', true), array('action' => 'index'));?></li>
	</ul>
</div>