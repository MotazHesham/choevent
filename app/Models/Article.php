<?php

namespace App\Models;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use \DateTimeInterface;

class Article extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    public $table = 'articles';

    protected $appends = [
        'featured_image',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'description',
        'category_id',
        'main_slider',
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
        $this->addMediaConversion('index')->fit('crop',  240, 160);
    }

    public function getFeaturedImageAttribute()
    {
        $file = $this->getMedia('featured_image')->last();

        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
            $file->index   = $file->getUrl('index');
        }

        return $file;
    }
    public function getDefaultImageAttribute()
    {
        $file = new \stdClass();
      
        $file->thumbnail = asset('images/news/default_news-thumb.jpg');
        $file->preview   = asset('images/news/default_news-preview.jpg');
        $file->index   = asset('images/news/default_news-index.jpg');
     
      
        return $file;
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    // 
    public function getShortDescriptionAttribute(){
        
       return  Str::limit(strip_tags($this->description),30);
    }
    public function getShortTitleAttribute(){
        
        return  Str::limit(strip_tags($this->title),15);
     }
}
