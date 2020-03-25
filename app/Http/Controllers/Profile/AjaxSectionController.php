<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SectionRequest;
use App\Models\Section;

class AjaxSectionController extends Controller
{
    public function add(SectionRequest $request)
    {
        $data = $request->validated();

        $section = new Section($data);
        $section->save();

        return response()->json(["id"=>$section->id], 200);
    }
    
    public function delete(Request $request)
    {
        $id = $request->all()["id"];

        $section = Section::find($id);
        $section->delete();

        return response()->json("Раздел успешно удален", 200);
    }

}
