@extends('layouts.layout')

@section('content')
    {{--<div class="container">
        <h1>{{$post->title}}</h1>
        <p>{{$post->description}}</p>
        <p><i>Créé le {{$post->created_at->format('d/m/Y')}}</i></p>

        <a href="{{route('postList')}}" class="btn btn-success">Retourner à la liste des articles</a>
    </div>--}}
<div class="container">
    <h1>Détail de : {{$post->title}}</h1>

    <div class="row">

        <div class="col-md-6">
            <form method="post" action="{{route('postUpdate', $post->id)}}">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label><b>Titre</b></label>
                    <input type="text" required class="form-control" name="title" value="{{old('title', $post->title)}}">
                </div>
                <br/>
                <div class="form-group">
                    <label>Extrait</label>
                    <input type="text" required class="form-control" name="extrait" value="{{old('extrait', $post->extrait)}}">
                </div>
                <br/>
                <div class="form-group">
                    <label>Description</label>
                    <textarea rows="5" type="text" required class="form-control" name="description"> {{old('description', $post->description)}} </textarea>
                </div>
                <br/>

                <div>
                    @foreach($categories as $category)
                        <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input" id="check-{{$category->id}}"
                                   name="checkboxCategories[{{$category->id}}]"
                                   value="{{$category->id}}"
                            @if($post->categories->contains('id', $category->id)) checked @endif>
                            <label for="check-{{$category->id}}" class="form-check-label">{{$category->name}}</label>
                        </div>
                    @endforeach
                </div>

                <br/>
                <button type="submit" class="btn btn-warning">Modifier</button>

                <a href="{{route('postList')}}" class="btn btn-success">Retour</a>
            </form>
            <br/>
                <form method="post" action="{{route('postDelete', $post->id)}}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">Supprimer l'articles</button>
                </form>


        </div>

        <div class="col-md-6">
            <form method="post" action="{{route('postUpdatePicture', $post->id)}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                <div class="form-group">
                    <label></label>
                    <input type="file" required class="form-control" name="picture" accept="image/png, image/jpeg, image/jpg">
                </div>
                <br/>
                <button type="submit" class="btn btn-warning">Modifier Image</button>
            </form>
        </div>


    </div>
    <br/>
    <h2>Commentaires</h2>

    @if(sizeof($post->comments) > 0)
        <ul>
            <br/>
            @foreach($post->comments as $comment)
                <li>
                    <p>{{$comment->content}}</p>
                    <form method="post" action="{{route('commentDelete', $comment->id)}}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Supprimer commentaire</button>

                    </form>
                    <br/>
                </li>
            @endforeach
        </ul>
    @else
        <p>Il n'y a pas de commentaire</p>
    @endif


    <form method="post" action="{{route('commentAdd', $post->id)}}">
        @csrf
        <div class="form-group">
            <label>Votre commentaire</label>
            <input type="text" class="form-control" name="content" required>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter ce commentaire</button>
    </form>


</div>
@endsection
