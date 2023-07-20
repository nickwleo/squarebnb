@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $listing->name }}</div>

                <div class="card-body">
                    <h4>{{ $listing->description }}</h4>
                    <h4>{{ $listing->address }}</h4>
                    <div id="map" style="width:100%;height:300px;display:none;"></div>
                    <br>
                    <h4>Image Stored on Cloudinary via Their API (if provided)</h4>
                    <p><img style="width:100%;height:auto;" src="{{ $listing->cloudinary_image_url }}"/></p>
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

async function initMap() {
    document.getElementById("map").style.display = "block";
    const { Map } = await google.maps.importLibrary("maps");
    map = new Map(document.getElementById("map"), {
    center: { lat: {{ $listing->lat }}, lng: {{ $listing->lng }} },
    zoom: 15,
    });
    new google.maps.Marker({
    position: { lat: {{ $listing->lat }}, lng: {{ $listing->lng }} },
    map,
    title: "Rental Location",
  });
}

initMap();

</script>


@endsection