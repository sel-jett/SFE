<template>
  <div class="h-screen w-screen z-10" id="mapContainer"></div>
</template>

<script>
import "leaflet/dist/leaflet.css";
import L from "leaflet";
import "../../../public/leaflet.curve.js";

export default {
  name: "LeafletMap",
  data() {
    return {
      map: null,
    };
  },
  mounted() {
    this.map = L.map("mapContainer").setView([46.05, 11.05], 5);
    L.tileLayer("http://{s}.tile.osm.org/{z}/{x}/{y}.png", {
      attribution:
        '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
    }).addTo(this.map);
    //use a mix of renderers
    var customPane = this.map.createPane("customPane");
    var canvasRenderer = L.canvas({ pane: "customPane" });
    customPane.style.zIndex = 399; // put just behind the standard overlay pane which is at 400
    L.marker([50, 14]).addTo(this.map);

    L.marker([53, 20]).addTo(this.map);
    L.marker([49.5, 19.5]).addTo(this.map);
    L.marker([49, 25]).addTo(this.map);
    L.marker([-10, 25]).addTo(this.map);
    L.marker([10, -25]).addTo(this.map);
    L.marker([0, 0]).addTo(this.map);
    var pathOne = L.curve(["M", [50, 14], "Q", [53, 20], [49, 25]], {
      renderer: canvasRenderer,
    }).addTo(this.map);
    L.curve(["M", [50, 14], "Q", [52, 20], [49, 25]], {
      renderer: canvasRenderer,
    }).addTo(this.map);
    L.curve(["M", [50, 14], "Q", [51, 20], [49, 25]], {
      renderer: canvasRenderer,
    }).addTo(this.map);
    L.curve(["M", [50, 14], "Q", [50, 20], [49, 25]], {
      renderer: canvasRenderer,
    }).addTo(this.map);
    L.curve(["M", [50, 14], "Q", [47, 20], [49, 25]], {
      renderer: canvasRenderer,
    }).addTo(this.map);
  },
  onBeforeUnmount() {
    if (this.map) {
      this.map.remove();
    }
  },
};
</script>
