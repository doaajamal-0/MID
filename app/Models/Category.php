<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'categories';
    protected $guarded = [];


    public function parent()
    {
       return $this->belongsTo(Category::class,'parent_id')->withDefault(); // parent بترجع عنصر فاضي في حال حدفنا ال
    }

    public function children()
    {
       return $this->hasMany(Category::class,'parent_id');
    }
    public function getTransNameAttribute()
    {
        return ($this->name);
    }
}
