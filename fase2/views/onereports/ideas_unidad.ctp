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
$graph = new Graph(720,320,'auto');
$graph->SetScale("textlin");
$graph->SetY2Scale("lin",0,90);
$graph->SetY2OrderBack(false);


$graph->SetMargin(35,50,20,5);

$theme_class = new UniversalTheme;
$graph->SetTheme($theme_class);

//$graph->yaxis->SetTickPositions(array(0,50,100,150,200,250,300,350), array(25,75,125,175,275,325));
//$graph->y2axis->SetTickPositions(array(30,40,50,60,70,80,90));

//$months = $gDateLocale->GetShortMonth();
//$months = array_merge(array_slice($months,3,9), array_slice($months,0,3));
$graph->SetBox(false);

$graph->ygrid->SetFill(false);
$graph->xaxis->SetTickLabels(array('A','B','C','D'));
$graph->yaxis->HideLine(false);
$graph->yaxis->HideTicks(false,false);
// Setup month as labels on the X-axis

$graph->xaxis->SetTickLabels($nombreUnidad);

// Create the bar plots
//$b1plot = new BarPlot($data[0]);
//$b2plot = new BarPlot($data[1]);
//$b3plot = new BarPlot($data[2]);

//$lplot = new BarPlot($data[5]);
$plot = new BarPlot($ideas);
// Create the grouped bar plot
//$gbbplot = new AccBarPlot(array($b3plot,$b4plot,$b5plot));
//$gbplot = new GroupBarPlot($plots);

// ...and add it to the graPH
$graph->Add($plot);
$plot->SetFillColor("#6be400");
$plot->value->setFormat("%d");
$plot->value->Show();

//$graph->AddY2($lplot);
/*
$b1plot->SetColor("#6be400");
$b1plot->SetFillColor("#6be400");
$b1plot->SetLegend($nombresFiliales[0]);
$b1plot->value->setFormat("%d");
$b1plot->value->Show();

$b2plot->SetColor("#0772a1");
$b2plot->SetFillColor("#0772a1");
$b2plot->value->setFormat("%d");
$b2plot->SetLegend($nombresFiliales[1]);
$b2plot->value->Show();

$b3plot->SetColor("#FFEE00");
$b3plot->SetFillColor("#ffee00");
$b3plot->value->setFormat("%d");
$b3plot->SetLegend($nombresFiliales[2]);
$b3plot->value->Show();


/*
$lplot->SetBarCenter();
$lplot->SetColor("yellow");
$lplot->SetLegend("Houses");
$lplot->mark->SetType(MARK_X,'',1.0);
$lplot->mark->SetWeight(2);
$lplot->mark->SetWidth(8);
$lplot->mark->setColor("yellow");
$lplot->mark->setFillColor("yellow");
*/
$graph->legend->SetFrameWeight(1);
$graph->legend->SetColumns(6);
$graph->legend->SetColor('#4E4E4E','#00A78A');


//$band = new PlotBand(VERTICAL,BAND_RDIAG,11,"max",'khaki4');
//$band->ShowFrame(true);
//$band->SetOrder(DEPTH_BACK);
//$graph->Add($band);

$graph->title->Set("Estado de ideas por unidad para: ".$filial);

// Display the graph
//$graph->Stroke(getcwd()."/tmp/estadoideasfilial.png");
$graph->Stroke();


?> 
