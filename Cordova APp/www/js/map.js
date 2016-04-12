var urlbus="http://metroapp.fashionwalla.com/busalgo.php";
var urlloc = "http://metroapp.fashionwalla.com/allloc.php";
var latlong = [];
latlong[0] = "latitude longitude";
var ways = [];
var busnames = [];
var buscount = 0;
var map,a,b;
var directionsDisplay;
var directionsService = new google.maps.DirectionsService();
$(document).ready(getbuses());

function initialize() {
  var myLatlng = new google.maps.LatLng(25.0111453,67.0647043);
  directionsDisplay = new google.maps.DirectionsRenderer();
  var mapOptions = {
    zoom: 10,
    center: myLatlng
  }
  var map = new google.maps.Map(document.getElementById('map-holder'), mapOptions);
   
  directionsDisplay.setPanel(document.getElementById("directionpanel"));
  directionsDisplay.setMap(map);
}


//Getting Busses From The Server
function getbuses()
{
     
    
    a = localStorage.getItem('loc1');
    b = localStorage.getItem('loc2');

    $.ajax(
    {
        // Post select to url.
        type : 'post',
        async : false,
        crossDomain: true,
        url : urlbus,
        dataType : 'json', // expected returned data format.
        data : 
        {
                'loc1' : a,
                "loc2" : b // the variable you're posting.
        },
        success : function(data){
            
            //datas = $.parseJSON(data);
           loadloc(data);
        }, //end of success,
        complete : function(data)
        {
           
        },
        error : function(errors)
        {
         
        }
        
    }); //end of ajax
    
     




}//end of get buses function

//Loading Latitude And Longitude From Database
function loadloc(datas)
{
  $.ajax(
    {
        // Post select to url.
        type : 'post',
        async : false,
        crossDomain: true,
        url : urlloc,
        dataType : 'json', // expected returned data format.
        success : function(data){
            
            $.each(data, function (key, value) {
              
              latlong[key] = new google.maps.LatLng(value.latitude,value.longitude);
            });
        },
        complete : function(data)
        {
            
        }
        
    });
    change(datas); 
}

//Loading Buses In The Div
function change(data)
{
    var waypoint = [];
    
     console.log(data);
     var busname = "";
$.each(data, function (key, value) {
    
  busname = value.busname;

$('#lists').append("<li class='collection-item'> <button class='btn' id='"+value.busname+"' onclick='busone(id)'>"+value.busname +"</button></li>");


 
    for(var i = 0; i < value.route.length; i++ )
   {
       var c = value.route[i];
      // if($.inArray(latlong[c],waypoint) === -1 )
       //{
           waypoint.push(
                   {
            location:   latlong[c],
            stopover : true
           
            }
                   );
           
           //waypoint.push();
                                 
            // console.log(ways[count]);
               
        //}
   }
   ways[busname] = waypoint;
   waypoint = [];
});

console.log(ways);

}





function busone(names)
{
  
 var name =  names;   
    route(a,b,ways[name]);
}

//Direction and Route in Map
function route(a,b,waypoint)
{
            // Get Latitude and Longitude of The Required Places
    var start = latlong[a];  //latlong[a];
    var end = latlong[a]; //latlong[b];
    
    //map.setCenter(flightPlanCoordinates[0]);
   //  waypoint = getbuses(a,b);
var request = {
    origin:start,
    destination:end,
    waypoints: waypoint,
   optimizeWaypoints: true,
    travelMode: google.maps.TravelMode.DRIVING
  };
  directionsService.route(request, function(response, status) {
    if (status == google.maps.DirectionsStatus.OK) {
      directionsDisplay.setDirections(response);
    }
  });
/*for(var i = 0; i<busnames.length;i++)
{
    
}*/

}//end of for

$('#getmap').click(function(event) {
  event.preventDefault();
  getbuses();
});


google.maps.event.addDomListener(window, 'load', initialize);
