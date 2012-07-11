<div class="onereporthistories form">
<?php echo $this->Form->create('Onereporthistory');?>
	<fieldset>
 		<legend><?php __('Add Onereporthistory'); ?></legend>
	<?php
		echo $this->Form->input('onereport_id');
		echo $this->Form->input('indicador');
		echo $this->Form->input('eanterior');
		echo $this->Form->input('esiguiente');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Onereporthistories', true), array('action' => 'index'));?></li>
	</ul>
</div>