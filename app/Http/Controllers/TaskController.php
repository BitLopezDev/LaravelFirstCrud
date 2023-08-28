<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Task;
use Illuminate\Http\Request;



class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        $tasks = Task::latest()->paginate(3);
        return view('index', ['tasks' => $tasks]);
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        //aquí se muestra el form para crear en DB. La lógica del formulario y todo lo demás está en Store
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // dd($request->all());

        $request->validate([
            'title' => 'required',
            'description' => 'required',

        ]);

        Task::create($request->all());
        return redirect()->route('tasks.index')->with('success', 'Nueva Tarea creada.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task) : View
    {
        //
        return view('edit', ['task' => $task]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task) : RedirectResponse
    {
        //
       // dd($request);
              $request->validate([
            'title' => 'required',
            'description' => 'required',

        ]);
        $task->update($request->all);
        return redirect()->route('tasks.index')->with('success', 'Nueva Tarea actualizada.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task) :RedirectResponse
    {
        //dd($task);
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Tarea eliminada');


    }
}
