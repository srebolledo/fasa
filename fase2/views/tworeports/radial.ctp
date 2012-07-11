<?php 
App::import('Vendor', 'jpgraph/jpgraph');
//App::import('Vendor', 'jpgraph/jpgraph_line');
App::import('Vendor', 'jpgraph/jpgraph_radar');


// Create the graph and the plot 

$graph = new RadarGraph (450,350, "auto"); 



//$plot1 = new RadarPlot($data2);

$graph->SetShadow();
$graph->grid->SetColor("navy");

$graph->SetScale('lin');

$graph->grid->Show(); 
$graph->HideTickMarks();

$graph->grid->SetLineStyle("longdashed");
$graph->title->Set($nombre);

$graph->axis->SetColor('darkgray');
$graph->grid->SetColor('darkgray');
$graph->SetTitles(array(utf8_decode("Planificación"),"Grupo\nEvaluador","Grupo Mejora","Taller"));


//$graph->grid->SetLineStyle("dotted");
// Add the plot and display the graph 
//$graph->Add( $plot); 
//$graph->Add( $plot1); 
$colors = array('red','blue','green','darkgoldenrod','black');
$i=0;
foreach($datos as $d){
	$plot = new RadarPlot ($d);
$plot->SetLegend($fechas[$i%12]);

$plot->SetLineWeight(3);

	$plot->SetColor($colors[$i%5]);
	$graph->Add( $plot); 
	$i++;

}


$graph->Stroke(); 





?>
