@extends('layouts.app')
@section('content')
    <destinations class="content-mt" :locations='@json($locations)'></destinations>
@endsection
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDCgfYv0ufxgizhpYSHibG4JENvJpchrGE"
            async defer></script>
