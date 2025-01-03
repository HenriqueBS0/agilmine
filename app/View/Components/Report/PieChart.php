<?php

namespace App\View\Components\Report;

use App\Services\DeepMerge;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PieChart extends Component
{
    public string $id;

    public array $options = [];

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $id,
        array $labels,
        array $datasets,
        DeepMerge $deepMerge,
        array $options = []
    ) {
        $this->id = $id;
        $this->options = $deepMerge->merge([
            'type' => 'pie',
            'data' => [
                'labels' => $labels,
                'datasets' => $datasets,
            ],
            'options' => [
                'plugins' => [
                    'datalabels' => false
                ]
            ]
        ], $options);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.report.chart');
    }
}
