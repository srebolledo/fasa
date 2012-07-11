<div class="tdsubjects form">
<?php echo $this->Form->create('Tdsubject');?>
	<fieldset>
 		<legend><?php __('Edit Tdsubject'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('descripcion');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Tdsubject.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Tdsubject.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Tdsubjects', true), array('action' => 'index'));?></li>
	</ul>
</div>