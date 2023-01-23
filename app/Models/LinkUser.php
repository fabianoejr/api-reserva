<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinkUser extends Model
{
    protected $table = 'linkuser';

    protected $fillable = ['id', 'client', 'idaffiliated', 'name', 'email', 'updated_at', 'created_at'];
}
