@if(Request::path() != 'contacts')
    <div id="mapdiv" class="map"></div>
    <script src="http://www.openlayers.org/api/OpenLayers.js"></script>
    <script>
        map = new OpenLayers.Map("mapdiv");
        map.addLayer(new OpenLayers.Layer.OSM());

        var pois = new OpenLayers.Layer.Text("My Points",
                {
                    location: "./textfile.txt",
                    projection: map.displayProjection
                });
        map.addLayer(pois);
        // create layer switcher widget in top right corner of map.
        //var layer_switcher= new OpenLayers.Control.LayerSwitcher({});
        // map.addControl(layer_switcher);
        //Set start centrepoint and zoom
        var lonLat = new OpenLayers.LonLat(30.7426, 46.499583)
                .transform(
                        new OpenLayers.Projection("EPSG:4326"), // transform from WGS 1984
                        map.getProjectionObject() // to Spherical Mercator Projection
                );
        var zoom = 11;
        map.setCenter(lonLat, zoom);

        function addMarker(x, y, title) {
            var size = new OpenLayers.Size(23, 25);
            var offset = new OpenLayers.Pixel(-(size.w / 2), -size.h);
            var icon = new OpenLayers.Icon('/images/logo_icon.gif', size, offset);

            var layer = new OpenLayers.Layer.Markers("Markers");
            map.addLayer(layer);

            var marker = new OpenLayers.LonLat(x, y).transform(
                    new OpenLayers.Projection("EPSG:4326"),
                    map.getProjectionObject()
            );

            layer.addMarker(new OpenLayers.Marker(marker, icon));

            layer.events.register('mouseover', marker, function () {
                var popup = new OpenLayers.Popup.FramedCloud("Popup", marker, null, title, null, true);
                map.addPopup(popup, false);
                layer.events.register('mouseout', marker, setTimeout(function () {
                    popup.destroy();
                }, 4000));
            });
        }

        addMarker(30.730315, 46.43711, 'Главный офис. Адмиральский пр, 33а');
        addMarker(30.730281, 46.482146, 'пл. Соборная 12"');
        addMarker(30.7951071, 46.575718, 'Днепропетровская дор., 94');
        addMarker(30.72347, 46.400676, 'ул. Академика Королева, 33');
    </script>
@endif