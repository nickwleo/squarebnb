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
    
                        <div id="map" style="width:100%;height:300px;display:none;"></div>

                        <br>
                        <button type="submit" class="form-control btn btn-success">Create Listing</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- prettier-ignore -->
<script>(g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})
    ({key: "{{ env('MAPS_API_TOKEN', '') }}", v: "weekly"});</script>


<script>

let map;

async function initMap(latitude, longitude) {
    document.getElementById("map").style.display = "block";
    const { Map } = await google.maps.importLibrary("maps");
    map = new Map(document.getElementById("map"), {
    center: { lat: latitude, lng: longitude },
    zoom: 15,
    });
    new google.maps.Marker({
    position: { lat: latitude, lng: longitude },
    map,
    title: "Rental Location",
  });

}

let getCoords = () => {
    $.get("https://maps.googleapis.com/maps/api/geocode/json?address=" + document.getElementById("address").value + "&key={{ env('MAPS_API_TOKEN', '') }}",
    (data) => {
        let coordinates = data.results[0].geometry.location;
        document.getElementById("latitude").value = coordinates.lat;
        document.getElementById("longitude").value = coordinates.lng;
        initMap(coordinates.lat,coordinates.lng);
    });
}

</script>


@endsection
