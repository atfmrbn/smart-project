<?php

namespace App\Http\Controllers;

use App\Models\TaskType;
use Illuminate\Http\Request;

class TaskTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $taskTypes = TaskType::all();
        $data = [
            "title" => "Task Types",
            "taskTypes" => $taskTypes
        ];

        return view('task-type.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            "title" => "Add Task Type",
        ];

        return view('task-type.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:100',
        ]);

        TaskType::create($data);

        return redirect()->route('task-type.index')->with('success', 'Task Type created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $taskType = TaskType::findOrFail($id);
        $data = [
            "title" => "Detail Task Type",
            "taskType" => $taskType
    ];

    return view('task-type.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $taskType = TaskType::find($id);
        if (!$taskType) {
            return redirect('taskType')->with("errorMessage", 'Kurikulum tidak dapat ditemukan');
        }

        $taskTypes = TaskType::all();

        $data = [
            'title' => 'Edit Task Type',
            'taskType' => $taskType,
            'taskTypes' => $taskTypes,
        ];

        return view('task-type.form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'required|max:100',
        ]);

        $taskType = TaskType::find($id);
        
        if (!$taskType) {
            return redirect()->route('task-type.index')->with('error', 'TaskType not found.');
        }
        $taskType->update($data); // Memanggil metode update() pada instance model $taskType

        return redirect()->route('task-type.index')->with('success', 'TaskType updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $taskType = TaskType::find($id);
        $taskType->delete();

        return redirect()->route('task-type.index')->with('success', 'TaskType deleted successfully.');
    }
}
