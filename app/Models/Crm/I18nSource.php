<?php

namespace App\Models\Crm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class I18nSource extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'category',
        'key',
    ];


    public function i18n_translations()
    {
        return $this->hasMany(I18nTranslation::class, 'source_id');
    }
}
