<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = "products";
    protected $fillable = [
        'name',
        'price',
        'stock',
        'user_id',
        'category_id',
        
       ];
public function category()
{
    return $this->belongsTo(Category::class);
}

public function Sales()
       {
        /// una venta es echa por un cliente si o si
        return $this->belongsToMany(Sale::class,'Details');
       }

}

