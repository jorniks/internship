
<!DOCTYPE html>

<html>
    <head>

        <link href="assets/img/interns.jpg" rel="icon">

        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Interns.Ng</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="assets/css/bootstrap.css">
        <link rel="stylesheet" href="assets/css/font-awesome.css">
        <link rel="stylesheet" type="text/css" media="screen" href="assets/css/style.css" />
    </head>

    <body>
        <!-- nav bar -->
            <?php include "core/sign_up_header.php";?>
        <!-- nav bar end-->

        <main>

            <div class="container-fluid">
                <?
                    session_start();
                    session_destroy();
                    header("refresh:1; url=index.php");
                ?>
            </div>

        </main>
    </body>

</html>