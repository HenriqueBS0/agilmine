<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sprint extends Model
{
    use HasFactory;

    // Definindo os campos que podem ser atribuídos em massa
    protected $fillable = [
        'nome',
        'data_inicio',
        'data_fim',
        'tarefas_id',
        'project_id'
    ];

    // Definindo que o campo 'tarefas_id' deve ser tratado como um array JSON
    protected $casts = [
        'tarefas_id' => 'array',
    ];

    protected $appends = [
        'dias'
    ];

    // Desativando timestamps automáticos, pois não foram incluídos na migration
    public $timestamps = false;

    protected function dias(): Attribute
    {
        return Attribute::make(
            get: function ($valor, $atributos) {
                $datas = [];
                $dataAtual = (new DateTime($atributos['data_inicio']))->setTime(0, 0, 0, 0);
                $dataFinal = new DateTime($atributos['data_fim']);

                while ($dataAtual <= $dataFinal) {
                    if ($dataAtual->format('N') <= 5) {
                        $datas[] = clone $dataAtual;
                    }

                    $dataAtual->modify('+1 day');
                }

                return $datas;
            },
        );
    }

    public static function getAllTarefasUtilizadasOutrasSprints(int $projectId, ?int $sprintId = null): array
    {
        $tarefas = [];

        $consulta = self::where('project_id', $projectId);

        if ($sprintId) {
            $consulta->whereNot('id', $sprintId);
        }

        foreach ($consulta->get() as $sprint) {
            $tarefas = array_merge($tarefas, $sprint->tarefas_id);
        }

        return $tarefas;
    }
}
