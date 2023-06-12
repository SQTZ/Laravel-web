<?php
namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\G_dashboard;

class UserChart
{
    public function build($Code_dossier, $versions)
{
    $chart = (new LarapexChart)->lineChart()
                               ->setTitle('User Chart')
                               ->setSubtitle('From January to March')
                               ->setXAxis($versions->toArray());

    // Ajouter une série de données pour chaque version
    foreach ($versions as $version) {
        $data = G_dashboard::where('Code_dossier', $Code_dossier)
                           ->where('Version', $version)
                           ->get()
                           ->pluck('PV')
                           ->toArray();

        // Ajoute chaque version comme une série distincte
        $chart->addData("Version $version", $data);
    }

    return $chart;
}



}

