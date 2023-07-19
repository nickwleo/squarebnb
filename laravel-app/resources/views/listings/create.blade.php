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
                        <label for="address">Complete Address</label>
                        <input class="form-control" id="address" name="address" type="text" />
                        <br>
                        <button type="button" onclick="getCoords()" class="form-control btn btn-primary">Get Address Coordinates</button>
                        <br>
                        <br>
                        <label for="description">Latitude (auto-populated)</label>
                        <input class="form-control" id="latitude" name="latitude" type="text" />
                        <br>
                        <label for="description">Longitude (auto-populated)</label>
                        <input class="form-control" id="longitude" name="longitude" type="text" />
                        <br>
                        <button type="submit" class="form-control btn btn-success">Create Listing</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>

let getCoords = () => {
    $.get("https://maps.googleapis.com/maps/api/geocode/json?address=" + document.getElementById("address").value + "&key={{ env('MAPS_API_TOKEN', '') }}",
    (data) => {
        let coordinates = data.results[0].geometry.location;
        document.getElementById("latitude").value = coordinates.lat;
        document.getElementById("longitude").value = coordinates.lng;
    });
}

</script>
