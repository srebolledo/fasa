<div class="onereporthistories form">
<?php echo $this->Form->create('Onereporthistory');?>
	<fieldset>
 		<legend><?php __('Edit Onereporthistory'); ?></legend>
	<?php
		echo $this->Form->input('id');
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

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Onereporthistory.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Onereporthistory.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Onereporthistories', true), array('action' => 'index'));?></li>
	</ul>
</div>