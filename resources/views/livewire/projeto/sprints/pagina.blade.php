<x-slot:navbar>
    <x-projeto.navbar :projeto="$projeto" />
</x-slot:navbar>
<x-slot:sidebar>
    <x-projeto.sidebar :projeto="$projeto" />
</x-slot:sidebar>
<x-main titulo="Sprints" x-data="mainData">
    <x-slot:acoes>
        <div>
            <x-input id="pesquisar" type="text" class="form-control" placeholder="Pesquisar..." x-model="search" />
        </div>
        @can('isGestor', $projeto)
            <a class="btn btn-primary ms-2" href="{{ route('pagina-projeto-criar-sprint', ['projeto' => $projeto]) }}">Criar
                Sprint</a>
        @endcan
    </x-slot:acoes>
    <div class="row g-3">
        @foreach ($sprints as $sprint)
            <div class="col-4 h-100" x-show="matchesSearch({{ Js::from($sprint) }})">
                <x-projeto.sprints.card :sprint="$sprint" :tarefas="$tarefas" :vercoes="$vercoes" />
            </div>
        @endforeach
    </div>
</x-main>

<script>
    function mainData() {
        return {
            search: '',
            matchesSearch(sprint) {
                return (sprint.serial + sprint.nome + sprint.resumo).toLowerCase().includes(this.search.toLowerCase());
            },
        }
    }
</script>
