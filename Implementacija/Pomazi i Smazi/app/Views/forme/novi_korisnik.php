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

                        <!--<a href="index.html" ><button type="button" class="btn btn-primary" >izloguj se</button></a>-->

                    </td>
                    <td></td>
                </tr>
            </table>

            <table class="table table-borderless table-dark" align="center" >

                <tr >
                    <td align="right" width="50%">
                        ime
                    </td>
                    <td align="left">
                        <input type="text" id="fname" name="fname">
                    </td>
                </tr>

                <tr >
                    <td align="right" width="50%">
                        prezime
                    </td>
                    <td align="left">
                        <input type="text" id="fname" name="fname">
                    </td>
                </tr>

                <tr >
                    <td align="right" width="50%">
                        username
                    </td>
                    <td align="left">
                        <input type="text" id="fname" name="fname">
                    </td>
                </tr>

                <tr >
                    <td align="right" width="50%">
                        password
                    </td>
                    <td align="left">
                        <input type="text" id="fname" name="fname">
                    </td>
                </tr>

                <tr >
                    <td align="right" width="50%">
                        <form action="<?= site_url("Korisnik/index_stranica") ?>" method="post">
                        <input type="submit" class="btn btn-danger" value="odustani">
                        </form>
                    </td>
                    <td align="left">
                        <form action="<?= site_url("Korisnik/napravi_nalog") ?>" method="post">
                        <input type="submit" class="btn btn-success" value="napravi nalog">
                        </form>
                    </td>
                </tr>
            </table>

        </div>


    </body>

</html>