<div class="minutas form">
<?php echo $this->Form->create('Minuta');?>
	<fieldset>
 		<legend><?php __('Edit Minuta'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('fecha');
		echo $this->Form->input('observaciones');
		echo $this->Form->input('tworeport_id');
		echo $this->Form->input('opened');
		echo $this->Form->input('participantes');
		echo $this->Form->input('temas_a_tratar');
		echo $this->Form->input('acuerdos');
		echo $this->Form->input('Participant');
		echo $this->Form->input('Tdsubject');
		echo $this->Form->input('Tsubject');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Minuta.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Minuta.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Minutas', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Tworeports', true), array('controller' => 'tworeports', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tworeport', true), array('controller' => 'tworeports', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Participants', true), array('controller' => 'participants', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Participant', true), array('controller' => 'participants', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tdsubjects', true), array('controller' => 'tdsubjects', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tdsubject', true), array('controller' => 'tdsubjects', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tsubjects', true), array('controller' => 'tsubjects', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tsubject', true), array('controller' => 'tsubjects', 'action' => 'add')); ?> </li>
	</ul>
</div>