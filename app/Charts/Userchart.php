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
        $percentageChanges = [];
        $previousPV = null;
        
        foreach ($versions as $version) {
            $data = G_dashboard::where('Code_dossier', $Code_dossier)
                               ->where('Version', $version)
                               ->get()
                               ->pluck('PV')
                               ->toArray();
                               
            $currentPV = $data[0] ?? null; // get the first PV value for the version, if it exists

            if ($previousPV !== null && $currentPV !== null) {
                // calculate the percentage change and add it to the array
                $percentageChange = (($currentPV - $previousPV) / $previousPV) * 100;
                $percentageChanges[] = $percentageChange;
            } else {
                $percentageChanges[] = null;
            }

            $versionData[] = $currentPV;

            // set the current PV as the previous PV for the next iteration
            $previousPV = $currentPV;
        }

        $chart->addData("Prix de Vente", $versionData); // add the PV data as a single series
        $chart->setXAxis($versions->toArray()); // convert the collection to an array
        $chart->setHeight(300); // hauteur de 500px

        // Get the last percentage change
        $lastPercentageChange = end($percentageChanges);

        // Check if the last percentage change is not null
        if ($lastPercentageChange !== null) {
            $lastPercentageChange = number_format($lastPercentageChange, 2) . '%';
        }

        return [
            'chart' => $chart,
            'lastPercentageChange' => $lastPercentageChange,
        ];
    }
}
