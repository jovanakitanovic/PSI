<html>

    <head>
        <title>
            Pomaži i Smaži
        </title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <meta charset="UTF-8">
    </head>


    <body>
        <div class="container-fluid" >
            <table class="table table-borderless table-dark">
                <tbody>

                    <tr>
                        <td>	<h3> &nbsp  &nbsp   &nbsp Pomaži i Smaži</h3></td>
                        <td align="right" width="50%"> 
                         <form action="<?= site_url("Gost/gost_pristup") ?>" method="post">
                          <input type="submit" class="btn btn-warning" name="posetibezlogovanja" value="poseti bez logovanja">
                         </form>
                        </td>
                    </tr>
                    <tr align="center" width="110%">
                        <td width="29%"></td>
                        <td align="left">
                            <h1> Dobrodošli i dobro se najeli</h1>
                        </td>	

                    </tr>
                </tbody>
            </table>
        </div>

        <div class="container-fluid">
            <table class="table table-borderless table-dark" align="center" >

                <tr >
                    <td align="right" width="50%">
                        username
                    </td>
                    <td align="left">
                        <input type="text" id="fname" name="fname">
                    </td>
                </tr>

                <tr>
                    <td align="right" width="50%"> 
                        password
                    </td>
                    <td align="left">
                        <input type="password" id="fname" name="fname">
                    </td>
                </tr>

                <tr>
                    <td align="right" width="50%"> 
                        <form action="<?= site_url("Korisnik/login_provera") ?>" method="post">
                          <input type="submit" class="btn btn-primary" name="ulogujse" value="uloguj se">
                         </form>
                    </td>
                    <td align="left">
                         <form action="<?= site_url("Korisnik/napravi_nalog") ?>" method="post">
                          <input type="submit" class="btn btn-info" name="napravi_nalog" value="napravi nalog">
                         </form>
                    </td>


                </tr>

            </table>
        </div>

    </body>

</html>