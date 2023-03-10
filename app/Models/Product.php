<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{

    use SoftDeletes;
    protected $table = 'products';

    protected $guarded = [];
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
}
