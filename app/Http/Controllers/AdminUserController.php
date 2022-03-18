<?php

namespace App\Http\Controllers;

use App\Mail\SendPassword;
use App\Models\Classroom;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Rule;

class AdminUserController extends Controller
{
    public function index()
    {
        return view('admin.user_index', [
            'users' => User::all()->sortBy('name')
        ]);
    }

    public function create()
    {
        return view('admin.user_create', [
            'roles' => Role::all(),
            'classrooms' => Classroom::all('id','class')
        ]);
    }

    public function store(Request $request)
    {
        $attributes = $this->validateUser($request);
        try {
            $created = User::create([
                'name' => $attributes['name'],
                'email' => $attributes['email'],
                'avatar' => $attributes['avatar'],
                'role_id' => $attributes['role_id'],
                'classroom_id' => $attributes['classroom_id']
            ]);
            if ($created) {
                $link = URL::temporarySignedRoute('password_create', now()->addDays(2), $created->id);
                Mail::to($created->email)->send(new SendPassword($created, $link));
            }
            toast("Usuário criado! Foi enviado um e-mail contendo um link para criação de senha desse usuário", 'success')->hideCloseButton();
            return redirect()->route('admin.users.index');
        } catch (\Exception $e) {
            alert('Algo deu errado', "Erro ao criar novo usuário", 'error');
            return redirect()->back();
        }
    }

    private function validateUser(Request $request, $user = null)
    {
        $attributes = $request->validate([
            'name' => ['required','min:2','max:60'],
            'email' => ['required','email','max:60','unique:users'],
            'avatar' => ['nullable','image','mimes:jpeg,jpg,png','max:2048'],
            'role_id' => ['required', Rule::exists('roles','id')],
            'classroom_id' => ['nullable', Rule::exists('classrooms','id')],
        ]);

        $attributes['avatar'] = $request->file('avatar')?->store('avatars');

        return $attributes;
    }
}
