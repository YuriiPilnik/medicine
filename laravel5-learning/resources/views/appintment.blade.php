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
        <li><a class="menu-asside" href="medicine/laravel5-learning/public/reviews/">Reviews</a></li>
        <li><a  class="menu-asside" href="medicine/laravel5-learning/public/news/">News</a></li>
        <li><a class="menu-asside" href="medicine/laravel5-learning/public/support/">Support</a></li>
        <li><a class="menu-asside" href="medicine/laravel5-learning/public/medic/">Medic</a></li>
        <li class="active"><a style="background-color: #535353; class="menu-asside" href="medicine/laravel5-learning/public/appointment/">Make an appointment</a></li>
      </ul><br>
  </div>
  @if($_COOKIE["cookiePatient"] == " ")
    <h1>This page is not avialable</h1>  
    <div class="container-fluid" >
      @else
        <div class="container-fluid" >
          <div class="row content">
            <div class="col-sm-9">
            <h2>List of appointments to the doctor</h2>
            <table class="table table-hover table-bordered">
              <thead>
                <tr>
                  <th>Type of problem</th>
                  <th>Date of admission</th>
                  <th>Description of problem</th>
                </tr>
              </thead>
              <tbody>
              @foreach($writes as $write)
                <tr>
                  <td>{{ $write->type }}</td>
                  <td>{{ $write->date }}</td>
                  <td>{{ $write->description }}</td>
                </tr>
              @endforeach
              </tbody>
            </table>
              <h3>Choose a doctor</h3>
              <hr>
              <!-- <div class="row"> -->
                <span style="display: none">{{ $i=1 }}</span>
                @foreach($array_specialtys_uniq as $specialty)
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse{!! $i !!}"> {{ $specialty }}</a>
                      </h4>
                    </div>
                    <div id="collapse{!! $i !!}" class="panel-collapse collapse">  
                    <div class="panel-body">
                      @foreach($doctors as $doctor)
                        @if($specialty == $doctor->specialty)
                              <div class="col-md-4">
                                <h4>{{ $doctor->fio }}</h4>
                                <p><span class="glyphicon glyphicon-education"></span> Standing: {{ $doctor->standing }} years</p>
                                <p style="text-align: justify;" class="background-local-text">{{ $doctor->description }}</p> 
                                <form>
                                  <input type="hidden" name="idDoctor" id="idDoctorForAppend" value="{{ $doctor->id }}">
                                  <input type="button" data-toggle="modal" data-target="#myModalEnroll" class="btn btn-success formAppointment" value="Enroll">
                                </form>
                              </div> 
                        @endif
                      @endforeach
                          </div>
                       <span style="display: none">{{ ++$i }}</span>
                    </div>
                  </div>
                @endforeach
              <!-- </div> -->
             <p>To show medical history:
              <a href="#" class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModalMedicelHistory" id="buttonHistory">
                <span class="glyphicon glyphicon-book"></span> Show 
              </a>
             </p> 
            </div>
          </div> 
        </div>   
      @endif
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
  <div class="modal fade" id="myModalEnroll" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Make an Appointment</h4>
        </div>
        <div class="modal-body">
           <form action="loginPatient/" method="post">
          {!! csrf_field() !!}
          <textarea class="form-control" id="desriptionAppointment" placeholder="Describe your problems" rows="3" required></textarea>
          <span id="messageAppointment"><br></span>
           <div class="input-group">
             <span class="input-group-addon"><i class="glyphicon glyphicon-time"> Date:</i></span>
             <select class="form-control" name = "quality" id="dateAppointment">
               
             </select>
           </div>
           <br>
            <div class="input-group">
             <span class="input-group-addon"><i class="glyphicon glyphicon-question-sign"> Type:</i></span>
             <select class="form-control" name = "problem" id="problem">
                <option value="Examination">Examination</option>
                <option value="Treatment">Treatment</option>
             </select>
           </div>
           <br>
           <input type="button" id="submitEntryToDoctor"  class="btn btn-success" value="Submit">
        </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default"  data-dismiss="modal">Close</button>
        </div>
      </div>

      
    </div>
  </div>
  <div class="modal fade" id="myModalMedicelHistory" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Dear, {{ $_COOKIE["cookiePatient"]}}, this is your disease history. Be healthy!!! </h4>
        </div>
        <div class="modal-body" id="bodyDiseaseHistory">
          @foreach($historys as $history)
             <center><p class="text-primary glyphicon glyphicon-time"> {{ $history->date }}</p></center>
            <div class="well">
              <p class="glyphicon glyphicon-exclamation-sign"> Your complaint: {{ $history->description }}</p><br>
              <p class="glyphicon glyphicon-compressed"> Type: {{ $history->type }}</p> 
              <hr>
              <p class="glyphicon glyphicon-pushpin"> Conclusion: {{ $history->conclusion }}</p><br>
              <p class="glyphicon glyphicon-pencil"> Note: {{ $history->note }}</p> 
             </div>
          @endforeach
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

