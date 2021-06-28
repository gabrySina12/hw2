<?php
namespace App\models;
use Illuminate\Database\Eloquent\Model;

class Squadra extends Model{
    protected $table = 'squadra';
    protected $fillable = [
        'id','nome'
    ];
    /*protected $casts = [
        'nome' => 'array'
    ];*/

    public function piloti() {
        return $this->hasMany("App\Models\User");
    }
    public function copiloti() {
        return $this->hasMany("App\Models\copilota");
    }
}

?>