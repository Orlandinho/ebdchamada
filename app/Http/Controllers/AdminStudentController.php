<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Models\Classroom;
use App\Models\Information;
use App\Models\Student;
use App\Traits\ImageUploadTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AdminStudentController extends Controller
{
    use imageUploadTrait;

    public function index()
    {
        return view('admin.student_index',[
            'students' => Student::all()->sortBy('name')
        ]);
    }

    public function create()
    {
        return view('admin.student_create',[
            'classrooms' => Classroom::all('id','class')
        ]);
    }

    public function store(StoreStudentRequest $request)
    {
        $attributes = $request->validated();
        $attributes['avatar'] = $this->avatarUpload($request);

        try {
            $check = DB::transaction(function() use ($request, $attributes) {

                $newStudent = Student::create([
                    'classroom_id' => $attributes['classroom_id'],
                    'name' => $attributes['name'],
                    'slug' => $attributes['slug'],
                    'email' => $attributes['email'],
                    'dob' => $attributes['dob'],
                    'avatar' => $attributes['avatar'],
                    'visitor' => $attributes['visitor']
                ]);

                Information::create([
                    'student_id' => $newStudent->id,
                    'address' => $attributes['address'],
                    'neighborhood' => $attributes['neighborhood'],
                    'city' => $attributes['city'],
                    'zipcode' => $attributes['zipcode'],
                    'cel' => $attributes['cel'],
                    'tel' => $attributes['tel']
                ]);
            });
            if(is_null($check)) {
                toast("Aluno {$request->name} cadastrado!",'success')->hideCloseButton();
                return redirect()->route('admin.students.index');
            } else {
                throw new \Exception('Não foi possível realizar o cadastro');
            }
        } catch (\Exception $e) {
            if (!is_null($attributes['avatar']) && Storage::exists($attributes['avatar'])) {
                Storage::delete($attributes['avatar']);
            }
            alert("Algo deu errado!",'Erro ao tentar cadastrar um novo aluno! '. $e->getMessage(), 'error');
            return redirect()->back();
        }
    }

    public function show(Student $student)
    {
        return view('admin.student_show', [
            'student' => $student
        ]);
    }

    public function edit(Student $student)
    {
        return view('admin.student_edit', [
            'student' => $student,
            'classrooms' => Classroom::all('id','class')
        ]);
    }

    public function update(Request $request, Student $student)
    {
        //TODO refactor
        //use Request Form and Trait
        $attributes = $this->validateRequest($request, $student);
        try {
            $check = DB::transaction(function() use ($request, $attributes, $student) {
                $student->update([
                    'classroom_id' => $attributes['classroom_id'],
                    'name' => $attributes['name'],
                    'slug' => $attributes['slug'],
                    'email' => $attributes['email'],
                    'dob' => $attributes['dob'],
                    'avatar' => $attributes['avatar'],
                    'visitor' => $attributes['visitor'],
                    'active' => $attributes['active']
                ]);

                Information::where('student_id', $student->id)->update([
                    'address' => $attributes['address'],
                    'neighborhood' => $attributes['neighborhood'],
                    'city' => $attributes['city'],
                    'zipcode' => $attributes['zipcode'],
                    'cel' => $attributes['cel'],
                    'tel' => $attributes['tel']
                ]);
            });
            if(is_null($check)) {
                toast("Dados do aluno {$request->name} atualizados!",'success')->hideCloseButton();
                return redirect()->route('admin.students.index');
            } else {
                throw new \Exception('Não foi possível realizar a atualização dos dados');
            }
        } catch (\Exception $e) {
            if (!is_null($attributes['avatar']) && Storage::exists($attributes['avatar'])) {
                Storage::delete($attributes['avatar']);
            }
            alert("Algo deu errado!","Erro ao tentar atualizar os dados do aluno {$request->name}! ". $e->getMessage(), 'error');
            return redirect()->back();
        }
    }

    public function destroy(Student $student)
    {
        if ($student->avatar ==! null) {
            Storage::delete($student->avatar);
        }
        $studentName = $student->name;
        try {
            $student->delete();
            toast("Dados do aluno {$studentName} excluídos!", 'success')->hideCloseButton();
            return redirect()->route('admin.students.index');
        } catch (\Exception $e) {
            alert('Algo deu errado', "Erro ao tentar excluir os dados do aluno {$studentName}", 'error');
            return redirect()->back();
        }
    }
}
