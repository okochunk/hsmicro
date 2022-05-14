<?php

namespace App;

use App\Traits\Uuid;
use Ramsey\Uuid\Uuid as Generator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Orders extends Model
{
    use Uuid;

    protected $fillable = [
        'user_id', 'uuid', 'status', 'notes', 'total', 'process_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetails::class, 'order_id', 'id');
    }

    public function scopeGetOrderByUuid($query, $uuid)
    {
        return $query->where('uuid', $uuid);
    }

    public function scopeGetOrderByUserId($query, $userid)
    {
        return $query->where('user_id', $userid)->orderBy('created_at', 'DESC');
    }

    public function scopeGetAllOrder($query, $request)
    {
        if (!empty($request->status) && is_numeric($request->status)) {
            $query->where('status', $request->status);
        }

        return $query->orderBy('process_date', 'ASC');

    }

    public function scopeGetDashboard($query, $status)
    {
        if (!empty($status) && is_numeric($status)) {
            $query->where('status', $status);
        }

        return $query->orderBy('created_at', 'DESC');

    }


    public function scopeUpdateStatus($query, $order_id, $status)
    {
        $data_for_order = [
            'status' => $status
        ];

        $query->where('id', $order_id)->update($data_for_order);
    }

    public function scopeCreateOrder($query, $content, $total,  $status, $request, $userid)
    {
        return DB::connection(env('DB_CONNECTION'))->transaction(function () use ($query, $content, $total, $status, $request, $userid) {

            $data_for_order = [
                'uuid'                  => Generator::uuid4()->toString(),
                'user_id'               => $userid,
                'status'                => $status,
                'notes'                 => $request->notes,
                'total'                 => $total,
                'process_date'          => $request->process_date,
            ];

            $order_id = $query->insertGetId($data_for_order);

            foreach ($content as $cart) {
                $order_detail = new OrderDetail;
                $order_detail->order_id = $order_id;
                $order_detail->product_id = $cart->id;
                $order_detail->quantity = $cart->qty;
                $order_detail->price = $cart->price;
                $order_detail->subtotal = $cart->subtotal;
                $order_detail->save();
            }


        });
    }
}
