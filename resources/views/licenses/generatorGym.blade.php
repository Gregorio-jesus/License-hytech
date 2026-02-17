@extends('layouts.app')

@section('title', 'Generador de Licencia')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/generatorGym.css') }}">
@endsection

@section('content')
<div class="container-fluid">
    <div class="section-header-title">
        <h1>Nueva Licencia</h1>
    </div>

    <form id="licenseForm" action="{{ route('gym.store') }}" method="POST">
        @csrf

        <div class="form-section card-custom">
            <div class="section-header-form">
                <h3>Información del cliente</h3>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="gym_client_id">Seleccionar cliente existente (opcional):</label>
                    <select id="gym_client_id" name="gym_client_id" class="select-custom">
                        <option value="">-- Nuevo cliente --</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}">{{ $client->name }} ({{ $client->gym_name }})</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div id="new-client-fields">
                <div class="form-row">
                    <div class="form-group">
                        <label for="name">Nombre del cliente:</label>
                        <input type="text" id="name" name="name" placeholder="Ej. Juan Pérez">
                    </div>
                    <div class="form-group">
                        <label for="email">Correo electrónico:</label>
                        <input type="email" id="email" name="email" placeholder="cliente@email.com">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="gym_name">Nombre del Gym:</label>
                        <input type="text" id="gym_name" name="gym_name" placeholder="Syfit Central">
                    </div>
                    <div class="form-group">
                        <label for="phone">Teléfono:</label>
                        <input type="tel" id="phone" name="phone" placeholder="XXX-XXX-XXXX">
                    </div>
                </div>
            </div>
        </div>

        <div class="form-section card-custom">
            <h2>Configuración de licencia</h2>
            <div class="form-row">
                <div class="form-group">
                    <label for="service_id">Tipo de software:</label>
                    <select name="service_id" id="service_id" required>
                        @foreach($services as $service)
                            <option value="{{ $service->id }}">{{ $service->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="is_trial">Tipo de licencia:</label>
                    <select name="is_trial" id="is_trial">
                        <option value="0">Versión completa (pago)</option>
                        <option value="1">Versión de prueba (trial)</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="device_limit">Cantidad de dispositivos:</label>
                    <input type="number" id="device_limit" name="device_limit" min="1" value="1" required>
                </div>
                <div class="form-group">
                    <label for="start_date">Fecha de inicio:</label>
                    <input type="date" id="start_date" name="start_date" required>
                </div>
                <div class="form-group">
                    <label for="expiration_date">Fecha de expiración:</label>
                    <input type="date" id="expiration_date" name="expiration_date" required>
                </div>
            </div>
        </div>

        <div class="button-group">
            <button type="button" class="btn btn-cancel" onclick="window.history.back()">Cancelar</button>
            <button type="submit" class="btn btn-submit">Generar</button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('js/generatorGym.js') }}"></script>
@endsection