@extends('layouts.app')

@section('titulo', 'Check-Out')

@section('contenido')
<h3 class="mb-4">Panel de Check-Out</h3>

{{-- Mensajes --}}
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

{{-- RESERVAS CONFIRMADAS --}}
<h4 class="mt-4">Reservas confirmadas por caducar</h4>

@forelse($reservas as $reserva)
    <div class="card mb-3">
        <div class="card-body">
            <h5>{{ $reserva->cliente->nombre ?? 'Sin nombre' }} {{ $reserva->cliente->apellido ?? '' }}</h5>
            <p>
                <strong>Habitación:</strong> {{ $reserva->habitacion->numero ?? 'Sin número' }}
                <span class="text-muted">(${{ number_format($reserva->habitacion->precio ?? 0, 2) }} / día)</span>
            </p>
            <p><strong>Entrada:</strong> {{ $reserva->fechaEntrada }}</p>
            <p><strong>Salida:</strong> {{ $reserva->fechaSalida }}</p>
            <p>
                <strong>Cronómetro:</strong>
                <span class="badge bg-warning cronometro-reserva"
                      data-fecha="{{ $reserva->fechaSalida }}"></span>
            </p>
    
            <h6>Consumos registrados</h6>
            @if($reserva->ventas->isEmpty())
                <p class="text-muted">No hay productos o servicios registrados.</p>
            @else
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Precio</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reserva->ventas as $venta)
                            <tr>
                                <td>{{ $venta->producto->nombre }}</td>
                                <td>${{ number_format($venta->producto->precio ?? 0, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

            {{-- Botón para mostrar/ocultar formulario --}}
            <button class="btn btn-success" type="button"
                    onclick="toggleForm('formSalidaReserva-{{ $reserva->idReserva }}')">
                Registrar salida
            </button>

            {{-- Formulario oculto --}}
            <div id="formSalidaReserva-{{ $reserva->idReserva }}" style="display: none; margin-top: 1rem;">
                <div class="card card-body">
                    <form method="POST" action="{{ route('checkout.registrar', $reserva->idReserva) }}">
                        @csrf

                        @php
                            $entrada = \Carbon\Carbon::parse($reserva->fechaEntrada);
                            $salida = \Carbon\Carbon::parse($reserva->fechaSalida);
                            $dias = max($entrada->diffInDays($salida), 1);
                            $precioDia = $reserva->habitacion->precio ?? 0;
                            $totalEstadia = $dias * $precioDia;
                        @endphp

                        <p><strong>Duración:</strong> {{ $dias }} día{{ $dias === 1 ? '' : 's' }}</p>
                        <p><strong>Total por estadía:</strong> ${{ number_format($totalEstadia, 2) }}</p>

                        {{-- Select múltiple de productos --}}
                        <div class="mb-3">
                            <label for="productoSelect-{{ $reserva->idReserva }}" class="form-label">Agregar consumos</label>
                            <select id="productoSelect-{{ $reserva->idReserva }}"
                                    name="productos[]"
                                    class="form-select"
                                    multiple
                                    onchange="actualizarTotalReserva('{{ $reserva->idReserva }}')">
                                @foreach($productos as $producto)
                                    <option value="{{ $producto->idProducto }}" data-precio="{{ $producto->precio }}">
                                        {{ $producto->nombre }} - ${{ number_format($producto->precio ?? 0, 2) }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="text-muted">Mantén presionada CTRL (o CMD en Mac) para seleccionar varios.</small>
                        </div>

                        <p>
                            <strong>Total a pagar:</strong>
                            $<span id="totalPagar-{{ $reserva->idReserva }}">{{ number_format($totalEstadia, 2) }}</span>
                        </p>
                        <input type="hidden" name="total_estadia" value="{{ $totalEstadia }}">
                        <input type="hidden" id="totalFinalInput-{{ $reserva->idReserva }}" name="total_final" value="{{ $totalEstadia }}">

                        <button type="submit" class="btn btn-primary">Confirmar salida</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@empty
    <p class="text-muted">No hay reservas confirmadas por caducar.</p>
@endforelse

{{-- CHECK-INS ACTIVOS --}}
<h4 class="mt-5">Check-ins activos</h4>

@forelse($checkins as $checkin)
    <div class="card mb-3">
        <div class="card-body">
            <h5>{{ $checkin->cliente->nombre ?? 'Sin nombre' }} {{ $checkin->cliente->apellido ?? '' }}</h5>
            <p>
                <strong>Habitación:</strong> {{ $checkin->habitacion->numero ?? 'Sin número' }}
                <span class="text-muted">(${{ number_format($checkin->habitacion->precio ?? 0, 2) }} / día)</span>
            </p>
            <p><strong>Entrada:</strong> {{ $checkin->fechaEntrada }}</p>
            <p><strong>Estado actual:</strong> <span class="badge bg-info">{{ $checkin->estado }}</span></p>

            {{-- Cronómetro progresivo --}}
            <p>
                <strong>Cronómetro:</strong>
                <span class="badge bg-warning cronometro-checkin"
                      data-fecha="{{ $checkin->fechaEntrada }}"></span>
            </p>

            {{-- Botón para mostrar/ocultar formulario --}}
            <button class="btn btn-success" type="button"
                    onclick="toggleForm('formSalidaCheckin-{{ $checkin->idCheckin }}')">
                Registrar salida
            </button>

            {{-- Formulario oculto --}}
            <div id="formSalidaCheckin-{{ $checkin->idCheckin }}" style="display: none; margin-top: 1rem;">
                <div class="card card-body">
                    <form method="POST" action="{{ route('checkout.registrarCheckin', $checkin->idCheckin) }}">
                        @csrf

                        @php
                            $entrada = \Carbon\Carbon::parse($checkin->fechaEntrada);
                            $salida = \Carbon\Carbon::now();
                            $dias = max($entrada->diffInDays($salida), 1);
                            $precioDia = $checkin->habitacion->precio ?? 0;
                            $totalEstadia = $dias * $precioDia;
                        @endphp

                        <p><strong>Duración:</strong> {{ $dias }} día{{ $dias === 1 ? '' : 's' }}</p>
                        <p><strong>Total por estadía:</strong> ${{ number_format($totalEstadia, 2) }}</p>

                        {{-- Select múltiple de productos --}}
                        <div class="mb-3">
                            <label for="productoSelectCheckin-{{ $checkin->idCheckin }}" class="form-label">Agregar consumos</label>
                            <select id="productoSelectCheckin-{{ $checkin->idCheckin }}"
                                    name="productos[]"
                                    class="form-select"
                                    multiple
                                    onchange="actualizarTotalCheckin('{{ $checkin->idCheckin }}')">
                                @foreach($productos as $producto)
                                    <option value="{{ $producto->idProducto }}" data-precio="{{ $producto->precio }}">
                                        {{ $producto->nombre }} - ${{ number_format($producto->precio ?? 0, 2) }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="text-muted">Mantén presionada CTRL (o CMD en Mac) para seleccionar varios.</small>
                        </div>

                        <p>
                            <strong>Total a pagar:</strong>
                            $<span id="totalPagarCheckin-{{ $checkin->idCheckin }}">{{ number_format($totalEstadia, 2) }}</span>
                        </p>
                        <input type="hidden" name="total_estadia" value="{{ $totalEstadia }}">
                        <input type="hidden" id="totalFinalInputCheckin-{{ $checkin->idCheckin }}" name="total_final" value="{{ $totalEstadia }}">

                        <button type="submit" class="btn btn-primary">Confirmar salida</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@empty
    <p class="text-muted">No hay check-ins activos registrados.</p>
@endforelse

{{-- JS para cronómetros, toggle y cálculo de totales --}}
<script>
    // Mostrar/ocultar formularios
    function toggleForm(id) {
        const el = document.getElementById(id);
        const visible = el.style.display === 'block';
        el.style.display = visible ? 'none' : 'block';
    }

    // Total para reservas
    function actualizarTotalReserva(idReserva) {
        const select = document.getElementById(`productoSelect-${idReserva}`);
        let sumaProductos = 0;
        for (const opt of select.selectedOptions) {
            const precio = parseFloat(opt.dataset.precio || 0);
            if (!isNaN(precio)) sumaProductos += precio;
        }
        const baseInput = document.querySelector(`#formSalidaReserva-${idReserva} input[name='total_estadia']`);
        const base = parseFloat(baseInput ? baseInput.value : 0);
        const total = base + sumaProductos;

        const totalSpan = document.getElementById(`totalPagar-${idReserva}`);
        const totalHidden = document.getElementById(`totalFinalInput-${idReserva}`);
        if (totalSpan) totalSpan.textContent = total.toFixed(2);
        if (totalHidden) totalHidden.value = total;
    }

    // Total para checkins
    function actualizarTotalCheckin(idCheckin) {
        const select = document.getElementById(`productoSelectCheckin-${idCheckin}`);
        let sumaProductos = 0;
        for (const opt of select.selectedOptions) {
            const precio = parseFloat(opt.dataset.precio || 0);
            if (!isNaN(precio)) sumaProductos += precio;
        }
        const baseInput = document.querySelector(`#formSalidaCheckin-${idCheckin} input[name='total_estadia']`);
        const base = parseFloat(baseInput ? baseInput.value : 0);
        const total = base + sumaProductos;

        const totalSpan = document.getElementById(`totalPagarCheckin-${idCheckin}`);
        const totalHidden = document.getElementById(`totalFinalInputCheckin-${idCheckin}`);
        if (totalSpan) totalSpan.textContent = total.toFixed(2);
        if (totalHidden) totalHidden.value = total;
    }

    // Cronómetro regresivo para reservas
    function renderCronometroReserva(el) {
        const fechaSalida = new Date(el.dataset.fecha);
        const ahora = new Date();
        const diff = fechaSalida - ahora;

        if (diff <= 0) {
            el.textContent = 'Caducado';
            el.classList.remove('bg-warning');
            el.classList.add('bg-danger');
            return;
        }
        const horas = Math.floor(diff / (1000 * 60 * 60));
        const minutos = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
        el.textContent = `${horas}h ${minutos}m restantes`;
    }

    // Cronómetro progresivo para checkins
    function renderCronometroCheckin(el) {
        const fechaEntrada = new Date(el.dataset.fecha);
        const ahora = new Date();
        const diff = ahora - fechaEntrada;

        if (diff <= 0) {
            el.textContent = 'Recién ingresado';
            el.classList.remove('bg-warning');
            el.classList.add('bg-info');
            return;
        }
        const dias = Math.floor(diff / (1000 * 60 * 60 * 24));
        const horas = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutos = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
        el.textContent = `${dias}d ${horas}h ${minutos}m en estadía`;
    }

    // Inicialización y actualización cada minuto
    function initCronometros() {
        document.querySelectorAll('.cronometro-reserva').forEach(renderCronometroReserva);
        document.querySelectorAll('.cronometro-checkin').forEach(renderCronometroCheckin);
    }
    initCronometros();
    setInterval(initCronometros, 60000); // refresca cada 60s
</script>
@endsection

