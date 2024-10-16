<nav aria-label="Page navigation example">
    <ul class="pagination">
        @for ($pagina = 1; $pagina <= $paginacao->getPaginas(); $pagina++)
            <li @class([
                'page-item',
                'active' => $paginacao->getPaginaAtual() === $pagina,
            ])>
                <button class="page-link" wire:click='atualizarPagina({{ $pagina }})'>{{ $pagina }}</button>
            </li>
        @endfor
    </ul>
</nav>
