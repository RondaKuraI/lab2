<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MusicModel;

class MusicController extends BaseController
{
    public function index()
    {
        return view('main_page');
    }
}
