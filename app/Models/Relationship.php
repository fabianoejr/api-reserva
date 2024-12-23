<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relationship extends Model
{
    protected $table = 'relationship';

    protected $fillable = ['id', 'client', 'user', 'updated_at', 'created_at', 'status'];
}
