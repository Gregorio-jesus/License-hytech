@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
    <div class="dashboard-grid">
        {{-- Aquí puedes poner los cards de la imagen que enviaste --}}
        <h1>Bienvenido, {{ Auth::user()->name }}</h1>
        <p>Panel de administración de licencias HyTech SaaS.</p>
    </div>
@endsection