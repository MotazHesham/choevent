<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use \DateTimeInterface;

class Order extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    public $table = 'orders';

    const TYPE_SELECT = [
        'service'    => 'service',
        'sponsoring' => 'sponsoring',
    ];

    protected $dates = [
        'setup_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'type',
        'event_id',
        'description',
        'classification',
        'price',
        'category_id',
        'service_provider_id',
        'sponsor_id',
        'days',
        'setup_date',
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

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function service_provider()
    {
        return $this->belongsTo(User::class, 'service_provider_id');
    }

    public function sponser()
    {
        return $this->belongsTo(User::class, 'sponsor_id');
    }

    public function getSetupDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setSetupDateAttribute($value)
    {
        $this->attributes['setup_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }
}
