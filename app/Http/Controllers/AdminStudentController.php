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
    /**
     * Display a listing of the resource.
     *
     *
     */
    public function index()
    {
        return view('admin.student_index',[
            'students' => Student::all()->sortBy('name')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     *
     */
    public function create()
    {
        return view('admin.student_create',[
            'classrooms' => Classroom::all('id','class')
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
        $attributes = $this->validateRequest($request);
        try {
            $check = DB::transaction(function() use ($request, $attributes) {

                $newStudent = Student::create([
                    'classroom_id' => $attributes['classroom_id'],
                    'name' => $attributes['name'],
                    'slug' => $attributes['slug'],
                    'email' => $attributes['email'],
                    'dob' => $attributes['dob'],
                    'avatar' => $attributes['avatar']
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

    /**
     * Display the specified resource.
     *
     * @param
     *
     */
    public function show(Student $student)
    {
        return view('admin.student_show', [
            'student' => $student
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Student
     *
     */
    public function edit(Student $student)
    {
        dd($student);
        return view('admin.student_edit', [
            'student' => $student
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     */
    public function destroy($id)
    {
        //
    }

    private function validateRequest(Request $request)
    {
        $attributes = $request->validate([
            'name' => ['required','min:2','max:60'],
            'dob' => ['required','date_format:d/m/Y','before_or_equal:date'],
            'classroom_id' => ['required', Rule::exists('classrooms','id')],
            'zipcode' => ['nullable','regex:/^(\d){5}-(\d){3}$/'],
            'address' => ['nullable','min:5', 'max:60'],
            'neighborhood' => ['nullable','min:2','max:30'],
            'city' => ['nullable','min:3'],
            'cel' => ['nullable','regex:/^\((\d){2}\) 9(\d){4}-(\d){4}$/'],
            'tel' => ['nullable','regex:/^\((\d){2}\) (\d){4}-(\d){4}$/'],
            'email' => ['nullable','email'],
            'avatar' => ['nullable','image','mimes:jpeg,jpg,png']
        ]);

        $attributes['avatar'] = $request->file('avatar')?->store('avatars');

        $attributes['dob'] = Carbon::createFromFormat('d/m/Y', $request->dob)->format('Y-m-d');
        $attributes['slug'] = Str::slug(explode(' ', $request->name)[0] . '-' . $attributes['dob']);

        return $attributes;
    }
}
