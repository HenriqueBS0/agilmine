<?php

namespace App\View\Components\Sprint\Backlog;

use App\Models\Sprint;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Tarefa extends Component
{
    public Sprint $sprint;

    /**
     * Create a new component instance.
     */
    public function __construct(Sprint $sprint)
    {
        $this->sprint = $sprint;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sprint.backlog.tarefa');
    }
}
