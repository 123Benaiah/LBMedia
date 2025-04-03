<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Media.php
public function category()
{
    return $this->belongsTo(Category::class);
}
}
