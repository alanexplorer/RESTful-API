<?php
require_once 'phplot/phplot.php';

# Data array: each row is (label, X, Ymin, YQ1, Ymid, YQ3, Ymax, [Youtlier...])
$data = array(array('', 1,  10, 15, 20, 25, 30));

$plot = new PHPlot(500, 500);
$plot->SetTitle('Consulta');
$plot->SetDataType('data-data');
$plot->SetDataValues($data);
$plot->SetPlotType('boxes');
$plot->SetImageBorderType('plain');

$plot->SetLineStyles('dashed');
$plot->SetLineWidths(array(3, 3, 1));
$plot->SetDataColors(array('blue', 'blue', 'red', 'blue'));
$plot->SetPointShapes('star');

$plot->DrawGraph();
