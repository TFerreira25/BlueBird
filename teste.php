<?php 
/*include 'connections/conn.php';
$query = "SELECT soc_morada, soc_id from sociedade where soc_tipo = 1 and soc_id != 49";
$sociedade = mysqli_query($conn, $query);
while($soc = mysqli_fetch_array($sociedade)){
    $array2 = explode(" ",$soc["soc_morada"]);
    $texto = "";
    for($i = 0; $i<Count($array2); $i++){
        if($array2[$i] == "DE" || $array2[$i] == "DO" || $array2[$i] == "DA"){
            $texto .= strtolower($array2[$i]).' ';
        }else{
            $texto .= mb_convert_case($array2[$i],  MB_CASE_TITLE).' ';
        }
    }
    mysqli_query($conn, "UPDATE sociedade set soc_nome = '$texto' where soc_tipo = 1 and soc_id = '$soc[soc_id]'");
    echo $texto.'<br>';
}*/

$string = "Dave We're All Alone In This Together";
$string = str_replace('\'', '&#39;', $string);
print_r($string);