@extends('layouts.app')

@section('title' ,'Página principal')


@section('content')
  <x-listar-post :posts="$posts" />
@endsection
