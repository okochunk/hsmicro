<?php

namespace App;

use App\Traits\FulltextSearch;
use App\Traits\Uuid;
use Ramsey\Uuid\Uuid as Generator;
use Illuminate\Database\Eloquent\Model;

class UserNotification extends Model
{
    use Uuid;
    use FulltextSearch;

    public function scopeGetAllNotification($query, $request)
    {
        if (!empty($request->title)) {
            $columns = 'title';

            $query->whereRaw("MATCH ({$columns}) AGAINST (? IN BOOLEAN MODE)", $this->fullTextWildcards($request->title));
        }

        return $query->orderBy('created_at', 'DESC');
    }

    public function scopeStoreNotification($query, $request)
    {
        $data_for_notification = [
            'uuid'        => Generator::uuid4()->toString(),
            'title'       => $request->title,
            'description' => $request->description,
            'is_active'   => $request->is_active,
            'start_date'  => $request->start_date,
            'end_date'    => $request->end_date,
        ];

        $query->insert($data_for_notification);
    }
}
