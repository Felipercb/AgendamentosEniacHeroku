<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Responsavel extends Model
{
    protected $table = 'responsavel';
    public $timestamps = false;
    protected $guarded = [];

    public function agendamentos () 
    {
        return $this->belongsTo(agendamentos::class);
    }
}
