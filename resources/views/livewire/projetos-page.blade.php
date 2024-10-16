<x-slot:navbar><livewire:navbar :$navbarBreadCrumbItens></livewire:navbar></x-slot:navbar>

<div class="container">
    <div class="container-projetos row row-cols-1 p-2 gap-2">
        @foreach ($projetos as $projeto)
            <livewire:projeto-item :$projeto :key="$projeto->getId()">
        @endforeach
    </div>
</div>
