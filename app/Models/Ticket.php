<?php

namespace App\Models;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Ticket extends Model
{
    use SoftDeletes;

    public $table = 'tickets';

    protected $dates = [
        'start_date',
        'end_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

     protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'entrance',
        'count',
        'max_count',
        'price',
        'event_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
    public function getStartDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getEndDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
//
    public function users(){
        return $this->belongsToMany(User::class)->withPivot('count','paid','marchent_id');
    }
    

    // 

    public function getSoldAttribute(){

        return $this->users()->sum('count');
    }
    public function getRemainderAttribute(){

        return ($this->count)-($this->sold)??0;
    }
   
    //scopes
    public function scopeAvailable($query){
        return $this->remainder;

    }
}
