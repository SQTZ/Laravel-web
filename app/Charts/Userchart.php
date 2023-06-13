<?php
namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\G_dashboard;

class UserChart
{
    public function build($Code_dossier, $versions)
{
    $chart = (new LarapexChart)->lineChart();

    $versionData = [];
    foreach ($versions as $version) {
        $data = G_dashboard::where('Code_dossier', $Code_dossier)
                           ->where('Version', $version)
                           ->get()
                           ->pluck('PV')
                           ->toArray();
                           
        $versionData[] = $data[0] ?? null; // get the first PV value for the version, if it exists
    }

    $chart->addData("Prix de Vente", $versionData); // add the PV data as a single series
    $chart->setXAxis($versions->toArray()); // convert the collection to an array

    return $chart;
}




}

