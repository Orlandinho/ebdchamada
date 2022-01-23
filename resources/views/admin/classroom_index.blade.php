<x-admin.layout>
    <x-admin.navbar />

    <x-admin.sidebar />

    <x-admin.content>
        @foreach($data as $classroom)
            <x-slot name="title">
                <x-admin.title />
            </x-slot>
            <x-admin.classroom-card :classroom="$classroom" />
        @endforeach
    </x-admin.content>

</x-admin.layout>
