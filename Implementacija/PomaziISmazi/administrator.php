<html>
    <head>
	<title>Administrator</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<meta charset="UTF-8">
    </head>
    <body>
        <?php
            include_once 'kontrola.php';
            session_start();
            
            //provera da li smo na stranicu probali da udjemo direktno preko linka, bez logovanja
            if(!isset($_SESSION["username"])) {
                $_SESSION["err1"]=1;
                header("Location: index.php");
                exit;
            }
            if($_SESSION["admin"]==0) {
                header("Location: pocetna_sa_nalogom.php");
                exit;
            }
        ?>
        
	<div class="container-fluid">
            <table class="table table-borderless table-dark" align="center" >
		<tr>
                    <td></td>
                    <td align=""><h3>Pomaži i Smaži</h3></td>
                    <td align="right">
                        <form method="post" action="<?php $_SERVER["PHP_SELF"]?>">
                            <button type="submit" class="btn btn-warning" name="logout" >Izloguj se</button>
                        </form>
                        <?php
                            if(isset($_POST["logout"])) {
                                
                                session_unset();
                                session_destroy();
                                header("Location: index.php");
                                exit;
                            }
                        ?>
                    </td>
                    <td></td>
		</tr>
            </table>
            <table class="table " align="center" >
                <tr>
                    <td align="right" width="20%">
			<table class="table table-bordered table-dark" align="center" >
                            <tr>
				<td align="center">Administratorski nalog <br/> PRIJAVE</td>
                            </tr>
                        </table>
                    </td>
                    <td align="left">
                        <table  align="center" >
                            <form method="post" action="<?php $_SERVER["PHP_SELF"]?>">
                                <?php
                                    include_once 'kontrola.php';
                                    ini_set("precision",3);

                                    $indeksi=array();
                                    $i=0;

                                    $sql="SELECT * FROM prijava ";
                                    $result= mysqli_query($conn, $sql);

                                    $count=array();

                                    if(mysqli_num_rows($result)>0) {
                                        while($row = mysqli_fetch_assoc($result)) {
                                            if(!isset($count[''.$row['idR']])) {
                                                $indeksi[$i++]=$row['idR'];
                                                $count[$row['idR']]=1;
                                            } else {
                                                $count[$row['idR']]++;
                                            }
                                        }
                                    }
                                    
                                    foreach($indeksi as $ind) {
                                        if(isset($_POST['ostavi'.$ind])) {
                                            $sql = "DELETE FROM prijava where idR=$ind";
                                            $result= mysqli_query($conn, $sql);

                                            if($result) {
                                                header("Location: administrator.php");
                                                exit;
                                            }
                                            else echo "<script type='text/javascript'>alert('Greska u radu sa bazom');</script>";
                                        } 
                                        if(isset($_POST['obrisi'.$ind])) {
                                            $sql="DELETE FROM prijava where idR=$ind;";
                                            $result= mysqli_query($conn, $sql);

                                            if($result) {
                                                $sql = "DELETE FROM recepti where id=$ind";
                                                $result= mysqli_query($conn, $sql);

                                                if($result) {
                                                    header("Location: administrator.php");
                                                    exit;
                                                }
                                                else echo "<script type='text/javascript'>alert('Greska u radu sa bazom');</script>";
                                            }
                                            else echo "<script type='text/javascript'>alert('Greska u radu sa bazom');</script>";
                                        }
                                    }

                                    foreach($indeksi as $ind) {
                                        $sql="SELECT * from RECEPTI where id=$ind";
                                        $result= mysqli_query($conn, $sql);
                                        $row=mysqli_fetch_assoc($result);

                                        echo '<tr> <td align="center" width="40%" >';
                                        echo '<img width="100%" src="'.$row['slika'] .'"></img></td>';
                                        echo '<td width="60%"><table> <tr> <h5> '.$row['ime'].'<hr/></h5></h5></tr>'.$row['sastojci'].'<hr/>'.$row['priprema'].'</td></tr><tr><hr/>  
                                                                            &nbsp &nbsp &nbsp 
                                                                            <h5>Broj prijava: '.$count[$ind].'
                                                                            &nbsp &nbsp &nbsp 
                                                                            <input type="submit" name="ostavi'.$row['id'].'" class="btn btn-success" value="Ostavi">		
                                                                            &nbsp &nbsp &nbsp
                                                                            <input type="submit" name="obrisi'.$row['id'].'" class="btn btn-danger" value="Obrisi"></h5>										
                                                                            </tr>
                                                                            </table>
                                                                    </td>
                                                            </tr>
                                                        </tr>';
                                    }

                                    
                                ?>
                            </form>
			</table>
                    </td>
		</tr>
            </table>
        </div>
    </body>
</html>