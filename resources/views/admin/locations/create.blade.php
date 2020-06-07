@extends('layouts.app')
@section('content')
@extends('auth.nav')
    <div class="admin location content-mt">
        <div class="container mt-lg-5">
            <div class="card">
                <div class="card-body">
                    <h2>Create Location</h2>
                    <form action="/auth/location" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" name="title">
                            <small class="form-text text-muted">John's Resto and Bar</small>
                        </div>

                        <div class="form-group">
                            <input type="submit" value="Create" class="btn btn-success">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection