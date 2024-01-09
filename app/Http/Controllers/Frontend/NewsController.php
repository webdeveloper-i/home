<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Crm\Config;
use App\Models\Crm\News;
use App\Models\Crm\NewsTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{


    public function index(Request $request)
    {
        if (!$language = $request->get('language', null))
            return $this->errorResponse('Language can not be blank', 404);

        $posts = News::join('news_translations', 'news_translations.news_id', '=', 'news.id')
            ->select('news.id', 'news_translations.title', 'news_translations.language', 'news.publish_at', 'news.type','news.status', 'news.img')
//            ->selectRaw('(SELECT GROUP_CONCAT(language)  FROM post_translations WHERE post_translations.post_id = posts.id) AS translations')
            ->selectRaw("(SELECT  string_agg(language,',')  FROM news_translations WHERE news_translations.news_id = news.id) AS translations")
            ->where([['news_translations.language', $language]])
            ->orderBy('news.id','asc')
            ->where(function ($query) use ($request) {
                if ($request->get('title'))
                    $query->where('news_translations.title', 'LIKE', "%{$request->get('title')}%");
                if ($request->get('type'))
                    $query->where('news.type', '=', $request->get('type'));
                if ($request->get('publish_at'))
                    $query->where('news.publish_at', '=', $request->get('publish_at'));
                if (is_numeric($request->status))
                    $query->where('news.status','=',$request->status);

            });

        $posts = $posts->paginate($request->get('limit', Config::key('grid-pagination-limit')));

        $posts = News::mediaUrl($posts);

        return $this->successResponse($posts);
    }

    public function show(Request $request, $id)
    {
        return $this->view(intval($id), $request);
    }

    protected function view($id, $request)
    {

        $post = News::join('news_translations', 'news_translations.news_id', '=', 'news.id')
            ->select('news.id', 'news_translations.title', 'news_translations.description', 'news_translations.language', 'news.publish_at','news.status', 'news.type', 'news.img')
            ->where('news.id', $id)
            ->where(function ($query) use ($request) {
                if ($request->language)
                    $query->where('news_translations.language', '=', $request->language);

            })->get();
        $post = News::mediaUrl($post);
        return $this->successResponse($post);
    }

    public function lists(Request $request)
    {
        $posts = News::join('news_translations', 'news_translations.news_id', '=', 'news.id')
            ->select('news.id', 'news_translations.title','news_translations.short_description', 'news_translations.description', 'news_translations.language', 'news.publish_at', 'news.type', 'news.img')
            ->where(function ($query) use ($request) {
                if ($request->language)
                    $query->where('news_translations.language', '=', $request->language);
                if ($request->type)
                    $query->where('news.type', '=', $request->type);
                if ($request->publish_at)
                    $query->where('news.publish_at', '=', $request->publish_at);
                if ($request->title)
                    $query->where('news_translations.title', 'LIKE', "%{$request->title}%");
                if (is_numeric($request->status))
                    $query->where('news.status','=',$request->status);

            })
            ->orderBy('news.id','asc')
            ->get();
        $posts = News::mediaUrl($posts);
        return $this->successResponse($posts);
    }
}
