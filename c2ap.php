<style type="text/css">
	#wpwrap{
		background-image: url('//img.centralcollege.info/C2AP/backgrounds/spring/11.jpg');
	}
	#loginData{
			margin: 0 auto;
			top: 100%;
			left: 30%;
			right: 30%;
			border-radius: 10px;
			-moz-border-radius: 10px;
			-webkit-border-radius: 10px;
			border: 1px solid #333;
			position:absolute;
			background-color: #fff;
			padding: 0 .5em;
			
			/*Opacity*/
			opacity:0.95;
  			filter:alpha(opacity=95);
			
			/*box-shadow*/
			-moz-box-shadow: 0px 0px 10px #fff;
			-webkit-box-shadow: 0px 0px 10px #fff;
			box-shadow: 0px 0px 10px #fff;
		}
	#loginData label {
		color: #000000;
		font-family: 'Trebuchet MS',Arial,Helvetica,sans-serif;
		font-size: 18px;
	}
	#loginData .submit {
		background-color: #FFFFFF;
		border-color: #666666;
		border-style: double;
		border-width: 3px;
		color: #333333;
		font-family: 'Trebuchet MS',Arial,Helvetica,sans-serif;
		font-size: 18px;
		padding: .25em;
	}
</style>
<div id="loginData">
    <div align="center"><img src="//www.central.edu/admin/images/12centralCollegeLogo.png" alt="Central College" /></div>
    
    
    <?php 
	//Make sure they are on a secure connection
	if(!empty($_SERVER['HTTPS'])){?>
	    <p align="center"><a href="https://www.central.edu/admin" style="text-decoration: none;" class="submit">Go to C2AP.</a></p>
	<?php 
		/*
		<form name="CentralAdminLogin" action="http://www.central.edu/admin/index.cfm" method="post" autocomplete="off">
        <input type="Hidden" name="myAction" value="LogIn"/>
        <p><label for="usr">Username:</label><br />
            <input type="text" id="usr" name="usr" style="width:97%;" /></p>
        <p><label for="pwd">Password:</label><br />
            <input id="pwd" name="pwd" type="password" style="width:97%;" /></p>
        <p align="right"><input type="submit" value="Login >>" name="Login" class="submit"/></p>
        </form>
		*/?>
	<?php }else{?>
		<p align="center">Coming Soon...</p>
	<?php } ?>
</div>