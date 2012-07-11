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
 		<div id="box">
	 		
	 		<div id="leftside">
		 		<?php
					echo $this->Form->input('semana', array("options"=> $semana,"default"=>0));
					echo $this->Form->input("ingeniero",array("options"=>$engineer,"default"=>0));
					echo $this->Form->input("actividad",array("options"=>$activity,"default"=>0));
					echo $this->Form->input("unidad",array("options"=>$unity,"default"=>0));
				?>
	 		</div>
	 		
	 		<div id="rightside">
	 			<?php
		 			echo $this->Form->input("estado",array("options"=>$estado,"default"=>0));
					echo $this->Form->input("emsefor",array("type"=>"text","id"=>"search"));
					echo $this->Form->hidden("emsefor_id",array("id"=>"emsefor_id"));
	 			?>
	 			<?php echo $this->Form->end(__('Filtrar', true));?>	
	 		</div>
 		</div>
	</fieldset>


	
	<table cellpadding="0" cellspacing="0">
	<tr>
		<?php
			if($pagina){	
			
		?>
			<th>ID</th>
			<th><?php echo $this->Paginator->sort('Ingeniero','engineer_id');?></th>
		<!--	<th><?php echo $this->Paginator->sort('semana');?></th>-->
			<th><?php echo $this->Paginator->sort('fecha');?></th>
			<th><?php echo $this->Paginator->sort('Actividad','activity_id');?></th>
			<th><?php echo $this->Paginator->sort('EMSEFOR','emsefor_id');?></th>
			<th><?php echo $this->Paginator->sort('Participantes programados','participantes');?></th>
			<th><?php echo $this->Paginator->sort('Participantes reales','participantes_reales');?></th>
			<!--<th><?php echo $this->Paginator->sort('cuadrilla');?></th>-->
			<th><?php echo $this->Paginator->sort('Unidad','unity_id');?></th>
			<!--<th><?php echo $this->Paginator->sort('contacto');?></th>-->
			<th><?php echo $this->Paginator->sort('lugar');?></th>

			<th><?php echo $this->Paginator->sort('Estado','state_id');?></th>
			<th><?php echo $this->Paginator->sort('Tema a tratar','tema');?></th>
			<th class="actions"><?php __('Acciones');?></th>
	</tr>

		<?php
			}
		else{
		?>
			<th>ID</th>
			<th><?php echo 'Ingeniero';?></th>
			<!--<th><?php echo 'Semana';?></th>-->
			<th><?php echo 'fecha';?></th>
			<th><?php echo 'Actividad';?></th>
			<th><?php echo 'EMSEFOR';?></th>
			<th>Participantes programados</th>
			<th>Participantes reales</th>
			<!--<th><?php echo 'cuadrilla';?></th>-->
			<th><?php echo 'Unidad';?></th>
			<!--<th><?php echo 'contacto';?></th>-->
			<th><?php echo 'Lugar';?></th>

			<th><?php echo 'Estado';?></th>
			<th><?php echo 'Tema a tratar';?></th>


			<th class="actions"><?php __('Acciones');?></th>


		<?php	
		
		}

		?>
	<?php
	$i = 0;
	$j = 1;
	foreach ($tworeports as $tworeport):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
		$view_url = $this->webroot.
				$this->params['controller'].
				'/view/'.$tworeport['Tworeport']['id'];
		
	?>
	<tr<?php echo $class;?> onclick="window.location.assign('<?php echo $view_url; ?>');">
		<td><?php echo $j;$j++;?></td>
		<td>
			<?php echo $engineer[$tworeport['Engineer']['id']]; ?>
		</td>
		<!--<td><?php echo $tworeport['Tworeport']['semana']; ?>&nbsp;</td>-->
		<td><?php echo $tworeport['Tworeport']['fecha']; ?>&nbsp;</td>
		<td>
			<?php echo $tworeport['Activity']['nombre']; ?>
		</td>
		<td>
			<?php echo $tworeport['Emsefor']['nombre']; ?>
			
		</td>
		<td><?php echo $tworeport['Tworeport']['participantes']; ?></td>
		<td><?php echo $tworeport['Tworeport']['participantes_reales']; ?></td>
		<!--<td><?php echo $tworeport['Tworeport']['cuadrilla']; ?>&nbsp;</td>-->
		<td>
			<?php echo $tworeport['Unity']['nombre']; ?>
		</td>
		<!--<td><?php echo $tworeport['Tworeport']['contacto']; ?>&nbsp;</td>-->
		<td><?php echo $tworeport['Place']['nombre']; ?>&nbsp;</td>

		<td>
			<?php echo $tworeport['State']['nombre']; ?>
		</td>
		<td><?php echo $tworeport['Tworeport']['tema']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Ver', true), array('action' => 'view', $tworeport['Tworeport']['id'])); ?>
			
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	
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
</div>

