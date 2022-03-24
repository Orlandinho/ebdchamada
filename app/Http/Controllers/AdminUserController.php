<?php

namespace App\Http\Controllers;

use App\Mail\SendPassword;
use App\Models\Classroom;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AdminUserController extends Controller
{
    public function index()
    {
        return view('admin.user_index', [
            'users' => User::all()->sortBy('name')
        ]);
    }

    public function show(User $user)
    {
        return view('admin.user_show', [
            'user' => $user
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
                'slug' => $attributes['slug'],
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

    public function edit(User $user)
    {
        return view('admin.user_edit', [
            'user' => $user,
            'roles' => Role::all(),
            'classrooms' => Classroom::all('id','class')
        ]);
    }

    public function update(User $user, Request $request)
    {
        $attributes = $this->validateUser($request, $user);
        //TODO fix
        //check for image profile, delete before saves it to storage if it exists
        $user->update([$attributes]);
    }

    public function destroy(User $user)
    {
        dd($user);
        if ($user->avatar ==! null) {
            Storage::delete($user->avatar);
        }
        $userName = $user->name;
        try {
            $user->delete();
            toast("Dados do colaborador(a) {$userName} excluídos!", 'success')->hideCloseButton();
            return redirect()->route('admin.users.index');
        } catch (\Exception $e) {
            alert('Algo deu errado', "Erro ao tentar excluir os dados do colaborador {$userName}", 'error');
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

        //TODO implements
        //add method to set the avatar

        if ($user->avatar ==! null && Storage::exists($user->avatar)) {
            if (isset($request->avatar)) {
                Storage::delete($user->avatar);
                $attributes['avatar'] = $request->file('avatar')->store('avatars');
            } else {
                $attributes['avatar'] = $user->avatar;
            }
        } else {
            $attributes['avatar'] = $request->file('avatar')?->store('avatars');
        }

        if($user === null) {
            $attributes['slug'] = Str::slug(explode(' ', $request->name)[0] . now()->isoFormat('Hmms'));
        }

        return $attributes;
    }
}
