var urlloc = "http://metroapp.fashionwalla.com/allloc.php";
var latlong = [];
latlong[0] = "latitude longitude";
//var bodys = Document.getElementsByTagName('body');
var datas="";

$(document).ready(function(){
    
    
    
    init();
    
   
    });

function init()
{
     
   // $('#main').hide();
    //var html = ' <div class="preloader-wrapper big active"><div class="spinner-layer spinner-blue"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div></div></div>'
   // $('body').append(html);
   localStorage.clear();
     $.ajax(
    {
        // Post select to url.
        type : 'post',
        url : urlloc,
        async : false,
        dataType : 'json', // expected returned data format.
        success : function(data){
            
            //datas = $.parseJSON(data);
            //console.log(datas);
             
            datas = data;
        },
        complete : function(data)
        {
             loadloc(datas);
        }
        
    });

  
        
}

//Loading Data in Select
function loadloc(data) {
	$('#loc1').empty().html(' ');
	$('#loc2').empty().html(' ');
	var values,names;
	$.each(data, function (key, value) {
	
	
	if (typeof(Storage) != "undefined") {
    // Store
   // latlong[key] = new google.maps.LatLng(value.latitude,value.longitude);
    //localStorage.setItem(key, new google.maps.LatLng(value.latitude,value.longitude));
  
 
} else {
     //latlong[key] = new google.maps.LatLng(value.latitude,value.longitude);
}
  values = key;
	 names  = value.name;
	$('#loc1').append(
      $("<option></option>")
        .attr("value",values)
        .text(names)
    );
	
	
	
	$('#loc1').material_select();
	
	
	});
	//$('#loc1').trigger('contentChanged');
	$.each(data, function (key, value) {
	
	
	 values = key;
	 names  = value.name;
	
	$('#loc2').append(
      $("<option></option>")
        .attr("value",values)
        .text(names)
    );
	
	
	$('#loc2').material_select();
	
	
	
	});
	
	
}
function search()
    {
        
        var loc1 = $('#loc1').val();
        var loc2 = $('#loc2').val();
        
         localStorage.setItem('loc1',loc1);
         localStorage.setItem('loc2',loc2);
            // similar behavior as clicking on a link
window.location.href = "map_page.html";
    
    }

