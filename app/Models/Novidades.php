<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Novidades extends Model
{
    protected $table = 'novidades';

    protected $fillable = ['id', 'titulo', 'descricao', 'data','situacao'];
}
