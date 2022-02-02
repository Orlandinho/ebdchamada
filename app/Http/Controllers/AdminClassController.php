<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AdminClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
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
     *
     */
    public function create()
    {
        $teachers = User::whereNull('classroom_id')->get();
        $students = Student::whereNull('classroom_id')->orderBy('dob')->get();
        return view('admin.classroom_create', [
            'teachers' => $teachers,
            'students' => $students
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     */
    public function store(Request $request)
    {
        $attributes = $this->validateClass($request);
        try {
            $check = DB::transaction(function() use ($request, $attributes) {
                $currentClass = Classroom::create($attributes);
                if(!empty($request->name)){
                    User::whereIn('id', $request->name)->update(['classroom_id' => $currentClass->id]);
                }
                if(!empty($request->classroom_id)){
                    Student::whereIn('id', $request->classroom_id)->update(['classroom_id' => $currentClass->id]);
                }
            });
            if(is_null($check)) {
                toast("Classe {$request->class} criada!",'success')->hideCloseButton();
                return redirect()->route('admin.classrooms.index');
            } else {
                throw new \Exception;
            }
        } catch (\Exception $e) {
            alert("Algo deu errado!",'Erro ao tentar criar a classe! '. $e->getMessage(), 'error');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
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
     *
     */
    public function edit(Classroom $classroom)
    {
        $teachers = User::where('classroom_id', $classroom->id)->orWhereNull('classroom_id')->get();
        $students = Student::where('classroom_id', $classroom->id)->orWhereNull('classroom_id')->orderBy('dob')->get();
        return view('admin.classroom_edit', [
            'classroom' => $classroom,
            'teachers' => $teachers,
            'students' => $students
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *
     */
    public function update(Request $request, Classroom $classroom)
    {
        $attributes = $this->validateClass($request);
        try {
            $check = DB::transaction(function() use ($request, $attributes, $classroom) {
                $classroom->update($attributes);
                User::where('classroom_id', $classroom->id)->update(['classroom_id' => null]);
                Student::where('classroom_id', $classroom->id)->update(['classroom_id' => null]);
                if(!empty($request->name)){
                    User::whereIn('id', $request->name)->update(['classroom_id' => $classroom->id]);
                }
                if(!empty($request->classroom_id)){
                    Student::whereIn('id', $request->classroom_id)->update(['classroom_id' => $classroom->id]);
                }
            });
            if(is_null($check)) {
                toast("Classe {$request->class} atualizada!",'success')->hideCloseButton();
                return redirect()->route('admin.classrooms.index');
            } else {
                throw new \Exception;
            }
        } catch (\Exception $e) {
            alert("Algo deu errado!",'Erro ao tentar atualizar a classe! '. $e->getMessage(), 'error');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\Classroom $classroom
     *
     */
    public function destroy(Classroom $classroom)
    {
        $name = $classroom->class;
        try {
            $check = DB::transaction(function() use ($classroom) {
                if ($classroom->teachers->isNotEmpty()) {
                    User::where('classroom_id', $classroom->id)->update(['classroom_id' => null]);
                }
                if($classroom->students->isNotEmpty()){
                    Student::where('classroom_id', $classroom->id)->update(['classroom_id' => null]);
                }
                $classroom->delete();
            });
            if(is_null($check)) {
                toast("Classe {$name} excluída da base de dados!",'success')->hideCloseButton();
                return redirect()->route('admin.classrooms.index');
            } else {
                throw new \Exception;
            }
        } catch(\Exception $e) {
            alert("Algo deu errado!",'Erro ao tentar excluir a classe! '. $e->getMessage(), 'error');
            return redirect()->back();
        }
    }

    /**
     * Validate data from request.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     */

    private function validateClass(Request $request)
    {
        $attributes = $request->validate([
            'class' => 'required', Rule::unique('classrooms','class')->ignore($request->id),
            'description' => 'required'
        ]);

        $attributes['slug'] = Str::slug($request->class, '-');

        return $attributes;
    }
}
