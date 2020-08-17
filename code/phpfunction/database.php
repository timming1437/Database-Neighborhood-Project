<?php
    $databaseConnection = null;
    function getConnect() {
        $hosthome = "localhost";
        $database = "neighborhood";
        $userName = "root";
        $password = "zty19970318123";
        global $databaseConnection;
        $databaseConnection = @mysqli_connect($hosthome, $userName, $password) or die (mysqli_connect_error());
        #mysqli_query("set names gbk");
        @mysqli_select_db($databaseConnection, $database) or die (mysqli_error($databaseConnection));
    }
    
    function closeConnect() {
        global $databaseConnection;
        if ($databaseConnection) {
            @mysqli_close($databaseConnection) or die (mysqli_error($databaseConnection));
        }
    }

    function createMap(){
        echo "
        <head>
            <style>
            /* Set the size of the div element that contains the map */
            #map {
                height: 400px;  /* The height is 400 pixels */
                width: 100%;  /* The width is the width of the web page */
            }
            </style>
        </head>
        <body>
            <!--The div element for the map -->
            <div id='map'></div>
            <script>
        // Initialize and add the map
        function initMap() {
        // The location of Uluru
        var uluru = {lat: 40.693275, lng: -73.986690};
        // The map, centered at Uluru
        var map = new google.maps.Map(
            document.getElementById('map'), {zoom: 15, center: uluru});
        // The marker, positioned at Uluru
        var marker = new google.maps.Marker({position: uluru, map: map});
        }
        </script>
        <!--Load the API from the specified URL
        * The async attribute allows the browser to render the page while the API loads
        * The key parameter will contain your own API key (which is not needed for this tutorial)
        * The callback parameter executes the initMap() function
        -->
        <script async defer
        src='https://cdn.jsdelivr.net/gh/somanchiu/Keyless-Google-Maps-API@v5.0/mapsJavaScriptAPI.js'>
        </script>";
    }

    function posMap($latitude, $longitude){
        echo "
        <head>
            <style>
            /* Set the size of the div element that contains the map */
            #map {
                height: 400px;  /* The height is 400 pixels */
                width: 100%;  /* The width is the width of the web page */
            }
            </style>
        </head>
        <body>
            <!--The div element for the map -->
            <div id='map'></div>
            <script>
        // Initialize and add the map
        function initMap() {
        // The location of Uluru
        var uluru = {lat: $latitude, lng: $longitude};
        // The map, centered at Uluru
        var map = new google.maps.Map(
            document.getElementById('map'), {zoom: 15, center: uluru});
        // The marker, positioned at Uluru
        var marker = new google.maps.Marker({position: uluru, map: map});
        }
        </script>
        <!--Load the API from the specified URL
        * The async attribute allows the browser to render the page while the API loads
        * The key parameter will contain your own API key (which is not needed for this tutorial)
        * The callback parameter executes the initMap() function
        -->
        <script async defer
        src='https://cdn.jsdelivr.net/gh/somanchiu/Keyless-Google-Maps-API@v5.0/mapsJavaScriptAPI.js'>
        </script>";
    }

    function clickMap(){
        echo "
        <head>
            <style>
            /* Set the size of the div element that contains the map */
            #map {
                height: 400px;  /* The height is 400 pixels */
                width: 100%;  /* The width is the width of the web page */
            }
            </style>
        </head>
        <body>
            <!--The div element for the map -->
            <div id='map'></div>
            <script>
        // Initialize and add the map
        function initMap() {
        // The location of Uluru
        var uluru = {lat: 40.693275, lng: -73.986690};
        // The map, centered at Uluru
        var map = new google.maps.Map(
            document.getElementById('map'), {zoom: 15, center: uluru});
        // The marker, positioned at Uluru

        markers = [];
        function clearOverlays() {
            while(markers.length) { markers.pop().setMap(null); }
            markers.length = 0;
        }
        
        var latitude = 0;
        var longitude = 0;

        map.addListener('click', function(e) {
            clearOverlays();
            placeMarker(e.latLng, map);
            latitude = e.latLng.lat();
            longitude = e.latLng.lng();
        });

        function placeMarker(position, map) {
            var marker = new google.maps.Marker({
                position: position,
                map: map
            });
            markers.push(marker);
            map.panTo(position);
        }
       
        }
        </script>
        
        <!--Load the API from the specified URL
        * The async attribute allows the browser to render the page while the API loads
        * The key parameter will contain your own API key (which is not needed for this tutorial)
        * The callback parameter executes the initMap() function
        -->
        <script async defer
        src='https://cdn.jsdelivr.net/gh/somanchiu/Keyless-Google-Maps-API@v5.0/mapsJavaScriptAPI.js'>
        </script>";
    }
?>