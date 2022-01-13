<x-admin.layout>
    <x-admin.navbar />

    <x-admin.sidebar :data="$data" />

    <x-admin.form>
        <x-form.input name="class" nome="classe" />
        <x-form.input name="description" nome="descrição" />
    </x-admin.form>
</x-admin.layout>
