<?php
include 'connections/conn.php';
$assunto= mysqli_real_escape_string($conn,$_REQUEST["assunto"]); 
$texto= mysqli_real_escape_string($conn,$_REQUEST["texto"]); 
$id = intval($_REQUEST["id"]); 
$id_user = intval($_REQUEST["id_user"]);
$dados = mysqli_fetch_array(mysqli_query($conn, "SELECT * from ave 
join especie on especie.esp_id = ave.ave_especie 
join variedade on ave.ave_variedade = variedade.var_id
join mutacao on ave.ave_mutacao = mutacao.mut_id 
where ave.ave_id = '$id'"));
if(@$id_user != null){
    $query = mysqli_fetch_array(mysqli_query($conn, "SELECT log_email from login where log_id = '$id_user'"));
    $email = $query["log_email"];
}else{
    $email= mysqli_real_escape_string($conn,$_REQUEST["email"]);
}
$dados_user = mysqli_fetch_array(mysqli_query($conn, "SELECT log_email from login 
where log_id = '$dados[ave_log_id]'"));
$to_email = $dados_user["log_email"];
switch(@$dados["ave_genero"]){
    case 1:
        $genero = "Macho";
        break;
    case 2:
        $genero = "Fêmea";
        break;
}
switch(@$dados["ave_estado"]){
    case 1:
        $estado = "Venda";
        break;
    case 2:
        $estado = "Empréstimo";
        break;
    case 3:
        $estado = "Indisponível";
        break;
    case 4:
        $estado = "Perdido";
        break;
}
switch(@$dados["ave_doenca"]){
    case 0:
        $doenca = "Não";
        break;
    case 1:
        $doenca = "Sim";
        break;
}
if(@$dados["ave_estado"] == 1){
    $preco = '<h5 class="mt-2"><b>Preço</b>: '.@$dados["ave_preco"].'€</h5><br>';
};
/*No body a imagem não funciona porque nos falta o servidor para evocar a imagem para o email*/
$body = '<h3>Mensagem do cliente:</h3>
        Assunto:<br>'.@$assunto.'
        <br>Mensagem:<br>'.@$texto.'
        <hr>
        <h3 class="card-title text-center">Dados de identificação de Ave</h3>
        <h4>Anilha: '.@$dados["ave_anilha"].'</h4>
        <!--<img src="assets/img/aves/'.@$dados["ave_foto"].'" style="width: 35%;">-->
        <b>Espécie</b>: '.@$dados["esp_nome"].'<br><b>Variedade</b>: '.@$dados["var_nome"].'<br><b>Mutação</b>: '.@$dados["mut_nome"].'<br>
        <b>Ano</b>:'.@$dados["ave_ano"].'<br>
        <b>Género</b>:'.@$genero.'<br>
        <b>Estado</b>:'.@$estado.'<br><b>Posturas</b>: '.@$dados["ave_postura"].'<br> 
        '.@$preco.'
        <b style="color: red">Email a contactar:</b>'.@$email.'<br>
        <label style="color: red"> Não responda a este email </label>
';

$headers[] = "From: bluebirdenterprisesy@gmail.com";
$headers[] = 'MIME-Version: 1.0';
$headers[] = 'Content-type: text/html; charset=iso-8859-1';
if (mail($to_email, "Pedido de Contacto", $body, implode("\r\n", $headers))) {
    echo 'Email Enviado com sucesso!';
}