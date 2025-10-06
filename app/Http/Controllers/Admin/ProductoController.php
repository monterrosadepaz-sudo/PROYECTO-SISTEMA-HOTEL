<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Producto;

class ProductoController extends Controller
{
    // Mostrar formulario + tabla de inventario
    public function index()
    {
        $productos = Producto::orderBy('created_at', 'desc')->get();
        return view('admin.productos', compact('productos'));
    }

    // Registrar nuevo producto o servicio
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'tipo' => 'required|in:producto,servicio',
            'precio' => 'required|numeric|min:0',
            'stock' => 'nullable|integer|min:0',
            'estado' => 'required|boolean',
        ]);

        Producto::create([
            'idProducto' => uniqid('prod_'),
            'nombre' => $request->nombre,
            'tipo' => $request->tipo,
            'precio' => $request->precio,
            'stock' => $request->tipo === 'servicio' ? null : $request->stock,
            'estado' => $request->estado,
        ]);

        return redirect()->route('productos.index')->with('mensaje', 'Producto registrado correctamente.');
    }

    // Cargar datos para edición
    public function edit($idProducto)
    {
        $producto = Producto::findOrFail($idProducto);
        $productos = Producto::orderBy('created_at', 'desc')->get();
        return view('admin.productos', compact('producto', 'productos'));
    }

    // Actualizar producto existente
    public function update(Request $request, $idProducto)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'tipo' => 'required|in:producto,servicio',
            'precio' => 'required|numeric|min:0',
            'stock' => 'nullable|integer|min:0',
            'estado' => 'required|boolean',
        ]);

        $producto = Producto::findOrFail($idProducto);
        $producto->update([
            'nombre' => $request->nombre,
            'tipo' => $request->tipo,
            'precio' => $request->precio,
            'stock' => $request->tipo === 'servicio' ? null : $request->stock,
            'estado' => $request->estado,
        ]);

        return redirect()->route('productos.index')->with('mensaje', 'Producto actualizado correctamente.');
    }

    // Baja lógica
    public function destroy($idProducto)
    {
        $producto = Producto::findOrFail($idProducto);
        $producto->estado = 0;
        $producto->save();

        return redirect()->route('productos.index')->with('mensaje', 'Producto desactivado correctamente.');
    }

    // Eliminación total
    public function eliminarDefinitivo($idProducto)
    {
        $producto = Producto::findOrFail($idProducto);
        $producto->delete();

        return redirect()->route('productos.index')->with('mensaje', 'Producto eliminado permanentemente.');
    }

    // Reactivar producto inactivo
    public function reactivar($idProducto)
    {
        $producto = Producto::findOrFail($idProducto);
        $producto->estado = 1;
        $producto->save();

        return redirect()->route('productos.index')->with('mensaje', 'Producto reactivado correctamente.');
    }
}
