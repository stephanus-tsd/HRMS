<?php
include "include/library.php";
require_once ('/jpgraph/src/jpgraph.php');
require_once ('/jpgraph/src/jpgraph_line.php');

$sql = new mysql("localhost","root","","hrm");
$sql->connect();

$year = $_GET['year'];

$array = $sql->getReportCuti($year);

foreach($array as $key => $value) {
	$tanggal[] = $key;
	$jumlah[] = $value;
}

//setup the graph
$graph = new Graph(600,600);
$graph->SetMargin(50,100,50,50);
$graph->SetScale("textlin",0,50);
$graph->SetShadow();

$theme_class = new UniversalTheme;

$graph->SetTheme($theme_class);
$graph->img->SetAntiAliasing(false);
$graph->title->Set('Jumlah Cuti Per Bulan');
$graph->SetBox(false);

$graph->img->SetAntiAliasing();

//setup legend
$graph->legend->Pos(0.1,0.5,"right","center");

// setting y axis
$graph->yaxis->title->Set('Jumlah');
$graph->yaxis->HideZeroLabel();
$graph->yaxis->HideLine(false);
$graph->yaxis->HideTicks(false,false);
$graph->yaxis->SetColor('red');
$graph->yscale->ticks->Set(10,2);

// setting x axis
$graph->xgrid->Show();
$graph->xgrid->SetLineStyle("solid");
$graph->xaxis->SetTickLabels($tanggal);
$graph->xgrid->SetColor('#E3E3E3');
$graph->xaxis->SetLabelAngle(70);

// Create the first line
$p1 = new LinePlot($jumlah);
$graph->Add($p1);
$p1->SetColor('blue');
$p1->value->Show();
$p1->value->SetColor('darkred');
$p1->value->SetFont(FF_FONT1,FS_BOLD);
$p1->value->SetFormat("%d");
$p1->mark->SetType(MARK_UTRIANGLE);
$p1->mark->SetColor('red');
//$p1->SetLegend("Nilai max = ".$max[1]." pada tanggal ".$max[0]);

// Output line
$graph->Stroke();
?>