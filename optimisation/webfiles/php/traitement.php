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
                var_dump(formValidator($_POST));
            } 


            function formValidator($array){

                $userPtrn = "/^[a-zA-ZÀ-ÿ]+$/";
                $passPtrn = "/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z])().{0,}$/";
                    
                $formErrors = [];

                foreach($array as $cle => $valeur){

                    // Si le champ parcouru a pour clé firstName ou lastName
                    if($cle === "firstName" || $cle === "lastName"){

                        // Alors procéder à la vérification des noms et prénoms (qui est identique).
                        if(empty(trim($valeur)) || strlen($valeur) < 2 || strlen($valeur) > 25 || !preg_match($userPtrn, trim($valeur))){
                            $formErrors[$cle] = TRUE;
                        }
                    }
                    // Si le champ parcouru en est un autre ...
                    else{

                        // Si le champ est mail
                        if($cle === "mail"){
                            if(!filter_var($valeur, FILTER_VALIDATE_EMAIL)){
                                $formErrors[$cle] = TRUE;
                            }
                        }

                        // Sinon, DANS CE CAS PRECIS, il ne reste plus que le champ motDePasse.
                        else{
                            if(strlen($valeur) < 8 && !preg_match($passPtrn, $valeur)){
                                $formErrors[$cle] = TRUE;
                            }
                        }
                    }
                }
                
                return $formErrors;
            }
    ?>

</body>
</html>

