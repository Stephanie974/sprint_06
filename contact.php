<?php

require_once "connexion.php";
 
$nom = $refer = $descri = $achat = $vente = $stock = $choix = "";
$name_err = $refer_err = $descri_err = $achat_err = $vente_err = $stock_err = $choix_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
//nom
    $input_name = trim($_POST["nom"]);
    if(empty($input_name)){
        $name_err = "Veuillez entrez un nom.";
     } else{
        $nom = $input_name;
    }
    // refer
    $input_refer = trim($_POST["refer"]);
    if(empty($input_refer)){
        $refer_err = "Veuillez entrez une reference.";
    } else{
        $refer = $input_refer;
    }
    
    //  descri
    $input_descri = trim($_POST["descri"]);
    if(empty($input_descri)){
        $descri_err = "Veillez entrez une description.";     
    } else{
        $descri = $input_descri;  
    }
    //  achat
    $input_achat = trim($_POST["achat"]);
    if(empty($input_achat)){
        $achat_err = "Veillez entrez le prix d'achat.";     
    } else{
        $achat = $input_achat;
    }

    //  vente
    $input_vente = trim($_POST["vente"]);
    if(empty($input_vente)){
        $vente_err = "Veillez entrez un prix de vente.";     
    } else{
        $vente = $input_vente;
    }
    
    // stock
    $input_stock = trim($_POST["stock"]);
    if(empty($input_stock)){
        $stock_err = "Voici le stock!";     
    } else{
        $stock = $input_stock;
    }
    // choix
    $input_choix = trim($_POST["choix"]);
    if(empty($input_choix)){
        $choix_err = "Voici le choix!";     
    } else{
        $choix = $input_choix;
    }
    
    if(empty($name_err) && empty($refer_err) && empty($descri_err) && empty($achat_err) && empty($vente_err) && empty($stock_err) && empty($choix_err)){
        echo "je suis entrée dan sla boucle";
        $sql = "INSERT INTO `stock vap` (nom, refer, descri, achat, vente, stock, choix) VALUES (?, ?, ?, ?, ?, ?, ?)";

       
        if($stmt = mysqli_prepare($link, $sql)){
        echo "je suis entrée dan sla boucle";
            mysqli_stmt_bind_param($stmt, "sssddds", $param_nom, $param_refer, $param_descri, $param_achat, $param_vente, $param_stock, $param_choix);
            
        
            $param_nom = $nom;
            $param_refer = $refer;
            $param_descri = $descri;
            $param_achat = $achat;
            $param_vente = $vente;
            $param_stock = $stock;
            $param_choix = $choix;
        
            if(mysqli_stmt_execute($stmt)){
    
                header("location: index.php");
                exit();
            } else{
                echo "Oops! une erreur est survenue.";
            }
        }
         
        mysqli_stmt_close($stmt);
    }

    mysqli_close($link);
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
<body>
<?php
require_once "header.php";?>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-2">Entrez votre demande</h2>
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
                            <!-- //<textarea name="ecole" class="form-control //<?php echo (!empty($ecole_err)) ? 'is-invalid' : ''; ?>">//<?php echo $ecole; ?></textarea> -->
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
                        <input type="submit" class="btn btn-primary" value="Enregistrer">
                        <a href="index.php" class="btn btn-secondary ml-2">Annuler</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
    <?php
require_once "footer.php";?>
</body>
</html>

