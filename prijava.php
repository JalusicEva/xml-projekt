<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Login</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>
<body class="container text-center">
<form action="" method="post" style="width: 500px; margin: auto;">
        <br><br><label class="form-label">Korisničko ime:</label><br>
		<input id="name" name="username" type="text" class="form-control" placeholder="Unesite korisničko ime"><br>
		<label class="form-label">Lozinka:</label><br>
		<input id="password" name="password" type="password" class="form-control"  placeholder="Unesite lozinku"><br>
	<input name="submit" type="submit" value=" Prijava "  class="btn btn-warning"> <br><br>
</form>

</body>
</html>

<?php

$username="";
$password="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	if (empty($_POST["username"]))  {
        	echo "Potrebno je upisati korisničko ime.";
    		}
	else if (empty($_POST["password"]))  {
        	echo "Potrebno je upisati lozinku.";
    		}
	else {
		$username= $_POST["username"];
		$password= $_POST["password"];
	
		prijava($username,$password);
		$_SESSION['username'] = $username; 
	}
}


function prijava($username, $password) {
	
	$xml=simplexml_load_file("korisnici.xml");	
	foreach ($xml->user as $usr) {
  	 	$k_username = $usr->username;
		$k_password = $usr->password;
		$k_ime=$usr->ime;
		$k_prezime=$usr->prezime;
        $k_naziv=$usr->naziv_razine;
        $k_razina=$usr->razina;

		if($k_username==$username){
			if($k_password == $password){
                echo "Dobrodošli ! <br><br>";
                echo "Prijavljeni ste kao $k_ime $k_prezime. Vaša razina pristupa: $k_naziv <br><br>";
                if($k_razina=="1"){
                    echo '<p><a type="button" class="btn btn-light" href="index1.php">Pristupi podacima</a></p>';
                }
                elseif($k_razina=="2"){
                    echo '<p><a type="button" class="btn btn-light" href="index2.php">Pristupi podacima</a></p>';
                }
                elseif($k_razina=="3"){
                    echo '<p><a type="button" class="btn btn-light" href="index3.php">Pristupi podacima</a></p>';
                }
                elseif($k_razina=="4"){
                    echo '<p><a type="button" class="btn btn-light" href="index4.php">Pristupi podacima</a></p>';
                }
                
				return;
				}
			else{
				echo "Neispravna lozinka.";
				return;
				}
			}
		}
		
	echo "Korisnik ne postoji. Provjerite ispravnost upisanih podataka.";
	return;
}
?>