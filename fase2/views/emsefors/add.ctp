<div class="emsefors form">
<?php echo $this->Form->create('Emsefor');?>
	<fieldset>
 		<legend><?php __('Add Emsefor'); ?></legend>
	<?php
		echo $this->Form->input('nombre');
		echo $this->Form->input('lugar');
		echo $this->Form->input('unity_id');
		echo $this->Form->input('filial_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Emsefors', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Filials', true), array('controller' => 'filials', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Filial', true), array('controller' => 'filials', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Unities', true), array('controller' => 'unities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unity', true), array('controller' => 'unities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Onereports', true), array('controller' => 'onereports', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Onereport', true), array('controller' => 'onereports', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tworeports', true), array('controller' => 'tworeports', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tworeport', true), array('controller' => 'tworeports', 'action' => 'add')); ?> </li>
	</ul>
</div>