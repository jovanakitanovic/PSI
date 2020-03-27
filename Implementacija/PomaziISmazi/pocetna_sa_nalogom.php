<!--Jovana Kitanovic 603/17-->
<html>
    <head>
	<title>Pomaži i Smaži</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<meta charset="UTF-8">
    </head>
    <body>
        <?php
            include_once 'kontrola.php';
            
            session_start();
            $id;
            
            //provera da li smo na stranicu probali da udjemo direktno preko linka, bez logovanja
            if(!isset($_SESSION["username"])) {
                $_SESSION["err1"]=1;
                header("Location: index.php");
                exit;
            }
            if($_SESSION["admin"]==1) {
                header("Location: admin.php");
                exit;
            }
            
            $user=$_SESSION["username"];

            $sql="SELECT id FROM korisnik WHERE username='$user'";
            $result= mysqli_query($conn, $sql);
         
            if(mysqli_num_rows($result)>0) {
                while($row= mysqli_fetch_assoc($result)){
                    // echo "<script type='text/javascript'>alert(".$row['id'].");</script>" ;
                    $id=$row['id'];
                }
            }
        ?>

		
	<form method="POST" >		
            <div class="container-fluid">
		<table class="table table-borderless table-dark" align="center" >
                    <tr>
			<td></td>
			<td align="">
                            <h3>Pomaži i Smaži</h3>
			</td>
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

				<tr >
					<td align="right" width="20%">
							
					<table class="table table-bordered table-dark" align="center" >
						<tr>
							<td align="center">
								<a href="slatko_sa_nalogom.php"  class="text-white">Slatko ćoše</a>
							</td>
						</tr>
						<tr>
							<td align="center">
								<a href="meso_sa_nalogom.php"  class="text-white">Za mesojede</a>
							</td>
						</tr>
						<tr>
							<td align="center">
								<a href="testo_sa_nalogom.php" class="text-white">Svakojaka testa</a>
							</td>
						</tr>
												<tr>
							<td align="center">
								<a href="pocetna_sa_nalogom.php" class="text-success">Sva jela</a>
							</td>
						</tr>
												<tr>
							<td align="center">
								<a href="izvrni_kuvar_sa_nalogom.php" class="text-danger">Izvrsni kuvar</a>
							</td>
						</tr>
						<tr>
							<td align="center">
								<a href="odlični_kuvar_sa_nalogom.php" class="text-danger">Odlični kuvar</a>
							</td>
						</tr>
						<tr>
							<td align="center">
								<a href="solidni_kuvar_sa_nalogom.php" class="text-danger">Solidni kuvar</a>
							</td>
						</tr>
						<tr>
							<td align="center">
								<a href="moj_nalog.php" class="text-info">Moj nalog</a>
							</td>
						</tr>
					</table>
                                            
            					</td>
					<td align="left">
					<table  class="table " align="center" >
                <?php  
                    include_once 'kontrola.php';
                    ini_set("precision",3);
             
                    $indeksi=array();
                    $i=0;
                    //   echo "<script type='text/javascript'>alert('alalal');</script>"   ;

                    $sql="SELECT * FROM recepti ";
                    $result= mysqli_query($conn, $sql);
                   
                    if(mysqli_num_rows($result)>0){
                        while($row= mysqli_fetch_assoc($result)){
                            $indeksi[$i++]=$row['id'];
                            echo '<tr> <td align="center" width="40%" >';
                            echo '<img width="100%" src="'.$row['slika'] .'"></img></td>';
                            echo '<td width="60%"><table> <tr> <h5> '.$row['ime'].'<hr/></h5></h5></tr>'.$row['sastojci'].'<hr/>'.$row['priprema'].'</td></tr><tr>	<hr/> <h5> oceni </h5>
									<input type="submit" class="btn btn-light" name="o'.$row['id'].'" value="5" class="question_radio" /> &nbsp			
									<input type="submit" class="btn btn-light" name="o'.$row['id'].'" value="4" /> &nbsp
									<input type="submit" class="btn btn-light" name="o'.$row['id'].'" value="3" /> &nbsp
									<input type="submit" class="btn btn-light" name="o'.$row['id'].'" value="2" /> &nbsp
									<input type="submit" class="btn btn-light" name="o'.$row['id'].'" value="1" /> 	
										&nbsp &nbsp &nbsp 
                                                                                <input type="submit" name="sacuvaj'.$row['id'].'" class="btn btn-primary" value="Sačuvaj">		
                                                                                &nbsp &nbsp &nbsp
									<input type="submit" name="prijavi'.$row['id'].'" class="btn btn-danger" value="Prijavi">										
									</tr>
									</table>
								</td>
							</tr></tr>';
                        }
                    }    
                if($indeksi!=0) {
                    foreach ($indeksi as $ind)    {
                                       
                        if(isset($_POST['sacuvaj'.$ind]))
                        {
                            $sql="SELECT * FROM sacuvano WHERE idK=".$id." and idR="."$ind";
                            $result= mysqli_query($conn, $sql);
                        
                            if(mysqli_num_rows($result)>0)  {
                                echo "<script type='text/javascript'>alert('recept je već sačuvan');</script>"    ;
                            } else{
                                $sql ="INSERT INTO sacuvano(idK,idR) VALUES($id,$ind)" ;
                                $result= mysqli_query($conn, $sql);
                            }
                        }
                   
                        if(isset($_POST['o'.$ind])){
                            $ocena=$_POST['o'.$ind];
                    
                            $sql="SELECT * FROM ko WHERE idK=".$id." and idR="."$ind";
                            $result= mysqli_query($conn, $sql);
                        
                            if(mysqli_num_rows($result)>0)  {
                                echo "<script type='text/javascript'>alert('recept je već ocenjen');</script>"    ;
                            }else{
                                $o=0;
                                $num;
                                $sql="INSERT INTO ko(idK,idR,ocena) VALUES($id,$ind,$ocena)";
                                $result= mysqli_query($conn, $sql);
                
                                $sql="select count(idR) as sum from ko where idR="."$ind" ;
                                $result= mysqli_query($conn, $sql);
            
                                while($row= mysqli_fetch_assoc($result)){
                                    //   echo "<script type='text/javascript'>alert('".$row['sum']."');</script>"   ;
                                    $num=$row['sum'];    
                                }
                
                                //ocenjivanje pojedinačnih recepata
                
                                $sql="select SUM(ocena) as sumO from ko where idR="."$ind" ;
                                $result= mysqli_query($conn, $sql);
            
                                while($row= mysqli_fetch_assoc($result)){
                                    //  echo "<script type='text/javascript'>alert('".$row['sumO']."');</script>"   ;
                                    $o=$row['sumO'];    
                                }
                                $rez=$o/$num;
                                // echo "<script type='text/javascript'>alert('".$rez."');</script>"   ;
                
                                $sql="UPDATE recepti SET ocena=$rez WHERE id=$ind";
                                $result= mysqli_query($conn, $sql);
                 
                                 
                                //ocenjivanje svih recepata korisnikaa   
                  
                  
                                $idAutora;
                                $sql="SELECT autor FROM recepti WHERE id=$ind";
                                $result= mysqli_query($conn, $sql);
                                while($row= mysqli_fetch_assoc($result)){
                                    //  echo "<script type='text/javascript'>alert('".$row['sumO']."');</script>"   ;
                                    $idAutora=$row['autor'];    
                                }
                
                                // echo "<script type='text/javascript'>alert('".$idAutora."');</script>"   ;

                  
                                $sql="select SUM(ocena) as sumO from recepti where autor="."$idAutora" ;
                                $result= mysqli_query($conn, $sql);
                
                                while($row= mysqli_fetch_assoc($result)){
                                    //  echo "<script type='text/javascript'>alert('".$row['sumO']."');</script>"   ;
                                    $o=$row['sumO'];    
                                }
                
                                $sql="select count(id) as sum from recepti where autor="."$idAutora" ;
                                $result= mysqli_query($conn, $sql);
            
                                while($row= mysqli_fetch_assoc($result)){
                                    //   echo "<script type='text/javascript'>alert('".$row['sum']."');</script>"   ;
                                    $num=$row['sum'];    
                                }
                
                                $rez=$o/$num;
                
                                /* echo "<script type='text/javascript'>alert('".$num."');</script>"   ;
                                echo "<script type='text/javascript'>alert('".$o."');</script>"   ;
                                echo "<script type='text/javascript'>alert('".$rez."');</script>"   ;*/


                                $sql="UPDATE korisnik SET ocena=$rez WHERE id=$idAutora";
                                $result= mysqli_query($conn, $sql);
                  
                            }
                        }  
                        if(isset($_POST["prijavi".$ind])) {
                            
                            $sql = "SELECT * FROM prijava";
                            $result = mysqli_query($conn, $sql);
                            
                            while($row= mysqli_fetch_assoc($result)) {
                                if($ind==$row['idR']&&$id==$row['idK']) {
                                    echo "<script type='text/javascript'>alert('Vec ste prijavili ovaj recept');</script>";
                                    exit;
                                }
                            }
                            
                            $sql = "INSERT INTO prijava(idR,idK) VALUES($ind,$id)";
                            $result= mysqli_query($conn, $sql);
                            
                            if($result) echo "<script type='text/javascript'>alert('Nepozeljan sadrzaj je uspesno prijavljen');</script>";
                            else echo "<script type='text/javascript'>alert('Greska u prijavi recepta');</script>";
                        }
                    }
                }
                ?>
                </table>
            </div>
        </form>
    </body>
</html>