<script type="text/javascript">
	
	function agregarAsistentes(){
		$("#asists").append("<tr>	<td><input type=\"data[Asist][0][emsefor_id]\" type=\"text\"></td><td><input type=\"data[Asist][0][total]\" type=\"text\"></td>	<td><input type=\"button\" value=\"Agregar\" onclick=\"agregarAsistentes()\"></td></tr>");
	}
	function agregarRelator(){
		$("#box > #rightside").append("	<div class=\"input text\"><label for=\"CapacitationRelatorNombre\">Nombre del relator</label><input name=\"data[Capacitation][0][relatorNombre]\" type=\"text\" id=\"CapacitationRelatorNombre\"></div><div class=\"input text\"><label for=\"CapacitationRelatorApellido\">Apellido del relator</label><input name=\"data[Capacitation][0][relatorApellido]\" type=\"text\" id=\"CapacitationRelatorApellido\"></div>")
	
	}



</script>


<div class="capacitations form">
<?php echo $this->Form->create('Capacitation');?>
	<div id="box">
	
		<div id="leftside">
			<?php
				echo $this->Form->input('fecha');
				echo $this->Form->input('filial_id');
			?>
		</div>
		<div id="rightside">
			<?php
				echo $this->Form->input('relatorNombre',array('type'=>'text','label'=>'Nombre del relator'));
				echo $this->Form->input('relatorApellido',array('type'=>'text','label'=>'Apellido del relator'));
			?>
			<td><input type="button" value="agregar" onclick="agregarRelator()"></td>
		</div>
	</div>
	<div id="box">
		<table id="asists">
			<tr>
				<th>EMSEFOR</th>
				<th>Total de asistentes</th>
			</tr>
			<tr>	
				<td class="emsefor"><input type="data[Asist][0][emsefor_id]" type="text"></td>
				<td class="total"><input type="data[Asist][0][total]" type="text"></td>		
				<td><input type="button" value="agregar" onclick="agregarAsistentes()"></td>
			</tr>
		</table>
			<?php 
				echo $this->Form->end(__('Guardar', true));
			?>
	</div>
</div>
