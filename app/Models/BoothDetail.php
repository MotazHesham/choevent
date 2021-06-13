<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class BoothDetail extends Model
{
    use SoftDeletes;

    public $table = 'booth_details';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const ACTIVITY_SELECT = [
        'restaurant'   => 'مطعم',
        'clothes_shop' => 'محل ملابس',
    ];

    protected $fillable = [
        'order',
        'activity',
        'length',
        'width',
        'price',
        'booth_id',
        'days',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function booth()
    {
        return $this->belongsTo(Booth::class, 'booth_id');
    }
}
