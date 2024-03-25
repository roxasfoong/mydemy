<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function category()
    {
        // Define a "belongsTo" relationship with the Category model
        return $this->belongsTo(Category::class, 'main_category_id', 'id');
    }

    public function SubCategory()
    {
        // Define a "belongsTo" relationship with the Category model
        return $this->belongsTo(SubCategory::class, 'main_category_id', 'id');
    }

}
