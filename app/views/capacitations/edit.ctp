<div class="capacitations form">
<?php echo $this->Form->create('Capacitation');?>
	<fieldset>
 		<legend><?php __('Edit Capacitation'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('fecha');
		echo $this->Form->input('filial_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Capacitation.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Capacitation.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Capacitations', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Filials', true), array('controller' => 'filials', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Filial', true), array('controller' => 'filials', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Capasists', true), array('controller' => 'capasists', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Capasist', true), array('controller' => 'capasists', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Relators', true), array('controller' => 'relators', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Relator', true), array('controller' => 'relators', 'action' => 'add')); ?> </li>
	</ul>
</div>