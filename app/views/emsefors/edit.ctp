<div class="emsefors form">
<?php echo $this->Form->create('Emsefor');?>
	<div id="box">
		<div id="leftside">
		<?php
			echo $this->Form->input('id');
			echo $this->Form->input('nombre',array('Nombre de fantasía (éste será el que permita las búsquedas)'));
			echo $this->Form->input('nombre_real',array('Nombre de fantasía (éste será el que permita las búsquedas)','type'=>'text'));
			echo $this->Form->input('lugar',array('label'=>'Código SAP','type'=>'text'));
			echo $this->Form->input('contacto',array('label'=>'Encargado EO','type'=>'text'));
		?>	
		</div>
		<div id="rightside">
		<?php
			

			echo $this->Form->input('trabajadores',array('label'=>'Número de trabajadores'));
			echo $this->Form->input('unity_id',array('label'=>'Unidad'));
			echo $this->Form->hidden('filial_id',array('label'=>'Filial'));

			
		?>
		<?php echo $this->Form->end(__('Guardar', true));?>		

		</div>
	
	</div>
	

</div>

