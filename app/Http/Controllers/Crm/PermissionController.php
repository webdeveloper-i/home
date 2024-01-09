<?php

namespace App\Http\Controllers\Crm;

use App\Models\Crm\Permission;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
    public function lists()
    {
        $permissions = Permission::select('id', 'name as module', 'display_name')->with('permissions')
            ->where('permissions.parent_id', NULL)
            ->orderBy('id', 'ASC')
            ->get();

        return $this->successResponse($permissions);
    }
}
