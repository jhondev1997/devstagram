@extends('layouts.app')

@section('title', 'Editar Perfil: '. auth()->user()->username)

@section('content')
  <div class="md:flex md:justify-center">
    <div class="md:w-1/2 bg-white shadow p-6">
      <form method="POST"
        action="{{ route('perfil.store')}}"
        class="mt-10 md:mt-0"
        enctype="multipart/form-data"
      >
        @csrf
        <div class="mb-5">
          <label for="username" class="mb-2 uppercase font-bold text-gray-500 block">
            Username
          </label>
          <input type="text"
            id="username"
            name="username"
            placeholder="Tu nombre de usuario"
            class="border p-3 w-full rounded-lg @error('username')
              border-red-500
            @enderror"
            value="{{ auth()->user()->username }}"
          />

          @error('username')
            <p class="bg-red-500 text-white my-2 p-2 rounded-lg text-sm text-center">
              {{ $message }}
            </p>
          @enderror
        </div>

        <div class="mb-5">
          <label for="imagen" class="mb-2 uppercase font-bold text-gray-500 block">
            Imagen
          </label>
          <input type="file"
            id="imagen"
            name="imagen"
            class="border p-3 w-full rounded-lg"
            accept=".jpg, .jpeg, .png"
          />

        </div>

        <input type="submit"
          value="Guardar cambios"
          class="bg-sky-600 hover:bg-sky-700 transition-colors uppercase font-bold cursor-pointer w-full p-3 text-white rounded-lg"
        />
      </form>

    </div>
  </div>
@endsection
