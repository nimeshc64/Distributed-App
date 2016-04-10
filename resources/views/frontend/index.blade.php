@extends('frontend.layouts.master')

@section('content')
    <div class="row">
        <div class="wide">
            <div class="col-xs-5 line"><hr></div>
            <div class="col-xs-2 logo"></div>
            <div class="col-xs-5 line"><hr></div>


            <div class="carousel-caption ">
                <p class="site_name">DISLERT</p>
                <p><h4>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi non quis exercitationem </h4></p>

                <p style="margin-top: 160px;">Scroll Down To Check Your Area Safe!</p>
                <a class="arrow-wrap" href="#" onclick="$('#map').animatescroll({scrollSpeed:3000,easing:'easeOutCubic'});">
                    <span class="arrow"></span>
                </a>
            </div>
        </div>
    </div><!--row-->

    <div class="row" >
        <div class="">
            <div class="clearfix"></div>
            <div id="a"></div>
            <div id="map"></div>

            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC0VNngrDJcJB5fXjoU40-hspXMamVKb8k"></script>

            <script>
                var mapLocationMarkers = [];

            </script>
            <script>
                var geocoder;
                var map;
                function initialize() {
                    geocoder = new google.maps.Geocoder();
                    var latlng = new google.maps.LatLng(7.0000, 81.0000);
                    var mapOptions = {
                        zoom: 8,
                        center: latlng
                    }
                    map = new google.maps.Map(document.getElementById("map"), mapOptions);
                    getlocationDetails();
                }
                function getlocationDetails() {

                    var locationtrack = function () {
                        var mapLocationMarkers = [];
                        var locationID=[];
                        var disasterName=[];
                        var disasterImg=[];
                        $.ajax({
                            'async': false,
                            'type': "GET",
                            'global': false,
                            'dataType': 'json',
                            url: '../findalert',
                            'success': function (data) {
                               // console.log(data);
                                for (index in data) {
                                    mapLocationMarkers.push(data[index].Area_name);
                                    locationID.push(data[index].A_id);
                                    $.ajax({
                                        'async': false,
                                        'type': "GET",
                                        'global': false,
                                        'dataType': 'json',
                                        url: '../disasterbyid',
                                        'success': function (data) {
                                            // console.log(data);
                                            for (index in data) {
                                               // mapLocationMarkers.push(data[index].Area_name);
                                                disasterName.push(data[index].Disaster_Name);
                                                disasterImg.push(data[index].img);
                                            }

                                        }
                                    });

                                }

                            }
                        });
                        markLocations(mapLocationMarkers,locationID,disasterName,disasterImg);
                        return mapLocationMarkers;
                    }();

                }

                function markLocations(locationdata,locaID,disasterName,disasterImg){

                    var locations = locationdata;
                    var locaid=locaID;

                    var nooflocations = locations.length;

                    for(var i=0;i<nooflocations;i++){
                        codeAddress(locations[i],locaid[i],disasterName[i],disasterImg[i]);
                    }
                }
                function codeAddress(address,locaid,disasterName,disasterImg) {

                    geocoder.geocode( { 'address': address}, function(results, status) {
                        if (status == google.maps.GeocoderStatus.OK) {

                            map.setCenter(results[0].geometry.location);
                            var marker = new google.maps.Marker({
                                map: map,
                                position: results[0].geometry.location,
                                icon: disasterImg,
                                title:disasterName,
                                id: locaid,
                                name:address
                            });


                            marker.addListener('click', function() {

                                var Mid=marker.id;

                                $.ajax({
                                    'async': false,
                                    'type': "GET",
                                    'global': false,
                                    'dataType': 'json',
                                    url: '../Alertbyid/',
                                    data: {id:Mid},
                                    'success': function (data) {

                                            var contentString = '<div id="content">'+
                                                    '<div id="siteNotice">'+
                                                    '</div>'+
                                                    '<h1 id="firstHeading" class="firstHeading" style="text-align: center;">'+marker.name+'</h1>'+
                                                    '<div id="bodyContent">'+
                                                    '<p><b>Alert Message :</b> '+ data.ALmessage+'</p>'+
                                                    '<p><b>Alert Date :</b> '+ data.ALdate+'</p>'+
                                                    '<p><b>Risk Level :</b> '+ data.ALriskLevel+'</p>'+
                                                    '<p><b>Safe Location :</b> '+ data.ALsafeLocation+'</p>'+
                                                    '</div>'+
                                                    '</div>';

                                            var infowindow = new google.maps.InfoWindow({
                                                content: contentString,
                                            });

                                            infowindow.open(map, marker);

                                            setTimeout(function ()
                                            {
                                                infowindow.close();
                                            }, 5000);
                                        //}

                                    }
                                });


                            });

                        } else {
                            alert("Geocode was not successful for the following reason: " + status);
                        }
                    });
                }

                google.maps.event.addDomListener(window, 'load', initialize);
            </script>

        </div>
    </div>
    <div class="scroll-top-wrapper " id="toTop">
	        <span class="scroll-top-inner">
		        <i class="fa fa-4x fa-arrow-circle-up"></i>
	        </span>
    </div>

    @include('frontend.includes.foot')
  @endsection

@section('after-scripts-end')
    <script>
        $(document).ready(function () {


        })
    </script>
@stop