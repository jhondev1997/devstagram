@extends('layouts.app')

@section('title', 'Crea una nueva publicación')

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@vite('resources/js/app.js')
@endpush

@section('content')
  <div class="md:flex md:items-center">
    <div class="md:w-1/2 px-10">
      <form action="{{ route('imagenes.store')}}"
        method="POST"
        id="dropzone"
        enctype="multipart/form-data"
        class="dropzone border-dashed border-2 w-full h-96 rounded flex flex-col justify-center items-center"
      >
        @csrf
      </form>
    </div>

    <div class="md:w-1/2 p-10 bg-white  rounded-lg shadow-lg mt-10 md:mt-0">

      <form action="{{route('posts.store')}}" method="POST" novalidate>
        @csrf
        <div class="mb-5">
          <label for="titulo" class="mb-2 uppercase font-bold text-gray-500 block">
            Título
          </label>
          <input type="text"
            id="titulo"
            name="titulo"
            placeholder="Tu titulo"
            class="border p-3 w-full rounded-lg @error('titulo')
              border-red-500
            @enderror"
            value="{{ old('titulo') }}"
          />

          @error('titulo')
            <p class="bg-red-500 text-white my-2 p-2 rounded-lg text-sm text-center">
              {{ $message }}
            </p>
          @enderror
        </div>

        <div class="mb-5">
          <label for="descripcion" class="mb-2 uppercase font-bold text-gray-500 block">
            Descriptión
          </label>
          <textarea type="text"
            id="descripcion"
            name="descripcion"
            placeholder="Descripción de la publicación"
            class="border p-3 w-full rounded-lg @error('description')
              border-red-500
            @enderror"

          >{{ old('descripcion') }}</textarea>

          @error('descripcion')
            <p class="bg-red-500 text-white my-2 p-2 rounded-lg text-sm text-center">
              {{ $message }}
            </p>
          @enderror
        </div>

        <div class="mb-5">
          <input type="hidden"
            name="imagen"
            value="{{ old('imagen')}}"
          />
          @error('imagen')
            <p class="bg-red-500 text-white my-2 p-2 rounded-lg text-sm text-center">
              {{ $message }}
            </p>
          @enderror
        </div>

        <input type="submit"
          value="Crear publicación"
          class="bg-sky-600 hover:bg-sky-700 transition-colors uppercase font-bold cursor-pointer w-full p-3 text-white rounded-lg"
        />
      </form>
    </div>
  </div>
@endsection
