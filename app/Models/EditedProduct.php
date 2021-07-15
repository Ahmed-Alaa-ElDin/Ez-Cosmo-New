<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EditedProduct extends Model
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
        'product_id',
        'form_id',
        'line_id',
        'brand_id',
        'category_id',
        'request_type',
        'created_by',
        'approved',
        'approved_by',
    ];

    public function Product()
    {
        return $this->belongsTo(Product::class)->withTrashed();
    }

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

    public function editor()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function indications()
    {
        return $this->belongsToMany(Indication::class, 'edited_product_indication', 'product_id', 'indication_id');
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'edited_product_ingredient', 'product_id', 'ingredient_id')->withPivot('concentration', 'role');
    }

    public function reviews()
    {
        return $this->belongsToMany(User::class, 'reviews', 'product_id', 'user_id')->withPivot('id', 'review', 'score', 'created_at')->orderBy('pivot_id');
    }
}
