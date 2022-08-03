@extends('admin.layout.app')

@section('title' , 'Listagem dos Posts')
    


@section('content')
<a href="{{ route('posts.create') }} ">Criar novo Post </a><br>

<form action="{{ route('posts.search') }}" method="post">
  @csrf
  <input type="text" name="search" id="" placeholder="Filtar">
  <button type="submit">Filtrar</button>
</form>

@if (session('message'))
  {{ session('message')  }}    
@endif

@foreach($posts as $post)
  <p>{{ $post->title }}
   <img src="{{ url("storage/{$post->image}")  }}" alt="{{ $post->title }}" style="max-width: 100px;">  
[ <a href="{{ route('post.show', $post->id) }}">Ver</a> |
  <a href="{{ route('posts.edit', $post->id) }}">Editar </a>  

]</p><br>
@endforeach

<hr>

@if (isset($fillters))
<!--Para paginação -->
  {{ $posts->appends($fillters)->links() }}    
   
@else
  {{ $posts->links( ) }}    
@endif

    
@endsection