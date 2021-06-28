<?php
namespace App\models;
use Illuminate\Database\Eloquent\Model;

class Video extends Model{
    protected $table = 'video';
    protected $fillable = [
        'link', 'pic'
    ];
    /*protected $casts = [
        'nome' => 'array'
    ];*/
    
}

?>