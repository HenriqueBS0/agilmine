<?php

namespace App\View\Components\Projeto\Report;

use App\Models\Projeto;
use App\Services\MarkdownService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Resumo extends Component
{
    public $resumo;

    /**
     * Create a new component instance.
     */
    public function __construct(Projeto $projeto, MarkdownService $markdownService)
    {
        $this->resumo = $markdownService->parse($projeto->descricao);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.projeto.report.resumo');
    }
}
