<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'file_path',
        'type',
        'category_id',
    ];
// Category.php
public function media()
{
    return $this->hasMany(Media::class);
}

}
