<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\User;
use Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

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
        $attributes = $this->validateClass($request);
        try {
            DB::transaction(function() use ($request, $attributes) {
                $currentClass = Classroom::create($attributes);

                if($request->name){
                    foreach($request->name as $key=>$id){
                        $user = User::find($id);
                        $user->classroom_id = $currentClass->id;
                        $user->save();
                    }
                }
            });
            toast("Classe {$request->class} criada!",'success')->hideCloseButton();
            return redirect()->route('admin.classrooms.index');
        } catch (\Exception $e) {
            toast("Erro ao tentar criar a classe! ". $e->getMessage(),'error')->hideCloseButton();
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Classroom $classroom)
    {
        return view('admin.classroom_show',[
            'classroom' => $classroom
        ]);
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
    public function update(Request $request, Classroom $classroom)
    {
        $attributes = $this->validateClass($request);
        try {
            DB::transaction(function() use ($request, $attributes, $classroom) {
                $classroom->update($attributes);
                User::where('classroom_id', $classroom->id)->update(['classroom_id' => null]);
                if(!empty($request->name)){
                    foreach($request->name as $key=>$id){
                        $user = User::find($id);
                        $user->classroom_id = $classroom->id;
                        $user->save();
                    }
                }
            });
            toast("Classe {$request->class} atualizada!",'success')->hideCloseButton();
            return redirect()->route('admin.classrooms.index');
        } catch (\Exception $e) {
            toast("Erro ao tentar atualizar a classe! ". $e->getMessage() ,'error')->hideCloseButton();
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classroom $classroom)
    {
        $name = $classroom->class;
        //$classroom->delete();
        toast("Classe {$name} excluída da base de dados!",'success')->hideCloseButton();
        return redirect()->back();
    }

    private function validateClass(Request $request)
    {
        $attributes = $request->validate([
            'class' => 'required', Rule::unique('classrooms','slug')->ignore($request->id),
            'description' => 'required'
        ]);

        $attributes['slug'] = Str::slug($request->class, '-');

        return $attributes;
    }


}
