<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinkEmpClient extends Model
{
    use HasFactory;

    protected $table = 'linkempclient';

    protected $fillable = ['id', 'user_emp', 'client', 'updated_at', 'created_at', 'status'];
}
