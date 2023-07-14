<?php

namespace App\Http\Controllers;
use App\Models\Gimnasios;
use Illuminate\Http\Request;

class GimnasiosController extends Controller
{
    public function index() {
        $gimnasios = Gimnasios::all();
    
        // Retornamos la vista 'verProductos' y pasamos los productos como una variable llamada 'productos'
        return view('admin.gymAndBoxes.gym')->with('gimnasios', $gimnasios);
    }

    public function create()
    {
        // Lógica para mostrar el formulario de creación de una nueva empresa
        return view('admin.gymAndBoxes.agregarGymBoxes');
    }
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'telefono' => 'required',
            'hora' => 'required',
            'descripcion' => 'required',
        ]);

        Gimnasios::create([
            'nombre' => $request->nombre,
            'telefono' => $request->telefono,
            'horario' => $request->hora,
            'descripcion' => $request->descripcion,
        ]);
        // Lógica para mostrar el formulario de creación de una nueva empresa
        $gimnasios = Gimnasios::all();
    
        // Retornamos la vista 'verProductos' y pasamos los productos como una variable llamada 'productos'
        return view('admin.gymAndBoxes.index')->with('gimnasios', $gimnasios);
    }
}
