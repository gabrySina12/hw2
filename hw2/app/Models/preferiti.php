<?php
namespace App\models;
use Illuminate\Database\Eloquent\Model;

class Preferiti extends Model{
    protected $table = 'preferiti';
    protected $fillable = [
        'id','username', 'titolo', 'link', 'pic', 'descrizione'
    ];
    /*protected $casts = [
        'titolo' => 'array'
    ];*/

}

?>