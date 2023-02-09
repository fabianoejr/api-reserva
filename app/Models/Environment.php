<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Environment extends Model
{
    protected $table = 'environment';

    protected $fillable = ['id', 'client', 'idenvironment', 'name', 'updated_at', 'created_at', 'status'];
}
