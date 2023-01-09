<!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta name="description" content="Trombinoscope" />
      <meta name="author" content="DAMODARANE Jean-Baptiste" />
      <meta name="date" content="2022-12-08" />
      <meta name="keywords" content="Département Informatique, Licence 3, L3-I, JB, trombinoscope" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <link rel="shortcut icon" href="assets/img/favicon.png" type="image/png">
      <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
      <link rel="stylesheet" href="assets/css/styles.css">
      
      <title><?php echo $titre;?></title>
    </head>
    <body>
        <header class="<?php echo $header;?>" id="header">
            <nav class="nav container">
                <a href="index.php" class="nav__logo">Trombinoscope</a>

                <div class="nav__menu" id="nav-menu">
                    <ul class="nav__list">
                        <li class="nav__item">
                            <a href="index.php" class="nav__link <?php echo $active_link;?>">Accueil</a>
                        </li>
                        <li class="nav__item">
                            <a href="contacter.php" class="nav__link <?php echo $active_link1;?>">Contacer</a>
                        </li>
                        <li class="nav__item">
                            <a href="bla.php" class="nav__link <?php echo $active_link1;?>">Formations</a>
                        </li>
                        <li class="nav__item">
                            <a href="bla.php" class="nav__link <?php echo $active_link1;?>">Se connecter</a>
                        </li>
                    </ul>

                    <i class="ri-close-line nav__close" id="nav-close"></i>
                </div>

                <div class="nav__toggle" id="nav-toggle">
                    <i class="ri-function-line"></i>
                </div>
            </nav>
        </header>