@if($errors->any())
    <ul>
         @foreach ($errors->all() as $errors)
            <li>{{ $errors }}</li>       
         @endforeach
    </ul>
@endif

<form action="{{ route('posts.store') }}" method="post">
  @include('admin.posts._partials')
</form>