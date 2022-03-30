<?php

require_once "connexion.php";
 
$nom = $refer = $descri = $achat = $vente = $stock = $choix =  "";
$name_err = $refer_err = $descri_err = $achat_err = $vente_err = $stock_err = $choix_err = "";

// verifier la valeur id dans le post pour la mise à jour
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // recuperation du champ chaché
    $id = $_POST["id"];

    // Validate name
    $input_name = trim($_POST["nom"]);
    if(empty($input_name)){
        $name_err = "Veillez entrez un nom.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Veillez entrez a valid name.";
    } else{
        $nom = $input_name;
    }
    
    // Validation refer
    $input_refer = trim($_POST["refer"]);
    if(empty($input_refer)){
        $refer_err = "Veillez entrez une reference.";
    
    } else{
        $refer = $input_refer;
    }
    
    // Validation descri
    $input_descri = trim($_POST["descri"]);
    if(empty($input_descri)){
        $descri_err = "Veillez entrez une description.";     
    } else{
        $descri = $input_descri;
    
    }
    // Validation achat
    $input_achat = trim($_POST["achat"]);
    if(empty($input_achat)){
        $achat_err = "Veillez entrez le prix d'achat.";     
    } else{
        $achat = $input_achat;
    }

    // Validation vente
    $input_vente = trim($_POST["vente"]);
    if(empty($input_vente)){
        $vente_err = "Veillez entrez un prix de vente.";     
    } else{
        $vente = $input_vente;
    }
    
    // Validation stock
    $input_stock = trim($_POST["stock"]);
    if(empty($input_stock)){
        $stock_err = "Voici le stock!";     
    } elseif(!ctype_digit($input_stock)){
        $stock_err = "Veillez entrez une valeur positive.";
    } else{
        $stock = $input_stock;
    }
    // Validation choix
    $input_choix = trim($_POST["choix"]);
    if(empty($input_choix)){
        $choix_err = "Veuillez entrer votre choix!"; 
    } else{
        $choix = $input_choix;
    }
    
    
    // verifier les erreurs avant modification
    if(empty($name_err) && empty($refer_err) && empty($descri_err) && empty($achat_err) && empty($vente_err) && empty($stock_err) && empty($choix_err)){
        // Prepare an update statement
        $sql = "UPDATE `stock vap` SET nom=?, refer=?, descri=?, achat=?, vente=?, stock=?, choix=?, WHERE id=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind les variables
            mysqli_stmt_bind_param($stmt, "sssdddsi", $param_nom, $param_refer, $param_descri, $param_achat, $param_vente, $param_stock, $param_choix, $param_id);
            
            // Set parameters
            $param_nom = $nom;
            $param_refer = $refer;
            $param_descri = $descri;
            $param_achat = $achat;
            $param_vente = $vente;
            $param_stock = $stock; 
            $param_choix = $choix;
            $param_id = $id;
            
            // executer
            if(mysqli_stmt_execute($stmt)){
                // enregistremnt modifié, retourne
                header("location: index.php");
                exit();
            } else{
                echo "Oops! une erreur est survenue.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
} else{
    // si il existe un paramettre id
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // recupere URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare la requete
        $sql = "SELECT * FROM `stock vap` WHERE id = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind les variables
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Set parameters
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* recupere l'enregistremnt */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // recupere les champs
                    $nom = $row["nom"];
                    $refer = $row["refer"];
                    $descri = $row["descri"];
                    $achat = $row["achat"];
                    $vente = $row["vente"];
                    $stock = $row["stock"]; 
                    $choix = $row["choix"];
                } else{
                    // pas de id parametter valid, retourne erreur
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Oops! une erreur est survenue.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
        
        // Close connection
        mysqli_close($link);
    }  else{
        // pas de id parametter valid, retourne erreur
        header("location: error.php");
        exit();
    }
}
?>
 
 <!DOCTYPE html>
<html lang="en">
<head>
<link
      rel="icon"
      type="image/png"
      href="vapoter%20(1).png"
    />
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        .wrapper{
            width: 700px;
            margin: 0 auto;
        }
    </style>
</head>
<body><?php
require_once "header.php";?>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Entrez votre demande</h2>
                    <p>Remplir le formulaire pour enregistrer le produit souhaité dans la base de données</p>

                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Nom</label>
                            <input type="text" name="nom" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $nom; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Reference</label>
                            <input type="text" name="refer" class="form-control <?php echo (!empty($refer_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $refer; ?>">
                            
                            <span class="invalid-feedback"><?php echo $refer_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <input type="text" name="descri" class="form-control <?php echo (!empty($descri_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $descri; ?>">
                            <span class="invalid-feedback"><?php echo $descri_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Achat</label>
                            <input type="number" name="achat" class="form-control <?php echo (!empty($achat_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $achat; ?>">
                            <span class="invalid-feedback"><?php echo $achat_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Vente</label>
                            <input type="number" name="vente" class="form-control <?php echo (!empty($vente_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $vente; ?>">
                            <span class="invalid-feedback"><?php echo $vente_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Stock</label>
                            <input type="number" name="stock" class="form-control <?php echo (!empty($stock_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $stock; ?>">
                            <span class="invalid-feedback"><?php echo $stock_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Choix</label>
                            <input type="text" name="choix" class="form-control <?php echo (!empty($choix_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $choix; ?>">
                            <span class="invalid-feedback"><?php echo $choix_err;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Enregistrer">
                        <a href="index.php" class="btn btn-secondary ml-2">Annuler</a>
                    </form>
                </div>
            </div>        
        </div>
    </div><?php
require_once "footer.php";?>
</body>
</html>

