<x-admin.layout>
    <x-admin.navbar />

    <x-admin.sidebar :data="$data" />

    <x-admin.form route="/admin/classrooms" method="POST" button="Criar" name="" header="Criando nova classe">
        <x-form.input name="class" nome="classe" autofocus />
        <x-form.input name="description" nome="descrição" />
        <x-form.select name="name" nome="Professores" :teachers="$teachers" />
    </x-admin.form>
</x-admin.layout>
