<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Affiliated extends Model
{
    protected $table = 'affiliated';

    protected $fillable = ['id', 'client', 'idaffiliated', 'name', 'updated_at', 'created_at'];
}
