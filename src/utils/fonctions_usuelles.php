<?php
function getDebutHtml(string $title = "title content", string $css = "") : string {
    $pageDebutHTML = "<!DOCTYPE html>
<html lang=\"fr\">
<head>
    <meta charset=\"utf-8\" />
    <link rel=\"stylesheet\" href=\"{$css}\" />
    <script src=\"script.js\"></script>
    <title>{$title}</title>
</head>
<body>";
    return $pageDebutHTML;
}

function getFinHtml() : string {
    $pageFinHtml = "\n</body>"."\n</html>";
    return $pageFinHtml;
}

function intoBalise(string $nomElement, string $contenuElement, array $params=null): string {
    if($params == null) {
        if(strlen($contenuElement) == 0) {
            return "<br />";
        } else {
            return "\n\t<$nomElement>$contenuElement</$nomElement>";
        }
    } else {
        if(is_array($params)) {
            $chaineRetour = "\n\t<$nomElement ";
            foreach($params as $cle => $valeur) {
                if(strlen($valeur) != 0) {
                    $chaineRetour .= $cle."="."'".$valeur."'";
                } else {
                    $chaineRetour .= $cle;
                }
            }
            $chaineRetour .= ">$contenuElement</$nomElement>";
            return $chaineRetour;
        }
    }
}
?>