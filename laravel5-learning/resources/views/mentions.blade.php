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
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/style.css">  
  <script type="text/javascript" src="js/index.js"></script>
</head>
<body >
<nav class="navbar navbar-default  navbar-local">
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
      <ul class="nav nav-pills nav-stacked" >
        <li><a class="menu-asside active" href="medicine/laravel5-learning/public/">Home</a></li>
        <li class="active"><a class="menu-asside" style="background-color: #535353; href="medicine/laravel5-learning/public/reviews/">Reviews</a></li>
        <li><a class="menu-asside" href="medicine/laravel5-learning/public/news/">News</a></li>
        <li><a class="menu-asside" href="medicine/laravel5-learning/public/support/">Support</a></li>
        <li><a class="menu-asside" href="medicine/laravel5-learning/public/medic/">Medic</a></li>
        <li><a class="menu-asside" href="medicine/laravel5-learning/public/appointment/">Make an appointment</a></li>
      </ul><br>
    </div>
<div class="container-fluid">
  <div class="row content">
    <div class="col-sm-9">
      <h3><small>Reviews</small></h3>
      <hr>
      @if($_COOKIE["cookiePatient"] != " ")
      <h4>Leave a Comment:</h4>
      <form role="form">
      {!! csrf_field() !!}
        <div class="form-group">
           <textarea class="form-control" id="commentArea" rows="3" required></textarea>
           <label for="sel1">Quality of service:</label>
           <select class="form-control" name = "quality" id="valuation" id="sel1">
              <option value="Excellent">Excellent</option>
              <option value="Good">Good</option>
              <option value="Normal">Normal</option>
              <option value="Bad">Bad</option>
              <option value="Disgustingly">Disgustingly</option>
           </select>
        </div>
        <button type="button" id="postMention" class="btn btn-success">Submit</button>
      </form>
      @endif
      <br><br>
      
      
      <div class="row" id="commentBlock">
      @foreach ($comments as $comment)

        <div class="col-sm-10">
        <h4>{{ $comment->name_patient }} <small>{{ $comment->created_at }}</small></h4>
          <h5><span class="label label-danger">Valuation: </span><span class="label label-primary">{{ $comment->valuation }}</span></h5>
          <p>{{ $comment->content }}</p>
          <br>
        </div>
      @endforeach
      </div>
    </div>
   
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
            <input id="login" type="text" class="form-control" name="login" placeholder="Login">
          </div>
          <span id="messageLogin"><br></span>
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input id="name" type="text" class="form-control" name="name" placeholder="Name">
          </div>
          <span id="messageName"><br></span>
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input id="email" type="text" class="form-control" name="email" placeholder="Email">
          </div>
          <span id="messageEmail"><br></span>
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
            <input id="password" type="password" class="form-control" name="password" placeholder="Password">
          </div>
          <span id="messagePassword"><br></span>
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-plus-sign"></i></span>
            <input id="age" type="number" class="form-control" name="age" placeholder="Age">
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
<div class="panel-footer" id="footer-local">From Yurii Pilnik 2017</div>
</body>
</html>

