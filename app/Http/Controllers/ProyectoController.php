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
        // Listar los proyectos del usuario autenticado
        $proyectos = Proyecto::where('user_id', auth()->id())->get();
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
        // Validar datos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'ciudad' => 'required|string|max:255',
            'local' => 'required|string|max:255',
            'id_producto' => 'required|exists:productos,id',
        ]);

        // Guardar datos del proyecto en la sesión
        session([
            'proyecto_temporal' => [
                'nombre' => $request->nombre,
                'ciudad' => $request->ciudad,
                'local' => $request->local,
                'id_producto' => $request->id_producto,
                'estado' => 'Nuevo',
                'user_id' => auth()->id(), // Asignar el proyecto al usuario autenticado
            ],
        ]);

        // Redirigir a una ruta genérica para manejar cortes temporales
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

    public function verCortes(Proyecto $proyecto)
    {
        // Verificar que el usuario autenticado sea el propietario del proyecto
        if ($proyecto->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para ver este proyecto.');
        }

        // Obtener los cortes asociados al proyecto
        $cortes = $proyecto->cortes;

        return view('proyectos.cortes', compact('proyecto', 'cortes'));
    }

    public function destroy(Proyecto $proyecto)
    {
        // Verificar que el usuario autenticado sea el propietario del proyecto
        if ($proyecto->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para eliminar este proyecto.');
        }

        $proyecto->delete();
        return redirect()->route('proyectos.index')->with('success', 'Proyecto eliminado con éxito.');
    }
    public function edit(Proyecto $proyecto)
    {
        // Verificar que el usuario autenticado sea el propietario del proyecto
        if ($proyecto->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para editar este proyecto.');
        }

        $productos = Producto::all();
        $cortes = $proyecto->cortes;
        return view('proyectos.edit', compact('proyecto', 'productos', 'cortes'));
    }

    public function update(Request $request, Proyecto $proyecto)
    {
        // Verificar que el usuario autenticado sea el propietario del proyecto
        if ($proyecto->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para editar este proyecto.');
        }

        // Validar datos del proyecto
        $request->validate([
            'nombre' => 'required|string|max:255',
            'ciudad' => 'required|string|max:255',
            'local' => 'required|string|max:255',
            'id_producto' => 'required|exists:productos,id',
            'estado' => 'required|in:Nuevo,En proceso,Completado',
            'cortes' => 'required|array',
            'cortes.*.id' => 'required|exists:cortes,id',
            'cortes.*.cantidad' => 'required|integer|min:1',
            'cortes.*.medidas' => 'required|string|max:255',
            'cortes.*.tipo_borde' => 'required|string|max:255',
            'cortes.*.color_borde' => 'required|string|max:255',
        ]);

        // Actualizar el proyecto
        $proyecto->update([
            'nombre' => $request->nombre,
            'ciudad' => $request->ciudad,
            'local' => $request->local,
            'id_producto' => $request->id_producto,
            'estado' => $request->estado,
        ]);

        // Actualizar los cortes
        foreach ($request->cortes as $corteData) {
            $corte = Corte::findOrFail($corteData['id']);
            $corte->update([
                'cantidad' => $corteData['cantidad'],
                'medidas' => $corteData['medidas'],
                'tipo_borde' => $corteData['tipo_borde'],
                'color_borde' => $corteData['color_borde'],
            ]);
        }

        return redirect()->route('proyectos.index')->with('success', 'Proyecto y cortes actualizados con éxito.');
    }
}
