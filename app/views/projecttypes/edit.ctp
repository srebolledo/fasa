<div class="projecttypes form">
<?php echo $this->Form->create('Projecttype');?>
	<fieldset>
 		<legend><?php __('Edit Projecttype'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('nombre');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Projecttype.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Projecttype.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Projecttypes', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Onereports', true), array('controller' => 'onereports', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Onereport', true), array('controller' => 'onereports', 'action' => 'add')); ?> </li>
	</ul>
</div>