<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Produto;
use Illuminate\Support\Facades\DB;

class Pedido extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function items()
    {
        // aqui estamos falando que um pedido tem muitos produtos e ai ele usa a tabela intermediaria
        return $this->belongsToMany(Produto::class, 'pedido_produtos')->withPivot('quantidade', 'created_at');
    }

    public function total() {
        $total = 0; 
        foreach ($this-> items as $item){
            $total = $total + ($item-> pivot-> quantidade * $item -> preco);
        }

        return $total;
    }

    
}



