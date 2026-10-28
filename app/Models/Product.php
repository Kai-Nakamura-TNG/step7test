<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Models\Company;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'product_name',
        'price',
        'stock',
        'comment',
        'img_path',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function scopeSearch($query, $search_conditions)
    {
        if (isset($search_conditions['keyword'])) {
            $query->where('product_name', 'like', '%' . $search_conditions['keyword'] . '%');
        }

        if (isset($search_conditions['company_id'])) {
            $query->where('company_id', $search_conditions['company_id']);
        }

        if (isset($search_conditions['min_price'])) {
            $query->where('price', '>=', $search_conditions['min_price']);
        }

        if (isset($search_conditions['max_price'])) {
            $query->where('price', '<=', $search_conditions['max_price']);
        }

        if (isset($search_conditions['min_stock'])) {
            $query->where('stock', '>=', $search_conditions['min_stock']);
        }

        if (isset($search_conditions['max_stock'])) {
            $query->where('stock', '<=', $search_conditions['max_stock']);
        }

        return $query;
    }

    public static function createWithImage($data, $image)
    {
        if ($image) {
            $path = $image->store('products', 'public');
            $data['img_path'] = $path;
        }

        return self::create($data);
    }

    public function updateWithImage($data, $image)
    {
        if ($image) {
            $path = $image->store('products', 'public');
            $data['img_path'] = $path;
        }

        $this->update($data);

        return $this;
    }

    public function deleteWithImage()
    {
        if ($this->img_path) {
            Storage::disk('public')->delete($this->img_path);
        }

        return $this->delete();
    }
}
