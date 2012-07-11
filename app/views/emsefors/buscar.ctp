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
source        : '<?php echo $this->base;?>/emsefors/getEmsefor',

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




<div class="emsefors index">
	<div id="box">
	<div id="leftside">
	<?php echo $this->Form->create('Emsefor');?>
		<?php
			echo $this->Form->input("emsefor",array("type"=>"text","id"=>"search"));
			echo $this->Form->hidden("emsefor_id",array("id"=>"emsefor_id"));
			echo $this->Form->input("lugar",array("type"=>"text","id"=>"sap",'label'=>'Código SAP'));
			echo $this->Form->end(__('Ver esta emsefor', true));
	  ?>
	  </div>
	</div>
	<h2><?php __('Emsefors');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('Nombre','nombre');?></th>
			<th><?php echo $this->Paginator->sort('SAP','lugar');?></th>
			<th><?php echo $this->Paginator->sort('Encargado EO','contacto');?></th>
			<th><?php echo $this->Paginator->sort('Unidad','unity_id');?></th>
			<th><?php echo $this->Paginator->sort('Filial','filial_id');?></th>
			<th class="actions"><?php __('Acciones');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($emsefors as $emsefor):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
			$view_url = $this->webroot.
				$this->params['controller'].
				'/view/'.$emsefor['Emsefor']['id'];
		
			
		}
	?>
	<tr<?php echo $class;?>  onclick="window.location.assign('<?php echo $view_url; ?>');">
		<td><?php echo $emsefor['Emsefor']['nombre']; ?>&nbsp;</td>
		<td><?php echo $emsefor['Emsefor']['lugar']; ?>&nbsp;</td>
		<td><?php echo $emsefor['Emsefor']['contacto']; ?>&nbsp;</td>
		<td><?php echo $emsefor['Unity']['nombre']; ?>&nbsp;</td>
		<td><?php echo $emsefor['Filial']['nombre']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Ver', true), array('action' => 'view', $emsefor['Emsefor']['id'])); ?>
			<?php echo $this->Html->link(__('Editar', true), array('action' => 'edit', $emsefor['Emsefor']['id'])); ?>
	</tr>
<?php endforeach; ?>
	</table>
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
</div>
