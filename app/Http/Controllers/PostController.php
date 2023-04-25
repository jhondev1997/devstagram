<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth')->except(['show', 'index']);
  }

  public function index(User $user)
  {

    $posts = Post::where('user_id', $user->id)->latest()->paginate(20);
    // $all_posts = Post::where('user_id', $user->id)->get()->count();

    return view('dashboard', [
      'user' => $user,
      'posts' =>$posts,
      // 'all_posts' => $all_posts
    ]);
    // dd(auth()->user());
  }

  public function create()
  {
    return view('posts.create');
  }

  public function store(Request $request)
  {
    $this->validate($request, [
      'titulo' => ['required', 'max:255'],
      'descripcion' => ['required'],
      'imagen' => ['required']
    ]);

    // Post::create([
    //   'titulo' => $request->titulo,
    //   'descripcion' => $request->descripcion,
    //   'imagen' => $request->imagen,
    //   'user_id' => auth()->user()->id
    // ]);

    // Todo: otra forma de hacer un registro

    // $post = new Post();
    // $post->titulo = $request->titulo;
    // $post->descripcion = $request->descripcion;
    // $post->imagen = $request->imagen;
    // $post->user_id = auth()->user()->id;

    // $post->save();

    // TOdo: OTra forma pero con el user

    $request->user()->posts()->create([
      'titulo' => $request->titulo,
      'descripcion' => $request->descripcion,
      'imagen' => $request->imagen,
      'user_id' => auth()->user()->id
    ]);

    return redirect()->route('posts.index', auth()->user()->username);
  }

  public function show(User $user, Post $post)
  {
    return view('posts.show', [
      'post' => $post,
      'user' => $user,
      'comentarios_reversos' => $post->comentarios()->latest()->paginate(20)
    ]);
  }

  public function destroy(Post $post)
  {
    $this->authorize('delete', $post);
    $post->delete();

    // Eliminar la imagen
    $imagen_path = public_path('uploads/' . $post->imagen);

    if(File::exists($imagen_path)){
      unlink(($imagen_path));
    }

    return redirect()->route('posts.index', auth()->user()->username);
  }
}
