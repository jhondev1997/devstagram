@extends("layouts.app")

@section('title' ,'Registrar')

@section('content')
  <div class="md:flex justify-center md:gap-8 md:items-center p-5">
    <div class="md:w-6/12">
      <img src="{{ asset('img/registrar.jpg')}}"
        alt="img"
      />
    </div>

    <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-lg">
      <form action="{{route('register')}}" method="POST">
        @csrf
        <div class="mb-5">
          <label for="name" class="mb-2 uppercase font-bold text-gray-500 block">
            Nombre
          </label>
          <input type="text"
            id="name"
            name="name"
            placeholder="Tu nombre"
            class="border p-3 w-full rounded-lg @error('name')
              border-red-500
            @enderror"
            value="{{ old('name') }}"
          />

          @error('name')
            <p class="bg-red-500 text-white my-2 p-2 rounded-lg text-sm text-center">
              {{ $message }}
            </p>
          @enderror
        </div>

        <div class="mb-5">
          <label for="username" class="mb-2 uppercase font-bold text-gray-500 block">
            Username
          </label>
          <input type="text"
            id="username"
            name="username"
            placeholder="Tu nombre de usuario"
            class="border p-3 w-full rounded-lg @error('username')
            border-red-500 @enderror"
            value="{{ old('username') }}"
          />

          @error('username')
            <p class="bg-red-500 text-white my-2 p-2 rounded-lg text-sm text-center">
              {{ $message }}
            </p>
          @enderror
        </div>

        <div class="mb-5">
          <label for="email" class="mb-2 uppercase font-bold text-gray-500 block">
            Email
          </label>
          <input type="email"
            id="email"
            name="email"
            placeholder="Tu email de registro"
            class="border p-3 w-full rounded-lg @error('email')
            border-red-500
            @enderror"
            value="{{ old('email') }}"
          />

          @error('email')
            <p class="bg-red-500 text-white my-2 p-2 rounded-lg text-sm text-center">
              {{ $message }}
            </p>
          @enderror
        </div>

        <div class="mb-5">
          <label for="password" class="mb-2 uppercase font-bold text-gray-500 block">
            Contraseña
          </label>
          <input type="password"
            id="password"
            name="password"
            placeholder="Password de Registro"
            class="border p-3 w-full rounded-lg @error('password')
            border-red-500
            @enderror"
          />

          @error('password')
            <p class="bg-red-500 text-white my-2 p-2 rounded-lg text-sm text-center">
              {{ $message }}
            </p>
          @enderror
        </div>

        <div class="mb-5">
          <label for="password_confirmation" class="mb-2 uppercase font-bold text-gray-500 block">
            Repetir Contraseña
          </label>
          <input type="password"
            id="password_confirmation"
            name="password_confirmation"
            placeholder="Repetir password"
            class="border p-3 w-full rounded-lg"
          />

        </div>

        <input type="submit"
          value="Crear cuenta"
          class="bg-sky-600 hover:bg-sky-700 transition-colors uppercase font-bold cursor-pointer w-full p-3 text-white rounded-lg"
        />
      </form>
    </div>

  </div>
@endsection
