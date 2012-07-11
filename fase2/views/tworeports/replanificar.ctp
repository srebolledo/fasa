<div class="tworeports form">

<?php echo $this->Form->create('Tworeport');?>
	<fieldset>
 		<legend><?php __('Replanificar reunión '.$this->data["Tworeport"]["id"]); ?></legend>
	<?php
		//echo $this->Form->input('id');
		echo $this->Form->input('engineer_id');
		echo $this->Form->hidden('semana');
		echo $this->Form->input('fecha');
		echo $this->Form->input('activity_id');
		echo $this->Form->input('emsefor_id');
		echo $this->Form->input('cuadrilla');
		echo $this->Form->input('unity_id');
		echo $this->Form->input('contacto');
		echo $this->Form->input('lugar');
		echo $this->Form->hidden('state_id',array("default"=>1));
		echo $this->Form->input('tema');
		echo $this->Form->hidden('parent',array("default" => $this->data["Tworeport"]["id"]));
		echo $this->Form->hidden('order',array("default" => $this->data["Tworeport"]["order"]+1));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Tworeport.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Tworeport.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Tworeports', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Engineers', true), array('controller' => 'engineers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Engineer', true), array('controller' => 'engineers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Activities', true), array('controller' => 'activities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Activity', true), array('controller' => 'activities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Emsefors', true), array('controller' => 'emsefors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Emsefor', true), array('controller' => 'emsefors', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Unities', true), array('controller' => 'unities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unity', true), array('controller' => 'unities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List States', true), array('controller' => 'states', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New State', true), array('controller' => 'states', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Minutas', true), array('controller' => 'minutas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Minuta', true), array('controller' => 'minutas', 'action' => 'add')); ?> </li>
	</ul>
</div>
