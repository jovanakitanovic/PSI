<html>
    <head>
            <style> table.a{position:static; heigth:5px;} </style>
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


