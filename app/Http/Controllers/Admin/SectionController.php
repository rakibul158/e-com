<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sections;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index()
    {
        $sections = Sections::get();
        return view('admin.sections.index')
            ->with('sections',$sections);
    }
}
