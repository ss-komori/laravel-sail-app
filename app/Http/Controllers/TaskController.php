<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\TaskRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    /**
     * @return Collection
     */
    public function index()
    {
        return DB::table('tasks')
            ->selectRaw('id')
            ->selectRaw('title')
            ->selectRaw('content')
            ->selectRaw('status')
            ->selectRaw('created_at')
            ->selectRaw('updated_at')
            ->orderByDesc('id')
            ->get();
    }

    /**
     * @param TaskRequest $request
     * @return JsonResponse
     * @throws Exception
     */
    public function store(TaskRequest $request)
    {
        Log::info($request);
        $task = Task::create($request->all());
        return $task
            ? response()->json($task, 201)
            : response()->json([], 500);
    }

    /**
     * @param TaskRequest $request
     * @param Task $task
     * @return JsonResponse
     */
    public function update(TaskRequest $request, Task $task)
    {
        $task->title = $request->title ?? $task->title;
        $task->content = $request->content ?? $task->content;
        $task->status = $request->status ?? $task->status;

        return $task->update()
            ? response()->json($task)
            : response()->json([], 500);
    }

    /**
     * @param Task $task
     * @return JsonResponse
     */
    public function destroy(Task $task)
    {
        return $task->delete()
            ? response()->json($task)
            : response()->json([], 500);
    }
}
