<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;

class UserChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        return $this->chart->barChart()
            ->setTitle('jumlah banyaknya akun')
            ->setSubtitle('')
            ->addData('superadmin', [6, 9, 3, 4, 10, 8])
            ->addData('dkm', [7, 3, 8, 2, 6, 4])
            ->addData('jamaah', [4, 5, 2, 6, 7, 8])
            ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June']);
            
    }
}
