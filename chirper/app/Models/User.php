<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;


class User extends Authenticatable
{
    use Notifiable;
     // Eu estou dizendo quais campos podem ser preenchidos no cadastro
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    //Para esconder a informação delicadas
    protected $hidden = [
        'password',
        'remember_token', //Aqui é para o usuário permanecer logado
    ];

    //Para ter a função de vários posts lá.
    public function chirps(): HasMany
        {
    return $this->hasMany(Chirp::class);
        }
    
}

