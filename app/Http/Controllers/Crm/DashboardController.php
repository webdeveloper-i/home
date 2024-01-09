<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use App\Models\Crm\Journal;
use App\Models\Crm\PublisherResourceUniversity;
use App\Models\Crm\University;
use App\Models\User;
use App\Models\User\PublisherResource;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function badgeCount(Request $request)
    {

        $users = User::where('role', 'user')->count();

        $arr = [];

        $arr['users'] = $users ? $users : 0;

        return $this->successResponse($arr);
    }
}
