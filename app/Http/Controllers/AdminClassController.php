<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.classroom_index', [
            'data' => Classroom::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teachers = User::whereNull('classroom_id')->get();
        return view('admin.classroom_create', [
            'data' => Classroom::all(),
            'teachers' => $teachers
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'class' => 'required|unique:classrooms,class',
            'description' => 'required'
        ]);

        $attributes['slug'] = Str::slug($request->class, '-');

        $currentClass = Classroom::create($attributes);

        if($request->name){
            foreach($request->name as $key=>$id){
                $user = User::find($id);
                $user->classroom_id = $currentClass->id;
                $user->save();
            }
        }

        return redirect()->route('admin.classrooms.index')->with('Success', 'Classe criada!');

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
    public function edit(Classroom $classroom)
    {
        $teachers = User::where('classroom_id', $classroom->id)->orWhereNull('classroom_id')->get();
        return view('admin.classroom_edit', [
            'data' => Classroom::all(),
            'classroom' => $classroom,
            'teachers' => $teachers
        ]);
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
