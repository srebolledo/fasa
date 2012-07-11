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
  }a
});



</script>



<div class="onereports index">

<?php echo $this->Form->create('Onereport');?>
<!--	<fieldset>
 		<div id="box">
 			<div id="leftside">
 				<?php
					//echo $this->Form->input("ingeniero",array("options"=>$engineer,"default"=>0));
					echo $this->Form->input("indicator",array("options"=>$indicator,"default"=>0));
					echo $this->Form->input('unity',array('label'=>'Unidad','options'=>$unity,'default'=>0));
					echo $this->Form->input("idea",array("options"=>$idea,"default"=>0));
					echo $this->Form->input("carta",array("options"=>$carta,"default"=>0));
				?>
 			
 			</div>
 			<div id="rightside">
			 	<?php
			 		echo $this->Form->input("proyecto",array("options"=>$proyecto,"default"=>0));
					echo $this->Form->input("emsefor",array("type"=>"text","id"=>"search"));
					echo $this->Form->hidden("emsefor_id",array("id"=>"emsefor_id"));
					echo $this->Form->end(__('Filtrar', true));

				?>
 			</div>
 		</div>
 		
	
	
	</fieldset>
-->

	<table cellpadding="0" cellspacing="0">
	<tr>
		<?php
			if($pagina){

		?>
			<th><?php echo $this->Paginator->sort('ID','id');?></th>
<!--			<th><?php echo $this->Paginator->sort('engineer_id');?></th>-->
<!--			<th><?php echo $this->Paginator->sort('correlativoidea');?></th>-->
			<!--<th><?php echo $this->Paginator->sort('folio');?></th>-->
			<th><?php echo $this->Paginator->sort('fecha');?></th>
<!--			<th><?php echo $this->Paginator->sort('unity_id');?></th>-->
<!--			<th><?php echo $this->Paginator->sort('cuadrilla');?></th>-->
			<th><?php echo $this->Paginator->sort('EMSEFOR','emsefor_id');?></th>
<!--			<th><?php echo $this->Paginator->sort('sap');?></th>-->
			<th><?php echo $this->Paginator->sort('Cargo','position_id');?></th>
<!--			<th><?php echo $this->Paginator->sort('trabajador');?></th>-->
<!--			<th><?php echo $this->Paginator->sort('indicator_id');?></th>-->
			<th><?php echo $this->Paginator->sort('resumen');?></th>
			<th><?php echo $this->Paginator->sort('Estado idea','ideasstate_id');?></th>
			<th><?php echo $this->Paginator->sort('Estado carta','cartastate_id');?></th>
			<th><?php echo $this->Paginator->sort('Estado proyecto','proyectostate_id');?></th>
<!--			<th><?php echo $this->Paginator->sort('proyectofecha');?></th>-->
<!--  		<th><?php //echo $this->Paginator->sort('Tipo de negocio');?></th>-->
<!--			<th><?php echo $this->Paginator->sort('proyectofechafin');?></th>-->
  		<th><?php echo 'Tipo de mejora';?></th>
<!--			<th><?php echo $this->Paginator->sort('observacion');?></th>-->
			<th>Acciones</th>
	<?php
		}
			else{
			?>
			<th><?php echo 'ID';?></th>
		<!--	<th><?php echo 'Folio';?></th>-->
			<th><?php echo 'Fecha';?></th>
		<!--	<th><?php echo 'Unidad';?></th>-->	
		<!--	<th><?php echo 'Cuadrilla';?></th>-->
			<th><?php echo 'EMSEFOR';?></th>
		<!--	<th><?php echo 'SAP';?></th>-->
			<th><?php echo 'Cargo';?></th>
		<!--	<th><?php echo 'Trabajador';?></th>-->
			<!--<th><?php echo 'Indicador';?></th>-->
			<th><?php echo 'Resumen';?></th>
			<th><?php echo 'Estado de la idea';?></th>
			<th><?php echo 'Estado de la carta';?></th>
			<th><?php echo 'Estado del proyecto';?></th>
			<!--<th><?php echo 'Fecha inicio proyecto';?></th>-->
			<!--<th><?php echo 'Fecha fin de proyecto';?></th>-->
  		<th><?php echo 'Tipo de mejora';?></th>
			<!--<th><?php echo 'Observaciones';?></th>-->
			
			<?php

			}
	?>
		<?php $i=1;?>

	</tr>
	<?php
	$cuantas = 1;
	$i = 1;
	$j=0;
	foreach ($onereports as $onereport):
		$class = null;
		if ($j++ % 2 == 0) {
			$class = ' class="altrow"';
		}
		$view_url = $this->webroot.
				$this->params['controller'].
				'/view/'.$onereport['Onereport']['id'];
		
		
	?>
	<tr<?php echo $class;?> onclick="window.location.assign('<?php echo $view_url; ?>');">
		<td><?php echo $i; $i++;?>
		<!--<td><?php echo $onereport['Onereport']['folio']; ?>&nbsp;</td>-->
		<td><?php echo $onereport['Onereport']['fecha']; ?>&nbsp;</td>
		<!--<td><?php echo $onereport['Unity']['nombre']; ?>&nbsp;</td>-->
		<!--<td><?php echo $onereport['Onereport']['cuadrilla']; ?>&nbsp;</td>-->
		<td><?php echo $onereport['Emsefor']['nombre']; ?>&nbsp;</td>
		<!--<td><?php echo $onereport['Onereport']['sap']; ?>&nbsp;</td>-->
		<td><?php echo $onereport['Position']['nombre']; ?>&nbsp;</td>
		<!--<td><?php echo $onereport['Onereport']['trabajador']; ?>&nbsp;</td>-->
		<!--<td>
			<?php echo $onereport['Indicator']['nombre']; ?>
		</td>-->
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
		<!--<td><?php if(strtotime($onereport['Onereport']['proyectofecha']) > 0) echo $onereport['Onereport']['proyectofecha'];
			  else echo "-"; ?>&nbsp;</td>
		<td><?php if(strtotime($onereport['Onereport']['proyectofechafin']) > 0) echo $onereport['Onereport']['proyectofechafin'];
			  else echo "-"; ?>&nbsp;</td>-->
    <td><?php echo $onereport['Businessstate']['nombre'];?></td>
		<!--<td><?php echo utf8_encode($onereport['Onereport']['observacion']); ?>&nbsp;</td>-->	
		<td class="actions">
			<?php //echo $this->Html->link(__('', true), array('action' => 'view', $onereport['Onereport']['id'])); ?>
      <?php
      
      	echo "<h1> Estado de la idea</h1>";
      	switch($onereport['Onereport']['ideasstate_id']){
      		case 1:
	     				echo $this->Html->link("Aprobada",array("action"=>"estadoIdea",$onereport["Onereport"]["id"], 2));
	     				echo $this->Html->link("Rechazada",array("action"=>"estadoIdea",$onereport["Onereport"]["id"], 3));
	     				echo $this->Html->link("Reproceso",array("action"=>"estadoIdea",$onereport["Onereport"]["id"], 4));
     			break;

      		case 2:
      			echo $this->Html->link("Pendiente",array("action"=>"estadoIdea",$onereport["Onereport"]["id"], 1));
	     			echo $this->Html->link("Rechazada",array("action"=>"estadoIdea",$onereport["Onereport"]["id"], 3));
	     			echo $this->Html->link("Reproceso",array("action"=>"estadoIdea",$onereport["Onereport"]["id"], 4));
      		break;

      		case 3:
       			echo $this->Html->link("Pendiente",array("action"=>"estadoIdea",$onereport["Onereport"]["id"], 1));
	     			echo $this->Html->link("Aprobada",array("action"=>"estadoIdea",$onereport["Onereport"]["id"], 2));
	     			echo $this->Html->link("Reproceso",array("action"=>"estadoIdea",$onereport["Onereport"]["id"], 4));
      		break;

      		case 4:
      		  echo $this->Html->link("Pendiente",array("action"=>"estadoIdea",$onereport["Onereport"]["id"], 1));
	     			echo $this->Html->link("Aprobada",array("action"=>"estadoIdea",$onereport["Onereport"]["id"], 2));
	     			echo $this->Html->link("Rechazada",array("action"=>"estadoIdea",$onereport["Onereport"]["id"], 3));
      		break;
      
      	
      	
      	}
      	echo "<br><br>";
        echo "<h1>Estado de la carta</h1>";
        switch($onereport['Onereport']['cartastate_id']){
       		case 1:
     				echo $this->Html->link("Pendiente",array("action"=>"estadoCarta",$onereport["Onereport"]["id"], 2));
     				echo $this->Html->link("No Aplica",array("action"=>"estadoCarta",$onereport["Onereport"]["id"], 3));
       			break;
       		      		
       		case 2:
	     			echo $this->Html->link("Enviada",array("action"=>"estadoCarta",$onereport["Onereport"]["id"], 1));
  					echo $this->Html->link("No Aplica",array("action"=>"estadoCarta",$onereport["Onereport"]["id"], 3));
       			break;
       		
       		case 3:
  					echo $this->Html->link("Pendiente",array("action"=>"estadoCarta",$onereport["Onereport"]["id"], 2));
  					echo $this->Html->link("Enviada",array("action"=>"estadoCarta",$onereport["Onereport"]["id"], 1));     			
       			break;
        	default:
        		echo $this->Html->link("Pendiente",array("action"=>"estadoCarta",$onereport["Onereport"]["id"], 2));
        		echo $this->Html->link("Enviada",array("action"=>"estadoCarta",$onereport["Onereport"]["id"], 1));
        		echo $this->Html->link("No Aplica",array("action"=>"estadoCarta",$onereport["Onereport"]["id"], 3));
        		break;
        }
         if($onereport['Onereport']['ideasstate_id'] == 2){
	 				echo "<br><br>";
	 				echo "<h1>Estado de proyectos</h1>";
					switch($onereport['Onereport']['proyectostate_id']){
						case 1:
			   			echo $this->Html->link("En preparación",array("action"=>"estadoProyecto",$onereport["Onereport"]["id"], 6));
			   			echo $this->Html->link("En evaluación",array("action"=>"estadoProyecto",$onereport["Onereport"]["id"], 2));
			   			echo $this->Html->link("Rechazado",array("action"=>"estadoProyecto",$onereport["Onereport"]["id"], 4));
			   			echo $this->Html->link("Aprobado",array("action"=>"estadoProyecto",$onereport["Onereport"]["id"], 3));
			   			echo $this->Html->link("No aplica",array("action"=>"estadoProyecto",$onereport["Onereport"]["id"], 5));
							break;
						case 2:
			   			echo $this->Html->link("Pendiente",array("action"=>"estadoProyecto",$onereport["Onereport"]["id"], 1));
			   			echo $this->Html->link("En preparación",array("action"=>"estadoProyecto",$onereport["Onereport"]["id"], 6));
			   			echo $this->Html->link("Rechazado",array("action"=>"estadoProyecto",$onereport["Onereport"]["id"], 4));
			   			echo $this->Html->link("Aprobado",array("action"=>"estadoProyecto",$onereport["Onereport"]["id"], 3));
			   			echo $this->Html->link("No aplica",array("action"=>"estadoProyecto",$onereport["Onereport"]["id"], 5));
							break;
			
						case 3:
								echo $this->Html->link("Pendiente",array("action"=>"estadoProyecto",$onereport["Onereport"]["id"], 1));
					 			echo $this->Html->link("En preparación",array("action"=>"estadoProyecto",$onereport["Onereport"]["id"], 6));
					 			echo $this->Html->link("En evaluación",array("action"=>"estadoProyecto",$onereport["Onereport"]["id"], 2));
					 			echo $this->Html->link("Rechazado",array("action"=>"estadoProyecto",$onereport["Onereport"]["id"], 4));
					 			echo $this->Html->link("No aplica",array("action"=>"estadoProyecto",$onereport["Onereport"]["id"], 5));
							break;

						case 4:
							echo $this->Html->link("Pendiente",array("action"=>"estadoProyecto",$onereport["Onereport"]["id"], 1));
					 		echo $this->Html->link("En preparación",array("action"=>"estadoProyecto",$onereport["Onereport"]["id"], 6));
					 		echo $this->Html->link("En evaluación",array("action"=>"estadoProyecto",$onereport["Onereport"]["id"], 2));
					 		echo $this->Html->link("Aprobado",array("action"=>"estadoProyecto",$onereport["Onereport"]["id"], 3));
					 		echo $this->Html->link("No aplica",array("action"=>"estadoProyecto",$onereport["Onereport"]["id"], 5));
							break;
					
						case 5:
							echo $this->Html->link("Pendiente",array("action"=>"estadoProyecto",$onereport["Onereport"]["id"], 1));
					 		echo $this->Html->link("En preparación",array("action"=>"estadoProyecto",$onereport["Onereport"]["id"], 6));
					 		echo $this->Html->link("En evaluación",array("action"=>"estadoProyecto",$onereport["Onereport"]["id"], 2));
					 		echo $this->Html->link("Aprobado",array("action"=>"estadoProyecto",$onereport["Onereport"]["id"], 3));
					 		echo $this->Html->link("Rechazado",array("action"=>"estadoProyecto",$onereport["Onereport"]["id"], 4));
							break;
						case 6:
							echo $this->Html->link("Pendiente",array("action"=>"estadoProyecto",$onereport["Onereport"]["id"], 1));
					 		echo $this->Html->link("En evaluación",array("action"=>"estadoProyecto",$onereport["Onereport"]["id"], 2));
					 		echo $this->Html->link("Aprobado",array("action"=>"estadoProyecto",$onereport["Onereport"]["id"], 3));
					 		echo $this->Html->link("Rechazado",array("action"=>"estadoProyecto",$onereport["Onereport"]["id"], 4));
					 		echo $this->Html->link("No aplica",array("action"=>"estadoProyecto",$onereport["Onereport"]["id"], 5));
							break;
						
						default:
							echo $this->Html->link("Pendiente",array("action"=>"estadoProyecto",$onereport["Onereport"]["id"], 1));
					 		echo $this->Html->link("En preparación",array("action"=>"estadoProyecto",$onereport["Onereport"]["id"], 6));
					 		echo $this->Html->link("En evaluación",array("action"=>"estadoProyecto",$onereport["Onereport"]["id"], 2));
					 		echo $this->Html->link("Aprobado",array("action"=>"estadoProyecto",$onereport["Onereport"]["id"], 3));
					 		echo $this->Html->link("Rechazado",array("action"=>"estadoProyecto",$onereport["Onereport"]["id"], 4));
					 		echo $this->Html->link("No aplica",array("action"=>"estadoProyecto",$onereport["Onereport"]["id"], 5));
						
							break;
					
					}
					}
        echo "<br><br>";
        
        echo "<h1>Tipo mejora</h1>";
        switch($onereport['Onereport']['businessstate_id']){
        	case 1:
        		echo $this->Html->link("B. Interno",array("action"=>"completaIdeas",$onereport["Onereport"]["id"], 2));
 		 				echo $this->Html->link("Innovación",array("action"=>"completaIdeas",$onereport["Onereport"]["id"], 3));
 		 				break;
        	
        	case 2:
        		echo $this->Html->link("B. Externo",array("action"=>"completaIdeas",$onereport["Onereport"]["id"], 1));
        		echo $this->Html->link("Innovación",array("action"=>"completaIdeas",$onereport["Onereport"]["id"], 3));
        		break;
        		
      		case 3:
  	    		echo $this->Html->link("B. Externo",array("action"=>"completaIdeas",$onereport["Onereport"]["id"], 1));
	      		echo $this->Html->link("B. Interno",array("action"=>"completaIdeas",$onereport["Onereport"]["id"], 2));
      			break;
      			
      		default:
      			echo $this->Html->link("B. Externo",array("action"=>"completaIdeas",$onereport["Onereport"]["id"], 1));
 						echo $this->Html->link("B. Interno",array("action"=>"completaIdeas",$onereport["Onereport"]["id"], 2));
						echo $this->Html->link("Innovación",array("action"=>"completaIdeas",$onereport["Onereport"]["id"], 3));
      			break;
        
        	
        }
     
				
      
      ?>
        <br><br>
			<?php
