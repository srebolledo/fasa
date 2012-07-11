<div class="minutas form">
<pre>
	El formulario que sigue sirve para rellenar la minuta.
</pre>
<?php echo $this->Form->create('Minuta');?>
	<fieldset>
 		<legend><?php __('Agregar minuta de la planificación '.$id_reporte); ?></legend>
	<?php
		echo $this->Form->input('fecha');
		echo $this->Form->input('observaciones');
		echo $this->Form->hidden('tworeport_id',array("default"=>$id_reporte));
		//echo $this->Form->input('opened');
		echo $this->Form->input('participantes');
		echo $this->Form->input('temas_a_tratar');
		echo $this->Form->input('acuerdos');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Ver mi planificación', true), array('controller' => 'tworeports', 'action' => 'abiertas')); ?> </li>
		<li><?php echo $this->Html->link(__('Volver al inicio', true), "/");?></li>
	</ul>
</div>
