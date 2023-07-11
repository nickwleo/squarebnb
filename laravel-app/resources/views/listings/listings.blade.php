@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Listings') }}</div>

                <div class="card-body">
                    <button class="form-control btn btn-success" onclick="window.location='/listings/create'">Create New Listing</button>
                    <p>
                        <br>
                        This is the listings page.
                    </p>
                    <table class="table">
                        <thead>
                            <tr><td>Listing Title</td><td>Description</td></tr>
                        </thead>
                        <tbody>
                            @foreach ($listings as $listing)
                                <tr><td>{{ $listing->name }}</td><td>{{ $listing->description }}</tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection