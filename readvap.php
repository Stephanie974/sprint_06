<?php
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
  
    require_once "connexion.php";
    

    $sql = "SELECT * FROM `stock vap` WHERE id = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
     
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        $param_id = trim($_GET["id"]);
        
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // les champs
                $nom = $row["nom"];
                $refer = $row["refer"];
                $descri = $row["descri"];
                $achat = $row["achat"];
                $vente = $row["vente"];
                $stock = $row["stock"];
                $stock = $row["choix"];
            } else{
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! une erreur est survenue.";
        }
    }
     
    // Close 
    mysqli_stmt_close($stmt);
    
    // Close 
    mysqli_close($link);
} else{
    header("location: error.php");
    exit();
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
    <title>Voir l'enregistrement</title>
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
                    <h1 class="mt-5 mb-3">Voir l'enregistremnt</h1>
                    <div class="form-group">
                        <label>Nom</label>
                        <p><b><?php echo $row["nom"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Reference</label>
                        <p><b><?php echo $row["refer"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <p><b><?php echo $row["descri"]; ?></b></p>
                    </div>
                    
                    <div class="form-group">
                        <label>Prix d'achat produit</label>
                        <p><b><?php echo $row["achat"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Prix de vente produit</label>
                        <p><b><?php echo $row["vente"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Quantité du stock</label>
                        <p><b><?php echo $row["stock"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Choix</label>
                        <p><b><?php echo $row["choix"]; ?></b></p>
                    </div>
                    <p><a href="index.php" class="btn btn-primary">Retour</a></p>
                </div>
            </div>        
        </div>
    </div>
    <?php
require_once "footer.php";?>
</body>
</html>
