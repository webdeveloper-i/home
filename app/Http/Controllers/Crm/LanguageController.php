<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use App\Models\Crm\Language;
use App\Http\Controllers\Resources\FileController;

class LanguageController extends Controller
{

    public function index()
    {
        $languages = Language::all();

        return $this->successResponse($languages);
    }
}
