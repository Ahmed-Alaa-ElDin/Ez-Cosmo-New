<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'volume',
        'units',
        'price',
        'advantages',
        'disadvantages',
        'notes',
        'directions_of_use',
        'product_photo',
        'code',
        'form_id',
        'brand_id',
        'line_id',
        'category_id',
    ];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    public function line()
    {
        return $this->belongsTo(Line::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function indications()
    {
        return $this->belongsToMany(Indication::class);
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class)->withPivot('concentration','role');
    }

    public function country()
    {
        return $this->hasOneThrough(Country::class, Brand::class);
    }

    public function reviews()
    {
        return $this->belongsToMany(User::class,'reviews','product_id','user_id')->withPivot('id','review','score','created_at')->orderBy('pivot_id');
    }

}
