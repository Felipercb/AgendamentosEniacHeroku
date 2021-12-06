<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class AgendamentosEspacosPivot extends Pivot
{
    protected $table = 'agendamentos_espacos';
    public $timestamps = false;
    protected $guarded = [];
}
