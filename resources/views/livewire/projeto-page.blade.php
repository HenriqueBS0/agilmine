<x-slot:navbar>
    <livewire:navbar :$navbarBreadCrumbItens></livewire:navbar>
</x-slot:navbar>
<div class="container p-2">
    <ul class="nav nav-tabs" id="tabs-projetos" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="backlog-tab" data-bs-toggle="tab" data-bs-target="#backlog-tab-pane" type="button"
                role="tab" aria-controls="backlog-tab-pane" aria-selected="true">Backlog</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="sprints-tab" data-bs-toggle="tab" data-bs-target="#sprints-tab-pane"
                type="button" role="tab" aria-controls="sprints-tab-pane" aria-selected="false">Sprints</button>
        </li>
    </ul>
    <div class="tab-content" id="tabs-projetos-content">
        <div class="tab-pane fade" id="backlog-tab-pane" role="tabpanel" aria-labelledby="backlog-tab" tabindex="0">
            <livewire:backlog-list :$projeto />
        </div>
        <div class="tab-pane fade show active" id="sprints-tab-pane" role="tabpanel" aria-labelledby="sprints-tab"
            tabindex="0">
            <livewire:sprint-list :$projeto />
        </div>
    </div>
</div>
