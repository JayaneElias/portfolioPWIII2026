<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;  

class Chirp extends Model {
    protected $fillable = [
        'message', 'user_id'
    ];

    //Função para dizer que o chirp pertence a determinado usuário 
    public function user(): BelongsTo 
      {
        //Um chirp é 1 -> 1 usuário
          return $this->belongsTo(User::class);
       }
}
