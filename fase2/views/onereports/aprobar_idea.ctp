<div class="onereports form">
<?php echo $this->Form->create('Onereport');?>
	<fieldset>
 		<legend><?php __('Edit Onereport'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->hidden('engineer_id');
		echo $this->Form->hidden('correlativoidea');
		echo $this->Form->hidden('folio');
		echo $this->Form->hidden('fecha');
		echo $this->Form->hidden('unity_id');
		echo $this->Form->hidden('cuadrilla');
		echo $this->Form->hidden('emsefor_id');
		echo $this->Form->hidden('sap');
		echo $this->Form->hidden('position_id');
		echo $this->Form->hidden('trabajador');
		echo $this->Form->hidden('indicator_id');
		echo $this->Form->hidden('resumen');
		echo $this->Form->hidden('ideasstate_id');
		echo $this->Form->hidden('cartastate_id');
		echo $this->Form->hidden('proyectostate_id');
		echo $this->Form->input('proyectofecha',array("label"=> "Fecha de inicio del proyecto"));
		echo $this->Form->hidden('proyectofechafin');
		echo $this->Form->hidden('observacion');

	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Onereport.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Onereport.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Onereports', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Indicators', true), array('controller' => 'indicators', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Indicator', true), array('controller' => 'indicators', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Ideasstates', true), array('controller' => 'ideasstates', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ideasstate', true), array('controller' => 'ideasstates', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Cartastates', true), array('controller' => 'cartastates', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cartastate', true), array('controller' => 'cartastates', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Proyectostates', true), array('controller' => 'proyectostates', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Proyectostate', true), array('controller' => 'proyectostates', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Projecttypes', true), array('controller' => 'projecttypes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Projecttype', true), array('controller' => 'projecttypes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tworeports', true), array('controller' => 'tworeports', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tworeport', true), array('controller' => 'tworeports', 'action' => 'add')); ?> </li>
	</ul>
</div>
