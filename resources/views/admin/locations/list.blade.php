@extends('layouts.app')
@section('content')
@extends('auth.nav')
    <div class="admin location content-mt">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h2>Locations</h2></div>
                <div class="col-lg-6 text-right">
                    <a href="/auth/location/create" class="btn btn-success">Create Locations</a>
                </div>
            </div>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Actions</th>
                        <th scope="col">Title</th>
                        <th scope="col">Address</th>
                        <th scope="col">Published</th>
                    </tr>
                </thead>
                @if (count($locations))
                <tbody>
                    @foreach ($locations as $location)
                        <tr>
                            <th scope="row" class="d-flex">
                                <div class="wrap">
                                    <a href="/auth/location/{{ $location->id }}/edit" class="btn btn-primary">Edit</a>
                                </div>
                                <form onsubmit="return confirm('Do you really want to delete this?');" action="/auth/location/{{$location->id}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button class="btn btn-danger">Delete</button>
                                </form>
                            </th>
                            <td>{{ $location->title }}</td>
                            <td></td>
                            <td>{!! $location->published ? '<span class="badge badge-pill badge-success">Yes</span>' : '<span class="badge badge-pill badge-danger">No</span>' !!}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <th>There are no locations right now! Well, get busy and start making some!</th>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection