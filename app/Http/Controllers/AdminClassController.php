<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClassRequest;
use App\Models\Classroom;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AdminClassController extends Controller
{
    public function index()
    {
        return view('admin.classroom_index', [
            'data' => Classroom::all()
        ]);
    }

    public function create()
    {
        $teachers = User::whereNull('classroom_id')->get();
        $students = Student::whereNull('classroom_id')->orderBy('dob')->get();
        return view('admin.classroom_create', [
            'teachers' => $teachers,
            'students' => $students
        ]);
    }

    public function store(StoreClassRequest $request)
    {
        $attributes = $request->validated();

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

    public function show(Classroom $classroom)
    {
        return view('admin.classroom_show',[
            'classroom' => $classroom
        ]);
    }

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

    public function update(StoreClassRequest $request, Classroom $classroom)
    {
        $attributes = $request->validated();

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
                throw new \Exception('Houve algum problema com a conexão ao banco de dados');
            }
        } catch(\Exception $e) {
            alert("Algo deu errado!",'Erro ao tentar excluir a classe! '. $e->getMessage(), 'error');
            return redirect()->back();
        }
    }
}
