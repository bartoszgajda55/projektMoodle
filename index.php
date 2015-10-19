<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <?php
        // put your code here
        ?>
        
        
        
        

           <nav class="navbar navbar-default">
                  <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                      
                      <a class="navbar-brand" href="#">moodle</a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                      
                     
                      <ul class="nav navbar-nav navbar-right">
                        <li><a href="#" class="btn btn-default btn-md">Logowanie</a></li>
                        <li><a href="#" class="btn btn-default btn-md">Rejestracja</a></li>
                      </ul>
                    </div><!-- /.navbar-collapse -->
                  </div><!-- /.container-fluid -->
                </nav>
        
        
          <div class="container">
        
        <div class="row">
       
        <div class="col-md-2"></div>
        <div class="col-md-8">
            
            
            <!-----------<form class="navbar-form navbar-left" role="loguj">
             <div class="input-group input-group-lg">
              <span class="input-group-addon" id="sizing-addon1">Login</span>
              <input type="text" class="form-control" placeholder="Login" aria-describedby="sizing-addon1">
            </div><br><br>
            <div class="input-group input-group-lg">
              <span class="input-group-addon" id="sizing-addon1">Hasło</span>
              <input type="password" class="form-control" placeholder="Hasło" aria-describedby="sizing-addon1">
            </div><br><br>
                <button type="button" class="btn btn-default navbar-btn btn-lg">Zaloguj</button>
                <button type="button" class="btn btn-default navbar-btn btn-lg">Przypomnij haslo</button>
            </form> ---->
            
            
            
            <div class=" well">
			<legend>Logowanie</legend>     
		   	
			<form action="" method="post" accept-charset="utf-8">
                                <div class="form-group">
                                    <input type="text" id="email" class="form-control" name="email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                   <input type="password" id="password" class="form-control" name="password" placeholder="Hasło">
                                </div>	
                            <button type="submit" name="submit" class="btn btn-info btn-block">Zaloguj</button>
			<button type="submit" name="submit" class="btn  btn-block">Przypomnij haslo</button>
					
				</form>		
            </div>
        
        
        </div>
        <div class="col-md-2"></div>
        
        </div>
        
    </div>    
        
       
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>
