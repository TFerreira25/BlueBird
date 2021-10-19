<?php
@$action = $_REQUEST["action"];
switch ($action) {
    case '1':
        include 'includes/vet/faqs.php';
    break;
    case '2':
        include 'includes/vet/alimentacao.php';
    break;
    case '3':
        include 'includes/vet/doenca.php';
    break;
}
?>