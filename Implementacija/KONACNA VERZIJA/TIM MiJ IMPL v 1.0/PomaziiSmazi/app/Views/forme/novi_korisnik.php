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

                <form action="<?= site_url("Gost/pravljenje_naloga") ?>" method="post">
                
                <tr >
                    <td align="right" width="50%">
                        ime
                    </td>
                    <td align="left">
                        <input type="text" id="fname" name="ime" value="<?= set_value('ime') ?>">
                    </td>
                    <td align='left'><font color='red'>
                    <?php 
                        if(!empty($GLOBALS['error'])) {
                            $errors = $GLOBALS['error'];
                            if(!empty($errors['ime'])) {
                                echo "Niste popunili polje ime!";
                                unset($GLOBALS['error']['ime']);
                            }
                        }
                    ?></font></td>
                </tr>

                <tr >
                    <td align="right" width="50%">
                        prezime
                    </td>
                    <td align="left">
                        <input type="text" id="fname" name="prezime" value="<?= set_value('prezime') ?>">
                    </td>
                    <td align='left'><font color='red'>
                    <?php 
                        if(!empty($GLOBALS['error'])) {
                            $errors = $GLOBALS['error'];
                            if(!empty($errors['prezime'])) {
                                echo "Niste popunili polje prezime!<br>";
                                unset($GLOBALS['error']['prezime']);
                            }
                        }
                    ?></font></td>
                </tr>

                <tr >
                    <td align="right" width="50%">
                        username
                    </td>
                    <td align="left">
                        <input type="text" id="fname" name="username" value="<?= set_value('username') ?>">
                    </td>
                    <td align='left'><font color='red'>
                    <?php 
                        if(!empty($GLOBALS['error'])) {
                            $errors = $GLOBALS['error'];
                            if(!empty($errors['username'])) {
                                echo "Niste popunili polje username!<br>";
                                unset($GLOBALS['error']['username']);
                            }
                            if(!empty($errors['user'])) {
                                echo $errors['user'];
                                unset($GLOBALS['error']['user']);
                            }
                        }
                    ?></font></td>
                </tr>

                <tr >
                    <td align="right" width="50%">
                        password
                    </td>
                    <td align="left">
                        <input type="password" id="fname" name="password">
                    </td>
                    <td align='left'><font color='red'>
                    <?php 
                        if(!empty($GLOBALS['error'])) {
                            $errors = $GLOBALS['error'];
                            if(!empty($errors['password'])) {
                                echo "Niste popunili polje password!<br>";
                                unset($GLOBALS['error']['password']);
                            }
                        }
                    ?></font></td>
                </tr>

                <tr >
                    <td align="right">
                        <input type="submit" class="btn btn-success" value="napravi nalog">
                        </form>
                    </td>
                    <td align="left">
                        <form action="<?= site_url("Gost/index_stranica") ?>" method="post">
                        <input type="submit" class="btn btn-danger" value="odustani">
                        </form>
                    </td>
                </tr>
            </table>

        </div>


    </body>

</html>