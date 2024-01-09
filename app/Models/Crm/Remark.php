<?php

namespace App\Models\Crm;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Plank\Mediable\Mediable;

class Remark extends Model
{
    use SoftDeletes;
    use Mediable;

    protected $fillable = [
        'title',
        'description',
        'file',
        'status',
        'creator_id',
        'answer_user',
        'answer_text',
        'answer_file',
        'created_date',
        'answered_date',
    ];
    public static function mediaUrl($posts)
    {
        foreach ($posts as $i => $item) {
            $posts[$i]->remark_file = $item->getMedia('remark_file')->first() ? url(
                Storage::url(
                    $item->getMedia('remark_file')->first()->directory . '/' .
                    $item->getMedia('remark_file')->first()->filename . '.' .
                    $item->getMedia('remark_file')->first()->extension)
            ) : "";
            $posts[$i]->remark_answer_file = $item->getMedia('remark_answer_file')->first() ? url(
                Storage::url(
                    $item->getMedia('remark_answer_file')->first()->directory . '/' .
                    $item->getMedia('remark_answer_file')->first()->filename . '.' .
                    $item->getMedia('remark_answer_file')->first()->extension)
            ) : "";
        }
        return $posts;
    }
}
