<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Vap factory</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link
      rel="icon"
      type="image/png"
      href="vapoter%20(1).png"
    />
    <style>
        .wrapper{
            width: 700px;
            margin: 0 auto;
        }
        table tr td:last-child{
            width: 120px;
        }
    </style>
</head>
<body><?php
require_once "header.php";?>
    <div class="wrapper p-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 d-flex justify-content-between">
                        <h2 class="pull-left">Cigarette electronique ou E-Liquid ? Faites votre choix ici !</h2>
                        <a href="contact.php" class="btn btn-success"><i class="bi bi-plus"></i> Ajouter une réference :</a>
                    </div>


                    <?php

                    require_once "connexion.php";
        
                    $sql = "SELECT * FROM `stock vap`";
                    
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Nom</th>";
                                        echo "<th>Refer</th>";
                                        echo "<th>decri</th>";
                                        echo "<th>Achat</th>";
                                        echo "<th>vente</th>";
                                        echo "<th>stock</th>";
                                        echo "<th>choix</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['nom'] . "</td>";
                                        echo "<td>" . $row['refer'] . "</td>";
                                        echo "<td>" . $row['descri'] . "</td>";
                                        echo "<td>" . $row['achat'] . "</td>";
                                        echo "<td>" . $row['vente'] . "</td>";
                                        echo "<td>" . $row['stock'] . "</td>";
                                        echo "<td>" . $row['choix'] . "</td>";
                                        echo "<td>";
                                            echo '<a href="readvap.php?id='. $row['id'] .'" class="me-3" ><span class="bi bi-eye"></span></a>';
                                            echo '<a href="update.php?id='. $row['id'] .'" class="me-3" ><span class="bi bi-pencil"></span></a>';
                                            echo '<a href="delete.php?id='. $row['id'] .'" ><span class="bi bi-trash"></span></a>';
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
              
                            mysqli_free_result($result);
                        } else{
                            echo '<div class="alert alert-danger"><em>Pas d\'enregistrement</em></div>';
                        }
                    } else{
                        echo "Oops! Une erreur est survenue";
                    }
                    mysqli_close($link);
                    ?>
                </div>
            </div>        
        </div>
    </div><?php
require_once "footer.php";?>
</body>
</html>