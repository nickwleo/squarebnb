@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Listing') }}</div>

                <div class="card-body">
                    <form action="/listings" method="POST">
                        @csrf
                        <label for="name">Listing Title</label>
                        <input class="form-control" id="name" name="name" type="text" />
                        <br/>
                        <label for="description">Listing Description</label>
                        <input class="form-control" id="description" name="description" type="text" />
                        <br>
                        <button type="submit" class="form-control btn btn-success">Create Listing</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
