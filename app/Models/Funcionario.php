<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    protected $fillable = [
        'nome', 'cargo', 'email', 'telefone', 'password','data_nascimento',
    ];

}
