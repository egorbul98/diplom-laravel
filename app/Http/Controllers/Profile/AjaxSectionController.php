<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SectionRequest;
use App\Models\Section;
use App\Models\Module;
use Auth;
class AjaxSectionController extends Controller
{
    public function add(SectionRequest $request)
    {
        $data = $request->validated();

        $section = new Section($data);
        $section->save();

        return response()->json(["id"=>$section->id, "msg"=>"Раздел успешно добавлен"], 200);
    }
    
    public function delete(Request $request)
    {
        $id = $request->all()["id"];

        $section = Section::find($id);
        $section->delete();

        return response()->json(["msg"=>"Раздел успешно удален"], 200);
    }

    public function listModules(Request $request)
    {
        $section = Section::find($request->all()["section_id"]);
        $modules_section_ids = $section->getModulesId();
        $user_id = Auth::user()->id;
        $modules = Module::select(["id", "title"])->where("author_id", $user_id)->whereNotIn("id",$modules_section_ids)->get(); //Получаем модули не входящие в данный раздел 
       
        return response()->json(["modules"=>$modules], 200);
    }
    public function searchModules(Request $request)
    {
        $data = $request->all();
        $section = Section::find($data["section_id"]);
        $text = $data["text"];
        $modules_section_ids = $section->getModulesId();
        $user_id = Auth::user()->id;

        $modules = Module::select(["id", "title"])->where("title", "like", "%".$text."%")->where("author_id", $user_id)->whereNotIn("id",$modules_section_ids)->get(); //Получаем модули не входящие в данный раздел и с текстом
        return response()->json(["modules"=>$modules], 200);
    }

    public function addModule(Request $request)
    {
        $data = $request->all();
        
        $module = Module::find($data["module_id"]);
        $module->sections()->attach($data["section_id"]);
        
        return response()->json(["msg"=>"Модуль успешно добавлен", "module"=>$module, "step_count"=>$module->steps->count()], 200);
    }

   
}
