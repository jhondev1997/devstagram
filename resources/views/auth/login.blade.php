@extends("layouts.app")

@section('title' ,'Iniciar sesión en devstagram')

@section('content')
  <div class="md:flex justify-center md:gap-8 md:items-center p-5">
    <div class="md:w-6/12">
      <img src="{{ asset('img/login.jpg')}}"
        alt="img"
      />
    </div>

    <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-lg">
      <form method="POST" action="{{ route('login') }}" novalidate>
        @csrf

        @if (session('mensaje'))
          <p class="bg-red-500 text-white my-2 p-2 rounded-lg text-sm text-center">
            {{ session('mensaje') }}
          </p>
        @endif

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

        <div class="mb-5 flex gap-x-1">
          <input type="checkbox" name="remember" id="remember"><label
          class="uppercase text-sm text-gray-500"
          for="remember">Mantener sesion</label>
        </div>

        <input type="submit"
          value="Iniciar sesión"
          class="bg-sky-600 hover:bg-sky-700 transition-colors uppercase font-bold cursor-pointer w-full p-3 text-white rounded-lg"
        />
      </form>
    </div>

  </div>
@endsection
