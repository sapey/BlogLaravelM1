@extends('layouts.layout') <!-- ou est la clé -->

@section('content')
    <br/>
    <div class="row">
        <div class="col-md-6">
            <h1>Ma liste d'article</h1>
        </div>
        <div class="col-md-6 pt20">
            <a href="{{route('postAjouter')}}" class="btn btn-success">Ajouter des articles</a>
        </div>
    </div>

    <div class="row">
        @foreach($posts as $post)

            <div class="col-md-4">
                <div class="card">
                    <img src="{{asset("storage/$post->picture")}}" class="card-img-top" style="object-fit: cover" height="300">
                    <div class="card-body">
                        <h5 class="card-title">{{$post->title}}</h5>
                        <p class="card-text">{{$post->extrait}}</p>
                        <p><i> Il y a {{$post->countComments()}}
                            @if($post->countComments() >= 2)
                                commentaires
                            @else
                                commentaire
                            @endif
                            </i>
                        </p>
                        <div>
                            @foreach($post->categories as $category)
                                <span class="text-white bg-dark p-2 rounded-pill">{{$category->name}}</span>
                            @endforeach
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{route('postDetails',  $post->id)}}" class="btn btn-warning">Voir le détail de l'articles</a>
                            </div>
                            <div class="col-md-6">
                                <form method="post" action="{{route('postDelete', $post->id)}}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">Supprimer l'articles</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <br/>
            </div>

            {{--<li>
                <h2>{{$post->title}}</h2>
                <h3>{{$post->description}}</h3>
                <p><i>{{$post->extrait}}</i></p>

                <a href="{{route('postDetails',  $post->id)}}" class="btn btn-warning">Voir le détail de l'articles</a>

                <form method="post" action="{{route('postDelete', $post->id)}}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">Supprimer l'articles</button>
                </form>


            </li>
            <br/>--}}



        @endforeach
    </div>
@endsection


