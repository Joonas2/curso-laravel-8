@extends('admin.layout.app')

@section('title', 'Detalhes do Post')

@section('content')
    
    <h1>
        Detalhes do Post {{ $post->title }}
    </h1>

    <ul>
        <li>{{ $post->title }}</li>
        <li>{{ $post->content }}</li>
    </ul>


    <form action="{{ route('posts.destroy', $post->id) }}" method="post">
        @csrf
        <input type="hidden" name="_method" value="delete">
        <button type="submit">Deletar o Post {{ $post->title }}</button>

    </form>
@endsection
