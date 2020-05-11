<!--Jovana Kitanovic 603/17-->
<html>
    <head>
        <title> Pomaži i Smaži</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <meta charset="UTF-8">
    </head>
    <body>



        <div class="container-fluid">


            <table class="table table-borderless table-dark" align="center" >
                <tr>
                    <td></td>
                    <td align="">
                        <h3>Pomaži i Smaži</h3>
                    </td>

                    <td align="right">
                        <form action="<?= site_url("Korisnik/logout") ?>" method="post">
                          <input type="submit" class="btn btn-warning" name="ulogujse" value="izloguj se">
                        </form>
                    </td>
                    <td></td>
                </tr>
            </table>

            <table class="table table-borderless table-dark" align="center" >

        <!--------------------------------------------------------------------------------------------------->  
            
            <form action="<?= site_url("Korisnik/pravljenje_recepta") ?>" method="post" enctype="multipart/form-data">
                
                <tr >
                    <td align="right" width="40%">
                        Naziv recepta
                    </td>
                    <td align="left">
                        <input type="text" id="fname" name="naziv" value="<?= set_value('naziv') ?>">
                    </td>
                    <td align='left'><font color='red'>
                    <?php 
                        if(!empty($GLOBALS['error'])) {
                            $errors = $GLOBALS['error'];
                            if(!empty($errors['naziv'])) {
                                echo "Niste popunili polje naziv!<br>";
                                unset($GLOBALS['error']['naziv']);
                            }
                        }
                    ?></font></td>
                </tr>

                <tr >
                    <td align="right">
                        kategorija
                    </td>
                    <td align="left">
                        <input type="checkbox" name="kategorija1" value="k1">  &nbsp jelo od mesa &nbsp
                        <input type="checkbox" name="kategorija2" value="k2">  &nbsp slatkiš &nbsp
                        <input type="checkbox" name="kategorija3" value="k3">  &nbsp testa &nbsp

                    </td>
                    <td align='left'><font color='red'>
                    <?php 
                        if(!empty($GLOBALS['error'])) {
                            $errors = $GLOBALS['error'];
                            if(!empty($errors['kategorija'])) {
                                echo $errors['kategorija'];
                                unset($GLOBALS['error']['kategorija']);
                            }
                        }
                    ?></font></td>
                </tr>

                <tr >
                    <td align="right">
                        sastojci
                    </td>
                    <td align="left">
                        <textarea id="w3mission" rows="4" cols="50" name="sastojci" value="<?= set_value('sastojci') ?>"></textarea>		
                    </td>
                    <td align='left'><font color='red'>
                    <?php 
                        if(!empty($GLOBALS['error'])) {
                            $errors = $GLOBALS['error'];
                            if(!empty($errors['sastojci'])) {
                                echo "Niste uneli sastojke!<br>";
                                unset($GLOBALS['error']['sastojci']);
                            }
                            if(!empty($errors['sas'])) {
                                echo $errors['sas'];
                                unset($GLOBALS['error']['sas']);
                            }
                        }
                    ?></font></td>
                </tr>

                <tr >
                    <td align="right">
                        način pripreme
                    </td>
                    <td align="left">
                        <textarea id="w3mission" rows="8" cols="50" name="priprema" value="<?= set_value('priprema') ?>"></textarea>	
                    </td>
                    <td align='left'><font color='red'>
                    <?php 
                        if(!empty($GLOBALS['error'])) {
                            $errors = $GLOBALS['error'];
                            if(!empty($errors['priprema'])) {
                                echo "Niste uneli nacin pripreme!<br>";
                                unset($GLOBALS['error']['priprema']);
                            }
                            if(!empty($errors['pri'])) {
                                echo $errors['pri'];
                                unset($GLOBALS['error']['pri']);
                            }
                        }
                    ?></font></td>
                </tr>

                <tr >
                    <td align="right">
                        ucitaj sliku
                    </td>
                    <td align="left">			<!-- deo za ibacivanje slike-->

                        <input type="file" name="slika">	
                        
                    </td>
                    <td align='left'><font color='red'>
                    <?php 
                        if(!empty($GLOBALS['error'])) {
                            $errors = $GLOBALS['error'];
                            if(!empty($errors['slika'])) {
                                echo "Niste odabrali sliku!<br>";
                                unset($GLOBALS['error']['slika']);
                            }
                        }
                        if(!empty($errors['sl'])) {
                            echo $errors['sl'];
                            unset($GLOBALS['error']['sl']);
                        }
                    ?></font></td>
                </tr>

                <tr >
                    
                    <td align="right">
                     
                       <input type="submit" class="btn btn-success" value="objavi">
            </form>
                    </td>
                    <td align="left">
                        <form action="<?= site_url("Korisnik/pravljenje_recepta") ?>" method="post">
                     <input type="submit" class="btn btn-danger" value="odustani" name="odustani" >
                        </form>
                    </td>
                </tr>
            </table>

        </div>


    </body>

</html>