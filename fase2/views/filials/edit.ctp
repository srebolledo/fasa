<div class="filials form">
<?php echo $this->Form->create('Filial');?>
	<fieldset>
 		<legend><?php __('Edit Filial'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('nombre');
		echo $this->Form->input('lugar');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Filial.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Filial.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Filials', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Engineers', true), array('controller' => 'engineers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Engineer', true), array('controller' => 'engineers', 'action' => 'add')); ?> </li>
	</ul>
</div>