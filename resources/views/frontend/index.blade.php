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
            <div id="map"></div>
            <script>
                var map;
                function initMap() {
                    map = new google.maps.Map(document.getElementById('map'), {
                        center: {lat: 8.26420, lng: 80.30956},
                        zoom: 8
                    });
                }
            </script>
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC0VNngrDJcJB5fXjoU40-hspXMamVKb8k&callback=initMap"
                    async defer></script>
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
        //Being injected from FrontendController
        console.log(test);
    </script>
@stop