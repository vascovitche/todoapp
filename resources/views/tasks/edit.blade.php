@extends('layouts.app')

@section('title', 'Edit '.$task->title)

@section('content')

    <form method="POST" action="{{ route('tasks.update', $task) }}" class="mt-3">
        @csrf
        @method('PUT')
        <div class="row mt-3">
            <div class="col">
                <label for="taskTitle" class="form-label">Title</label>
                <input
                    name="title"
                    value="{{ old('title', $task->title) }}"
                    type="text"
                    id="taskTitle"
                    class="form-control"
                    placeholder="Title"
                    aria-label="title"
                >
                @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row mt-3">
            <div class="col">
                <label for="taskDoer" class="form-label">Select a doer</label>
                <select name="doer" class="form-select" aria-label="Default select example" id="taskDoer">
                    <option selected>{{ old('doer', $task->doer) }}</option>
                    @foreach($users as $user)
                        <option value="{{ $user->name }}">{{ $user->name }}</option>
                    @endforeach
                </select>
                @error('doer')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="mb-3 mt-3">
            <label for="taskDescription" class="form-label">Task Description</label>
            <textarea name="description" class="form-control" id="taskDescription" rows="3" type="text">{{ old('description', $task->description) }}</textarea>
            @error('description')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="row mt-4">
            <div class="col">
                <button type="submit" class="btn btn-success">Apply</button>
{{--                <a type="button" class="btn btn-secondary" href="{{ route('tasks.index') }}">Cancel</a>--}}
            </div>
        </div>

    </form>
@endsection

