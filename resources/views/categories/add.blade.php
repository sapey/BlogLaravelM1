@extends('layouts.layout')

@section('content')
    <div class="container">

        <h1>Ajouter une catégorie</h1>

        <form method="post" action="{{route('categoryStore')}}">
            @csrf
            <div class="form-group">
                <label>Nom de la catégorie</label>
                <input type="text" required class="form-control" name="name">
            </div>
            <button class="btn btn-primary" type="submit">Ajouter</button>
        </form>
    </div>
@endsection
