<?php //pr($tworeports);?>

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



<div class="tworeports index">
<?php echo $this->Form->create('Tworeport');?>
	<fieldset>
 		<legend><?php __('Filtrar'); ?></legend>
 		<div id="box">
 			<div id="leftside">
				<?php
	 				echo $this->Form->input('semana', array("options"=> $semana,"default"=>0));
					echo $this->Form->input("unidad",array("options"=>$unity,"default"=>0));
					echo $this->Form->input("actividad",array("options"=>$activity,"default"=>0));

				?>
 			</div>
 			
 			<div id="rightside">
				<?php
					echo $this->Form->input("estado",array("options"=>$estado,"default"=>0));
					echo $this->Form->input("emsefor",array("type"=>"text","id"=>"search"));
					echo $this->Form->hidden("emsefor_id",array("id"=>"emsefor_id"));
	   			echo $this->Form->end(__('Filtrar', true));
				?>
 			</div>
 		
 		</div>

	</fieldset>

<?php 	if(isset($tworeports)){ ?>
	<h2><?php __('Planificaci&oacute;n');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
	<?php if($pagina){ ?>
			<th>ID</th>
			<th><?php echo $this->Paginator->sort("Semana",'semana');?></th>
		<!--	<th><?php echo $this->Paginator->sort('fecha');?></th>-->
			<th><?php echo $this->Paginator->sort('Actividad','activity_id');?></th>
			<th><?php echo $this->Paginator->sort("Emsefor",'emsefor_id');?></th>
		<!--	<th><?php echo $this->Paginator->sort('cuadrilla');?></th> -->
			<th><?php echo $this->Paginator->sort("Unidad",'unity_id');?></th>
		<!--	<th><?php echo $this->Paginator->sort('contacto');?></th>-->
		<!--	<th><?php echo $this->Paginator->sort('lugar');?></th> -->
			<th><?php echo $this->Paginator->sort("Estado",'state_id');?></th>
			<th><?php echo $this->Paginator->sort("Observaciones",'tema');?></th>
			<th class="actions"><?php __('Acciones');?></th>
	<?php }
		else{
			?>
			<th>ID</th>
			<th><?php echo "Semana";?></th>
		<!--	<th><?php echo 'Fecha';?></th>-->
			<th><?php echo 'Actividad';?></th>
			<th><?php echo "Emsefor";?></th>
			<!--<th><?php echo 'cuadrilla';?></th>-->
			<th><?php echo "Unidad";?></th>
			<!--<th><?php echo 'contacto';?></th>-->
			<!--<th><?php echo 'lugar';?></th>-->
			<th><?php echo "Estado";?></th>
			<th><?php echo "Observaciones";?></th>
			<th class="actions"><?php __('Acciones');?></th>
		<?php
		}				

	?>
	</tr>
	<?php
	$i = 0;
	$j=1;

	foreach ($tworeports as $tworeport):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
		if (strtotime("now")>strtotime($tworeport["Tworeport"]["fecha"]) && $tworeport["Tworeport"]["state_id"] == 1){
			$class = ' class="alert"';
		}
		if ($tworeport["Tworeport"]["state_id"] == 3){
			$class = ' class="norealizada"';
		}
		if ($tworeport["Tworeport"]["state_id"] == 1 &&strtotime("now")<strtotime($tworeport["Tworeport"]["fecha"]) ){
			$class = ' class="planificada"';
		}
		$view_url = $this->webroot.
				$this->params['controller'].
				'/view/'.$tworeport['Tworeport']['id'];
		
	?>
	<tr<?php echo $class;?> onclick="window.location.assign('<?php echo $view_url; ?>');">
		<td><?php echo $j;$j++;	?></td>
		<td><?php echo $tworeport['Tworeport']['semana']; ?>&nbsp;</td>
		<!--<td><?php echo $tworeport['Tworeport']['fecha']; ?>&nbsp;</td>-->
		<td>
			<?php echo $tworeport['Activity']['nombre']; ?>
		</td>
		<td>
			<?php echo $tworeport['Emsefor']['nombre']; ?>
		</td>
		<!--<td><?php echo $tworeport['Tworeport']['cuadrilla']; ?>&nbsp;</td>-->
		<td>
			<?php echo $tworeport['Unity']['nombre']; ?>
		</td>
		<!--<td><?php echo $tworeport["Tworeport"]["contacto"]; ?>&nbsp;</td>-->
		<!--<td><?php echo $tworeport['Place']['nombre']; ?>&nbsp;</td>-->
		<td>
			<?php echo $tworeport['State']['nombre']; ?>
		</td>
		<td><?php echo  $tworeport['Tworeport']['tema']; ?>&nbsp;</td>
		
		<td class="actions" style="text-align:left">
		<?php echo $this->Html->link(__('Ver', true), array('action' => 'view', $tworeport['Tworeport']['id'])); ?>

			<?php 
				if($tworeport["State"]["id"] == 1){
					echo $this->Html->link("Agregar minuta",array("controller"=>"minutas","action"=>"add",$tworeport['Tworeport']['id']));
					echo $this->Html->link("No realizada",array("controller"=>"tworeports","action"=>"norealizada",$tworeport["Tworeport"]["id"]))."<br><br>";
					
				}
				if($tworeport["State"]["id"] == 2){
					echo $this->Html->link("Agregar idea",array("controller"=>"onereports","action"=>"add"));
				}
				else if(($tworeport["State"]["id"] == 1 && strtotime("now") <= strtotime($tworeport["Tworeport"]["fecha"])) || ($tworeport["State"]["id"] == 3 )){

					echo $this->Html->link("Replanificar", array("controller"=>"tworeports","action"=>"replanificar",$tworeport["Tworeport"]["id"]));
				}
			?>
			
			<?php echo $this->Html->link(__('Editar', true), array('action' => 'edit', $tworeport['Tworeport']['id'])); ?>
			<?php echo $this->Html->link(__('Borrar', true), array('action' => 'delete', $tworeport['Tworeport']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $tworeport['Tworeport']['id'])); ?>

		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	if($pagina){
		echo "<p>";
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
	<?php
	
	}
	?>
	<?php } ?>
</div>



<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Nueva planificación', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Volver al inicio', true), "/");?></li>
		
	</ul>
	
</div>

