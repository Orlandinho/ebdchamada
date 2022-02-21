@props(['student'])

<div class="content-wrapper pl-2">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 d-inline-flex align-items-center">
                <img src="{{ $student->avatar !== null ? asset('storage/'.$student->avatar) : asset('storage/avatars/avatar.png') }}" class="rounded elevation-2" style="width: 96px;" alt="User Image">
                <h1 class="ml-3">{{ $student->name }}</h1>
            </div>
        </div>
    </section>
    <section class="container-fluid">
        <div class="d-block">
            <label>Classe: </label>
            <p class="d-inline">{{ \App\Models\Classroom::find($student->classroom_id)->class ?? 'Classe não atribuída' }}</p>
        </div>
        <div class="d-block">
            <label>Idade: </label>
            <p class="d-inline">{{ $student->age() }}</p>
        </div>
        <div class="d-block">
            <label>Data de Nascimento: </label>
            <p class="d-inline">{{ $student->getDob() }}</p>
        </div>
        <div class="d-block">
            <label>Ativo: </label>
            <p class="d-inline">{{ $student->active ? 'Sim' : 'Não' }}</p>
        </div>
        <div class="d-block">
            <label>Visitante: </label>
            <p class="d-inline">{{ $student->visitant ? 'Sim' : 'Não' }}</p>
        </div>
        <div class="d-block">
            <label>E-mail: </label>
            <p class="d-inline">{{ $student->email ?? '---' }}</p>
        </div>
        <div class="d-block">
            <label>Endereço: </label>
            <p class="d-inline">{{ $student->information->address ?? '---' }}</p>
        </div>
        <div class="d-block">
            <label>Bairro: </label>
            <p class="d-inline">{{ $student->information->neighborhood ?? '---' }}</p>
        </div>
        <div class="d-block">
            <label>Cidade: </label>
            <p class="d-inline">{{ $student->information->city ?? '---' }}</p>
        </div>
        <div class="d-block">
            <label>CEP: </label>
            <p class="d-inline">{{ $student->information->zipcode ?? '---' }}</p>
        </div>
        <div class="d-block">
            <label>Telefone Fixo: </label>
            <p class="d-inline">{{ $student->information->tel ?? '---' }}</p>
        </div>
        <div class="d-block">
            <label>Celular: </label>
            <p class="d-inline">{{ $student->information->cel ?? '---' }}</p>
        </div>
    </section>
</div>
