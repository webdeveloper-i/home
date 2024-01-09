<?php

namespace App\Models\Crm;

use App\Traits\HasCompositePrimaryKey;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class I18nTranslation extends Model
{
    use SoftDeletes;

    public $primaryKey = ['source_id', 'language'];
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'source_id',
        'language',
        'message'
    ];

    public function i18n_source()
    {
        return $this->belongsTo('App\Models\Crm\I18nSource');
    }

    public function language()
    {
        return $this->belongsTo('App\Models\Crm\Language');
    }
}
