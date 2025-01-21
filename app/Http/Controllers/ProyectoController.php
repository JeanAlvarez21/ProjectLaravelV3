<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Models\Producto; 
use App\Models\Corte;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    public function index()
    {
        // Listar todos los proyectos
        $proyectos = Proyecto::all();
        return view('proyectos.index', compact('proyectos'));
    }

    public function create()
    {
        // Mostrar formulario para crear proyecto
        $productos = Producto::all();
        return view('proyectos.create', compact('productos'));
    }

    public function store(Request $request)
    {
        // Guardar datos del proyecto en la sesión
        $request->validate([
            'nombre' => 'required|string|max:255',
            'ciudad' => 'required|string|max:255',
            'local' => 'required|string|max:255',
            'id_producto' => 'required|exists:productos,id',
        ]);

        session([
            'proyecto_temporal' => [
                'nombre' => $request->nombre,
                'ciudad' => $request->ciudad,
                'local' => $request->local,
                'id_producto' => $request->id_producto,
                'estado' => 'Nuevo',
            ],
        ]);

        return redirect()->route('proyectos.crearCortes');
    }

    public function crearCortes()
{
    $proyectoTemporal = session('proyecto_temporal');

    if (!$proyectoTemporal) {
        return redirect()->route('proyectos.index')->withErrors('Primero debe crear un proyecto.');
    }

    $cortesTemporales = session('cortes_temporales', []);

    return view('proyectos.cortes', compact('proyectoTemporal', 'cortesTemporales'));
}

public function verCrearCortes(Proyecto $proyecto)
{
    // Obtener los cortes asociados al proyecto
    $cortes = $proyecto->cortes;

    return view('proyectos.cortes', compact('proyecto', 'cortes'));
}
    public function guardarCorte(Request $request)
{
    $request->validate([
        'proyecto_id' => 'required|exists:proyectos,id',
        'id_producto' => 'required|exists:productos,id',
        'cantidad' => 'required|integer|min:1',
        'medidas' => 'required|string|max:255',
        'tipo_borde' => 'required|string|max:255',
        'color_borde' => 'required|string|max:255',
    ]);

    // Verificar si el proyecto existe
    $proyecto = Proyecto::findOrFail($request->proyecto_id);

    // Crear el corte y asignar precio_total como 0
    $proyecto->cortes()->create(array_merge(
        $request->except('precio_total'),
        ['precio_total' => 0]
    ));

    return back()->with('success', 'Corte agregado correctamente con precio de 0.');
}

public function guardarCorteTemporal(Request $request)
{
    $request->validate([
        'cantidad' => 'required|integer|min:1',
        'medidas' => 'required|string|max:255',
        'tipo_borde' => 'required|string|max:255',
        'color_borde' => 'required|string|max:255',
        'precio_total' => 'required|numeric|min:0',
    ]);

    $cortesTemporales = session('cortes_temporales', []);
    $cortesTemporales[] = $request->all();
    session(['cortes_temporales' => $cortesTemporales]);

    return back()->with('success', 'Corte agregado temporalmente.');
}

public function guardarProyecto()
{
    $proyectoTemporal = session('proyecto_temporal');
    $cortesTemporales = session('cortes_temporales', []);

    if (!$proyectoTemporal || empty($cortesTemporales)) {
        return redirect()->route('proyectos.index')->withErrors('Debe agregar al menos un corte para guardar el proyecto.');
    }

    // Guardar el proyecto
    $proyecto = Proyecto::create($proyectoTemporal);

    // Asociar los cortes al proyecto
    foreach ($cortesTemporales as $corte) {
        $corte['proyecto_id'] = $proyecto->id;
        Corte::create($corte);
    }

    // Limpiar los datos temporales
    session()->forget(['proyecto_temporal', 'cortes_temporales']);

    return redirect()->route('proyectos.index')->with('success', 'Proyecto guardado con éxito.');
}


    public function destroy(Proyecto $proyecto)
    {
        $proyecto->delete();
        return redirect()->route('proyectos.index')->with('success', 'Proyecto eliminado con éxito.');
    }

    public function verCortes(Proyecto $proyecto)
{
    // Obtener los cortes asociados al proyecto
    $cortes = $proyecto->cortes;

    // Retornar la vista con los datos del proyecto y sus cortes
    return view('proyectos.cortes', compact('proyecto', 'cortes'));
}

}

