<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Resources\FileController;
use App\Models\Crm\Config;
use App\Models\Crm\News;
use App\Models\Crm\NewsTranslation;
use App\Models\Crm\Remark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RemarkController extends Controller
{
    public function __construct()
    {
         $this->media = new FileController();
//         $this->middleware('permission:crm_remark_index', ['only' => 'index']);
//         $this->middleware('permission:crm_remark_store', ['only' => 'store', 'show']);
//         $this->middleware('permission:crm_remark_update', ['only' => 'update', 'show']);
//         $this->middleware('permission:crm_remark_update_status', ['only' => 'update_status', 'show']);
//         $this->middleware('permission:crm_remark_show', ['only' => 'show']);
//         $this->middleware('permission:crm_remark_destroy', ['only' => 'destroy']);
    }

    public function index(Request $request)
    {
        if (!$language = $request->get('language', null))
            return $this->errorResponse('Language can not be blank', 404);

        $posts = Remark::select('id','title','file','description', 'status', 'creator_id','answer_user','answer_file', 'answer_text','created_date','answered_date')
            ->orderBy('id','asc')
            ->where(function ($query) use ($request) {
                if ($request->get('title'))
                    $query->where('title', 'LIKE', "%{$request->get('title')}%");
                if ($request->get('description'))
                    $query->where('description', '=', $request->get('description'));
                 if (is_numeric($request->status))
                    $query->where('status','=',$request->status);

            });

        $posts = $posts->paginate($request->get('limit', Config::key('grid-pagination-limit')));

        $posts = Remark::mediaUrl($posts);

        return $this->successResponse($posts);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'=>'required',
            'description'=>'required',
            'file'=>'required|numeric',
            'status'=>'required|numeric',
            'creator_id'=>'required|numeric',
            'answer_user'=>'required',
            'answer_text'=>'required',
            'answer_file'=>'required|numeric',
            'created_date'=>'required|date|date_format:d.m.Y',
            'answered_date'=>'required|date|date_format:d.m.Y'
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->messages(), 422);
        }

        $remark = Remark::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'file'=>$request->file,
            'status'=>$request->status,
            'creator_id'=>$request->creator_id,
            'answer_user'=>$request->answer_user,
            'answer_text'=>$request->answer_text,
            'answer_file'=>$request->answer_file,
            'created_date'=>$request->created_date,
            'answered_date'=>$request->answered_date,
        ]);

        if ($request->file) {
            $remark->syncMedia($request->file, ['remark_file']);
            $this->media->moveFolderFile($request->file, $remark->id, 'Remark');
        }

        if ($request->answer_file) {
            $remark->syncMedia($request->answer_file, ['remark_answer_file']);
            $this->media->moveFolderFile($request->answer_file, $remark->id, 'Remark');
        }

        return $this->successResponse('Stored successfully');
    }

    public function update(Request $request, $id)
    {
        if (!$remark = Remark::where('id', intval($id))->first())
            abort(404);

        $validator = Validator::make($request->all(), [
            'title'=>'required',
            'description'=>'required',
            'file'=>'required|numeric',
            'status'=>'required|numeric',
            'creator_id'=>'required|numeric',
            'answer_user'=>'required',
            'answer_text'=>'required',
            'answer_file'=>'required|numeric',
            'created_date'=>'required|date|date_format:d.m.Y',
            'answered_date'=>'required|date|date_format:d.m.Y'
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->messages(), 422);
        }

        $remark->update([
            'title'=>$request->title,
            'description'=>$request->description,
            'file'=>$request->file,
            'status'=>$request->status,
            'creator_id'=>$request->creator_id,
            'answer_user'=>$request->answer_user,
            'answer_text'=>$request->answer_text,
            'answer_file'=>$request->answer_file,
            'created_date'=>$request->created_date,
            'answered_date'=>$request->answered_date,
        ]);

        if ($request->file) {
            $remark->syncMedia($request->file, ['remark_file']);
            $this->media->moveFolderFile($request->file, $remark->id, 'Remark');
        }

        if ($request->answer_file) {
            $remark->syncMedia($request->answer_file, ['remark_answer_file']);
            $this->media->moveFolderFile($request->answer_file, $remark->id, 'Remark');
        }

        return $this->successResponse('Changed successfully');
    }

    public function show(Request $request, $id)
    {
        return $this->view(intval($id), $request);
    }

    public function destroy($id)
    {
        $post = Remark::findOrFail(intval($id));

        $post->update(['deleted_by' => auth()->id()]);
        $post->delete();

        return $this->successResponse('Deleted successfully');
    }

    protected function view($id, $request)
    {
        $remark = Remark::where('id', $id)
            ->get();
        $remark = Remark::mediaUrl($remark);
        return $this->successResponse($remark);
    }

    public function lists(Request $request)
    {
        $posts = Remark::select('id','title','description','file','status','creator_id','answer_user','answer_text','answer_file','created_date','answered_date')
            ->where(function ($query) use ($request) {
                if ($request->title)
                    $query->where('title', '=', $request->title);
                if ($request->type)
                    $query->where('description', '=', $request->description);

            })
            ->orderBy('id','asc')
            ->get();
        $posts = Remark::mediaUrl($posts);
        return $this->successResponse($posts);
    }
}
