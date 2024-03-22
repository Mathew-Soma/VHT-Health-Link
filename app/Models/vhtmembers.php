<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class vhtmembers extends Model
{
    protected $table = 'vhtmembers';
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
}
