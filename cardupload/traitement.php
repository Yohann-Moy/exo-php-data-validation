<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP - Revue de code sur le traitement de formulaires</title>
    <meta name="description" content="Exercice de PHP sur les formulaires - revue de code">
</head>

<body>

    <?php
    // Si le formulaire n'a pas été envoyé (par méthode POST)
    if (empty($_POST)) { ?>
        <h1><?php echo "Le formulaire n'a pas été envoyé"; ?></h1>
        <?php   }

    // Sinon (c'est que le formulaire a été envoyé par méthode POST)
    else {
        // Si la fonction formValidator retourne des erreurs
        if (!empty(formValidator($_POST))) { ?>
            <ul>
                <h1>Liste des erreurs</h1>
                <?php foreach (formValidator($_POST) as $champ => $erreur) { ?>
                    <li><?php echo $champ; ?></li>
                <?php } ?>
            </ul>
        <?php
        } else { ?>
            <ul>
                <?php $imgPath = './uploads/' . basename($_FILES["img"]["name"]); ?>
                <img src="<?php echo $imgPath; ?>" alt="Photo de profil"> 
                <?php foreach ($_POST as $valeur) { ?>
                    <li><?php echo $valeur; ?></li>
                <?php } ?>
            </ul>
    <?php }
    }


    function formValidator($array)
    {

        $userPtrn = "/^[a-zA-ZÀ-ÿ]+$/";
        $passPtrn = "/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z])().{0,}$/";

        $formErrors = [];

        foreach ($array as $cle => $valeur) {

            // Si le champ parcouru a pour clé firstName ou lastName
            if ($cle === "fName" || $cle === "lName") {

                // Alors procéder à la vérification des noms et prénoms (qui est identique).
                if (empty(trim($valeur)) || strlen($valeur) < 2 || strlen($valeur) > 25 || !preg_match($userPtrn, trim($valeur))) {
                    $formErrors[$cle] = TRUE;
                }
            }
            // Si le champ parcouru en est un autre ...
            else {

                // Si le champ est mail
                if ($cle === "mail") {
                    if (!filter_var($valeur, FILTER_VALIDATE_EMAIL)) {
                        $formErrors[$cle] = TRUE;
                    }
                }

                // Sinon, DANS CE CAS PRECIS, il ne reste plus que le champ motDePasse.
                if (strlen($valeur) < 8 && !preg_match($passPtrn, $valeur)) {
                    $formErrors[$cle] = TRUE;
                }

                if ($cle === "link1" || $cle === "link2" || $cle === "link3") {
                    if (!filter_var($valeur, FILTER_VALIDATE_URL)) {
                        $formErrors[$cle] = TRUE;
                    }
                }
            }
        }

        if (!empty($_FILES)) {
            $tempPath = $_FILES["img"]["tmp_name"];
            $definitivePath = './uploads/' . basename($_FILES["img"]["name"]);

            if (exif_imagetype($tempPath) != IMAGETYPE_JPEG) {
                $formErrors["img"] = TRUE;
            } else {
                move_uploaded_file($tempPath, $definitivePath);
            }
        }
        return $formErrors;
    }

    ?>

</body>

</html>