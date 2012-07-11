<?php
	echo "<table>";
	echo "<tr><th>Correlativo</th><th>Fecha</th><th>Filial</th><th>Unidad</th><th>Cod_SAP</th><th>Emsefor</th><th>Cargo del Trabajador</th><th>Resumen</th><th>Estado Idea</th><th>Estado Carta</th><th>Estado Proyecto</th><th>".utf8_decode('Estado Implementación')."</th><th>Tipo Indicador</th><th>Tipo Mejora</th></tr>";
		
	foreach($onereport as $o){
		echo "<tr>\n";
		echo "<td>".$o["Onereport"]["id"]."</td><td>".$o["Onereport"]["fecha"]."</td><td>".$filials[$o["Engineer"]["filial_id"]]."</td>";
		echo "<td>".utf8_decode($o["Unity"]["nombre"])."</td>";
		echo "<td>".$o["Emsefor"]["lugar"]."</td>";
		echo "<td>".utf8_decode($o["Emsefor"]["nombre"])."</td>";
		echo "<td>".$o["Position"]["nombre"]."</td>";
		echo "<td>".utf8_decode($o["Onereport"]["resumen"])."</td>";
		echo "<td>".$o["Ideasstate"]["nombre"]."</td>";
		echo "<td>".$o["Cartastate"]["nombre"]."</td>";
		echo "<td>".utf8_decode($o["Proyectostate"]["nombre"])."</td>";
		echo "<td>"." </td>"; //falta estado de implementación
		echo "<td>".utf8_decode($o['Indicator']['nombre'])."</td>";
		echo "<td>".utf8_decode($o['Businessstate']['nombre'])." </td>";
		echo "</tr>\n";
	}
echo "</table>";
/*
Correlativo	Fecha	Filial	Unidad	Cod_SAP	Emsefor	Cargo del Trabajador	Resumen	Estado Idea	Estado Carta	Estado Proyecto	Estado Implementación	Tipo Indicador	Tipo Mejora																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																		



[Onereport] => Array
                (
                    [id] => 1
                    [engineer_id] => 4
                    [correlativoidea] => 1
                    [folio] => 0
                    [fecha] => 2010-11-22
                    [unity_id] => 3
                    [cuadrilla] => 
                    [emsefor_id] => 307
                    [sap] => 52880
                    [trabajador] => Carlos Yevenes
                    [position_id] => 1
                    [indicator_id] => 1
                    [resumen] => Realizar una plataforma externa a la cancha para instalar en esta la torre de madereo, asi quedara mas espacio en la cancha aumentando la productividad y se disminuira el riesgo de accidente
                    [ideasstate_id] => 3
                    [cartastate_id] => 1
                    [proyectostate_id] => 1
                    [proyectofecha] => 0000-00-00
                    [proyectofechafin] => 0000-00-00
                    [observacion] => Esta idea ya la esta utilizando por Forestal Celco Norte, en la planificacion de futuras canchas.
                )

            [Engineer] => Array
                (
                    [id] => 4
                    [nombre] => Carlos
                    [apellido] => Quezada
                    [filial_id] => 1
                    [user_id] => 7
                )

            [Unity] => Array
                (
                    [id] => 3
                    [nombre] => Cosecha
                    [descripcion] => 
                )

            [Emsefor] => Array
                (
                    [id] => 307
                    [nombre] => Soc. Forestal Puerto Mayor Ltda.
                    [lugar] => 
                    [unity_id] => 0
                    [filial_id] => 0
                )

            [Position] => Array
                (
                    [id] => 1
                    [nombre] => Opedaror Torre
                )

            [Indicator] => Array
                (
                    [id] => 1
                    [nombre] => Negocio
                )

            [Ideasstate] => Array
                (
                    [id] => 3
                    [nombre] => Rechazada
                )

            [Cartastate] => Array
                (87,88cm
                    [id] => 1
                    [nombre] => Enviada
                )

            [Proyectostate] => Array
                (
                    [id] => 1
                    [nombre] => Pendiente
                )

        )

*/
?>

