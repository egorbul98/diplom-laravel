<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\Step;
use App\Models\StepType;
use Illuminate\Http\Request;
use Auth;
use Gate;
class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modules = Auth::user()->modules()->paginate(10);
        return view("profile.edit-module.list-modules", compact("modules"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $id_step=null)
    {
        $module = Module::findOrFail($id);

        if(Gate::denies("edit-module", [$module])){
            return back()->withErrors(["error"=>trans('messages.not_enough_rights')]);
        };
        $step_types = StepType::all();
        if($id_step==null && isset($module->steps[0])){
            $step = $module->steps[0];
        }else if($id_step!=null){
            $step = Step::find($id_step);
        }else{
            $step = null;
        }
        return view("profile.edit-module.module", compact("module", "step_types", "step"));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
