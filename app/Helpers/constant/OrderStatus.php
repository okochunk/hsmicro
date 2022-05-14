<?php

namespace App\Helpers\Constant;

class OrderStatus
{
    const PENDING   = 1;
    const COMPLETED = 2;

    public static function generateIcon($status)
    {
        if (is_null($status)) {
            return "";
        }

        if ($status == self::PENDING) {
            return "<span class='label label-warning'>Pending</span>";
        } else if ($status == self::COMPLETED) {
            return "<span class='label label-success'>Complete </span>";
        }
    }

    public static function completeState()
    {
        return [self::COMPLETED];
    }

    public static function generateList()
    {
        return [
            self::PENDING => 'Pending',
            self::COMPLETED => 'Completed'
        ];
    }

    public static function generateSelectList()
    {
        return [
            '' => 'All Status',
            self::PENDING => 'Pending',
            self::COMPLETED => 'Completed'
        ];
    }

}