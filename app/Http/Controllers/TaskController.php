<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public const TASK_STATUS_NEW = 1;
    public const TASK_STATUS_WORK = 2;
    public const TASK_STATUS_CHECK = 3;
    public const TASK_STATUS_DONE = 4;

    public function index(): JsonResponse
    {
        $tasks = Task::all();

        try {
            $tasksData = [];

            foreach ($tasks as $task) {
                $items = [
                    'title' => $task->title,
                    'status'=> $task->status,
                    'doer'=> $task->doer,
                ];
                $tasksData[] = $items;
            }

        } catch (\Throwable $e) {
            report($e);

            return response()->json([
                'error' => $e,
            ]);
        }

        return response()->json($tasksData);
    }

    public function createNewTask(Request $request): JsonResponse
    {
        $newTask = $request->all();

        try {
            Task::create($newTask);
        } catch (\Throwable $e) {
            report($e);

            return response()->json([
                'error' => $e,
            ]);
        }

        return response()->json();
    }

    public function getTask(int $taskId): JsonResponse
    {
        try {
            $targetTask = Task::find($taskId);
        } catch (\Throwable $e) {
            report($e);

            return response()->json([
                'error' => $e,
            ]);
        }

        if (empty($targetTask)) {
            return response()->json([
                'existence'=> false,
            ]);
        }

        return response()->json([
            'existence'=> true,
            'data'=> $targetTask,
        ]);
    }

    public function updateTask(Request $request): JsonResponse
    {
        $taskId = $request->input('id');
        $updatedTask = $request->all();

        try {
            $targetTask = Task::find($taskId);
            $targetTask->update($updatedTask);
        } catch (\Throwable $e) {
            report($e);

            return response()->json([
                'error' => $e,
            ]);
        }

        return response()->json();
    }

    public function deleteTask(Request $request): JsonResponse
    {
        $taskId = $request->input('id');

        try {
            $targetTask = Task::find($taskId);
            $targetTask->delete();
        } catch (\Throwable $e) {
            report($e);

            return response()->json([
                'error' => $e,
            ]);
        }

        return response()->json();
    }

    public function searchTaskByStatus(Request $request): JsonResponse
    {
        $value = (int)$request->all();

        try {
            $tasks = Task::where('status', $value)->get();
        } catch (\Throwable $e) {
            report($e);

            return response()->json([
                'error' => $e,
            ]);
        }

        return response()->json($tasks);
    }

    public function searchTaskByDoer(Request $request): JsonResponse
    {
        $value = $request->all();

        try {
            $tasks = Task::where('doer', $value)->get();
        } catch (\Throwable $e) {
            report($e);

            return response()->json([
                'error' => $e,
            ]);
        }

        return response()->json($tasks);
    }

}
