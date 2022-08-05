<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdatePost;
use App\Models\Post;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index(){
        $posts = Post::latest()->paginate(3); //paginate é utilizado para definir a quantidade de elementos por pagina

        return view('admin.posts.index', compact('posts'));
    }

    public function create(){

        return view('admin.posts.create');
    }

    public function store(StoreUpdatePost $request){
        $data = $request->all();

        if ($request->image->isValid()) {
            $nameFile = Str::of($request->title)->slug('-').'.'. $request->image->getClientOriginalExtension(); //pega a extensão original do arquivo
            $image = $request->image->storeAs('posts', $nameFile);
            $data['image'] = $image;
        }
        
        Post::create($data); 
        
       return redirect()->route('posts.index')->with('message', 'Post criado com sucesso'); //utilizando o nome da route.
    }


    public function show($id){
          if(!$post = Post::where('id', $id)->first()){ 
                return redirect()->route('posts.index');
          }
           
          return view('admin.posts.show', compact('post'));
    }


    public function destroy($id){ 
       if (!$post = Post::find($id)) {
            return redirect()->route('posts.index');
       }

       if(Storage::exists($post->image)){
             Storage::delete($post->image);
       }

       $post->delete();
       return redirect()->route('posts.index')->with('message', 'Post deletado com sucesso');
    }

    public function edit($id){
        if (!$post = Post::find($id)) {
            return redirect()->back();
        }

        return view('admin.posts.edit', compact('post')); 
    }    


     public function update(StoreUpdatePost $request ,$id){
        if(!$post =Post::find($id)){
            return redirect()->back();
        }
        $data = $request->all();

        if ($request->image && $request->image->isValid()) {
            
            if(Storage::exists($post->image)){ //Storage verifica se o arquivo existe
                Storage::delete($post->image); //caso ele exista, ele deleta o arquivo 
                $nameFile = Str::of($request->title)->slug('-').'.'. $request->image->getClientOriginalExtension(); //pega a extensão original do arquivo
                $image = $request->image->storeAs('posts', $nameFile);
                $data['image'] = $image;
            }
        }


        $post->update($data);

        return redirect()->route('posts.index')->with('message', 'Post Criado com sucesso');
     }

     public function search(Request $request){
        $fillters = $request->all();        

        $posts = Post::where('title', 'LIKE', "%{$request->search}%")
                    ->orWhere('content', 'LIKE', "%{$request->search}%")
                    ->paginate(3);

        return view('admin.posts.index', compact('posts', 'fillters'));
    }

}
