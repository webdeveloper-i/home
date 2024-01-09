<?php

namespace App\Models\Crm;

use App\Traits\HasCompositePrimaryKey;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class NewsTranslation extends Model
{
    public $incrementing = false;
    public $primaryKey = ['news_id', 'language'];

    use Notifiable;

    protected $fillable = [
        'news_id',
        'language',
        'title',
        'short_description',
        'description'
    ];
}
