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
<div class="onereports index">
	<h2><?php __('Buscar en el reporte de ideas');?></h2>

<?php echo $this->Form->create('Onereport');?>
	<fieldset>
 			<div id="box">
				<div id="leftside">
				<?php
					echo $this->Form->input("ingeniero",array("options"=>$engineer,"default"=>0));
					echo $this->Form->input("indicator",array("options"=>$indicator,"default"=>0,'label'=>'Indicador'));
					echo $this->Form->input('unity',array('label'=>'Unidad','options'=>$unity,'default'=>0));
					if(isset($proyectos)){
						echo $this->Form->input("idea",array("options"=>$idea,"default"=>2,'label'=>'Estado de la idea','type'=>'hidden'));
						echo $this->Form->input('proyectoFlag',array('type'=>'hidden','value'=>'2'));									
					}
					else{
						echo $this->Form->input("idea",array("options"=>$idea,"default"=>0,'label'=>'Estado de la idea'));
					}
					
				?>
				</div>
				
				<div id="rightside">
				<?php
					echo $this->Form->input("carta",array("options"=>$carta,"default"=>0,'label'=>'Estado de la carta'));
					echo $this->Form->input("proyecto",array("options"=>$proyecto,"default"=>0,'label'=> 'Estado del proyecto'));
					echo $this->Form->input("emsefor",array("type"=>"text","id"=>"search"));
					echo $this->Form->hidden("emsefor_id",array("id"=>"emsefor_id"));
				?>
					<?php echo $this->Form->end(__('Buscar', true));?>	
					</div> 
				

		</div>
	</fieldset>

<?php
	if(isset($onereports)){
?>

	

	<table cellpadding="0" cellspacing="0">
	<tr>
			<?php if($pagina) {?>
			<th>ID</th>
			<th><?php echo $this->Paginator->sort('engineer_id');?></th>
			<th><?php echo $this->Paginator->sort('fecha');?></th>
			<th><?php echo $this->Paginator->sort('unity_id');?></th>
			<th><?php echo $this->Paginator->sort('emsefor_id');?></th>
			<th><?php echo $this->Paginator->sort('indicator_id');?></th>
			<th><?php echo $this->Paginator->sort('resumen');?></th>
			<th><?php echo $this->Paginator->sort('ideasstate_id');?></th>
			<th><?php echo $this->Paginator->sort('cartastate_id');?></th>
			<th><?php echo $this->Paginator->sort('proyectostate_id');?></th>
			<th><?php echo $this->Paginator->sort('observacion');?></th>
			<th class="actions"><?php __('Acciones');?></th>

	<?php
			}

			else{

		?>
			<th>ID</th>
			<th><?php echo 'Ingeniero';?></th>
			<th><?php echo 'Fecha';?></th>
			<th><?php echo 'Unidad';?></th>
			<th><?php echo 'EMSEFOR';?></th>
			<th><?php echo 'Indicador';?></th>
			<th><?php echo 'Resumen idea';?></th>
			<th><?php echo 'Estado de idea';?></th>
			<th><?php echo 'Estado de la carta';?></th>
			<th><?php echo 'Estado del proyecto';?></th>
			<th><?php echo 'Observación';?></th>
			<th class="actions"><?php __('Acciones');?></th>
	

		<?php
		}

	?>
	</tr>
	<?php
	$i = 0;
	$j =1;
	foreach ($onereports as $onereport):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	$view_url = $this->webroot.
				$this->params['controller'].
				'/view/'.$onereport['Onereport']['id'];
		
	?>
	<tr<?php echo $class;?> onclick="window.location.assign('<?php echo $view_url; ?>');">
		<td><?php echo $j;$j++;?></td>
		<td><?php echo $this->requestAction("/engineers/getName/".$onereport['Onereport']['engineer_id']); ?>&nbsp;</td>

		<td><?php echo $onereport['Onereport']['fecha']; ?>&nbsp;</td>
		<td><?php echo $onereport['Unity']['nombre']; ?>&nbsp;</td>
		<td><?php echo $onereport['Emsefor']['nombre']; ?>&nbsp;</td>
		<td>
			<?php echo $onereport['Indicator']['nombre']; ?>
		</td>
		<td><?php echo $onereport['Onereport']['resumen']; ?>&nbsp;</td>
		<td>
			<?php echo $onereport['Ideasstate']['nombre']; ?>
		</td>
		<td>
			<?php echo $onereport['Cartastate']['nombre']; ?>
		</td>
		<td>
			<?php echo $onereport['Proyectostate']['nombre']; ?>
		</td>
		<td><?php echo $onereport['Onereport']['observacion']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Ver', true), array('action' => 'view', $onereport['Onereport']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<?php if($pagina){?>
	<p>
	<?php
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
	<?php } ?>
	
	<?php } 	?>
</div>
