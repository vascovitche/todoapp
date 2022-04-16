@extends('layouts.app')

@section('title', 'Tasks')
    @section('action')
        <div class="container">
            <div class="row">
                <div class="col">

                </div>
                <div class="col-4">
                    <form method="GET" action="{{ route('tasks.search') }}">
                        <div class="input-group mb-3">
                            <input
                                type="text"
                                name="search"
                                value="{{ request()->search }}"
                                placeholder="Type something..."
                                class="form-control"
                            >
                            <button type="submit" class="btn btn-outline-secondary">Search</button>
                        </div>
                    </form>
                </div>
                <div class="col-2">
                    <a class="btn btn-primary mb-3" role="button" href="{{ route('tasks.create') }}">Add Task</a>
                </div>
            </div>
        </div>
    @endsection

@section('content')
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Title</th>
            <th scope="col">Status</th>
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
            <td>
                @switch($task->status)
                    @case(1)
                        <div class="bg-dark d-inline p-1 text-white rounded-2">NEW</div>
                        @break
                    @case(2)
                        <div class="bg-info d-inline p-1 text-white rounded-2 bg-opacity-75">IN WORK</div>
                        @break
                    @case(3)
                        <div class="bg-secondary d-inline p-1 text-white rounded-2 bg-opacity-75">CHECK</div>
                        @break
                    @case(4)
                        <div class="bg-success d-inline p-1 text-white rounded-2 bg-opacity-75">DONE</div>
                        @break
                @endswitch
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

    {{ $tasks->appends(['search' => request()->search])->links() }}

@endsection
