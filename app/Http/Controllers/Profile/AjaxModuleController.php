<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ModuleRequest;
use App\Models\Module;

class AjaxModuleController extends Controller
{
   
    public function add(ModuleRequest $request)
    {
        $data = $request->all();
        $module = new Module($data);
        $module->save();
        $module->sections()->attach($data["section_id"]);
        return response()->json(["id"=>$module->id, "msg"=>"Модуль успешно добавлен"], 200);
    }
    public function delete(Request $request)
    {
        $data = $request->all();
        
        $module = Module::find($data["id"]);
        $module->sections()->detach($data["section_id"]);
        // $module->delete();

        return response()->json(["msg"=>"Модуль успешно удален"],  200);
    }
    
}
