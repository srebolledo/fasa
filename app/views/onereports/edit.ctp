
<script type="text/javascript">

////file:app/webroot/js/application.js
$(document).ready(function(){
// Caching the movieName textbox:
var username = $('#search');

// Defining a placeholder text:
<?php
	if(!empty($emsefors_id)){
		echo "username.defaultText('".$this->requestAction("/emsefors/getName/".$emsefors_id)."')";
}
	else{
		echo "username.defaultText('Buscar emsefor')";

	}
?>


// Using jQuery UI's autocomplete widget:
username.autocomplete({
minLength    : 1,
source        : '<?php echo $this->base;?>/onereports/getEmsefor',

select: function(event,ui) {
          $("#emsefor_id").val(ui.item.id);
	  //alert(ui.item.id);
          //$("#search").val(ui.item.label);
          //$("#researchline").val(ui.item.researchline);	

          }
});
});
$('.ui-autocomplete-input').css('width','300px');

// A custom jQuery method for placeholder text:




$.fn.defaultText = function(value,label){

	var element = this.eq(0);

	element.data('defaultText',value);

	element.focus(
		function(){
			if(element.val() == value){
				element.val('').removeClass('defaultText');
				$("#emsefor").hide();

			}
		}
	).blur(function(){
			if(element.val() == '' || element.val() == value){
				element.addClass('defaultText').val(value);

			}
		}
	);

	return element.blur();
}

$('#search').keypress(function(e) {
  // when Enter is pressed
  if (e.which === 13 || e.keyCode === 13) {
    $(this).blur();
  }
});
</script>


<div class="onereports form">
<?php echo $this->Form->create('Onereport');?>
	<div id="box">
	<div id="leftside">
<?php
		echo $this->Form->input('id');
		if($tipoUsuario != 0){
			echo $this->Form->input('engineer_id',array('label'=>'Ingeniero'));
		}
		else{
			echo $this->Form->input('engineer_id',array('label'=>'Ingeniero','type'=>'hidden'));
		}
		echo $this->Form->input('correlativoidea',array('type'=>'hidden'));
		echo $this->Form->input('folio');
		echo $this->Form->input('fecha');
		echo $this->Form->input('unity_id',array('label'=>'Unidad'));
		echo $this->Form->input('cuadrilla');
		echo $this->Form->hidden('emsefor_id',array("id"=>"emsefor_id"));
		echo $this->Form->input('sap',array('type'=>'hidden'));
		echo $this->Form->input('position_id',array('label'=>'Cargo del trabajador'));
		echo $this->Form->input('trabajador',array('label'=>'Nombre del trabajador'));
		echo $this->Form->input('indicator_id',array('label'=>'Indicador'));
?>

	</div>

	<div id="rightside">
	<div class="input text"><label for="search">Empresa de servicios forestales (EMSEFOR)</label>
<input type="text" id="search" /></div>
<?php
		
		echo $this->Form->input('resumen');
		if($tipoUsuario != 0){
			echo $this->Form->input('ideasstate_id',array('label'=>'Estado de idea'));
			echo $this->Form->input('cartastate_id',array('label'=>'Estado de carta'));
			echo $this->Form->input('proyectostate_id',array('label'=>'Estado de proyecto'));
			echo $this->Form->input('proyectofecha',array('label'=>'Fecha de inicio de proyecto','type'=>'date','selected'=>date('Y-m-d')));
			echo $this->Form->input('proyectofechafin',array('label'=>'Fecha de término de proyecto','type'=>'hidden'));
		}
		else{
			echo $this->Form->input('ideasstate_id',array('label'=>'Estado de idea','type'=>'hidden'));
			echo $this->Form->input('cartastate_id',array('label'=>'Estado de carta','type'=>'hidden'));
			echo $this->Form->input('proyectostate_id',array('label'=>'Estado de proyecto','type'=>'hidden'));
			echo $this->Form->input('proyectofecha',array('label'=>'Fecha de inicio de proyecto','type'=>'date','selected'=>date('Y-m-d'),'type'=>'hidden'));
			echo $this->Form->input('proyectofechafin',array('label'=>'Fecha de término de proyecto','type'=>'hidden'));
		
		}
		echo $this->Form->input('observacion',array('label'=>'Observación'));
	?>
	<?php echo $this->Form->end(__('Guardar', true));?>

	</div>
	</div>

</div>

