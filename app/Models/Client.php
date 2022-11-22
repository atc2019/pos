<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $table = "clients";

    protected $fillable = [
        'nit',
        'name',
        'last_name',
        'birth_date',
       ];

       public function Sales()
       {
        /////tiene muchas ventas
        return $this->hasMany(Client::class);
       }
       public function Contacs()
       {
        /////tiene muchas numeros de contactos
        return $this->hasMany(Contac::class);
       }
}
