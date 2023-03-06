<?php

namespace App\Models;

use App\Models\Categories;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Operations extends Model
{
    use HasFactory;
    protected $fillable = ['operationDescription', 'operationDate', 'operationSomme', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Categories::class);
    }
}
