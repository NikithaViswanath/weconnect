<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>WeConnect</title>
 	

<?php include('./header.php'); ?>
<?php include('./db_connect.php'); ?>
<?php 
session_start();
if(isset($_SESSION['login_id']))
header("location:index.php?page=home");
	
?>

</head>

<style>
	body{
	    background-image:url("CampusLife-Library_blSwV.jpeg");
		background-size:100%;
	}
	main#main{
		width:100%;
		height: calc(100%);
		background:white;
	}
	#login-right{
		position: absolute;
		right:0;
		width:40%;
		height: calc(100%);
		
		align-items: center;
	}
	
	#login-right .card{
		position:relative;
		left:-55%;
		top:30%;
		background: #000000;;
		height: 260px;
		border: none;	
		border-radius: 6%;
		box-shadow: 8px 8px 8px rgba(0,0,0,0.4);

	}


div#login-right::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: calc(100%);
    height: calc(100%);
}
label
{
	color: white;
	font-weight: 600;
	padding-bottom:3px;
}
.btn-login{
	color: aliceblue;
	background-color: #000000;
	width: 30%;
	height: 10%;	
	border:none;
	position: absolute;
	left: 8.5%;
	top: 14px;
}
.btn-ca{
	color: aliceblue;
	background-color: #000000;
	width: 40%;
	height: 10%;	
	border:none;
	position: absolute;
	left: 50%;
	top: 14px;
}


.btn-login:hover{
	text-decoration: underline;
}
.btn-ca:hover{
	text-decoration: underline;
}
#username{
	color:white;
}
#password{
	color:white;
}

h1{
	position:absolute;
	top: 85px;
	left: 650px;
	color:black;
	font-size: 50px;
}
</style>

<body>
	<h1>WeConnect</h1>
  <main id="main" class=" bg-dark">
		
  		<div id="login-right">
  			<div class="card col-md-8">
  				<div class="card-body">
  					<form id="login-form" >
  						<div class="form-group">
  							<label for="username" class="control-label ">Username</label>
  							<input type="text" id="username" name="username" class="form-control bg-transparent bx-border-none">
  						</div>
  						<div class="form-group">
  							<label for="password" class="control-label">Password</label>
  							<input type="password" id="password" name="password" class="form-control bg-transparent bx-border-none">
  						</div>
  						<div class="col-md-12">
  						<button class="btn-ca" type="button" id="create_account">Create Account</button>
  						<button class="btn-login">Login</button>
  						</div>
  					</form>
  				</div>
  			</div>
  		</div>
   

  </main>

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <div class="modal fade" id="uni_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title"></h5>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='submit' onclick="$('#uni_modal form').submit()">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
      </div>
    </div>
  </div>

</body>
<script>
	window.start_load = function(){
	    $('body').prepend('<di id="preloader2"></di>')
	  }
	  window.end_load = function(){
	    $('#preloader2').fadeOut('fast', function() {
	        $(this).remove();
	      })
	  }
	 window.uni_modal = function($title = '' , $url='',$size=""){
		start_load()
		$.ajax({
		    url:$url,
		    error:err=>{
		        console.log()
		        alert("An error occured")
		    },
		    success:function(resp){
		        if(resp){
		            $('#uni_modal .modal-title').html($title)
		            $('#uni_modal .modal-body').html(resp)
		            if($size != ''){
		                $('#uni_modal .modal-dialog').addClass($size)
		            }else{
		                $('#uni_modal .modal-dialog').removeAttr("class").addClass("modal-dialog modal-md")
		            }
		            $('#uni_modal').modal({
		              show:true,
		              backdrop:'static',
		              keyboard:false,
		              focus:true
		            })
		            end_load()
		        }
		    }
		})
		}
	$('#login-form').submit(function(e){
		e.preventDefault()
		start_load()
		if($(this).find('.alert-danger').length > 0 )
			$(this).find('.alert-danger').remove();
		$.ajax({
			url:'ajax.php?action=login',
			method:'POST',
			data:$(this).serialize(),
			error:err=>{
				console.log(err)
				end_load()
			},
			success:function(resp){
				if(resp == 1){
					location.href ='index.php?page=home';
				}else if(resp == 2){
					location.href ='voting.php';
				}else{
					$('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>')
					end_load()
				}
			}
		})
	})
	$('#create_account').click(function(){
		uni_modal('Signup','signup.php')
	})
</script>	
</html>