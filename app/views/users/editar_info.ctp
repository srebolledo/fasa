<div class="users form">
<?php echo $this->Form->create('User');?>
	<fieldset>
 		<legend><?php __('Editar mi información'); ?></legend>
 		<div id ="box">
			<div id="leftside">
				<?php echo $this->Form->input('id');?>	
				<?php echo 'Nombre de usuario: '.$this->data['User']['username'];?>
				<?php echo $this->Form->input('password',array('value'=>'','label'=>'Contraseña'));?>
   			<?php echo $this->Form->input('password2',array('value'=>'','label'=>'Confirmar contraseña','type'=>'password'));?>
				<?php echo $this->Form->input('email');?>
			</div>
		</div>
	</fieldset>
	<?php echo $this->Form->end(__('Cambiar mis datos', true));?>
</div>
