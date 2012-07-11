
<script type="text/javascript">

////file:app/webroot/js/application.js
$(document).ready(function(){
	//Ver si es capacitacion o actividad
	$('#TworeportActivityId').change(function(){
		var actividad = $('#TworeportActivityId').val();
		if(actividad == 11 || actividad == 1){
			$('#hide').show();
		
		}
		else{
			$('#hide').hide();
		}
			
	
	});









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


<div class="tworeports form">
Acá usted podrá planificar su trabajo. <br><br><br>

<?php echo $this->Form->create('Tworeport');?>
	<fieldset>
 		<legend><?php __('Nueva Planificación'); ?></legend>
	<?php		
		echo "<div id=leftside>";
		echo $this->Form->input('engineer_id',array( 'label' => 'Ingeniero residente' ) );
		echo $this->Form->hidden('semana');
		echo $this->Form->input('fecha');
		echo $this->Form->input('activity_id',array( 'label' => 'Actividad' ) );
		?>
		<div id="hide">
		<?php
		echo $this->Form->input('participantes',array('label'=>'Número de participantes'));
			?>
		</div>
	<div class="input text"><label for="search">Empresa de servicios forestales (EMSEFOR)</label><input type="text" id="search" /></div>
	<?php		
		
		echo $this->Form->hidden('emsefor_id',array( 'id' => 'emsefor_id' ) );

		echo "</div>";
		echo "<div id=rightside>";		
		echo $this->Form->input('unity_id',array( 'label' => 'Unidad a la que pertenece' ) );
		echo $this->Form->input('contacto',array( 'label' => 'Persona contactada' ) );
		//echo $this->Form->input('lugar',array( 'label' => 'Lugar que se lleva a cabo la reunión' ) );
		echo $this->Form->input('place_id',array( 'label' => 'Lugar que se lleva a cabo la reunión' ) );
		echo $this->Form->hidden('state_id',array('default'=>1) );
		
		echo $this->Form->hidden('parent',array('default'=>$padre[0]));
		echo $this->Form->hidden('order',array('default'=>$padre[1]));
		echo "</div>";	
		echo "<div id=leftside>";
		echo $this->Form->input('cuadrilla',array('label'=>'Sigla'));
		echo "</div>";
		echo "<div id=rightside>";
		echo $this->Form->input('tema',array( 'label' => 'Tema a tratar u observaciones' ) );
		echo "</div>";
	?>
	</fieldset>
<?php echo $this->Form->end(__('Guardar', true));?>
</div>
<div class="actions">
	<h3><?php __('Acciones'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Ver planificaciones', true), array('action' => 'abiertas'));?></li>
		
	</ul>
</div>
