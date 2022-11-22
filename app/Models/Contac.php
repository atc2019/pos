<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contac extends Model
{
    use HasFactory;
    protected $table = "contacs";
    protected $fillable = [
        'value',
        'type',
        
       ];
  
       public function Client()
       {
           return $this->belongsTo(Client::class);
       }   
}
