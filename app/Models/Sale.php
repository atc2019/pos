<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    protected $table = "sales";

    protected $fillable = [
        'user_id',
        'client_id',
        'invoice_number',
        'nit',
        'name',
        'sale_date',
        
       ];
       public function User()
       {
        // una venta es echa por un usuario si o si
        return $this->belongsTo(User::class);
        
       }
       public function Client()
       {
        /// una venta es echa por un cliente si o si
        return $this->belongsTo(Client::class);
       }
       public function Details()
       {
       
        return $this->hasMany(Detail::class);
       }


       public function Products()
       {
        /// una venta es echa por un cliente si o si
        return $this->belongsToMany(Product::class,'Details');
       }
}
