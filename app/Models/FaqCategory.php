<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name','sort_order'];

    public function items()
    {
        return $this->hasMany(FaqItem::class)->orderBy('created_at');
    }
}
