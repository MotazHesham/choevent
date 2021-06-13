<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use \DateTimeInterface;

class Event extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    public $table = 'events';

    protected $appends = [
        'featured_image',
        'album',
        'stage',
    ];

    const NATIONALITY_SELECT = [
        'any'   => 'Any Nationality',
        'saudi' => 'Saudi Onlu',
    ];

    const SEX_SELECT = [
        'any'    => 'Any Sex',
        'male'   => 'Male',
        'female' => 'Female',
    ];

    protected $dates = [
        'start_at',
        'end_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'address',
        'location_url',
        'lat',
        'lng',
        'description',
        'start_at',
        'end_at',
        'age_max',
        'age_min',
        'nationality',
        'sex',
        'category_id',
        'user_id',
        'publish',
        'city_id',
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
        $this->addMediaConversion('show')->fit('crop', 770, 447);
        $this->addMediaConversion('index')->fit('crop', 240, 160);
        $this->addMediaConversion('home')->fit('crop', 360, 230);
    }

    public function getStartAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setStartAtAttribute($value)
    {
        $value=new Carbon($value);
       
        $this->attributes['start_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
        
    }

    public function getEndAtAttribute($value)
    {
       
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setEndAtAttribute($value)
    {
        $value=new Carbon($value);
        $this->attributes['end_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

  

    public function getFeaturedImageAttribute()
    {
        $file = $this->getMedia('featured_image')->last();

        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
            $file->show   = $file->getUrl('show');
            $file->index   = $file->getUrl('index');
            $file->home   = $file->getUrl('home');
        }

        return $file;
    }
    public function getDefaultImageAttribute()
    {
        $file = new \stdClass();
      
        $file->thumbnail = asset('images/events/default_event-thumb.jpg');
        $file->preview   = asset('images/events/default_event-preview.jpg');
        $file->show   = asset('images/events/default_event-show.jpg');
        $file->index   = asset('images/events/default_event-index.jpg');
        $file->home   = asset('images/events/default_event-home.jpg');
      
        return $file;
    }

    public function getAlbumAttribute()
    {
        $files = $this->getMedia('album');
        $files->each(function ($item) {
            $item->url       = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview   = $item->getUrl('preview');
        });

        return $files;
    }

    public function getStageAttribute()
    {
        $file = $this->getMedia('stage')->last();

        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

   
    public function booth(){
        return $this->hasMany(Booth::class);
    }
    //
    public function getShortDescriptionAttribute(){
        
        return  Str::limit(strip_tags($this->description),30);
     }
     public function getShortTitleAttribute(){
        
        return  Str::limit(strip_tags($this->title),30);
     }

    public function sponsoringOrders(){
       
        return $this->hasMany(Order::class)->where('type','sponsoring');
    }
    public function serviceOrders(){
        return $this->hasMany(Order::class)->where('type','service');  
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
   //
    public function tickets(){
        return $this->hasMany(Ticket::class);
    }
    public function activeTickets(){
        return $this->hasMany(Ticket::class)
                ->whereDate('end_date','>=',today()->toDateString())
                ->whereDate('start_date','<=',today()->toDateString());
    }
  
 public function getTicketPriceAttribute(){
        return $this->tickets()->min('price');
    }
    public function getCountAttribute(){
        return $this->tickets()->sum('count');
    }
    public function getStartDateAttribute(){
        return (new Carbon($this->start_at))->format('Y-m-d');
    }
    public function getEndDateAttribute(){
        return (new Carbon($this->end_at))->format('Y-m-d');
    }
    //scopes
    public function scopeHasActiveTickets($query)
    {
        return $query->whereHas('tickets',function($q){
            return $q->whereDate('end_date','>=',today()->toDateString())
                 ->whereDate('start_date','<=',today()->toDateString());
        });
    }

   
}
