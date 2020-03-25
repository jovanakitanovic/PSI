<!--Jovana Kitanovic 603/17-->
 <html>
    <head>
	<title>Pomaži i Smaži</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<meta charset="UTF-8">
    </head>
    <body>
        <div class="container-fluid">
            <div class="row table-dark pt-3 ml-1 mr-1">
                <div class="col-9"><h3>Pomaži i Smaži</h3></div>
                <div class="col-3">&nbsp;</div>
            </div>
        </div>
        <div class="container-fluid mt-3">
            <form method="post" action="<?php $_SERVER["PHP_SELF"];?>">
                <div class="row table-dark pt-3 pb-3 ml-1 mr-1">
                    <div class="col-6 pt-3" align="right">Ime:</div>
                    <div class="col-6 pt-3" align="left"><input type="text" name="ime"></div>
                    <div class="col-6 pt-3" align="right">Prezime:</div>
                    <div class="col-6 pt-3" align="left"><input type="text" name="prezime"></div>
                    <div class="col-6 pt-3" align="right">Username:</div>
                    <div class="col-6 pt-3" align="left"><input type="text" name="username"></div>
                    <div class="col-6 pt-3" align="right">Password:</div>
                    <div class="col-6 pt-3" align="left"><input type="password" name="password"></div>
                    <div class="col-6 pt-3" align="right">
                        <a href="index.php">
                            <input type="button" value="Odustani" class="btn btn-danger">
                        </a>
                    </div>
                    <div class="col-6 pt-3" align="left">
                        <input type="submit" value="Napravi nalog" name="submit" class="btn btn-success">
                    </div>
                </div>
            </form>
                <?php
                    include_once "kontrola.php";
                    if(isset($_POST["submit"])) {
                        if($_POST["ime"]==""||$_POST["prezime"]==""||$_POST["username"]==""||$_POST["password"]=="") {
                            echo '<script type="text/javascript">alert("Niste uneli sve potrebne podatke!")</script>';
                        } else {
                            $user=$_POST["username"];
                            $password=hash('sha512',$_POST["password"]);
                            $ime=$_POST["ime"];
                            $prezime=$_POST["prezime"];

                            $sql="SELECT * FROM korisnik WHERE korisnik.username='$user'";
                            $result= mysqli_query($conn, $sql);


                            if(mysqli_num_rows($result)==0) {
                                $sql="INSERT INTO korisnik(username,ime,prezime,sifra) VALUES('$user','$ime','$prezime','$password')";
                                $result=mysqli_query($conn, $sql);
                                header("Location: index.php");
                                exit;
                            }
                            else {
                                echo '<script type="text/javascript">alert("Korisnicko ime vec postoji!")</script>';
                            }
                        }
                    }
                ?>
        </div>
    </body>
</html>