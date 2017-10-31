<!DOCTYPE html>
<html lang="en">
<head>
 <title>Hospital</title>
  <meta charset="utf-8">
   <meta name="csrf-token" content="{{ csrf_token() }}">
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
<nav class="navbar navbar-default navbar-local">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#" id="title">Hospital of Chernigiv</a>
    </div>
    <ul class="nav navbar-nav navbar-right">
        @if($_COOKIE["cookieSupport"] == " ")
           <li><a data-toggle="modal" data-target="#supportModalLogin"  id="text-menu" href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>  
        @else
          <li><a class="supportModalLogOut"  id="text-menu" href="#"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>  
        @endif      
    </ul>
  </div>
</nav>
 <div class="col-sm-3 sidenav">
      <ul class="nav nav-pills nav-stacked">
        <li ><a  class="menu-asside active" href="medicine/laravel5-learning/public/">Home</a></li>
        <li><a class="menu-asside" href="medicine/laravel5-learning/public/reviews/">Reviews</a></li>
        <li><a class="menu-asside" href="medicine/laravel5-learning/public/news/">News</a></li>
        <li class="active"><a style="background-color: #535353;" class="menu-asside active" href="medicine/laravel5-learning/public/support/">Support</a></li>
        <li><a class="menu-asside" href="medicine/laravel5-learning/public/medic/">Medic</a></li>
        <li><a class="menu-asside" href="medicine/laravel5-learning/public/appointment/">Make an appointment</a></li>
      </ul><br>
      
</div>
<div class="container-fluid">
  @if($_COOKIE["cookieSupport"] == " ")
       <h1>The page is not avialable</h1>
  @else
    <div class="row content">
    <div class="col-sm-9">
      <h3><small>News</small></h3>
      <hr>
       <div class="panel panel-default">
          <div class="panel-heading">Leave a News:</div>
          <div class="panel-body">
            <form role="form">
              {!! csrf_field() !!}
              <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input id="titles" type="text" class="form-control" name="titles" placeholder="Title">
              </div><br>
                <span id="messageTitle"></span>
                <textarea class="form-control glyphicon glyphicon-user" id="news" rows="3" placeholder="News" required></textarea>
                <span id="messageNews"></span>
              </div>
              <button type="button" id="postNews" class="btn btn-success">Submit</button>
            </form>
          </div>
      </div>
      <h3><small>Applications of the doctor</small></h3>
      <hr>
      @foreach ($requests as $request)
          <div class="panel-group" id="accordion">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $request->id }}">Request №{{ $request->id }}</a>
                </h4>
              </div>
              <div id="collapse{{ $request->id }}" class="panel-collapse collapse ">
                <div class="panel-body">
                  <h5><span class="glyphicon glyphicon-time"></span> Post by {{ $request->fio }}, {{ $request->created_at }}.</h5>
                  <p class="bg-info">{{ $request->description }}</p>
                  <h5><span class="glyphicon glyphicon-education"></span> Specialty: {{ $request->specialty }}.</h5>
                  <h5><span class="glyphicon glyphicon-phone"></span> Phone number: {{ $request->phone }}.</h5>
                  <h5><span class="glyphicon glyphicon-envelope"></span> Email: {{ $request->email }}.</h5>
                  <h5><span class="glyphicon glyphicon-star glyphicon "></span> Standing: {{ $request->standing }}.</h5>
                  <table>
                    <tr>
                    <td>
                    <form action="medicine/laravel5-learning/public/appendDoctor/" method="get">
                      <input type="hidden" name="idDoctor" value="{{ $request->id }}">
                      <input type="submit" class="btn btn-success" value="Allow">
                    </form>
                    </td>
                    <td style="padding-left:  10px">
                    <form action="medicine/laravel5-learning/public/dropDoctor/" method="get">
                      <input type="hidden" name="idDoctor" value="{{ $request->id }}">
                      <input type="submit" class="btn btn-danger" value="Drop">
                    </form>
                    </td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
          </div>
      @endforeach
      </div>
    </div>
  @endif
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
 <div class="modal fade" id="supportModalLogin" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Enter login and password</h4>
        </div>
        <div class="modal-body">
           <form action="loginSupport/" method="post">
          {!! csrf_field() !!}
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input id="loginSupport" type="text" class="form-control" name="loginLog" placeholder="Login">
          </div>
          <span id="messageLoginSupport"><br></span>
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
            <input id="passwordSupport" type="password" class="form-control" name="passwordLog" placeholder="Password">
          </div>
          <span id="messagePasswordSupport"><br></span>
          <input type="button" id="submitSupportLoginData"  class="btn btn-success" value="Login">
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

