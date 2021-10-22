@extends('layouts.layout')

@section('content')
    <div class="container">

        <h1>Formulaire de création d'un article</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus aut blanditiis cumque delectus, ducimus eius eum facere fugit illum ipsa ipsum laborum libero minus molestias porro tenetur veniam veritatis voluptatum?</p>

        @if($errors->any())
            @foreach($errors->all() as $error)
                <script>
                    alert('{{$error}}');
                </script>
            @endforeach
        @endif

        <form method="post" action="{{route('postStore')}}" enctype="multipart/form-data">
        @csrf
            <div class="form-group">
                <label>Titre</label>
                <input type="text" required class="form-control" name="title" value="{{old('title')}}">
            </div>

            <div class="form-group">
                <label>Extrait</label>
                <input type="text" required class="form-control" name="extrait" value="{{old('extrait')}}">
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea rows="5" type="text" required class="form-control" name="description">{{old('description')}}</textarea>
            </div>

            <div class="form-group">
                <label>Image</label>
                <input type="file" required class="form-control" name="picture" accept="image/png, image/jpeg, image/jpg">
            </div>

            <br/>

            <label>Catégorie de l'article </label>
            <div>
                @foreach($categories as $category)
                    <div class="form-check form-check-inline">
                        <input type="checkbox" class="form-check-input" id="check-{{$category->id}}"
                               name="checkboxCategories[{{$category->id}}]"
                               value="{{$category->id}}">
                        <label for="check-{{$category->id}}" class="form-check-label">{{$category->name}}</label>
                    </div>
                @endforeach
            </div>

            <br/>

            <button type="submit" class="btn btn-primary">Ajouter</button>

            <a href="{{route('postList')}}" class="btn btn-success">Retour</a>


        </form>

    </div>
@endsection

