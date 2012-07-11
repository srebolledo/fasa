<div class="emsefors form">
<?php echo $this->Form->create('Emsefor');?>

	<div id="box">
		<div id="leftside">
	<?php
		echo $this->Form->input('nombre',array('label'=>'Nombre de fantasía (Éste será usado para las búsquedas)'));
		echo $this->Form->input('nombre_real',array('label'=>'Nombre real','type'=>'text'));
		echo $this->Form->input('lugar',array('label'=>'Código SAP','type'=>'text'));
		echo $this->Form->input('contacto',array('label'=>'Encargado EO','type'=>'text'));
		
?>		
		</div>
		<div id="rightside">
			<?php
				echo $this->Form->input('trabajadores',array('label'=>'Número de trabajadores'));
				echo $this->Form->input('unity_id',array('label'=>'Unidad'));
				if(isset($filialIngeniero)){
					echo $this->Form->hidden('filial_id',array('label'=>'Filial','default'=>$filialIngeniero,'type'=>'text'));
				}
				else{
					echo $this->Form->input('filial_id',array('label'=>'Filial'));				
				}
				
			?>
			<?php echo $this->Form->end(__('Agregar', true));?>
		</div>
	
	</div>
		

</div>

