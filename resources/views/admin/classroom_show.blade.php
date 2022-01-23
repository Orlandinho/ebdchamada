<x-admin.layout>
    <x-admin.navbar />

    <x-admin.sidebar />

    <x-admin.content>
        <x-slot name="title"></x-slot>
        <x-admin.class-content :classroom="$classroom" />
    </x-admin.content>
</x-admin.layout>
