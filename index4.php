<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Kupac</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <style>
        body {background: #fafafa;}
    </style>
</head>
<body class="container-fluid">


<header>
<nav class="navbar navbar-expand-lg bg-body-tertiary border-bottom border-bottom-dark ">
    <div class="container " >
    <p class="navbar-text">Kupac - podaci iz tablice Skladište s djelomičnim pristupom</p>
        <div class="d-flex">
            <p class="navbar-text">Prijavljeni ste kao: 
            <?php 
                $xml=simplexml_load_file("korisnici.xml");
                foreach ($xml->user as $usr):
                    if($usr->username==$_SESSION['username']){
                        echo $usr->ime . " "; 
                        echo $usr->prezime ;
                }
                endforeach; ?>        
        </p>
            <a type="button" class="btn btn-warning" style="height:40px; margin-left:10px;" href="prijava.php">Odjava</a>
        </div>
    </div>
</nav>
</header>

<?php
$xml=simplexml_load_file("skladiste.xml");    
?>
<div class="container text-center">
        <table class="table caption-top table-hover">
            <caption>PONUDA ARTIKALA</caption>
            <thead>
                <tr>
                    <th>Naziv artikla</th>
                    <th>Cijena u eurima</th>
                    <th>Stanje</th>
                    <th>Količina</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php foreach ($xml->artikl as $art): 
                    if($art->stanje=="nedostupno"){
                        echo '<tr class=" fw-light fst-italic">';
                    }
                    else{
                        echo "<tr>";
                    }
                    ?>
                        <td><?php echo $art->naziv; ?></td>
                        <td><?php echo $art->cijena_eur; ?></td>
                        <td><?php echo $art->stanje; ?></td>
                        <td><?php echo $art->kolicina; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <br><br>
    </div>

</body>
</html>