/*
			if($onereport["Onereport"]["ideasstate_id"] == 1){
				echo $this->Html->link("Aprobar idea",array("action"=>"aprobarIdea",$onereport["Onereport"]["id"]) );
				echo $this->Html->link("Rechazar idea",array("action"=>"rechazarIdea",$onereport["Onereport"]["id"]) );
				echo $this->Html->link("Reprocesar idea",array("action"=>"reprocesoIdea",$onereport["Onereport"]["id"]) );
				echo "<br><br>";
			}*/
			?>
			<?php
		/*
			if($onereport["Onereport"]["ideasstate_id"] == 2 && ($onereport["Onereport"]["proyectostate_id"] == 1 || $onereport["Onereport"]["proyectostate_id"] == 6)){
				echo $this->Html->link("Rechazar idea",array("action"=>"rechazarIdea",$onereport["Onereport"]["id"]) );
				
				if($onereport['Onereport']['proyectostate_id'] != 6) echo $this->Html->link("Proyecto en preparación",array("action"=>"preparacion",$onereport["Onereport"]["id"]) );
				if($onereport['Onereport']['proyectostate_id'] == 6)echo $this->Html->link("Agregar proyecto",array("controller"=>"projects","action"=>"add",$onereport["Onereport"]["id"],$onereport["Project"]['id']) );
				echo "<br><br>";		
			}*/
		
	?>	
			<br>
			<?php echo $this->Html->link(__('Editar', true), array('action' => 'edit', $onereport['Onereport']['id'])); ?>
			<?php echo $this->Html->link(__('Borrar', true), array('action' => 'delete', $onereport['Onereport']['id']), null, sprintf(__('La idea a borrar es de fecha %s y emsefor %s?', true), $onereport['Onereport']['id'],$onereport['Emsefor']['nombre'])); ?>

			<?php /*if($onereport["Onereport"]["proyectostate_id"] ==2 ){
			?>
<?php echo $this->Html->link("Agregar archivo",array("controller"=>"projects","action"=>"add",$onereport["Onereport"]["id"],$onereport["Project"]['id']) );?>
			<?php if(isset($onereport['Projectfile'])){



			?>			

			<h4> Archivos </h4>
				
			<?php
				if(!empty($onereport["Project"])){
					echo "Nombre proyecto: ".$onereport["Project"]["nombre"]."<br><br>";
					
				}
				?>

					<?php
						//pr($onereport);
						foreach($onereport["Projectfile"] as $projectfile){
							echo "<li>".$this->Html->link($projectfile["Projectfile"]["filename"], '/projects/'.$projectfile["Projectfile"]["filename"].'', array('escape' => false))."</li><br>";
						
						}

					?>

			<?php
				}
			
			}*/
		
			?>
		</td>
	</tr>
<?php 
$cuantas++;

endforeach; ?>

	</table>
	<?php if ($pagina) {?>
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
</div>

