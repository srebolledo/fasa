<?php 
App::import('Vendor', 'jpgraph/jpgraph');
App::import('Vendor', 'jpgraph/jpgraph_line');
App::import('Vendor', 'jpgraph/jpgraph_bar');

//bar1
/*
$data1y=array(115,130,135,130,110,130,130,150,130,130,150,120);
//bar2
$data2y=array(180,200,220,190,170,195,190,210,200,205,195,150);
//bar3
$data3y=array(220,230,210,175,185,195,200,230,200,195,180,130);
$data4y=array(40,45,70,80,50,75,70,70,80,75,80,50);
$data5y=array(20,20,25,22,30,25,35,30,27,25,25,45);
//line1
$data6y=array(50,58,60,58,53,58,57,60,58,58,57,50);
foreach ($data6y as &$y) { $y -=10; }
*/
	

// Create the graph. These two calls are always required
$graph = new Graph(1000,500,'auto');
$graph->SetScale("textlin");
//$graph->SetY2Scale("lin",0,90);
//$graph->SetY2OrderBack(false);


//$graph->SetMargin();

$theme_class = new UniversalTheme;
$graph->SetTheme($theme_class);

//$graph->yaxis->SetTickPositions(array(0,50,100,150,200,250,300,350), array(25,75,125,175,275,325));
//$graph->y2axis->SetTickPositions(array(30,40,50,60,70,80,90));

//$months = $gDateLocale->GetShortMonth();
//$months = array_merge(array_slice($months,3,9), array_slice($months,0,3));
$graph->SetBox(false);
$graph->yaxis->scale->SetGrace(10);
$graph->ygrid->SetFill(false);
$graph->xaxis->SetTickLabels($emsefors);
$graph->xaxis->SetLabelAngle(60);
$graph->yaxis->HideLine(false);
$graph->yaxis->HideTicks(false,false);
// Setup month as labels on the X-axis
//$graph->xaxis->SetTickLabels();

// Create the bar plots
/*
$pendientes = new BarPlot($data[0]);
$aprobadas = new BarPlot($data[1]);
$rechazadas = new BarPlot($data[2]);
$reproceso = new BarPlot($data[3]);*/
$line = array();
foreach($data as $d){
	array_push($line,6);

}
array_push($line,6);
$lines = new LinePlot($line);
$plots = new BarPlot($data);

//$plots = new GroupBarPlot(array($pendientes,$aprobadas,$rechazadas,$reproceso));

$graph->Add($plots);
$graph->add($lines);
$plots->SetWidth(0.85);

$lines->SetColor("#53df00");
$plots->SetFillColor("#369100");
$plots->value->setFormat("%d");
$plots->value->Show();
#$pendientes->SetLegend("Pendientes");
#$pendientes->SetFillColor("#53df00");
#$pendientes->SetColor("#53df00");
#$pendientes->value->setFormat("%d");
#$pendientes->value->Show();


#$aprobadas->SetLegend("Aprobadas");
#$aprobadas->SetFillColor("#1144aa");
#$aprobadas->SetColor("#53df00");
#$aprobadas->value->Show();
#$aprobadas->value->setFormat("%d");
#//$aprobadas->SetWidth(25);

#$rechazadas->SetLegend("Rechazadas");
#$rechazadas->SetFillColor("#ffe100");
#$rechazadas->SetColor("#53df00");
#$rechazadas->value->Show();
#$rechazadas->value->setFormat("%d");
#//$rechazadas->SetWidth(25);

#$reproceso->SetLegend("Reproceso");
#$reproceso->SetFillColor("#369100");
#$reproceso->SetColor("#53df00");
#$reproceso->value->Show();
#$reproceso->value->setFormat("%d");
//$reproceso->SetWidth(25);

$graph->legend->SetFrameWeight(1);
$graph->legend->SetColumns(6);
$graph->legend->SetColor('#4E4E4E','#00A78A');
$graph->legend->Pos(0.01,0.05,"right", "up");


$graph->title->Set("Ideas por emsefor de ".$this->requestAction("/filials/getName/".$filial));

// Display the graph
$graph->Stroke(getcwd()."/tmp/topemsefors.png");
$graph->Stroke();


?> 
