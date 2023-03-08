<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rangetime extends Model
{
    protected $table = 'rangetime';

    protected $fillable = ['id', 'idenvironment', 'day_week', 'seq', 'title', 'h_init', 'h_last', 'h_interval', 'updated_at', 'created_at'];
}
