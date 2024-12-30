<div @tarefa-selecionada.window="onTarefaSelecionada($event)" x-data="{
    tarefa: null,
    onTarefaSelecionada(event) {
        this.tarefa = event.detail.tarefa
    }
}" x-html="tarefa?.descricaoHtml ?? ''"
    style="height: 118px; overflow-y: scroll; padding: 4px">

</div>
