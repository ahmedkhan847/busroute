/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var urlloc = "http://metroapp.fashionwalla.com/busalgo.php";
var latlong = [];
latlong[0] = "latitude longitude";
//var bodys = Document.getElementsByTagName('body');

$(document).ready(init());

function init()
{
     $.ajax(
    {
        // Post select to url.
        type : 'post',
        url : urlloc,
        dataType : 'json', // expected returned data format.
        data : 
        {
                'loc1' : localStorage.getItem('loc1'),
                "loc2" : localStorage.getItem('loc2') // the variable you're posting.
        },
        success : function(data){
            
            //datas = $.parseJSON(data);
            //console.log(datas);
                loadloc(data);
            
        }
    });
    
    localStorage.setItem('loc1',' ')
    localStorage.setItem('loc2',' ')
}
