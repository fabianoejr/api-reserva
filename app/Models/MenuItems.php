<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItems extends Model
{
    protected $table = 'menuitems';

    protected $fillable = ['codite', 'codprf', 'urlite', 'desite', 'icoite', 'mosmen', 'ordite', 'codmod', 'updated_at', 'created_at'];
}
