<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Mostrar todas las categorías
    public function index()
    {
        return Category::all();
    }

    // Mostrar una categoría específica
    public function show(Category $category)
    {
        return $category;
    }

    // Almacenar una nueva categoría
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Category::create($request->only(['name']));
        return response()->json($category, 201);
    }

    // Actualizar una categoría específica
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category->update($request->only(['name']));
        return response()->json($category);
    }

    // Eliminar una categoría específica
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(null, 204);
    }
}
