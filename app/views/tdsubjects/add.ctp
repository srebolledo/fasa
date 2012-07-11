<div class="tdsubjects form">
<?php echo $this->Form->create('Tdsubject');?>
	<fieldset>
 		<legend><?php __('Add Tdsubject'); ?></legend>
	<?php
		echo $this->Form->input('descripcion');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Tdsubjects', true), array('action' => 'index'));?></li>
	</ul>
</div>