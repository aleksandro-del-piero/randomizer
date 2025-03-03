<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = ['page_id', 'amount', 'is_win', 'random_number'];
}
