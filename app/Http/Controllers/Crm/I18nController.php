<?php

namespace App\Http\Controllers\Crm;

use App\Models\Crm\I18nSource;
use App\Http\Controllers\Controller;
use App\Models\Crm\I18nTranslation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class I18nController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:crm_i18n_index', ['only' => 'index']);
        $this->middleware('permission:crm_i18n_store', ['only' => 'store', 'show']);
        $this->middleware('permission:crm_i18n_update', ['only' => 'update', 'show']);
        $this->middleware('permission:crm_i18n_show', ['only' => 'show']);
        $this->middleware('permission:crm_i18n_destroy', ['only' => 'destroy']);
    }

    public function index(Request $request)
    {
        $i18n = I18nSource::
            with(['i18n_translations' => function ($query) use ($request) {
                $query->select('source_id','language','message');
            if ($request->get('language'))
                $query->where('i18n_translations.language', $request->get('language'));
            }])
            ->whereHas('i18n_translations', function (Builder $query) use ($request) {
                if ($request->get('message'))
                    $query->where('i18n_translations.message', 'ilike', "%{$request->get('message')}%");
                if ($request->get('language'))
                    $query->where('i18n_translations.language', $request->get('language'));

            })
            ->where(function ($query) use ($request) {
                if ($request->get('category'))
                    $query->where('i18n_sources.category', 'ilike', "%{$request->get('category')}%");

                if ($request->get('key'))
                    $query->where('i18n_sources.key', 'ilike', "%{$request->get('key')}%");
            })
            ->select('i18n_sources.id', 'i18n_sources.category', 'i18n_sources.key')
            ->selectRaw("(SELECT  string_agg(language,',')  FROM i18n_translations WHERE i18n_translations.source_id = i18n_sources.id) AS translations");

        $i18n = $i18n->orderBy('i18n_sources.id', 'DESC')
            ->paginate($request->get('limit', 15));

        return $this->successResponse($i18n);
    }

    public function show($id, Request $request)
    {
        return $this->view(intval($id), $request);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category' => 'required',
            'key' => 'required',
            'values.*.language' => 'nullable|string|exists:languages,code',
            'values.*.message' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->messages(), 422);
        }

        if ($i18n = I18nSource::query()->where('category', $request->category)
            ->where('key', $request->key)->exists()) {
            return $this->errorResponse('I18nSource dublicate: category and key', 422);
        }

        $i18n = I18nSource::create([
            'category' => $request->category,
            'key' => $request->key
        ]);

        foreach ($request->values as $item) {

            $message = $item['message'];
            if ($item['message'] == null) {
                $message = "";
            }
            if ($item['message']) {
                $tr = I18nTranslation::create([
                    'source_id' => $i18n->id,
                    'language' => $item['language'],
                    'message' => $message
                ]);
            }
        }

        return $this->successResponse('Stored successfully');
    }

    public function update(Request $request, I18nSource $i18n)
    {
        $validator = Validator::make($request->all(), [
            'key' => 'required',
            'values.*.language' => 'nullable|string|exists:languages,code',
            'values.*.message' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->messages(), 422);
        }

        $i18n->update([
            'category' => $request->category,
            'key' => $request->key
        ]);

        foreach ($request->values as $item) {

            $message = $item['message'];
            if ($item['message'] == null) {
                $message = "";
            }

            if (I18nTranslation::where('source_id', $i18n->id)->where('language', $item['language'])->first()) {
                I18nTranslation::where('source_id', $i18n->id)->where('language', $item['language'])
                    ->update([
                        'message' => $message
                    ]);
            } else {
                I18nTranslation::create([
                    'source_id' => $i18n->id,
                    'language' => $item['language'],
                    'message' => $message
                ]);
            }
        }

        return $this->successResponse('Changed successfully');
    }

    public function destroy(I18nSource $i18n)
    {
        $i18n->delete();
        $i18n_translation = I18nTranslation::where('source_id',$i18n->id)->delete();
        return $this->successResponse('Deleted successfully');
    }

    public function lists(Request $request)
    {
        $i18n = I18nSource::join('i18n_translations', 'i18n_translations.source_id', '=', 'i18n_sources.id')
            ->orderBy('i18n_sources.id', 'DESC')
            ->where(function ($query) use ($request) {
                if ($request->get('message'))
                    $query->where('i18n_translations.message', 'ilike', "%{$request->get('message')}%");
                if ($request->get('language'))
                    $query->where('i18n_translations.language', $request->get('language'));

                if ($request->get('category'))
                    $query->where('i18n_sources.category', 'ilike', "%{$request->get('category')}%");

                if ($request->get('key'))
                    $query->where('i18n_sources.key', 'ilike', "%{$request->get('key')}%");
            })
            ->select(

                'i18n_sources.key',

                'i18n_translations.message'

            )
            ->pluck(

                'i18n_translations.message',

                'i18n_sources.key'

            )
            ->toArray();;


        return $this->successResponse($i18n);
    }

    protected function view($id, $request)
    {
        if (!I18nSource::where('id', $id)->exists())
            return $this->errorResponse('I18nSource not found', 404);
        else
            $i18n = I18nSource::join('i18n_translations', 'i18n_translations.source_id', '=', 'id')
                ->where('i18n_sources.id', $id)
                ->where(function ($query) use ($request) {
                    if ($request->language)
                        $query->where('i18n_translations.language', '=', $request->language);
                })
                ->select(
                    'i18n_sources.id',
                    'i18n_sources.category',
                    'i18n_sources.key',
                    'i18n_translations.message',
                    'i18n_translations.language'
                )->get();
        return $this->successResponse($i18n);
    }
}
