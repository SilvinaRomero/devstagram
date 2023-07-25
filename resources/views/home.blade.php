@extends('layouts.app')

@section('titulo1')
    Página principal
@endsection
@section('titulo')
    Página principal
@endsection

@section('contenido')
   <x-listar-post :posts="$posts"/>
@endsection
