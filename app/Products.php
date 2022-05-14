<?php

namespace App;

use App\Traits\FulltextSearch;
use App\Traits\Uuid;
use Ramsey\Uuid\Uuid as Generator;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use Uuid;
    use FulltextSearch;

    protected $fillable = [
        'name', 'uuid', 'category_id', 'quantity', 'price', 'is_active', 'internal_code', 'media_id'
    ];

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id', 'id');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetails::class, 'product_id', 'id');
    }

    public function getFullProductAttribute()
    {
        return $this->name .' @ '. $this->price . ' GBP ' ;
    }

//    public function getPriceAttribute($value)
//    {
//        return str_replace('.', ',', $value);
//    }
//
//    public function setPriceAttribute($value)
//    {
//        $this->attributes['price'] = str_replace(',', '.', $value);
//    }

    public function scopeGetAllActiveProduct($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeGetProductByUuid($query, $uuid)
    {
        return $query->where('uuid', $uuid);
    }

    public function scopeGetAllProduct($query, $request)
    {
        if (!empty($request->name)) {
            $columns = 'name';

            $query->whereRaw("MATCH ({$columns}) AGAINST (? IN BOOLEAN MODE)", $this->fullTextWildcards($request->name));
        }

        return $query->orderBy('created_at', 'ASC');
    }

    public function scopeStoreProduct($query, $request)
    {
        $data_for_product = [
            'uuid'          => Generator::uuid4()->toString(),
            'name'          => $request->name,
            'internal_code' => $request->internal_code,
            'category_id'   => $request->category_id,
            'quantity'      => $request->quantity,
            'price'         => $request->price,
            'is_active'     => $request->is_active
        ];

        $query->insert($data_for_product);
    }
}
