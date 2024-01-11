<?php

namespace App\Http\Controllers\Crm;

use App\Models\Crm\Config;
use App\Models\Crm\PermissionGroup;
use App\Http\Controllers\Controller;
use App\Models\Crm\PermissionGroupPermission;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class PermissionGroupController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:crm_permission_group_index',   ['only' => 'index']);
        $this->middleware('permission:crm_permission_group_store',   ['only' => 'store', 'show']);
        $this->middleware('permission:crm_permission_group_update',  ['only' => 'update', 'show']);
        $this->middleware('permission:crm_permission_group_show',    ['only' => 'show']);
        $this->middleware('permission:crm_permission_group_destroy', ['only' => 'destroy']);
    }

    public function index(Request $request)
    {
        $permission_groups = PermissionGroup::select('id', 'name')
            ->where(function ($query) use ($request){
                if ($request->get('name'))
                    $query->where('permission_groups.name', 'LIKE', "%{$request->get('name')}%");
            });

        $permission_groups = $permission_groups->paginate($request->get('limit',Config::key('grid-pagination-limit')));

        return $this->successResponse($permission_groups);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'permissions' => 'required|array',
            'permissions.*' => 'required|integer|distinct|exists:permissions,id'
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->messages(),422);
        }

        $permission_group = PermissionGroup::firstOrCreate([
            'name' => $request->name
        ]);

        foreach ($request->permissions as $id) {
            PermissionGroupPermission::firstOrCreate([
                'permission_group_id' => $permission_group->id,
                'permission_id' => $id
            ]);
        }

        return $this->successResponse('Stored successfully');
    }

    public function update(Request $request, PermissionGroup $permission_group)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'permissions' => 'required|array',
            'permissions.*' => 'required|integer|distinct|exists:permissions,id'
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->messages(),422);
        }

        $permission_group->update([
            'name' => $request->name
        ]);

        PermissionGroupPermission::where('permission_group_id', $permission_group->id)->delete();

        foreach ($request->permissions as $id) {
            PermissionGroupPermission::create([
                'permission_group_id' => $permission_group->id,
                'permission_id' => $id
            ]);
        }

        return $this->successResponse('Changed successfully');
    }

    public function show(PermissionGroup $permission_group)
    {
        return $this->view($permission_group->id);
    }

    public function view($id)
    {
        $permission_group = PermissionGroup::select('id', 'name')
            ->with('permissions.permission')
            ->where('id', $id)
            ->get();

        return $this->successResponse($permission_group);
    }

    public function destroy(PermissionGroup $permission_group)
    {
        $permission_group = PermissionGroup::findOrFail(intval($permission_group->id));

        PermissionGroupPermission::where('permission_group_id', $permission_group->id)->delete();
        $permission_group->delete();

        return $this->successResponse('Deleted successfully');
    }

	public function lists(Request $request)
    {
        $permission_groups = PermissionGroup::select('id', 'name')
            ->where(function ($query) use ($request){
                if ($request->get('name'))
                    $query->where('permission_groups.name', 'LIKE', "%{$request->get('name')}%");
            });

        $permission_groups = $permission_groups->get();

        return $this->successResponse($permission_groups);
    }
}
