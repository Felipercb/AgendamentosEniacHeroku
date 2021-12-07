<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agendamentos extends Model
{
    use SoftDeletes;

    protected $table = 'agendamentos';
    public $timestamps = false;
    protected $guarded = [];
    protected $dates = ['deleted_at'];
    
    protected $casts = [
        "tempo_inicial" => "datetime",
        "tempo_final" => "datetime"
    ]; //Converte campos
    
    public function RecursosAudioVisuais ()
    {
        return $this->belongsToMany(RecAudioVisuais::class , 'agendamentos_recaudiovisuais' , 'agendamentos_id' ,'recaudiovisuais_id') ;
    }

    public function ServicosExtras () 
    {
        return $this->belongsToMany(ServicosExtras::class, 'agendamentos_servicosextras', 'agendamentos_id' ,'servicosextras_id');
    }

    public function Staff () 
    {
        return $this->belongsToMany(Staff::class, 'agendamentos_staff', 'agendamentos_id' ,'staff_id');
    }

    public function Espacos() 
    {
        return $this->belongsToMany(Espacos::class, 'agendamentos_espacos', 'agendamentos_id' ,'espacos_id');
    }
    
    public function responsavel () 
    {
        return $this->hasOne(Responsavel::class);
    }
}
