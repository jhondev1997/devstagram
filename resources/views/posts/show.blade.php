@extends('layouts.app')

@section('title', $post->titulo)

@section('content')
  <div class="container mx-auto md:flex">
    <div class="md:w-1/2">
      <img src="{{ asset('uploads') . '/' . $post->imagen}}" alt="Imagen del post:{{ $post->titulo}}">

      <div class="p-3 flex items-center gap-2">
        @auth

          <livewire:like-post :post="$post"/>

          {{-- @if ($post->checkLike(auth()->user()))
            <form action="{{ route('posts.like.destroy', $post)}}" method="POST">
              @method('DELETE')
              @csrf
              <div class="my-4">
                <button type="submit">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="red" viewBox="0 0 24 24" stroke-width="0.2" stroke="currentColor" class="w-6 h-6 border-white">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                  </svg>
                </button>
              </div>
            </form>
          @else
            <form action="{{ route('posts.like.store', $post)}}" method="POST">
              @csrf
              <div class="my-4">
                <button type="submit">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                  </svg>
                </button>
              </div>
            </form>
          @endif --}}

        @endauth
        {{-- <p class="font-bold">{{ $post->likes->count()}}
          <span class="font-normal"> Likes</span>
        </p> --}}
        @if (!auth()->user())
          <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" stroke-width="0.2" stroke="currentColor" class="w-6 h-6 border-white">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
          </svg>
          <p class="font-bold">{{ $post->likes->count()}}

            <span class="font-normal"> Likes</span>
          </p>
        @endif
      </div>

      <div>
        <p class="font-bold">{{$post->user->username}}</p>
        <p class="text-sm text-gray-500">{{$post->created_at->diffForHumans()}}</p>
        <p class="mt-5">{{$post->descripcion}}</p>
      </div>

      @auth
        @if ($post->user_id === auth()->user()->id)
          <form action="{{route('posts.destroy', $post)}}" method="POST">
            @method('DELETE')
            @csrf
            <input type="submit"
              value="Eliminar publicacion"
              class="bg-red-500 hover:bg-red-600 p-2 rounded text-white font-bold mt-4 cursor-pointer"
            />
          </form>
        @endif
      @endauth
    </div>

    <div class="md:w-1/2 p-5">
      <div class="shadow bg-white p-5 mb-5">
        @auth
          <p class="text-xl font-bold text-center mb-4">Agrega un nuevo comentario</p>

          @if (session('mensaje-creado'))
            <div class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold">
              {{session('mensaje-creado')}}
            </div>
          @endif

          @if (session('mensaje-borrado'))
            <div class="bg-red-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold">
              {{session('mensaje-borrado')}}
            </div>
          @endif

          <form action="{{ route('comentarios.store', ['post' => $post, 'user' => $user ]) }}" method="POST">
            @csrf
            <div class="mb-5">
              <label for="comentario" class="mb-2 uppercase font-bold text-gray-500 block">
                Añade un comentario
              </label>
              <textarea type="text"
                id="comentario"
                name="comentario"
                placeholder="Agruega un comentario"
                class="border p-3 w-full rounded-lg @error('comentario')
                  border-red-500
                @enderror"

              >{{ old('comentario') }}</textarea>

              @error('comentario')
                <p class="bg-red-500 text-white my-2 p-2 rounded-lg text-sm text-center">
                  {{ $message }}
                </p>
              @enderror
            </div>

            <input type="submit"
              value="Comentar"
              class="bg-sky-600 hover:bg-sky-700 transition-colors uppercase font-bold cursor-pointer w-full p-3 text-white rounded-lg"
            />
          </form>
        @endauth

        <div class="bg-white shadow mb-5 max-h96 overflow-y-scroll mt-10">
          @if ($comentarios_reversos->count())
            @foreach ($comentarios_reversos as $comentario)
              <div class="p-5 border-gray-300 border-b">
                <header class="flex justify-between">
                  <a class="font-bold" href="{{ route('posts.index', $comentario->user)}}">
                    {{$comentario->user->username}}
                  </a>

                  @auth
                    @if ($comentario->user_id === auth()->user()->id)
                      <form class="text-xs" action="{{route('comentario.destroy', ['user' => $user, 'comentario' => $comentario, 'post' => $post])}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <input type="submit"
                          value="Eliminar comentario"
                          class="text-blue-500 cursor-pointer"
                        />
                      </form>
                    @endif
                  @endauth
                </header>
                <p>{{$comentario->comentario}}</p>
                <p class="text-sm text-gray-500">{{$comentario->created_at->diffForHumans()}}</p>
              </div>
            @endforeach
          @else
            <p class="p-10 text-center">No hay comentarios, sé el primero en comentar.</p>
          @endif
        </div>
      </div>
    </div>
  </div>
@endsection
