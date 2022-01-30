@props(['student'])
<div class="form-check d-flex justify-content-between mb-1">
    <div>
        <input class="form-check-input" type="checkbox" name="classroom_id[]" {{ $student->classroom_id !== null ? 'checked' : '' }} value="{{ $student->id }}" id="student-{{ $student->id }}">
        <label class="form-check-label" for="student-{{ $student->id }}"> {{ $student->name }} </label>
    </div>
    <div>
        <span class="mr-2">{{ $student->age() . ' anos' }}</span>
    </div>
</div>
