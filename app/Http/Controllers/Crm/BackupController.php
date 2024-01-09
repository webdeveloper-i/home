<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class BackupController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:crm_backup_database_index',   ['only' => 'index']);
        $this->middleware('permission:crm_backup_database_store',   ['only' => 'store']);
        $this->middleware('permission:crm_backup_database_destroy', ['only' => 'destroy']);
    }

    public function index(Request $request)
    {
        $result = [];
        $files = Storage::files('Laravel');
        foreach ($files as $file) {
            $size = Storage::size($file);
            $name = explode('/', $file)[1];
            $lastmodified = Storage::lastModified($file);
            $lastmodified = date("Y-m-d H:i:s", $lastmodified);

            array_push($result, [
                'name' => $name,
                'last_modified' => $lastmodified,
                'size' => $this->humanReadable($size),
            ]);
        }

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 15;
        $currentItems = array_slice($result, $perPage * ($currentPage - 1), $perPage);
        $results = new LengthAwarePaginator($currentItems, count($result), $perPage, $currentPage, ['path' => url('api/crm/backup-database')]);

        return $this->successResponse($results);
    }

    public function store()
    {
        Artisan::call('backup:run', ['--only-db' => true]);

        return $this->successResponse('Backup created');
    }

    private function humanReadable($bytes)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];
        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }
        return round($bytes, 2) . ' ' . $units[$i];
    }

    public function destroy($path)
    {
        if(Storage::files('Laravel')){
            Storage::disk('local')->delete('Laravel' . DIRECTORY_SEPARATOR . $path);
        }

        return $this->successResponse('Backup deleted');
    }
}
