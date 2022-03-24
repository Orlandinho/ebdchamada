<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Information;
use App\Models\Student;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use mysql_xdevapi\Exception;

class AdminStudentController extends Controller
{
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

    public function store(Request $request)
    {
        $attributes = $this->validateRequest($request);
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

    private function validateRequest(Request $request, $student = null)
    {
        $attributes = $request->validate([
            'name' => ['required','min:2','max:60'],
            'dob' => ['required','date_format:d/m/Y','before_or_equal:date'],
            'classroom_id' => ['required', Rule::exists('classrooms','id')],
            'zipcode' => ['nullable','regex:/^(\d){5}-(\d){3}$/'],
            'address' => ['nullable','min:5', 'max:60'],
            'neighborhood' => ['nullable','min:2','max:30'],
            'city' => ['nullable','min:3','max:30'],
            'cel' => ['nullable','regex:/^\((\d){2}\) 9(\d){4}-(\d){4}$/'],
            'tel' => ['nullable','regex:/^\((\d){2}\) (\d){4}-(\d){4}$/'],
            'email' => ['nullable','email','max:50'],
            'avatar' => ['nullable','image','mimes:jpeg,jpg,png','max:2048']
        ]);

        $attributes['active'] = $request->active ?? 0;
        $attributes['visitor'] = $request->visitor ?? 0;

        if ($student->avatar ==! null && Storage::exists($student->avatar)) {
            if (isset($request->avatar)) {
                Storage::delete($student->avatar);
                $attributes['avatar'] = $request->file('avatar')->store('avatars');
            } else {
                $attributes['avatar'] = $student->avatar;
            }
        } else {
            $attributes['avatar'] = $request->file('avatar')?->store('avatars');
        }

        $attributes['dob'] = Carbon::createFromFormat('d/m/Y', $request->dob)->format('Y-m-d');
        $attributes['slug'] = Str::slug(explode(' ', $request->name)[0] . '-' . $attributes['dob']);

        return $attributes;
    }
}
