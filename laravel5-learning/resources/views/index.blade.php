<!DOCTYPE html>
<html lang="en">
<head>
 <title>Hospital</title>
 <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/themes/ui-darkness/jquery-ui.css" rel="stylesheet">
<script type="text/javascript">
  
     function initialize() {
            var mapOptions = {
                center: new google.maps.LatLng(51.5054801,31.3346588),
                zoom: 18,
                scrollwheel: false,
                draggable: true,
                panControl: true,
                zoomControl: true,
                mapTypeControl: true,
                scaleControl: true,
                streetViewControl: true,
                overviewMapControl: true,
                rotateControl: true,

            };
            var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
        }
        google.maps.event.addDomListener(window, 'load', initialize);
</script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/style.css">  
  <script type="text/javascript" src="js/index.js"></script>
</head>
<body onload="initialize();">
<nav class="navbar navbar-default navbar-local">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#" id="title">Hospital of Chernigiv</a>
    </div>
    <ul class="nav navbar-nav navbar-right">
      <li><a id="text-menu" class="buttonReg" data-toggle="modal" data-target="#myModal" href="#"><span class="glyphicon glyphicon-user"></span> Registration</a></li>
      @if($_COOKIE["cookiePatient"] == " ")
        <li><a data-toggle="modal" data-target="#myModalLogin"  id="text-menu" href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      @else
         <li><a id="text-menu" href="#" class="logOut"><span class="glyphicon glyphicon-log-out"></span> Login Out</a></li>
      @endif
    </ul>
  </div>
</nav>
 <div class="col-sm-3 sidenav">
      <ul class="nav nav-pills nav-stacked">
        <li class="active"><a style="background-color: #535353;" class="menu-asside active" href="medicine/laravel5-learning/public/">Home</a></li>
        <li><a class="menu-asside" href="medicine/laravel5-learning/public/reviews/">Reviews</a></li>
        <li><a class="menu-asside" href="medicine/laravel5-learning/public/news/">News</a></li>
        <li><a class="menu-asside" href="medicine/laravel5-learning/public/support/">Support</a></li>
        <li><a class="menu-asside" href="medicine/laravel5-learning/public/medic/">Medic</a></li>
        <li><a class="menu-asside" href="medicine/laravel5-learning/public/appointment/">Make an appointment</a></li>
      </ul><br>
    </div>
<div class="container-fluid">
  <div class="row content">
    <div class="col-sm-9">
         <h3><small>Home</small></h3>
        <hr>
      <div class="panel-body" id="panel-content"><p>In the 1950’s, Warrensville Heights was mostly farmland with sheep grazing on the open pastures. Two groups of enterprising physicians toured the landscape and purchased acreage for two different kinds of hospitals. Each dreamed of achieving new levels of accessibility and quality in the delivery of healthcare for the rapidly growing community.
</p>
<p>Brentwood Hospital and Suburban Community Hospital both opened in 1957 as next-door neighbors, separated by a creek. Their two different approaches to patient care were innovative, but also sources of early rivalry. While competition for patients was fierce, the physicians also consulted each other on various medical issues and cases in the best interests of the surrounding communities.
</p>
<p>After many years of commitment to patient care excellence, the two small hospitals merged to form South Pointe Hospital, which continues to serve the community’s healthcare needs. As a teaching hospital, South Pointe passes its legacy of commitment onto new generations of visionary physicians.
</p>

<img src="images/hospital.jpg" class="img-rounded" id="imageHospital" alt="Cinque Terre" width="40%"> 
<p>
In the 1950’s, Warrensville Heights was mostly farmland with sheep grazing on the open pastures. Two groups of enterprising physicians toured the landscape and purchased acreage for two different kinds of hospitals. Each dreamed of achieving new levels of accessibility and quality in the delivery of healthcare for the rapidly growing community.
</p>
<p>Brentwood Hospital and Suburban Community Hospital both opened in 1957 as next-door neighbors, separated by a creek. Their two different approaches to patient care were innovative, but also sources of early rivalry. While competition for patients was fierce, the physicians also consulted each other on various medical issues and cases in the best interests of the surrounding communities.
</p>
<p>After many years of commitment to patient care excellence, the two small hospitals merged to form South Pointe Hospital, which continues to serve the community’s healthcare needs. As a teaching hospital, South Pointe passes its legacy of commitment onto new generations of visionary physicians.</p></div>
<div class="container-fluid" style='background-color: #F5F5F5; margin-top: 5px' >
  <h2 class="text-center">CONTACT</h2>
  <div class="row">
    <div class="col-sm-5">
      <p>Contact us and we'll get back to you within 24 hours.</p>
      <p><span class="glyphicon glyphicon-map-marker"></span> Chernigiv, Ukraine</p>
      <p><span class="glyphicon glyphicon-phone"></span> +380930000000</p>
      <p><span class="glyphicon glyphicon-envelope"></span> myemail@something.com</p>
    </div>
    <div class="col-sm-7">
      <div class="row">
        <div class="col-sm-6 form-group">
          <input class="form-control" id="name" name="name" placeholder="Name" type="text" required>
        </div>
        <div class="col-sm-6 form-group">
          <input class="form-control" id="email" name="email" placeholder="Email" type="email" required>
        </div>
      </div>
      <textarea class="form-control" id="comments" name="comments" placeholder="Comment" rows="5"></textarea><br>
      <div class="row">
        <div class="col-sm-12 form-group">
          <button class="btn btn-default pull-right" type="submit">Send</button>
        </div>
      </div>
    </div>
  </div>
</div> 
    <div id="map-canvas"></div>   
    <!--Google Maps API-->

    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDnycWatbGyK6ldFqErjFtko1yeMclNUOA&callback=initMap"></script>
</div>

</div>

 
  
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Enter the data for Registration</h4>
        </div>
        <div class="modal-body">
          <form action="postRegistration/" method="post">
          {!! csrf_field() !!}
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input id="logins" type="text" class="form-control" name="login" placeholder="Login">
          </div>
          <span id="messageLogin"><br></span>
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input id="names" type="text" class="form-control" name="name" placeholder="Name">
          </div>
          <span id="messageName"><br></span>
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input id="emails" type="text" class="form-control" name="email" placeholder="Email">
          </div>
          <span id="messageEmail"><br></span>
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
            <input id="passwords" type="password" class="form-control" name="password" placeholder="Password">
          </div>
          <span id="messagePassword"><br></span>
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-plus-sign"></i></span>
            <input id="ages" type="number" class="form-control" name="age" placeholder="Age">
          </div>
          <span id="messageAge"><br></span>
          <input type="button" id="submitRegData"  class="btn btn-success" value="Submit">
          <!-- <button >Submit</button> -->
        </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default"  data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  <div class="modal fade" id="myModalLogin" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Enter login and password</h4>
        </div>
        <div class="modal-body">
           <form action="loginPatient/" method="post">
          {!! csrf_field() !!}
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input id="loginLog" type="text" class="form-control" name="loginLog" placeholder="Login">
          </div>
          <span id="messageLoginLog"><br></span>
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
            <input id="passwordLog" type="password" class="form-control" name="passwordLog" placeholder="Password">
          </div>
          <span id="messagePasswordLog"><br></span>
          <input type="button" id="submitLoginData"  class="btn btn-success" value="Login">
          <!-- <button >Submit</button> -->
        </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default"  data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>
  
            

 



<div class="panel-footer" id="footer-local" >From Yurii Pilnik 2017
</div>
</body>
</html>

