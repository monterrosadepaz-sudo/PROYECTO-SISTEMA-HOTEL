@extends('layouts.app')

@section('titulo', 'Gestión de productos y servicios')

@section('contenido')
<div class="container">

    {{-- Mensaje de confirmación --}}
    @if(session('mensaje'))
        <div class="alert alert-success">{{ session('mensaje') }}</div>
    @endif

<div class="mb-3">
    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary btn-sm">
        ← Volver
    </a>
</div>

    {{-- Formulario de creación (solo si no hay producto seleccionado) --}}
    @if(!isset($producto))
        <h2 class="mb-4">Agregar nuevo producto o servicio</h2>
        <form method="POST" action="{{ route('productos.store') }}">
            @csrf

            {{-- Campos --}}
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="tipo" class="form-label">Tipo</label>
                <select name="tipo" id="tipo" class="form-select" required>
                    <option value="">Seleccionar tipo</option>
                    <option value="producto">Producto</option>
                    <option value="servicio">Servicio</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="number" step="0.01" name="precio" id="precio" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" name="stock" id="stock" class="form-control">
            </div>

            <div class="mb-3">
                <label for="estado" class="form-label">Estado</label>
                <select name="estado" id="estado" class="form-select" required>
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
    @endif

    {{-- Tabla de inventario --}}
    <hr>
    <h3 class="mt-5">Inventario actual</h3>
    <p>Total productos: {{ count($productos) }}</p>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($productos as $p)
                <tr>
                    <td>{{ $p->nombre }}</td>
                    <td>{{ ucfirst($p->tipo) }}</td>
                    <td>${{ number_format($p->precio, 2) }}</td>
                    <td>{{ $p->stock ?? '—' }}</td>
                    <td>{{ $p->estado ? 'Activo' : 'Inactivo' }}</td>
                    <td>
                        <a href="{{ route('productos.edit', $p->idProducto) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('productos.destroy', $p->idProducto) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este producto?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No hay productos registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Formulario de edición (solo si hay producto seleccionado) --}}
    @if(isset($producto))
        <hr>
        <h3 class="mt-5">Editar producto o servicio</h3>
        <form method="POST" action="{{ route('productos.update', $producto->idProducto) }}">
            @csrf
            @method('PUT')

            {{-- Campos --}}
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $producto->nombre) }}" required>
            </div>

            <div class="mb-3">
                <label for="tipo" class="form-label">Tipo</label>
                <select name="tipo" id="tipo" class="form-select" required>
                    <option value="">Seleccionar tipo</option>
                    <option value="producto" {{ $producto->tipo === 'producto' ? 'selected' : '' }}>Producto</option>
                    <option value="servicio" {{ $producto->tipo === 'servicio' ? 'selected' : '' }}>Servicio</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="number" step="0.01" name="precio" id="precio" class="form-control" value="{{ old('precio', $producto->precio) }}" required>
            </div>

            <div class="mb-3">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" name="stock" id="stock" class="form-control" value="{{ old('stock', $producto->stock) }}">
            </div>

            <div class="mb-3">
                <label for="estado" class="form-label">Estado</label>
                <select name="estado" id="estado" class="form-select" required>
                    <option value="1" {{ $producto->estado == 1 ? 'selected' : '' }}>Activo</option>
                    <option value="0" {{ $producto->estado == 0 ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Actualizar</button>
        </form>
    @endif

</div>
@endsection

