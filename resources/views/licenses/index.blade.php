@extends('layouts.app')

@section('title', 'Licencias Gym Syfit')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/licensesList.css') }}">
@endsection

@section('content')
<div class="container-fluid">
    <div class="page-header-actions">
        <h1 class="page-title-main">Licencias</h1>
    </div>

    <div class="licenses-controls">
        <div class="entries-wrapper"> Mostrar 
            <select id="entriesSelector" class="entries-dropdown">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select> entradas
        </div>

        <div class="search-wrapper">
            <input type="text" id="searchInput" placeholder="Buscar por nombre del cliente">
        </div>
    </div>

    <div class="licenses-table-card">
        <table class="licenses-table">
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Nombre del gym</th>
                    <th>Estado</th>
                    <th>Vencimiento</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                @forelse($licenses as $license)
                <tr>
                    <td class="td-client">{{ $license->client->name }}</td>
                    <td class="td-gym">{{ $license->client->gym_name }}</td>
                    <td class="td-status">
                        <span class="status-pill {{ $license->status == 'active' ? 'pill-active' : 'pill-inactive' }}">{{ ucfirst($license->status == 'active' ? 'Activo' : 'Inactivo') }}</span>
                        <div class="connection-status" style="margin-top: 8px; font-size: 0.75rem; line-height: 1.2;">
                             @if($license->last_check_in && $license->last_check_in->diffInMinutes(now()) < 10)
                                <span style="color: #4ade80;">En línea</span>
                            @else
                                <span style="color: #666;">Desconectado</span>
                            @endif
                            <span style="display: block; margin-top: 2px;">
                                @if($license->hardware_id)
                                    <small style="color: #5855d6;" title="ID: {{ $license->hardware_id}}">
                                        Vinculado
                                    </small>
                                @else
                                    <small style="color: #eab308;">
                                        Sin vincular
                                    </small>
                                @endif
                            </span>
                        </div>
                    </td>
                    <td class="td-date">{{ $license->expiration_date->format('Y-m-d') }}</td>
                    <td class="td-actions">
                        <div class="btn-group-actions">
                             <a href="{{ route('gym.download', $license->id) }}" class="btn-action btn-descargar" title="Descargar">Descargar</a>  
                            <button class="btn-action btn-modificar" onclick="openEditModal('{{ $license->id }}', '{{ $license->status }}', '{{ $license->expiration_date->format('Y-m-d') }}')">Modificar</button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr class="no-data-row">
                    <td colspan="5" class="no-data">No hay licencias generadas aún.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="licenses-footer">
        <div id="paginationInfo" class="pagination-info">Mostrando 0 a 0 de 0 registros</div>
        <div id="paginationControls" class="pagination-controls"></div>
    </div>
</div>

<div id="editModalOverlay" class="modal-overlay">
    <div class="custom-modal">
        <div class="modal-header">
            <h3 class="modal-title">Actualizar Licencia</h3>
            <button class="close-modal" onclick="closeModal('editModalOverlay')">&times;</button>
        </div>
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-body">
                <label for="edit_status">Estado de la Licencia</label>
                <select name="status" id="edit_status" class="modal-input">
                    <option value="active">Activo</option>
                    <option value="inactive">Inactivo</option>
                </select>

                <label for="edit_expiration">Nueva Fecha de Vencimiento</label>
                <input type="date" name="expiration_date" id="edit_expiration" class="modal-input">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-action" style="background: #333;" onclick="closeModal('editModalOverlay')">Cancelar</button>
                <button type="submit" class="btn-action btn-modificar">Guardar Cambios</button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
    <script src="{{ asset('js/licenseList.js') }}"></script>
@endsection