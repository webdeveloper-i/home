<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Resources\FileController;
use App\Models\Crm\Config;
use App\Models\Crm\News;
use App\Models\Crm\NewsTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
    public function __construct()
    {
         $this->media = new FileController();
         $this->middleware('permission:crm_news_index', ['only' => 'index']);
         $this->middleware('permission:crm_news_store', ['only' => 'store', 'show']);
         $this->middleware('permission:crm_news_update', ['only' => 'update', 'show']);
         $this->middleware('permission:crm_news_update_status', ['only' => 'update_status', 'show']);
         $this->middleware('permission:crm_news_show', ['only' => 'show']);
         $this->middleware('permission:crm_news_destroy', ['only' => 'destroy']);
    }

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

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'body'=>'required|array',
            'body.*.language' => 'required|string|exists:languages,code',
            'body.*.title' => 'required|string|max:255',
            'short_description.*' => 'required|array',
            'description.*' => 'required|array',
            'img' => 'exists:media,id',
            'publish_at' => 'required|date|date_format:d.m.Y',
            'type' => 'required|string|in:announce,news',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->messages(), 422);
        }

        $post = News::create([
            'created_by' => auth()->id(),
            'img' => $request->img,
            'publish_at' => $request->publish_at,
            'type' => $request->type,
        ]);

        if ($request->img) {
            $post->syncMedia($request->img, ['news_image']);
            $this->media->moveFolderImage($request->img, $post->id, 'News');
        }

        foreach ($request->body as $item) {

            $title = $item['title'];
            if ($item['title'] == null) {
                $title = "";
            }

            $short_description = $item['short_description'];
            if ($item['short_description'] == null) {
                $description = "";
            }

            $description = $item['description'];
            if ($item['description'] == null) {
                $description = "";
            }

            $tr = NewsTranslation::create([
                'news_id' => $post->id,
                'language' => $item['language'],
                'title' => $title,
                'short_description' => $short_description,
                'description' => $description
            ]);
        }

//        $tr->notify(new \App\Notifications\PostPublished());

        return $this->successResponse('Stored successfully');
    }

    public function update(Request $request, $id)
    {
        if (!$post = News::where('id', intval($id))->first())
            abort(404);

        $validator = Validator::make($request->all(), [
            'body'=>'required|array',
            'body.*.language' => 'required|string|exists:languages,code',
            'body.*.title' => 'required|string|max:255',
            'short_description.*' => 'array|string',
            'description.*' => 'array|string',
            'img' => 'exists:media,id',
            'publish_at' => 'required|date|date_format:d.m.Y',
            'type' => 'required|string|in:page,news',
            'status' => 'required|integer|in:0,1,2',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->messages(), 422);
        }

        $post->update([
            'updated_by' => auth()->id(),
            'img' => $request->img ? $request->img : $post->img,
            'publish_at' => $request->publish_at,
            'type' => $request->type,
            'status' => $request->status,
        ]);

        if ($request->img) {
            $post->syncMedia($request->img, ['news_image']);
            $this->media->moveFolderImage($request->img, $post->id, 'News');
        }
        foreach ($request->body as $item) {

            $title = $item['title'];
            if ($item['title'] == null) {
                $title = "";
            }

            $short_description = $item['short_description'];
            if ($item['short_description'] == null) {
                $description = "";
            }

            $description = $item['description'];
            if ($item['description'] == null) {
                $description = "";
            }

            if (NewsTranslation::where('news_id', $id)->where('language', $item['language'])->first()) {
                NewsTranslation::where('news_id', $id)->where('language', $item['language'])
                    ->update([
                        'title' => $title,
                        'short_description' => $short_description,
                        'description' => $description
                    ]);
            } else {
                NewsTranslation::create([
                    'news_id' => $post->id,
                    'language' => $item['language'],
                    'title' => $title,
                    'short_description' => $short_description,
                    'description' => $description
                ]);
            }
        }

        return $this->successResponse('Changed successfully');
    }

    public function update_status(Request $request,$id){

        if (!$post = News::where('id', intval($id))->first())
            abort(404);

        $validator = Validator::make($request->all(), [
            'status' => 'required|integer|in:0,1,2',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->messages(), 422);
        }

        $post->update([
            'updated_by' => auth()->id(),
            'status' => $request->status
        ]);

        if ($request->img) {
            $post->syncMedia($request->img, ['news_image']);
            $this->media->moveFolderImage($request->img, $post->id, 'News');
        }
        return $this->successResponse('Changed successfully');
    }

    public function show(Request $request, $id)
    {
        return $this->view(intval($id), $request);
    }

    public function destroy($id)
    {
        $post = News::findOrFail(intval($id));

        $post->update(['deleted_by' => auth()->id()]);
        $post->delete();

        return $this->successResponse('Deleted successfully');
    }

    protected function view($id, $request)
    {

        $post = News::join('news_translations', 'news_translations.news_id', '=', 'news.id')
            ->select('news.id', 'news_translations.title', 'news_translations.description', 'news_translations.language', 'news.publish_at','news.status', 'news.type', 'news.img')
            ->where('news.id', $id)
            ->where(function ($query) use ($request) {
                if ($request->language)
                    $query->where('news_translations.language', '=', $request->language);

            })
            ->get();
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
