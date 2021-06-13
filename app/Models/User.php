<?php

namespace App\Models;

use Carbon\Carbon;
use Hash;
use Illuminate\Support\Str;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use \DateTimeInterface;

class User extends Authenticatable implements HasMedia
{
    use SoftDeletes, Notifiable, HasApiTokens, HasMediaTrait;

    public $table = 'users';

    protected $appends = [
        'avatar',
    ];

    protected $hidden = [
        'remember_token',
        'password',
    ];

    const SEX_SELECT = [
        'male'   => 'Male',
        'female' => 'Female',
    ];
    const NATIONALITY_SELECT = [
        'saudi'   => 'Saudi',
        'other' => 'Other',
    ];

    protected $dates = [
        'email_verified_at',
        'mobile_verified_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const GROUP_SELECT = [
        'admin'            => 'Admin',
        'user'             => 'User',
        'sponsor'          => 'Sponsor',
        'event_organizer'  => 'Event Organizer',
        'service_provider' => 'Service Provider',
    ];

    protected $fillable = [
        'name',
        'email',
        'code',
        'email_verified_at',
        'mobile_verified_at',
        'password',
        'remember_token',
        'mobile',
        'description',
        'age',
        'sex',
        'company_register',
        'nationality',
        'employee_name',
        'identity_number',
        'active',
        'group',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getIsAdminAttribute()
    {
        return $this->roles()->where('id', 1)->exists();
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
        $this->addMediaConversion('circle')->fit('crop', 206, 206);
        $this->addMediaConversion('organizer_page')->fit('crop', 570, 505);
    }

    public function getEmailVerifiedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setEmailVerifiedAtAttribute($value)
    {
        $this->attributes['email_verified_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function setPasswordAttribute($input)
    {
        if ($input) {
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
        }
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function getAvatarAttribute()
    {
        $file = $this->getMedia('avatar')->last();

        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
            $file->circle   =$file->getUrl('circle');
            $file->organizer_page =$file->getUrl('organizer_page');
        }

        return $file;
    }

    public function services()
    {
        return $this->belongsToMany(Category::class);
    }
    //
    public function getShortDescriptionAttribute(){
        
        return  Str::limit(strip_tags($this->description),60);
     }
    //  
    public function tickets(){
        return $this->belongsToMany(Ticket::class)
            ->withPivot('count','paid','marchent_id','used_at');
    }
    public function events(){
        return $this->hasMany(Event::class);
    }
    public function orders(){
       
        return $this->hasManyThrough(Order::class, Event::class);
    }
    public function sponsoringOffers(){
        return $this->hasMany(Offer::class,'sponsor_id');
    }
    public function serviceOffers(){
        return $this->hasMany(Offer::class,'service_provider_id');
    }
   
}

