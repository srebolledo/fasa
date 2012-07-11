<div class="projects form">
<?php echo $this->Form->create('Project', array('enctype' => 'multipart/form-data') );?>
	<fieldset>
 		<legend><?php __('Agregar un proyecto / nuevo archivo de proyecto'); ?></legend>
	<?php
		if($info){
		echo $this->Form->input('nombre');
		echo $this->Form->input('projecttype_id');
		echo $this->Form->input('fecha');
		echo $this->Form->hidden('onereport_id',array('default'=>$id));

		}else{

		echo $this->Form->hidden('nombre');
		echo $this->Form->hidden('projecttype_id');
		echo $this->Form->hidden('fecha');
		echo $this->Form->hidden('onereport_id',array('default'=>$id));
		echo $this->Form->hidden('projectID',array('default'=>$projectID));
		}
		echo $this->Form->file('Projectfile.filename');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Projects', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Onereports', true), array('controller' => 'onereports', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Onereport', true), array('controller' => 'onereports', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Projecttypes', true), array('controller' => 'projecttypes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Projecttype', true), array('controller' => 'projecttypes', 'action' => 'add')); ?> </li>
	</ul>
</div>
