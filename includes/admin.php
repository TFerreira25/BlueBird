<?php
@$admin = $_REQUEST["admin"];
switch ($admin) {
    case '1'://webdados-Página de dados da empresa
        include 'includes/admin/cargos.php';
    break;
    case '2'://webdados-Página de dados da empresa
        include 'includes/admin/lista_associacoes.php';
    break;
    case '3'://webdados-Página de dados da empresa
        include 'includes/admin/institucional.php';
    break;
}
?>