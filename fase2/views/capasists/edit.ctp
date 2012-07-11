<div class="capasists form">
<?php echo $this->Form->create('Capasist');?>
	<fieldset>
 		<legend><?php __('Edit Capasist'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('emsefor_id');
		echo $this->Form->input('total');
		echo $this->Form->input('capacitation_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Capasist.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Capasist.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Capasists', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Emsefors', true), array('controller' => 'emsefors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Emsefor', true), array('controller' => 'emsefors', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Capacitations', true), array('controller' => 'capacitations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Capacitation', true), array('controller' => 'capacitations', 'action' => 'add')); ?> </li>
	</ul>
</div>