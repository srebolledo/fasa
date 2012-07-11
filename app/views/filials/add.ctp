<div class="filials form">
<?php echo $this->Form->create('Filial');?>
	<fieldset>
 		<legend><?php __('Add Filial'); ?></legend>
	<?php
		echo $this->Form->input('nombre');
		echo $this->Form->input('lugar');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Filials', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Engineers', true), array('controller' => 'engineers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Engineer', true), array('controller' => 'engineers', 'action' => 'add')); ?> </li>
	</ul>
</div>