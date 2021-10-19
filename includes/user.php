<?php
@$action = $_REQUEST["action"];
switch ($action) {
    case '1':
        include 'includes/user/user_dados.php';
    break;
    case '2':
        include 'includes/user/inserir_aves.php';
    break;
    case '3':
        include 'includes/user/store.php';
    break;
    case '4':
        include 'includes/user/store_emprestimo.php';
    break;
    case '5':
        include './vistas/usuarios.php';
    break;
}
?>