@props(['user'])

<div class="content-wrapper pl-2">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 d-inline-flex align-items-center">
                <img src="{{ $user->avatar !== null ? asset('storage/'.$user->avatar) : asset('storage/avatars/avatar.png') }}" class="rounded elevation-2" style="width: 96px;" alt="User Image">
                <h1 class="ml-3">{{ $user->name }}</h1>
            </div>
        </div>
    </section>
    <section class="container-fluid">
        <div class="d-block">
            <label>Função: </label>
            <p class="d-inline">{{ \App\Models\Role::find($user->role_id)->name }}</p>
        </div>
        <div class="d-block">
            <label>Classe: </label>
            <p class="d-inline">{{ \App\Models\Classroom::find($user->classroom_id)->class ?? 'Classe não atribuída' }}</p>
        </div>
        <div class="d-block">
            <label>E-mail: </label>
            <p class="d-inline">{{ $user->email }}</p>
        </div>
    </section>
</div>
