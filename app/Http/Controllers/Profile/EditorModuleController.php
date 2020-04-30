<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\Step;
use App\Models\StepType;
use App\Models\Section;
use Illuminate\Support\Facades\Gate;

// use App\Http\Requests\EditorSectionRequest;


class EditorModuleController extends BaseController
{
    public function edit(Module $module, Section $section, $id_step = null)
    {
        
        if(Gate::denies("edit-module", [$module])){
            return back()->withErrors(["error"=>trans('messages.not_enough_rights')]);
        };
      
        if(isset($section->title)){
            if(Gate::denies('edit-section', [$section])){
                return back()->withErrors(["error" => trans('messages.not_enough_rights')]);
            }
        };
        $step_types = StepType::all();
        if($id_step==null && isset($module->steps[0])){
            $step = $module->steps[0];
        }else if($id_step!=null){
            $step = Step::find($id_step);
        }else{
            $step = null;
        }
        
        return view("profile.edit-module.module", compact("module", "step_types", "step", "section"));
    }
   
    
}
