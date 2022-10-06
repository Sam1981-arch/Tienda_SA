@extends('layouts.app')

@section('content')
<div class="container">
    @include('layouts.alerts')

    <div class="card">
        <div class="card-header">
            <h2>Editar Usuario</h2>
            <a class="btn btn-primary" href="{{route('show.user.table')}}">Atras</a>
        </div>
        <div class="card-body">
            <form action="{{route('update.user', ['user' => $user->id])}}" method="post">
                @csrf
                @method('PUT')
                @include('layouts.user.form')
            </form>
        </div>
    </div>
</div>
@endsection