@extends('layouts.app')
@section('content')
    <destinations class="content-mt"
          :locations='@json($locations)'
          :google-api-key='@json(config('services.google.key'))'
    ></destinations>
@endsection
