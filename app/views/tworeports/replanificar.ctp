<div class="tworeports form">

<?php echo $this->Form->create('Tworeport');?>
	<fieldset>
 		<legend><?php __('Replanificar reunión '.$this->data["Tworeport"]["id"]); ?></legend>
	<?php
		//echo $this->Form->input('id');
		echo $this->Form->hidden('engineer_id');
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

