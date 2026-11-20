<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');
        $priority = $request->input('priority');

        $tasks = Task::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->when(in_array($status, ['pendiente', 'completada']), function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->when(in_array($priority, ['baja', 'media', 'alta']), function ($query) use ($priority) {
                $query->where('priority', $priority);
            })
            ->latest()
            ->get();

        $totalTasks = Task::count();

        $pendingTasks = Task::where('status', 'pendiente')->count();

        $completedTasks = Task::where('status', 'completada')->count();

        $overdueTasks = Task::where('status', 'pendiente')
            ->whereNotNull('due_date')
            ->whereDate('due_date', '<', now()->toDateString())
            ->count();

        return view('tasks.index', compact(
            'tasks',
            'totalTasks',
            'pendingTasks',
            'completedTasks',
            'overdueTasks',
            'search',
            'status',
            'priority'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:150',
            'description' => 'nullable|string',
            'priority' => 'required|in:baja,media,alta',
            'due_date' => 'nullable|date',
        ]);

        Task::create($validated);

        return redirect()->route('tasks.index')
            ->with('success', 'Tarea creada correctamente.');
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:150',
            'description' => 'nullable|string',
            'priority' => 'required|in:baja,media,alta',
            'status' => 'required|in:pendiente,completada',
            'due_date' => 'nullable|date',
        ]);

        $task->update($validated);

        return redirect()->route('tasks.index')
            ->with('success', 'Tarea actualizada correctamente.');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')
            ->with('success', 'Tarea eliminada correctamente.');
    }

    public function toggleStatus(Task $task)
    {
        $task->update([
            'status' => $task->status === 'pendiente'
                ? 'completada'
                : 'pendiente',
        ]);

        return redirect()->route('tasks.index')
            ->with('success', 'Estado de la tarea actualizado.');
    }
}
