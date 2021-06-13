<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use \DateTimeInterface;

class Offer extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    public $table = 'offers';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'order_id',
        'service_provider_id',
        'sponsor_id',
        'description',
        'price',
        'publish',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
   

    public function service_provider()
    {
        return $this->belongsTo(User::class, 'service_provider_id');
    }

    public function sponser()
    {
        return $this->belongsTo(User::class, 'sponsor_id');
    }
}
