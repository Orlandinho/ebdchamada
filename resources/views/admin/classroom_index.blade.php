<x-admin.layout>
    <x-admin.navbar />

    <x-admin.sidebar :data="$data" />

    <x-admin.content>
        @foreach($data as $classroom)
            <x-admin.classroom-card :classroom="$classroom" />
        @endforeach
    </x-admin.content>
</x-admin.layout>
