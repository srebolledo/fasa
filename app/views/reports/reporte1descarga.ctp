<?php
	//pr($onereport);
	echo "<table>\n";

	echo "<th>Correlativo</th>\n";
	echo "<th>Ingeniero</th>\n";
	echo "<th>Folio</th>\n";
	echo "<th>Fecha</th>\n";
	echo "<th>Unidad</th>\n";
	echo "<th>Cuadrilla</th>\n";
	echo "<th>EMSEFOR</th>\n";
	echo "<th>SAP</th>\n";
	echo "<th>Nombre trabajador</th>\n";
	echo "<th>Cargo</th>\n";
	echo "<th>Indicador</th>\n";
	echo "<th>Resumen</th>\n";
	echo "<th>Estado de la idea</th>\n";
	echo "<th>Estado de la carta </th>\n";
	echo "<th>Estado del proyecto</th>\n";
	echo "<th>Fecha inicio proyecto</th>\n";
	echo "<th>Fecha fin proyecto</th>\n";
	echo "<th>Observacion</th>\n";

	foreach($onereport as $o){
		echo "<tr>\n";
			echo "<td>".$o["Onereport"]["id"]."</td>";
			echo "<td>".utf8_decode($o["Engineer"]["nombre"])." ".utf8_decode($o["Engineer"]["apellido"])."</td>";
			echo "<td>".$o["Onereport"]["folio"]."</td>";
			echo "<td>".$o["Onereport"]["fecha"]."</td>";
			echo "<td>".utf8_decode($o["Unity"]["nombre"])."</td>";
			echo "<td>".utf8_decode($o["Onereport"]["cuadrilla"])."</td>";
			echo "<td>".utf8_decode($o["Emsefor"]["nombre"])."</td>";
			echo "<td>".$o["Emsefor"]["lugar"]."</td>";
			echo "<td>".utf8_decode($o["Onereport"]["trabajador"])."</td>";
			echo "<td>".utf8_decode($o["Position"]["nombre"])."</td>";
			echo "<td>".utf8_decode($o["Indicator"]["nombre"])."</td>";
			echo "<td>".utf8_decode($o["Onereport"]["resumen"])."</td>";
			echo "<td>".utf8_decode($o["Ideasstate"]["nombre"])."</td>";
			echo "<td>".utf8_decode($o["Cartastate"]["nombre"])."</td>";
			echo "<td>".utf8_decode($o["Proyectostate"]["nombre"])."</td>";
			if($o["Onereport"]["proyectofecha"] != "0000-00-00"){
			echo "<td>".$o["Onereport"]["proyectofecha"]."</td>";
			}
			else{

			 	echo "<td>-</td>";
			}
			if($o["Onereport"]["proyectofechafin"] != "0000-00-00"){

				 echo "<td>".$o["Onereport"]["proyectofechafin"]."</td>";
			}
			else{
				echo "<td>-</td>";
			}
			echo "<td>".$o["Onereport"]["observacion"]."</td>";

			

		
		echo "</tr>\n";


	}
	echo "</table>";
?>

