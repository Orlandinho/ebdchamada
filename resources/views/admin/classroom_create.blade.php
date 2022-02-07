<x-admin.layout>

    <x-admin.navbar />

    <x-admin.sidebar />

    <x-admin.form route="/admin/classrooms" method="POST" name="Criando nova classe">
        <div class="card-body d-flex">
            <div class="col-md-5">
                <x-form.input name="class" nome="classe" autofocus/>
                <x-form.input name="description" nome="descrição"/>
                <x-form.multiselect name="name" nome="Professores" :teachers="$teachers"/>
                <x-form.submit-button>Criar Classe</x-form.submit-button>
            </div>
            <div class="col-md-7">
                <label>Alunos</label>
                <div class="container rounded-sm pt-2 pl-2" style="height: 260px; border: solid 1px #ccc; overflow: auto">
                    <div class="row">
                        <div class="col-md-6">
                            @foreach($students as $student)
                                @if($loop->odd)
                                    <x-form.checkbox :student="$student" />
                                @endif
                            @endforeach
                        </div>
                        <div class="col-md-6">
                            @foreach($students as $student)
                                @if($loop->even)
                                    <x-form.checkbox :student="$student" />
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-admin.form>

</x-admin.layout>
