<?php
use Ghunti\HighchartsPHP\Highchart;
use Ghunti\HighchartsPHP\HighchartJsExpr;

$data = [
	[
		"hc-key" => "nl-gr",
		"value"  => 10,
	],
	[
		"hc-key" => "nl-fr",
		"value"  => 20,
	],
	[
		"hc-key" => "nl-dr",
		"value"  => 30,
	],
	[
		"hc-key" => "nl-ov",
		"value"  => 40,
	],
	[
		"hc-key" => "nl-ge",
		"value"  => 50,
	],
	[
		"hc-key" => "nl-ut",
		"value"  => 60,
	],
	[
		"hc-key" => "nl-fl",
		"value"  => 70,
	],
	[
		"hc-key" => "nl-nh",
		"value"  => 80,
	],
	[
		"hc-key" => "nl-zh",
		"value"  => 90,
	],
	[
		"hc-key" => "nl-ze",
		"value"  => 100,
	],
	[
		"hc-key" => "nl-nb",
		"value"  => 110,
	],
	[
		"hc-key" => "nl-li",
		"value"  => 120,
	],
];

$chart = new Highchart(Highchart::HIGHMAPS);

$chart->chart->renderTo = "container";
$chart->title->text = "Dutch Provinces";
$chart->chart->mapNavigation->enabled = true;
$chart->colorAxis->min = 0;
$chart->mapNavigation->enabled = true;
$chart->mapNavigation->buttonOptions->verticalAlign = "bottom";

$chart->series[0] = [
	"name"       => "Some numbering",
	"data"       => $data,
	"joinBy"     => "hc-key",
	"mapData"    => new HighchartJsExpr("Highcharts.maps['countries/nl/nl-all']"),
	"states"     => [
		"hover" => [
			"color" => "#BADA55",
		],
	],
	"dataLabels" => [
		"enabled" => true,
		"format"  => "{point.name}",
	],
];

$chart->addExtraScript('country-nl', 'https://code.highcharts.com/mapdata/', 'countries/nl/nl-all.js');
$chart->includeExtraScripts(['country-nl']);
?>
<html>
	<head>
		<title>Area</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<?php $chart->printScripts(); ?>
	</head>
	<body>
		<div id="container"></div>
		<script type="text/javascript">
			<?php echo $chart->render("chart"); ?>
		</script>
	</body>
</html>
