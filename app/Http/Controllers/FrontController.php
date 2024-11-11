<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontController extends Controller
{
    public function index(){
        $projects = Project::orderBy('id', 'desc')->take(6)->get();

        return view('front.index', [
            'projects' => $projects,
        ]);
    }

    public function details(Project $project){

        return view('front.details', [
            "project" => $project
        ]);
    }

    public function services(){

        return view('front.services');

    }
    


    public function book(){
        return view('front.book');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'budget' => 'required|integer',
            'category' => 'required|string|in:Website Development,App Development,Graphic Design,Digital Marketing',
            'brief' => 'required|string|max:65535'
        ]);

        DB::beginTransaction();

        try{

            $newProjectOrder = ProjectOrder::create($validated);

            DB::commit();

            return redirect()->route('front.index')->with('success', 'Project Order created successfully!');
        }
        catch(\Exception $e){
            DB::rollBack();

            return redirect()->back()->with('error', 'System error! '.$e->getMessage());

        }
    }
}
