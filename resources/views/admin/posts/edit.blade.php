<h1>Editar o Post {{ $post->title }}</h1>


<form action="{{ route('posts.update', $post->id) }}" method="post">
    @method('put')
    @include('admin.posts._partials.form') 
   

</form>