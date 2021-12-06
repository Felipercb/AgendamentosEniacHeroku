<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class AgendamentosServicosextrasPivot extends Pivot
{
    protected $table = 'agendamentos_servicosextras';
    public $timestamps = false;
    protected $guarded = [];
}
