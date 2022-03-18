<x-admin.layout>

    <x-admin.navbar />

    <x-admin.sidebar />

{{--    TODO
        create a class component for the dashboard --}}
    <x-admin.dashboard-content :users="$users" :students="$students" />

</x-admin.layout>
