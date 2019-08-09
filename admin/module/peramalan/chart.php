<?php // content="text/plain; charset=utf-8"
require_once ('jpgraph/jpgraph.php');
require_once ('jpgraph/jpgraph_line.php');

$myArr = json_decode(base64_decode($_GET['data']), true); //jadi yang tadinya diubah karakter diubah lagi ke array dan disimpan di array datay1 dan datay2, data isini tu yang ada di url yang karakter semua itu coba di tab baru

$datay1 = $myArr['pred']['value'];
$datay2 = $myArr['actual'];
// $datay3 = array(5,17,32,24);

function nama_bulan($id) {
	$bulan = array(
		'Jan',
		'Feb',
		'Mar',
		'Apr',
		'Mei',
		'Jun',
		'Jul',
		'ags',
		'sep',
		'okt',
		'nov',
		'des',
	);
	return $bulan[$id];
}

$bln = $myArr['pred']['label'];

// Setup the graph
$graph = new Graph(1030,400);
$graph->SetScale("textlin");

$theme_class=new UniversalTheme;

$graph->SetTheme($theme_class);
$graph->img->SetAntiAliasing(false);
$graph->title->Set('Geafik Peramalan Penjualan');
$graph->SetBox(false);

$graph->SetMargin(40,20,36,63);

$graph->img->SetAntiAliasing();

$graph->yaxis->HideZeroLabel();
$graph->yaxis->HideLine(false);
$graph->yaxis->HideTicks(false,false);

$graph->xgrid->Show();
$graph->xgrid->SetLineStyle("solid");
$graph->xaxis->SetTickLabels($bln);
$graph->xgrid->SetColor('#E3E3E3');

// Create the first line
$p1 = new LinePlot($datay1);
$graph->Add($p1);
$p1->SetColor("#6495ED");
$p1->SetLegend('Prediction');

// Create the second line
$p2 = new LinePlot($datay2);
$graph->Add($p2);
$p2->SetColor("#B22222");
$p2->SetLegend('Actual');

// // Create the third line
// $p3 = new LinePlot($datay3);
// $graph->Add($p3);
// $p3->SetColor("#FF1493");
// $p3->SetLegend('Line 3');

$graph->legend->SetFrameWeight(1);

// Output line
$graph->Stroke();

?>

