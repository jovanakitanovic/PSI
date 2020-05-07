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

                <tr >
                    <td align="right" width="50%">
                        Naziv recepta
                    </td>
                    <td align="left">
                        <input type="text" id="fname" name="fname">
                    </td>
                </tr>

                <tr >
                    <td align="right" width="50%">
                        kategorija
                    </td>
                    <td align="left">
                        <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">  &nbsp jelo od mesa &nbsp
                        <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">  &nbsp slatkiš &nbsp
                        <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">  &nbsp testa &nbsp

                    </td>
                </tr>

                <tr >
                    <td align="right" width="50%">
                        sastojci
                    </td>
                    <td align="left">
                        <textarea id="w3mission" rows="4" cols="50"></textarea>		
                    </td>
                </tr>

                <tr >
                    <td align="right" width="50%">
                        način pripreme
                    </td>
                    <td align="left">
                        <textarea id="w3mission" rows="8" cols="50"></textarea>	
                    </td>
                </tr>

                <tr >
                    <td align="right" width="50%">
                        ucitaj sliku
                    </td>
                    <td align="left">			<!-- deo za ibacivanje slike-->

                        <input type="file" />	

                    </td>
                </tr>

                <tr >
                    <td align="right" width="50%">
                        <form action="<?= site_url("Korisnik/index_stranica") ?>" method="post">
                     <input type="submit" class="btn btn-danger" value="odustani" >
                        </form>
                    </td>
                    <td align="left">
                         <form action="<?= site_url("Korisnik/index_stranica") ?>" method="post">
                       <input type="submit" class="btn btn-success" value="objavi">
                         </form>
                    </td>
                </tr>
            </table>

        </div>


    </body>

</html>