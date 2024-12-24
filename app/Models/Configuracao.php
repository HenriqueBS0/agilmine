<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuracao extends Model
{
    use HasFactory;

    public const string KEY_REDMINE_URL_API = 'redmine_api_url';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'configuracoes';

    protected $fillable = ['key', 'value'];

    /**
     * Retorna o valor de uma configuração com base na chave.
     */
    public static function getValor(string $key): ?string
    {
        return cache()->rememberForever("configuracoes_{$key}", function () use ($key) {
            return self::where('key', $key)->value('value');
        });
    }

    /**
     * Atualiza o valor de uma configuração e limpa o cache.
     */
    public static function setValor(string $key, string $value): void
    {
        self::updateOrCreate(['key' => $key], ['value' => $value]);
        cache()->forget("configuracoes_{$key}");
    }
}
