<script type="text/javascript">

////file:app/webroot/js/application.js
$(document).ready(function(){
// Caching the movieName textbox:
var username = $('#search');

// Defining a placeholder text:
username.defaultText('Buscar EMSEFOR');

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

			}
		}
	).blur(function(){
			if(element.val() == '' || element.val() == value){
				element.addClass('defaultText').val(value);
				$("#emsefor_id").val("0");

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
	<fieldset>
 		<legend><?php __('Agregar idea'); ?></legend>
	<?php
		echo "<div id=leftside>";
		echo $this->Form->input('engineer_id',array("label"=>"Ingeniero"));
		echo $this->Form->hidden('correlativoidea',array("label"=>"Correlativo de la idea"));
		echo $this->Form->input('folio');
		echo $this->Form->input('fecha');
		echo $this->Form->input('indicator_id',array("label"=>"Tipo de indicador"));
		echo $this->Form->input('cuadrilla'	,array('type'=>'text','label'=>'Sigla'));
		echo "</div>";
		echo "<div id=rightside>";		
		?>
	<div class="input text"><label for="search">Empresa de servicios forestales (EMSEFOR)</label><input type="text" id="search" /></div>
	<?php
		//echo $this->Form->input('emsefor',array("label"=>"Empresa de servicios forestales (EMSEFOR)","id"=>"search","type"=>"text"));
		echo $this->Form->hidden("emsefor_id",array("id"=>"emsefor_id"));
		echo $this->Form->input('unity_id',array("label"=>"Unidad"));
		echo $this->Form->hidden('sap',array("label"=>"Código SAP"));
		echo $this->Form->input('position_id',array("label"=>"Cargo"));
		echo $this->Form->input('trabajador',array("label"=>"Nombre del trabajador"));


		echo "</div>";
		echo "<div id=\"box\">";
		echo $this->Form->input('resumen',array("label"=>"Resumen de la idea"));
		echo $this->Form->hidden('ideasstate_id',array("label"=>"Estado de la idea","default"=>1));
		echo $this->Form->hidden('cartastate_id',array("label"=>"Estado de la carta","default"=>0));
		echo $this->Form->hidden('proyectostate_id',array("label"=>"Estado del proyecto","default"=>0));
		//echo $this->Form->input('proyectofecha',array("label"=>"Fecha de inicio del proyecto"));
		//echo $this->Form->input('proyectofechafin',array("label"=>"Fecha de término del proyecto"));
    echo $this->Form->input('businessstate_id',array('label'=>'Tipo de mejora'));
		echo $this->Form->input('observacion',array("label"=>"Observaciones"));
		echo "</div>";
	?>
	</fieldset>
<?php echo $this->Form->end(__('Guardar', true));?>
</div>
<div class="actions">
	<h3><?php __('Acciones'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Nueva planificación', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Volver al inicio', true), "/");?></li>

		
	</ul>
</div>
