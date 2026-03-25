<!doctype html>
<html lang="fr">

<head>
    <title><?=$title?></title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
    <!-- fontawesome -->
    <script src="https://kit.fontawesome.com/ca399f254d.js" crossorigin="anonymous"></script>
    <style>
        /* Uniform image cropping using object-fit */
        .card-img-top.fixed-thumb {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        /* smaller thumbnails in bag */
        .bag-thumb {
            width: 60px;
            height: 40px;
            object-fit: cover;
        }

        /* square preview (forms) */
        .preview-thumb {
            width: 200px;
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>
<body style="background-image: url('/img/fond.jpg'); background-size: cover; background-position: center; background-attachment: fixed;">
    <?= $this->include('_errorsMessages.php') ?>
    <main class="container">
        <?= $this->renderSection('body') ?>
    </main>
    <div class="container">
        <div>
            <nav class="navbar navbar-dark"></nav>
        </div>
        <div>
            <?= $this->renderSection('body') ?>
        </div>
    </div>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    <script></script>
</body>

</html>