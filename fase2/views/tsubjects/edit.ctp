<div class="tsubjects form">
<?php echo $this->Form->create('Tsubject');?>
	<fieldset>
 		<legend><?php __('Edit Tsubject'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('descripcion');
		echo $this->Form->input('tiempo');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Tsubject.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Tsubject.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Tsubjects', true), array('action' => 'index'));?></li>
	</ul>
</div>