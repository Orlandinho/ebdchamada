<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Jobs\SendPasswordEmail;
use App\Models\Classroom;
use App\Models\Role;
use App\Models\User;
use App\Traits\ImageUploadTrait;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class AdminUserController extends Controller
{
    use ImageUploadTrait;

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

    public function store(StoreUserRequest $request)
    {
        $attributes = $request->validated();
        $attributes['avatar'] = $this->avatarUpload($request);

        try {
            $created = User::create($attributes);
            if ($created) {
                $link = URL::temporarySignedRoute('password_create', now()->addDays(2), $created->id);
                SendPasswordEmail::dispatch($created, $link)->delay(10);
            }
            toast("Usuário criado! Foi enviado um e-mail contendo um link para criação de senha desse usuário", 'success')->hideCloseButton();
            return redirect()->route('admin.users.index');
        } catch (\Exception $e) {
            alert('Algo deu errado', "Erro ao criar novo usuário: " . $e->getMessage(), 'error');
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

    public function update(User $user, StoreUserRequest $request)
    {
        $attributes = $request->except(['slug']);
        $attributes['avatar'] = $this->avatarUpload($request, $user);

        try {
            $user->update($attributes);
            toast("Dados do colaborador(a) atualizados!", 'success')->hideCloseButton();
            return redirect()->route('admin.users.index');
        } catch (\Exception $e) {
            alert('Algo deu errado', "Erro ao criar novo usuário", 'error');
            return redirect()->back();
        }
    }

    public function destroy(User $user)
    {
        $this->authorize('delete');

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
}
