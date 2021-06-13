<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Coupon extends Model
{
    use SoftDeletes;

    public $table = 'coupons';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const TYPE_SELECT = [
        'all'      => 'all',
        'ticket'   => 'ticket',
        'booth'    => 'booth',
        'register' => 'register',
    ];

    protected $fillable = [
        'title',
        'code',
        'description',
        'discount',
        'type',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
