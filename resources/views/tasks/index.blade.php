@extends('layouts.app')

@section('title', 'Tasks')

@section('content')

    <a class="btn btn-primary mt-3 mb-3" role="button" href="{{ route('tasks.create') }}">Add New Task</a>

    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Title</th>
            <th scope="col">Doer</th>
            <th scope="col">Created</th>
            <th scope="col">Updated</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tasks as $task)
        <tr>
            <th scope="row">{{ $task->id }}</th>
            <td>
                <a href="{{ route('tasks.show', $task) }}">
                {{ $task->title }}
            </td>
            <td>{{ $task->doer }}</td>
            <td>{{ $task->created_at->format('d.m.y H:i') }}</td>
            <td>{{ $task->updated_at->format('d.m.y H:i') }}</td>
            <td>
                <form method="POST" action="{{ route('tasks.destroy', $task) }}">
                    <a type="button" class="btn btn-warning" href="{{ route('tasks.edit', $task) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>

    {{ $tasks->links() }}

@endsection
