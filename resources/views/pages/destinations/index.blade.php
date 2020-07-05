@extends('layouts.app')
@section('title', 'Virac Special | Destinations')
@section('content')
    <destinations class="content-mt"
          :locations='@json($locations)'
          :google-api-key='@json(config('services.google.key'))'
    ></destinations>
@endsection
