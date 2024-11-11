<?php

namespace App\Http\Controllers;

use App\Models\Tool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ToolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tools = Tool::orderBy('id', 'desc')->get();
        return view('admin.tools.index', ['tools' => $tools]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tools.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'tagline' => 'required|string|max:255',
            'logo' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        DB::beginTransaction();

        try{
            if($request->hasFile('logo')){
                $path = $request->file('logo')->store('tools', 'public');
                $validated['logo'] = $path;
            }

            $newTool = Tool::create($validated);

            DB::commit();

            return redirect()->route('admin.tools.index')->with('success', 'Tool created successfully!');
        }
        catch(\Exception $e){
            DB::rollBack();

            return redirect()->back()->with('error', 'System error! '.$e->getMessage());

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Tool $tool)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tool $tool)
    {
        return view('admin.tools.edit', [
            'tool' => $tool
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tool $tool)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'tagline' => 'required|string|max:255',
            'logo' => 'sometimes|image|mimes:png|max:2048',
        ]);

        DB::beginTransaction();

        try{
            if($request->hasFile('logo')){
                $path = $request->file('logo')->store('tools', 'public');
                $validated['logo'] = $path;
            }

            $tool->update($validated);

            DB::commit();

            return redirect()->route('admin.tools.index')->with('success', 'Tool updated successfully!');
        }
        catch(\Exception $e){
            DB::rollBack();

            return redirect()->back()->with('error', 'System error! '.$e->getMessage());

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tool $tool)
    {
        try {
            $tool->delete();

            return redirect()->back()->with('success', 'Tool deleted successfully!');
        }
        catch(\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'System error! '.$e->getMessage());

        }
    }
}
