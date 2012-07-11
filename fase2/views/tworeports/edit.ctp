
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


<div class="tworeports form">

<?php echo $this->Form->create('Tworeport');?>
	<fieldset>
 		<legend><?php __('Edit Tworeport'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('engineer_id',array('type'=>'hidden'));
		echo $this->Form->hidden('semana');
		echo $this->Form->input('fecha');
		echo $this->Form->input('activity_id');
?>

<div class="input text"><label for="search">Empresa de servicios forestales (EMSEFOR)</label>
<input type="text" id="search" /></div>
	<?php	
		echo $this->Form->hidden('emsefor_id',array("id"=>"emsefor_id"));
		echo $this->Form->input('cuadrilla');
		echo $this->Form->input('unity_id');
		echo $this->Form->input('contacto');
		echo $this->Form->input('lugar');
		echo $this->Form->input('state_id');
		echo $this->Form->input('tema');
		echo $this->Form->hidden('parent',array("default" => $this->data["Tworeport"]["id"]));
		echo $this->Form->hidden('order',array("default" => $this->data["Tworeport"]["order"]+1));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Editar', true));?>
</div>

