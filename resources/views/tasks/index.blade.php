@extends('layouts.app')

@section('title', 'Tasks')

@section('content')

    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Title</th>
            <th scope="col">Doer</th>
            <th scope="col">Created</th>
            <th scope="col">Updated</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tasks as $task)
        <tr>
            <th scope="row">{{ $task->id }}</th>
            <td>{{ $task->title }}</td>
            <td>{{ $task->doer }}</td>
            <td>{{ $task->created_at->format('d.m.y H:i') }}</td>
            <td>{{ $task->updated_at->format('d.m.y H:i') }}</td>
        </tr>
        @endforeach
        </tbody>
    </table>

    {{ $tasks->links() }}

@endsection
