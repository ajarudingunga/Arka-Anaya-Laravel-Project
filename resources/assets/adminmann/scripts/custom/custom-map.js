var mapMarker;
   $(".dataTables_processing").hide();
   $.ajax({
     url: SITE_URL+"user/vehicle/trip-history/trip-json",
     type: "post",
     data: {'trip_id':$('#tripId').val()},
     beforeSend:function(){
       $(".dataTables_processing").show();
     },
     success: function(response){

         $(".dataTables_processing").hide();
         response = JSON.parse(response);
         console.log(response);

         var path= [];
         var bounds = new google.maps.LatLngBounds();
         for(var trip=0;trip<response.tripsummary.length;trip++){
           latlong = (response.tripsummary[trip].latlong).split(',');
           path[trip]={lat:eval(latlong[0]),lng:eval(latlong[1])};
           boundLatLng = new google.maps.LatLng(path[trip]);
           bounds.extend(boundLatLng);
         }

         var map = new google.maps.Map(document.getElementById('gmap_marker'), {
           zoom: 12,
           center: {lat: path[0].lat, lng: path[0].lng},
           mapTypeId: google.maps.MapTypeId.TERRAIN
         });
         var carPath = new google.maps.Polyline({
           path: path,
           geodesic: true,
           strokeColor: '#FF0000',
           strokeOpacity: 1.0,
           strokeWeight: 5
         });
         carPath.setMap(map);
         map.fitBounds(bounds);

     }
   });
