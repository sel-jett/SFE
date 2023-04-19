<template>
  <div class="h-screen w-screen z-10" id="mapContainer"></div>
</template>

<script>
import "leaflet/dist/leaflet.css";
import L, { PolyUtil, map, marker } from "leaflet";
import "../../../public/leaflet.curve.js";
import { onMounted, ref } from 'vue';
import markerIcon from "../../../public/images/icons/map-marker-red.svg";

export default {
  name: "LeafletMap",
  setup () {
    let mymap;
    onMounted(() => {
      mymap = L.map('mapContainer').setView([51.505, -0.09], 13);
      L
        .tileLayer(
          "https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1Ijoic2FsYWhqZXR0aW91aSIsImEiOiJjbGdsMXgxYzEwNXdpM2VxaWdneDRhZHN3In0.9LkUVnRagdHkMm1vXWnmyg",
          {
            attribution:
              'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: "mapbox/streets-v11",
            tileSize: 512,
            zoomOffset: -1,
            accessToken:
              "pk.eyJ1Ijoic2FsYWhqZXR0aW91aSIsImEiOiJjbGdsMXgxYzEwNXdpM2VxaWdneDRhZHN3In0.9LkUVnRagdHkMm1vXWnmyg",
          }          
        )
        .addTo(mymap);

        getGeolocation();
    });

    const coords = ref(null);
    const fetchCoords = ref(null);
    const geoMarker = ref(null);

    const getGeolocation = () => {
      fetchCoords.value = true;
      navigator.geolocation.getCurrentPosition(setCoords, getLocError)
    };

    const setCoords = (pos) => {
      fetchCoords.value = true;
      console.log(pos); 

      const setSessionCoords = {
        lat: pos.coords.latitude,
        lng: pos.coords.longitude, 
      };
      sessionStorage.setItem('coords',  JSON.stringify(setSessionCoords));

      coords.value = setSessionCoords;

      plotGeolocation(coords.value);
    };

    const plotGeolocation = (coords) => {
      const customMarker = L.icon({
        iconUrl: markerIcon,
        iconSize: [35, 35],
      });

      geoMarker.value = L.marker([coords.lat, coords.lng], {
        icon: customMarker
      }).addTo(mymap);

      mymap.setView([coords.lat, coords.lng], 5)
    }

    const getLocError = (err) => {
      console.log(err);
    };

    return { coords, geoMarker };
  },
};
</script>
