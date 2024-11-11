<?php

namespace App\Http\Controllers;

use App\Models\ProjectTool;
use App\Models\Project;
use App\Models\Tool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectToolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Project $project)
    {
        $tools = Tool::orderBy('id', 'desc')->get();
        return view('admin.project_tools.create', ['tools' => $tools, 'project' => $project]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Project $project)
    {
        $validated = $request->validate([
            'tool_id' => 'required|integer',
        ]);

        DB::beginTransaction();

        try{
            $validated['project_id'] = $project->id;
            $assignTool = ProjectTool::updateOrCreate($validated);

            DB::commit();

            return redirect()->back()->with('success', 'Tool assigned successfully!');
        }
        catch(\Exception $e){
            DB::rollBack();

            return redirect()->back()->with('error', 'System error! '.$e->getMessage());

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ProjectTool $projectTool)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProjectTool $projectTool)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProjectTool $projectTool)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProjectTool $projectTool)
    {
        try {
            $projectTool->delete();
            return redirect()->back()->with('success', 'Project deleted successfully!');
        }
        catch(\Exception $e){
            DB::rollBack();

            return redirect()->back()->with('error', 'System error! '.$e->getMessage());

        }
    }
}
