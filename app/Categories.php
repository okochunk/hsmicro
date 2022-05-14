<?php

namespace App;

use App\Traits\Uuid;
use Ramsey\Uuid\Uuid as Generator;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use Uuid;

    protected $fillable = [
        'name', 'parent_id', 'is_active'
    ];

    public function scopeGetAllCategory($query, $request)
    {
        if (!empty($request->status) && is_numeric($request->status)) {
            $query->where('is_active', $request->status);
        }

        return $query->orderBy('created_at', 'ASC');
    }

    public function scopeStoreCategory($query, $name, $is_active)
    {
        $data_for_category = [
            'uuid'      => Generator::uuid4()->toString(),
            'name'      => $name,
            'is_active' => $is_active
        ];

        $query->insert($data_for_category);
    }
}
