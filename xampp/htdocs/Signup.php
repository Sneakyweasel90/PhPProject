<!DOCTYPE html>
<?php 
session_start();

if (isset($_GET["message"])){
    $message = $_GET["message"];
    echo "<script> alert(`$message`)
	window.location.href='Signup.php'</script>";
}

if (isset($_SESSION["SESS_MEMBER_ID"])) {
    header("location:Index.php");
}

?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sign up for exclusive access to our services. Create an account to unlock features, benefits, and personalized content.">
    <meta name="author" content="Neil_Mannion_neil.mannion1@gmail.com">
    <link rel="icon" href="favicon.ico">

    <title>Signup - Why use X when you can use Y!</title>

    <!-- Bootstrap core CSS -->
    <link href="includes/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="includes/starter-template.css" rel="stylesheet">
	<!-- Bootstrap core JavaScript-->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
	
    <script src="includes/bootstrap.min.js"></script>

	<!-- Include for validation on the form!! if needed -->
	<!-- <script src="signupValidation.js"></script> -->
    
	<script type="text/javascript">
		//any JS validation you write can go here
	document.addEventListener("DOMContentLoaded", function () {
    	document.getElementById("registration_form").addEventListener("submit", function (event) { 

			
			let firstName = document.getElementById('firstname').value.trim();
			let lastName = document.getElementById('lastname').value.trim();
			let email = document.getElementById('email').value.trim();
			let userName = document.getElementById('username').value.trim();
			let password = document.getElementById('password').value.trim();
			let confirm = document.getElementById('confirm').value.trim();
			let phone = document.getElementById('phone').value.trim();
			let address = document.getElementById('address').value.trim();
			let province = document.getElementById('province').value;
			let postalCode = document.getElementById('postalCode').value.trim();
			let url = document.getElementById('url').value.trim();
			let desc = document.getElementById('desc').value.trim();
			let location = document.getElementById('location').value.trim();

			
			let isValid = true;
			$msg = "";

			if (firstName === "" || firstName.length > 50) {
				$msg += "First name is required and can't be larger than 50 characters.\n";
				isValid = false;
			}
			if (lastName === "" || lastName.length > 50) {
				$msg += "Last name is required and can't be larger than 50 characters.\n";
				isValid = false;
			}
			if (userName === "" || userName.length > 50) {
				$msg += "Screen name is required and can't be larger than 50 characters.\n";
				isValid = false;
			}
			if (email === "" || email.length > 100 || !/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/.test(email)) {
				$msg += "Email is required and can't be larger than 100 characters.\n";
				isValid = false;
			}
			if (password === "" || password.length > 250) {
				$msg += "Password is required and can't be larger than 250 characters.\n";
				isValid = false;
			}
			if (confirm !== password) {
				$msg += "Passwords must match.\n";
				isValid = false;
			}
			if (phone === "" || !/^(\(\d{3}\) |\d{3} )\d{3}-\d{4}$/.test(phone) || phone.length > 25) {
				$msg += "Phone is required and must be in the format (123) 456-7890.\n";
				isValid = false;
			}
			if (address === "" || address.length > 200) {
				$msg += "Address is required and can't be larger than 200 characters.\n";
				isValid = false;
			}
			if (province === "") {
				$msg += "Province is required.\n";
				isValid = false;
			}
			if (postalCode === "" || !/^[ABCEGHJ-NPRSTVXY]\d[ABCEGHJ-NPRSTV-Z][ -]?\d[ABCEGHJ-NPRSTV-Z]\d$/i.test(postalCode) || postalCode.length > 7) {
				$msg += "Postal code is required and must be valid.\n";
				isValid = false;
			}
			if (desc === "" || desc.length > 160) {
				$msg += "Description is required and can't be larger than 160 characters.\n";
				isValid = false;
			}
			if (location.length > 50) {
				$msg += "Location can't be larger than 50 characters.\n";
				isValid = false;
			}

			if (!isValid) {
				event.preventDefault(); // This will submit the form to the server
				alert($msg);
			}
    	});
	});

	//'go to SignupAjax.php page for answer'
	function checkUsername(username) {
            if (username.length > 0) {
                document.getElementById("username").innerHTML;

                fetch("SignupAjax.php?q=" + username)
                    .then(response => response.json())
                    .then(data => {
                        if (data.screen_name === 'taken') {
                            document.getElementById("usernameStatus").innerHTML = '<span style="color:red;">Username is already taken</span>';
                        } else if (data.screen_name === 'available') {
                            document.getElementById("usernameStatus").innerHTML = '<span style="color:green;">Username is available</span>';
                        } else {
                            document.getElementById("usernameStatus").innerHTML = '<span style="color:red;">Error checking username</span>';
                        }
                    })
                    .catch(error => {
                        document.getElementById("usernameStatus").innerHTML = '<span style="color:red;">Error: Could not check username</span>';
                        console.error("Error occurred while checking username", error);
                    });
            } else {
                document.getElementById("usernameStatus").innerHTML = "";
            }
        }
	

	</script>
  </head>

  <body>
  
    <nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse fixed-top">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
			<a class="navbar-brand" href="index.html"><img src="images/y_logo.png" class="logo"></a>
		
        
      </div>
    </nav>

	<BR><BR>
    <div class="container">
		<div class="row">
			
			<div class="main-login main-center">
				<h5>Sign up once and troll as many people as you like!</h5>
					<form method="post" id="registration_form" action="signup_proc.php">
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">First Name</label>
							<div class="cols-sm-10">
								<div class="input-group">
									
									<input type="text" class="form-control" required name="firstname" id="firstname"  placeholder="Enter your First Name"/>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Last Name</label>
							<div class="cols-sm-10">
								<div class="input-group">
									
									<input type="text" class="form-control" required name="lastname" id="lastname"  placeholder="Enter your Last Name"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="email" class="cols-sm-2 control-label">Your Email</label>
							<div class="cols-sm-10">
								<div class="input-group">
									
									<input type="text" class="form-control" required name="email" id="email"  placeholder="Enter your Email"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="username" class="cols-sm-2 control-label">Screen Name</label>
							<div class="cols-sm-10">
								<div class="input-group">
									
									<input type="text" class="form-control" required name="username" id="username"  placeholder="Enter your Screen Name" onkeyup="checkUsername(this.value)"/>
									<div id="usernameStatus"></div>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="password" class="cols-sm-2 control-label">Password</label>
							<div class="cols-sm-10">
								<div class="input-group">
									
									<input type="password" class="form-control" required name="password" id="password"  placeholder="Enter your Password"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="confirm" class="cols-sm-2 control-label">Confirm Password</label>
							<div class="cols-sm-10">
								<div class="input-group">
									
									<input type="password" class="form-control" required name="confirm" id="confirm" placeholder="Confirm your Password"/>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Phone Number</label>
							<div class="cols-sm-10">
								<div class="input-group">
									
									<input type="text" class="form-control" required name="phone" id="phone"  placeholder="Enter your Phone Number"/>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Address</label>
							<div class="cols-sm-10">
								<div class="input-group">
									
									<input type="text" class="form-control" required name="address" id="address"  placeholder="Enter your Address"/>
								</div>
							</div>
						</div>
						
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Province</label>
							<div class="cols-sm-10">
								<div class="input-group">
									
									<select name="province" id="province" class="textfield1" required><?php echo $vprovince; ?> 
										<option> </option>
										<option value="British Columbia">British Columbia</option>
										<option value="Alberta">Alberta</option>
										<option value="Saskatchewan">Saskatchewan</option>
										<option value="Manitoba">Manitoba</option>
										<option value="Ontario">Ontario</option>
										<option value="Quebec">Quebec</option>
										<option value="New Brunswick">New Brunswick</option>
										<option value="Prince Edward Island">Prince Edward Island</option>
										<option value="Nova Scotia">Nova Scotia</option>
										<option value="Newfoundland and Labrador">Newfoundland and Labrador</option>
										<option value="Northwest Territories">Northwest Territories</option>
										<option value="Nunavut">Nunavut</option>
										<option value="Yukon">Yukon</option>
									  </select>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Postal Code</label>
							<div class="cols-sm-10">
								<div class="input-group">
									
									<input type="text" class="form-control" required name="postalCode" id="postalCode"  placeholder="Enter your Postal Code"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Url</label>
							<div class="cols-sm-10">
								<div class="input-group">
									
									<input type="text" class="form-control" name="url" id="url"  placeholder="Enter your URL"/>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Description</label>
							<div class="cols-sm-10">
								<div class="input-group">
									
									<input type="text" class="form-control" required name="desc" id="desc"  placeholder="Description of your profile"/>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Location</label>
							<div class="cols-sm-10">
								<div class="input-group">
									
									<input type="text" class="form-control" name="location" id="location"  placeholder="Enter your Location"/>
								</div>
							</div>
						</div>
						
						
						<div class="form-group ">
							<input type="submit" name="button" id="button" value="Register" class="btn btn-primary btn-lg btn-block login-button"/>
							
						</div>
						
					</form>
				</div>
			
		</div> <!-- end row -->
    </div><!-- /.container -->
    
  </body>
</html>