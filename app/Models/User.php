<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Services\ApiRedmine\ApiRedmine;
use App\Services\ApiRedmine\Entidades\Usuario;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'admin',
        'habilitado',
        'key_redmine',
        'id_usuario_redmine'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'admin' => 'boolean',
        'habilitado' => 'boolean'
    ];

    protected static function booted()
    {
        static::updating(function ($user) {
            if ($user->isDirty('key_redmine')) { // Verifica se 'key_redmine' foi alterado
                $user->id_usuario_redmine = null; // Limpa o campo 'id_usuario_redmine'
            }
        });
    }

    /**
     * Obtém o ID do usuário no Redmine.
     *
     * @return int|null
     */
    public function getRedmineId(): ?int
    {
        if ($this->key_redmine === null) {
            return null;
        }

        if (is_int($this->id_usuario_redmine)) {
            return $this->id_usuario_redmine;
        }

        try {
            $usuario = ApiRedmine::listar(Usuario::parametroListar())->dados()[0];

            $this->id_usuario_redmine = $usuario->getId();
            $this->save();

            return $this->id_usuario_redmine;
        } catch (\Throwable $th) {
            return null;
        }
    }
}
