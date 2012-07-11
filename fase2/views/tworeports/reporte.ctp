<?php 	if(!$download){	?>

<div class="reportes form">

<?php 
	

	echo $this->Form->create('Tworeport',array("controller"=>"tworeports","action"=>"reporte"));
	echo $this->Form->input('tworeports',array("label"=>"Seleccione semana"));
	echo $this->Form->input('engineers',array("label"=>"Seleccione Ingeniero"));
	echo $this->Form->input('filials',array("label"=>"Seleccione Filial"));
	echo $this->Form->end("Obtener");
	echo "Las condiciones sirven para ver algún reporte en específico. Si quiere obtener todas las planificaciones, no seleccione nada y aprete el botón obtener. Por ahora solo están disponibles los reportes de la planificación";
	?>
</div>
	<div class="actions">
	<?php
		$usuario = $this->Session->read("Auth.User");

	?>
	<h3><?php __('Acciones'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Volver', true), "/"); ?> </li>

	</ul>
</div>


<?php


	}
else{	
	echo "Correlativo\tFilial\tIngeniero\tSemana\tFecha\tActividad\tEMSEFOR\tCuadrilla\tUnidad\tContacto\tLugar\tEstado\tObservaciones\n";
	foreach($tworeports as $tworeport){

	echo $tworeport["Tworeport"]["id"]."\t".$filials[$tworeport["Engineer"]["filial_id"]]."\t".utf8_decode($tworeport["Engineer"]["nombre"])." ".utf8_decode($tworeport["Engineer"]["apellido"])."\t";
	echo $tworeport["Tworeport"]["semana"]."\t".$tworeport["Tworeport"]["fecha"]."\t".iconv('UTF-8',"ISO-8859-1",$tworeport["Activity"]["nombre"])."\t".iconv('UTF-8',"ISO-8859-1",$tworeport["Emsefor"]["nombre"])."\t".iconv('UTF-8',"ISO-8859-1",$tworeport["Tworeport"]["cuadrilla"])."\t";
	echo iconv('UTF-8',"ISO-8859-1",$tworeport["Unity"]["nombre"])."\t".$tworeport["Tworeport"]["contacto"]."\t".$tworeport["Tworeport"]["lugar"]."\t".$tworeport["State"]["nombre"]."\t".$tworeport["Tworeport"]["tema"]."\n";
	}
}
?>

