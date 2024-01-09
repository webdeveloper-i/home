<?php

namespace App\Http\Controllers\Crm;

use App\Models\Crm\Config;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ConfigController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:crm_config_index', ['only' => 'index']);
        $this->middleware('permission:crm_config_store', ['only' => 'store', 'show']);
        $this->middleware('permission:crm_config_update', ['only' => 'update', 'show']);
        $this->middleware('permission:crm_config_show', ['only' => 'show']);
    }

    public function index(Request $request)
    {
        $configs = Config::select('id','value')
            ->where(function ($query) use ($request) {
                if ($request->get('key'))
                    $query->where('configs.id', 'LIKE', "%{$request->get('key')}%");
                $query->orWhere('configs.value', 'LIKE', "%{$request->get('key')}%");
            });

        $configs = $configs->paginate(request()->get('limit', Config::key('grid-pagination-limit')));

        return $this->successResponse($configs);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|string|min:1|max:255',
            'value' => 'required|string|min:1|max:255',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->messages(), 422);
        }

        $config = Config::create([
            'id' => $request->id,
            'value' => $request->value
        ]);

        return $this->successResponse('Stored successfully');
    }

    public function show($id)
    {
        return $this->view($id);
    }

    public function update(Request $request, $id)
    {
        if (!$config = Config::where('id',$id)->first())
            abort(404);

        $validator = Validator::make($request->all(), [
            'value' => 'required|string|min:1|max:255',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->messages(), 422);
        }
        $config->update([
            'value' => $request->value
        ]);

        return $this->successResponse('Changed successfully');
    }

    public function view($id)
    {
        if (!$config = Config::where('id',$id)->first())
            abort(404);

        return $this->successResponse($config);
    }
}
