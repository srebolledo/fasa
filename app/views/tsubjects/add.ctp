<div class="tsubjects form">
<?php echo $this->Form->create('Tsubject');?>
	<fieldset>
 		<legend><?php __('Add Tsubject'); ?></legend>
	<?php
		echo $this->Form->input('descripcion');
		echo $this->Form->input('tiempo');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Tsubjects', true), array('action' => 'index'));?></li>
	</ul>
</div>