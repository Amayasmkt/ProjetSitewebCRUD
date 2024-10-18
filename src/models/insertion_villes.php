<?php
    require('../utils/fonctions_usuelles.php');
    require('../utils/fonctions_villes.php');

    $pageHTML = getDebutHtml("Insertion de villes");

    $tableauFormulaire = "<table border='0'><tr>";

    $tableauFormulaire .= "<th>Nom de la ville: </th>";
    $tableauFormulaire .= "<td>".intoBalise("input","",array("type"=>"text","name"=>"ville_nom","required"=>""))
                            ."</td>"."</tr>";

    $tableauFormulaire .= "<tr>"."<th>Département de la ville: </th>";
    $tableauFormulaire .= "<td>".intoBalise("input","",array("type"=>"text","name"=>"ville_department","required"=>""))
                            ."</td>"."</tr>";
    
    $tableauFormulaire .= "<tr>"."<th>Région de la ville: </th>";
    $tableauFormulaire .= "<td>".intoBalise("input","",array("type"=>"text","name"=>"ville_region","required"=>""))
                            ."</td>"."</tr>"; 

    $tableauFormulaire .= "<tr>".intoBalise("td",intoBalise("button","Envoyer",array("type"=>"submit")));
    $tableauFormulaire .= intoBalise("td",intoBalise("button","Effacer",array("type"=>"reset")))."</tr>";
                        
    $tableauFormulaire .= "</table>";
                            
    $body = $tableauFormulaire;
                        
    $formulaire = intoBalise("form",$body,array("action"=>"../controllers/inserer_villes.php","method"=>"post"));
                            
    $pageHTML .= $formulaire;

    $pageHTML .= getFinHtml();
    echo $pageHTML;
?>