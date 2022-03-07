@props(['classroom','teachers'])
<div class="card card-primary card-outline mr-2 col-lg-3">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h5 class="m-0">
                    <a href="/admin/classrooms/{{ $classroom->slug }}">{{ $classroom->class }}</a>
                </h5>
            </div>
            <div class="d-flex align-items-center">
                <a href="/admin/classrooms/{{ $classroom->slug }}/edit" class="mr-2">
                    <i class="text-gray-dark fas fa-edit"></i>
                </a>
                <form action="/admin/classrooms/{{ $classroom->slug }}" class="deleteclass" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-link classname" data-isclass="1" data-name="{{ $classroom->class }}">
                        <i class="text-danger fas fa-trash-alt"></i>
                    </button>
                </form>
            </div>
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
                <a href="/admin/users/{{ $classroom->teachers[0]['id'] }}">{{ $classroom->teachers[0]['name'] }}</a></h6>
        @else
            <h6 class="card-title mb-3">Professores:
                @foreach($classroom->teachers as $teacher)
                    <a href="/admin/users/{{ $teacher->id }}">{{ $teacher->name }} </a>
                    @if(! $loop->last)
                        e
                    @endif
                @endforeach
            </h6>
        @endif

        <p class="card-text">Descrição: {{ $classroom->description }}</p>
        <p>Total de
            @if($classroom->id === 1)
                oficiais:
                <a href="/#" class="card-link">{{ $classroom->students->count() }} Oficiais</a>
            @else
                alunos:
                <a href="/#" class="card-link">{{ $classroom->students->count() }} Alunos</a>
            @endif
        </p>
    </div>
</div>
