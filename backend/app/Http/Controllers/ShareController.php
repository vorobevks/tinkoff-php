<?php

namespace App\Http\Controllers;

use App\Models\Share;

class ShareController extends Controller
{
    public function getAll()
    {
        return Share::all();
    }
}
