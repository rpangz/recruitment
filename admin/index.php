<?php 
include ('login.php');

if (isset($_SESSION['login_user'])){
header("location: main.php");
}
?>

<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>PT. MITRA DANA TOP FINANCE</title>
    
        <link rel="stylesheet" href="css/style.css">
      
  </head>

  <body>

    <div class="wrapper">
	<div class="container">
		
	      <form action="" method="post">	
			<h1>Welcome</h1>
			<input id="name" name="username" placeholder="Username" type="text" onChange="myFunction()">
	
			<input id="password" name="password" placeholder="Password" type="password">
			
			<input type="submit" name="submit" id="submit" value="Login">
            <h3><?php echo $error;?></h3>
		  </form>
	</div>
	
	<ul class="bg-bubbles">
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
	</ul>
</div>
        
    <script>
		function myFunction() {
 	 	var x = document.getElementById("name");
  		x.value = x.value.toUpperCase();
		}
	</script>
    

  </body>
</html>