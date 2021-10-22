@extends('layouts.layout') <!-- ou est la clé -->

@section('content')
    <h1>Ma liste d'article</h1>

    <ul>
        @foreach($posts as $post)
            <li>
                <h2>{{$post->title}}</h2>
                <p>{{$post->extrait}}</p>
            </li>
        @endforeach
    </ul>
@endsection
