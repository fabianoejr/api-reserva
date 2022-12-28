<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTerms extends Model
{
    protected $table = 'userterms';

    protected $fillable = ['id', 'descricao', 'situacao'];
}
