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
            if(empty($_POST)){ ?>
                <h1><?php echo "Le formulaire n'a pas été envoyé"; ?></h1>
    <?php   }

            // Sinon (c'est que le formulaire a été envoyé par méthode POST)
            else{ 

                /* Patterns qui vous seront utiles par la suite afin de contrôler via la fonction preg_match que :
                   - $userPtrn : le nom et le prénom contiennent exclusivement des lettres majuscules, minuscules et accentueés.
                   - $passPtrn : le mot de passe contient au minimum un chiffre, une minuscule, une majuscule et un caractère spécial.
                */

                $userPtrn = "/^[a-zA-ZÀ-ÿ]+$/";
                $passPtrn = "/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z])().{0,}$/";

                /*  Stocke la saisie de l'utilisateur renseignée dans le champ HTML dont 
                    l'attribut name vaudrait "firstname" dans une nouvelle variable $fName. */
                $fName = $_POST["firstname"];

                /*  Test conditionnel de la saisie associée au champ nom :
                    Le champ est considéré valide si il : 
                    - n'est pas vide (espaces en début et fin de chaines retirés via TRIM pour les hackeurs du dimanche qui ne renseigneraient que des espaces)
                    - contient au minimum 2 caractères.
                    - contient au maximum 25 caractères.
                    - est conforme au pattern attendu (déclaré dans la variable $userPtrn).
                */

                if(!empty(trim($fName)) && strlen($fName) > 1 && strlen($fName) < 26 && preg_match($userPtrn, $fName)){
                    echo "Champ nom : OK";
                }
                else{
                    echo "Champ nom : MAL RENSEIGNÉ";
                }

                /*  Test conditionnel de la saisie associée au champ prénom :
                    Le champ est considéré valide si il : 
                    - n'est pas vide (espaces en début et fin de chaines retirés via TRIM pour les hackeurs du dimanche qui ne renseigneraient que des espaces)
                    - contient au minimum 2 caractères.
                    - contient au maximum 25 caractères.
                    - est conforme au pattern attendu (déclaré dans la variable $userPtrn).
                */
                if(){}
                else{}

                /*  Test conditionnel de la saisie associée au champ nom :
                    Le champ est considéré valide si il : 
                    - est conforme au format e-mail (voir la doc FILTER_VALIDATE_EMAIL).
                */
                if(){}
                else{}

                /*  Test conditionnel de la saisie associée au champ mot de passe :
                    Le champ est considéré valide si il :
                    - contient au minimum 8 caractères
                    - est conforme au pattern attendu (déclaré dans la variable $passPtrn).
                */
                if(){}
                else{}
            } 
    ?>

</body>
</html>

