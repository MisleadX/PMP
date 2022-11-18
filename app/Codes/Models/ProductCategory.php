<?php

namespace App\Codes\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $table = 'product_category';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'image',
        'status'
    ];

    protected $appends = [
        'image_full'
    ];

    protected $dates = [
        'created_at',
    ];

    public function getCreatedAtAttribute()
    {
        return \Carbon\Carbon::parse($this->attributes['created_at'])
            ->format('Y-m-d H:i:s');
    }

    public function getImageFullAttribute()
    {
        if (strlen($this->image) > 0) {
            return  asset($this->image);
        }
        return asset('assets/cms/images/no-img.png');
    }

}
