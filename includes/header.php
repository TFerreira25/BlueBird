<header>
	<?php
	include 'connections/conn.php';
	$query = mysqli_fetch_array(mysqli_query($conn, "SELECT wb_nome from webdados where wb_id = 1"));
	$nome = $query["wb_nome"];
	include 'connections/deconn.php';
	echo '<nav class="navbar navbar-expand-md navbar-light bg-light mb-4">
    	<div class="container-fluid">';
			echo '<a class="navbar-brand" href="?opt=0">
				<img src="logo_PAP_azul.png" style="width: 10%; height: 10%"><label style="padding-left: 2%"><b style="color: blue">'.substr($nome, 0, $length = 4).'</b>'.substr($nome, 4, $length = mb_strlen($nome)).'</label>
			</a>';
			echo '<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarCollapse">
				<ul class="navbar-nav ms-auto me-5 mb-md-1 nav-pills d-flex">';
						if(@$_SESSION["log_type"] != ''){
							if (@$_SESSION["log_type"] == '0') {//separa menus de admin dos restantes
								include 'includes/lista_menu_admin.php';
							}else if (@$_SESSION["log_type"] == '1'){
								include 'includes/lista_menu_vet.php';
							}else if (@$_SESSION["log_type"] == '2'){
								include 'includes/lista_menu_user.php';
							}
							echo '
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-bs-toggle="dropdown" aria-expanded="false">';
									include 'connections/conn.php';
									$sql = mysqli_fetch_array(mysqli_query($conn, "Select uti_nome, uti_apelido, uti_foto from utilizador where uti_log_id = '$_SESSION[log_id]'"));
									echo '<img src="assets/img/foto_perfil/'.$sql["uti_foto"].'" style="width:2em; height: 2em; border-radius:50%"><label>&nbsp;'.$sql["uti_nome"].' '.$sql["uti_apelido"].'</label>
								</a>
								<ul class="dropdown-menu" aria-labelledby="dropdown03">';
								echo '<li><a class="dropdown-item" href="includes/terminar_sessao.php">Sair</a></li>
								</ul>
							</li>';
							//echo '<li class="nav-item"><a class="nav-link" href="includes/terminar_sessao.php"><i class="fas fa-sign-out-alt"></i> Sair</a></li>';
						}else{
							include 'includes/lista_main.php';
						}
				echo '</ul>
			</div>
    	</div>
    </nav>';