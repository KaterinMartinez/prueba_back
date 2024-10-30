<?php

namespace App\Http\Controllers; 

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Mostrar todas las tareas
    public function index()
    {
        return Task::with('category')->get(); // Cargar las categorías junto con las tareas
    }

    // Mostrar una tarea específica
    public function show(Task $task)
    {
        return $task->load('category'); // Retorna la tarea específica junto con la categoría
    }

    // Almacenar una nueva tarea
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id', // Validar que la categoría exista
        ]);

        $task = Task::create($request->only(['title', 'description', 'category_id']));
        return response()->json($task, 201); // Retorna la tarea creada con código 201
    }

    // Actualizar una tarea específica
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id', // Validar que la categoría exista
        ]);

        $task->update($request->only(['title', 'description', 'category_id']));
        return response()->json($task);
    }

    // Eliminar una tarea específica
    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json(null, 204); // Devuelve un estado 204 No Content
    }
}
