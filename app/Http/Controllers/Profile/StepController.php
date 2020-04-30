<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\Section;
use App\Models\Step;

use Illuminate\Support\Facades\Gate;
class StepController extends BaseController
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($module_id, $step_type_id, Section $section)
    {
        
        if ($step_type_id <= 0 && $step_type_id >= 4) {
            return back()->withErrors(["error"=>trans('messages.error_creating_step')]);
        }
        $module = Module::find($module_id);
        if(Gate::denies('edit-module', [$module])){
            
            return back()->withErrors(["error" => trans('messages.not_enough_rights')]);
        }
        if(isset($section->id)){
            if(Gate::denies('edit-section', [$section])){
                return back()->withErrors(["error" => trans('messages.not_enough_rights')]);
            }
        }
        
        $step = new Step();
        $step->step_type_id = $step_type_id;
        $step->module_id = $module_id;
        $step->save();
        if(isset($section->id)){
            return redirect()->route("profile.course.module.edit", [$module, $section, $step->id]);
        }else{
            return redirect()->route("profile.module.edit", [$module, $step->id]);
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $module_id, $id)
    {
        $module = Module::find($module_id);
        $data = $request->all();

        $step = Step::find($id);
        $result = $step->update($data);

        if ($result) {
            return back()->with(["success" => trans('messages.saved_successfully')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($module_id, $id, Section $section)
    {
        $module = Module::find($module_id);
        if(Gate::denies('edit-module', [$module])){
            return back()->withErrors(["error" => trans('messages.not_enough_rights')]);
        }
        if(isset($section->id)){
            if(Gate::denies('edit-section', [$section])){
                return back()->withErrors(["error" => trans('messages.not_enough_rights')]);
            }
        }
        $step = Step::find($id);
        $step->delete();

        // return back()->route("profile.course.module.edit", [$module, $section]);
        return back()->with(["success"=>trans('messages.step_successfully_deleted')]);
    }
}
