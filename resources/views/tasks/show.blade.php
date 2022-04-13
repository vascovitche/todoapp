@extends('layouts.app')

@section('title', $task->title)

@section('content')
    <a type="button" class="btn btn-secondary" href="{{ route('tasks.index') }}">Back</a>

    <div class="card mt-5">
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><b>Id:</b> {{$task->id}}</li>
            <li class="list-group-item"><b>Doer:</b> {{$task->doer}}</li>
            <li class="list-group-item"><b>Status:</b> {{$task->status}}</li>
            <li class="list-group-item"><b>Created:</b> {{$task->created_at->format('d.m.y H:i') }}</li>
            <li class="list-group-item"><b>Updated:</b> {{$task->updated_at->format('d.m.y H:i') }}</li>
            <li class="list-group-item"><b>Description:</b> {{$task->description}}</li>
        </ul>
    </div>

    <form method="POST" class="mt-4" action="{{ route('tasks.destroy', $task) }}">
        <a type="button" class="btn btn-warning" href="{{ route('tasks.edit', $task) }}">Edit</a>
        @csrf
        @method('DELETE')
        <button class="btn btn-danger" type="submit">Delete</button>
    </form>
@endsection
