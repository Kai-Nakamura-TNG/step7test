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

    public function scopeSearch($query, $keyword, $companyId)
    {
        if ($keyword) {
            $query->where('product_name', 'like', '%' . $keyword . '%');
        }

        if ($companyId) {
            $query->where('company_id', $companyId);
        }

        return $query;
    }

    public static function createWithImage($data, $image)
    {
        if ($image){
            $path = $image->store('products', 'public');
            $data['img_path'] = $path;
        }

        return self::create($data);
    }

    public function updateWithImage($data, $image)
    {
        if ($image){
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
