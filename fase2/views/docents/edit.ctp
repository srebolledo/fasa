<div class="docents form">
<?php echo $this->Form->create('Docent');?>
	<fieldset>
 		<legend><?php __('Edit Docent'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('nombre');
		echo $this->Form->input('apellido');
		echo $this->Form->input('emsefor_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Docent.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Docent.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Docents', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Emsefors', true), array('controller' => 'emsefors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Emsefor', true), array('controller' => 'emsefors', 'action' => 'add')); ?> </li>
	</ul>
</div>