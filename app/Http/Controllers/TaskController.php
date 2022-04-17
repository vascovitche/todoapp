<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $tasks = Task::paginate(12);
        $users = User::get('name');
        return view('tasks.index', compact('tasks'), compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $users = User::get('name');
        return view('tasks.create', compact('users'));
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $users = User::get('name');
        $tasks = Task::where('title', 'like', "%{$search}%")->paginate(12);
        return view('tasks.index', compact('tasks'), compact('users'));
    }

    public function sort(Request $request)
    {
        $doer = $request->doer;
        $users = User::get('name');
        if ($doer == 'all') {
            return redirect()->route('tasks.index');
        } else {
            $tasks = Task::where('doer', 'like', $doer)->paginate(12);
        }

        return view('tasks.index', compact('tasks'), compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTaskRequest $request
     * @return RedirectResponse
     */
    public function store(StoreTaskRequest $request)
    {
        Task::create($request->only(['title', 'description', 'doer']));
        return redirect()->route('tasks.index')->withSuccess('Added new task '.$request->title);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return Application|Factory|View
     */
    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return Application|Factory|View
     */
    public function edit(Task $task)
    {
        $users = User::get('name');
        return view('tasks.edit', compact('task'), compact('users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTaskRequest  $request
     * @param  \App\Models\Task  $task
     * @return Response
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $task->update($request->only(['title', 'description', 'doer']));
        return redirect()->route('tasks.index')->withSuccess('Updated task '.$request->title);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->withDanger('Deleted task '.$task->title);
    }
}
