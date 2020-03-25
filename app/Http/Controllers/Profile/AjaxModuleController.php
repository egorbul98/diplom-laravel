<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ModelRequest;
use App\Models\Module;

class AjaxModuleController extends Controller
{
   
    public function add(ModelRequest $request)
    {
        $data = $request->validated();

        $module = new Module($data);
        $module->save();

        return response()->json(["id"=>$module->id], 200);
    }
    public function delete(Request $request)
    {
        $id = $request->all()["id"];

        $module = Module::find($id);
        $module->delete();

        return response()->json("Модуль успешно удален", 200);
    }
}
