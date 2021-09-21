<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SectionController extends Controller
{
    public function index()
    {
        Session::put('page','sections');
        $sections = Sections::get();
        return view('admin.sections.index')
            ->with('sections',$sections);
    }

    public function updateSectionStatus(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            if($data['status'] == "Active")
            {
                $status = 0;
            } else {
                $status = 1;
            }
            Sections::where('id',$data['section_id'])->update(['status' => $status]);
            return response()->json(['status'=> $status, 'section_id'=>$data['section_id']]);
        }
    }
}
