<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telegram extends Model
{
    protected $table = 'telegram';
    public $timestamps = false;
    protected $guarded = [];
}
