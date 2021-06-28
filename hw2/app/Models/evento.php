<?php
namespace App\models;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model{
    protected $table = 'evento';
    protected $fillable = [
        'nome', 'citta', 'link', 'pic', 'descrizione'
    ];
    /*protected $casts = [
        'nome' => 'array'
    ];*/
    
}

?>