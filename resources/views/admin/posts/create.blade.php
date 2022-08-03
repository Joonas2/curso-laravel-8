@extends('admin.layout.app')

@section('title', 'Criar novo Post')
    

@section('content')
          <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
            @include('admin.posts._partials.form')
        </form>
 
@endsection
