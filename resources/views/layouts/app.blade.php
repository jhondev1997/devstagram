<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Laravel | @yield('title')</title>
  @stack('styles')
  {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
  @vite('resources/css/app.css')

  @livewireStyles
</head>

<body class="bg-gray-100">
  <header class="p-5 border-b bg-white shadow sticky top-0">
    <div class="flex container justify-between items-center mx-auto">

      <a href="{{ route('home')}}">
        <h1 class="text-3xl font-black" id="name_page">Devstagram</h1>
      </a>

      {{-- @if (auth()->user())
      <p>autenticado</p>
      @else
      <p>no autenticado</p>
      @endif --}}

      @auth
      <nav class="flex gap-2 items-center">
        <a href="{{ route('posts.create')}}"
          class="flex items-center gap-2 bg-white hover:bg-slate-50 border p-2 text-gray-600 rounded text-sm uppercase font-bold cursor-pointer">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" />
          </svg>

          Crear
        </a>

        <a class="font-bold text-sm text-gray-600" href="{{ route('posts.index', auth()->user()->username)}}">
          Hola: <span class="font-normal">{{auth()->user()->username}}</span>
        </a>

        <form action="{{route('logout') }}" method="POST">
          @csrf
          <button class="font-bold uppercase text-sm text-gray-600" type="submit">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
            </svg>
          </button>
        </form>
      </nav>
      @endauth

      @guest
      <nav class="flex gap-2 items-center">
        <a class="font-bold uppercase text-sm text-gray-600" href="{{ route('login') }}">Login</a>
        <a class="font-bold uppercase text-sm text-gray-600" href="{{ route('register')}}">Crear cuenta</a>
      </nav>
      @endguest
    </div>
  </header>


  <main class="container mx-auto mt-10">
    <h2 class="font-black text-center text-3xl mb-10">
      @yield('title')
    </h2>
    @yield('content')
  </main>

  <footer class="mt-10 text-xl text-center font-bold  relative bottom-0">
    Jhon Cruz - todos los derechos reservados

    {{ now()->year }}
  </footer>

  @livewireScripts

  @vite('resources/js/lowModifiers/namePage.js')

</body>

</html>
