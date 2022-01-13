@props(['classroom','teachers'])
<div class="card card-primary card-outline mr-2 col-lg-3">
    <div class="card-header">
        <div class="d-inline-block">
            <h5 class="m-0"><a href="/#">{{ $classroom->class }}</a></h5>
        </div>
        <div class="float-right">
            <a href="#" class="d-inline mr-3">
                <i class="text-gray-dark fas fa-edit"></i>
            </a>
            <a href="#" class="d-inline">
                <i class="text-danger fas fa-trash-alt"></i>
            </a>
        </div>
    </div>
    <div class="card-body">
        @if($classroom->teachers->count() === 1)
            <h6 class="card-title mb-3">
                @if($classroom->id === 1)
                    Superintendente:
                @else
                    Professor:
                @endif
                <a href="/#">{{ $classroom->teachers[0]['name'] }}</a></h6>
        @else
            <h6 class="card-title mb-3">Professores:
                @foreach($classroom->teachers as $teacher)
                    <a href="/admin/{{ $teacher->id }}">{{ $teacher->name }} </a>
                    @if($loop->last)
                        .
                    @else
                        e
                    @endif
                @endforeach
            </h6>
        @endif

        <p class="card-text">Descrição: {{ $classroom->description }}</p>
        <p>Total de
            @if($classroom->id === 1)
                oficiais:
                <a href="/#" class="card-link">{{ $classroom->students->count() }} Oficiais</a></p>
            @else
                alunos:
                <a href="/#" class="card-link">{{ $classroom->students->count() }} Alunos</a></p>
            @endif

    </div>
</div>
