<?php

namespace App\Models\Crm;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Plank\Mediable\Mediable;

class News extends Model
{
    use SoftDeletes;
    use Mediable;

    protected $fillable = [
        'img',
        'publish_at',
        'type',
        'status',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at',
        'deleted_by',
    ];

    public function post_translations()
    {
        return $this->hasMany('App\Models\Crm\NewsTranslation');
    }

    public static function mediaUrl($posts)
    {
        foreach ($posts as $i => $item) {
            $posts[$i]->file_url_photo = $item->getMedia('news_image')->first() ? url(
                Storage::url(
                    $item->getMedia('news_image')->first()->directory . '/' .
                    $item->getMedia('news_image')->first()->filename . '.' .
                    $item->getMedia('news_image')->first()->extension)
            ) : "";

        }
        return $posts;
    }

    public function getPublishAtAttribute($date)
    {
        return $date ? Carbon::createFromFormat('Y-m-d', $date)->format('d.m.Y') : '';
    }

    public function setPublishAtAttribute($date)
    {
        return $this->attributes['publish_at'] = Carbon::createFromFormat('d.m.Y', $date)->format('Y-m-d');
    }

    public function getCreatedAtAttribute($date)
    {
        return $date ? Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d.m.Y H:i:s') : '';
    }

    public function getUpdatedAtAttribute($date)
    {
        return $date ? Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d.m.Y H:i:s') : '';
    }

    public function getDeletedAtAttribute($date)
    {
        return $date ? Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d.m.Y H:i:s') : '';
    }
    public function scopeActive($query)
    {
        return $query->where('news.status', 1);
    }
}
