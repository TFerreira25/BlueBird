$(document).ready(function() {
    /*Avisos de erro ocultos*/
    $('#pswd_info').hide();
    $("#erros").hide();
    $("#erro_nome").hide();
    $("#erro_apelido").hide();
    $("#erro_data").hide();
    $("#erro_email").hide();
    $("#erro_pw").hide();
    $("#erro_pw_2").hide();
    $("#erro_checkbox").hide();
    //$("#mostra_ave").hide();

    /*animação para aparecer o contacto no botão após o click*/
    $("#numero").click(function(){
        var contacto = $("#contacto").val();
        if($("#numero").val() == "Número"){
            $.post('verifica_numero.php', { contacto: contacto}, function(data){
                if(data == 0){
                    $("#numero").attr({
                        "value" : "Sem número"
                    });
                }else{
                    $("#numero").attr({
                        "value" : data
                    });
                }
            })
        }else{
            $("#numero").attr({
                "value" : "Número"
            });
            
        }
    });

    $("#ranger_text").on("input change", function(){
        var mostra = $("#ranger_text").val();
        $("#mostra_ranger").html("(" + mostra + ")");
    });
    /*Troca de login com o registar*/
    $("#login").show();
    $("#registo").hide();
    $("#fazer_registo").click(function(){
        $("#login").hide().fadeOut(100);
        $("#registo").fadeIn(500);
    });
    $("#fazer_login").click(function(){
        $("#registo").hide().fadeOut(100);
        $("#login").fadeIn(500);
    });
    /*preenchimento das checkbox correspondetes ao concelho e a freguesia*/
    $("#distrito").click(function(){
        var distrito = $("#distrito").val();
        var concelho = $("#distrito").val();
        $.post('concelho.php', { distrito: distrito, concelho: concelho }, function(data){
            $("#concelho").html(data);
        })
    });

    $("#concelho").click(function(){
        var concelho = $("#concelho").val();
        $.post('freguesia.php', { concelho: concelho }, function(data){
            $("#freguesia").html(data);
        })
    });
    
    /*Validação da password forte*/
    $('#reg_password').keyup(function() {
		var pswd = $(this).val();
		//validate the length
		if ( pswd.length <= 8 ) {
			$('#length').removeClass('text-primary').addClass('text-danger');
		} else {
			$('#length').removeClass('text-danger').addClass('text-primary');
		}
		//validate letter
		if ( pswd.match(/[A-z]/) ) {
			$('#letter').removeClass('text-danger').addClass('text-primary');
		} else {
			$('#letter').removeClass('text-primary').addClass('text-danger');
		}
		//validate capital letter
		if ( pswd.match(/[A-Z]/) ) {
			$('#capital').removeClass('text-danger').addClass('text-primary');
		} else {
			$('#capital').removeClass('text-primary').addClass('text-danger');
		}
		//validate number
		if ( pswd.match(/\d/) ) {
			$('#number').removeClass('text-danger').addClass('text-primary');
		} else {
			$('#number').removeClass('text-primary').addClass('text-danger');
		}
		
		//validate space
		if ( pswd.match(/[^a-zA-Z0-9\-\/]/) ) {
			$('#space').removeClass('text-danger').addClass('text-primary');
		} else {
			$('#space').removeClass('text-primary').addClass('text-danger');
		}
		
	}).focus(function() {
		$('#pswd_info').show();
        $("#erro_pw").hide();
        $("#erro_pw_2").hide();
	}).blur(function() {
		$('#pswd_info').hide();
	});
    
    /*registo do utilizador*/
    $("#btn_registar").click(function(){
        $("#erros").show();
        $("#erro_nome").hide();
        $("#erro_apelido").hide();
        $("#erro_data").hide();
        $("#erro_email").hide();
        $("#erro_pw").hide();
        $("#erro_pw_2").hide();
        var reg_nome = $("#reg_nome").val();
        var reg_apelido = $("#reg_apelido").val();
        var reg_data = $("#reg_data").val();
        var reg_email = $("#reg_email").val();
        var reg_pw = $("#reg_password").val();
        var reg_pw_2 = $("#reg_password_check").val();
        var erro = "";
        var contagem = 0;

        if (reg_nome != "") {
			contagem += 1;
		} else {
            $("#erro_nome").show();
            $("#erro_nome").html("Campo de nome vazio");
        }
        if (reg_apelido != "") {
			contagem += 1;
		} else {
            $("#erro_apelido").show();
            $("#erro_apelido").html("Campo de apelido vazio");
        }
        if (reg_data != "") {
			contagem += 1;
		} else {
            $("#erro_data").show();
            $("#erro_data").html("Campo de data vazio");
        }
        if (reg_email == "") {
            $("#erro_email").show();
            $("#erro_email").html("Campo Email vazio");
        }else{
            if(!reg_email.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)){
                $("#erro_email").show();
                $("#erro_email").html("Formato de email inválido");
            }else if (reg_email != "") {
                contagem += 1;
            }
        }
        
        if (!(reg_pw.length < 8) && (reg_pw.match(/[A-z]/)) && (reg_pw.match(/[A-Z]/)) && (reg_pw.match(/\d/)) && (reg_pw.match(/[^a-zA-Z0-9\-\/]/))) {
            contagem += 1;
		} else {
            $("#erro_pw").show();
            $("#erro_pw").html("Campo de password vazio");
        }
        if (reg_pw_2 == "") {
			$("#erro_pw_2").show();
            $("#erro_pw_2").html("Campo de confirmação de password vazio");
		} else {
            if(reg_pw_2 == reg_pw){
                contagem+=1;
            }else if(reg_pw_2 != reg_pw){
                $("#erro_pw_2").show();
                $("#erro_pw_2").html("Passwords diferentes");
            }
        }
        if($('#reg_termos_condicoes').prop('checked')){
            contagem+=1;
        }else{
            $("#erro_checkbox").show();
            $("#erro_checkbox").html("Necessita de aceitar os Termos e Condições");
        }
        if(contagem == 7){
            $.post('registar.php', { nome: reg_nome, apelido: reg_apelido, data: reg_data, email: reg_email, pw: reg_pw}, function(data){
                if(data == 0){
                    $("#erros").show();
                    $("#erros").html("Email Existente");
                }else{
                    $("#erros").show();
                    $("#erros").html(data);
                }
            })
        }
    });

    $("#btn_login").click(function(){
        $("#erro_email").hide();
        $("#erro_pw").hide();
        var log_email = $("#log_email").val();
        var log_pw = $("#log_password").val();
        var contagem = 0;

        if (log_email == "") {
            $("#erro_email").show();
            $("#erro_email").html("Campo Email vazio");
        }else{
            if(!log_email.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)){
                $("#erro_email").show();
                $("#erro_email").html("Formato de email inválido");
            }else if (log_email != "") {
                contagem += 1;
            }
        }
        if (log_pw == "") {
			$("#erro_pw").show();
            $("#erro_pw").html("Campo de Password Vazio");
		} else {
            contagem+=1;
        }
        
        if(contagem == 2){
            $.post('login.php', {email: log_email, pw: log_pw}, function(data){
                $("#erros").show();
                $("#erros").html(data);
            })
        }
    });

    $("#especie").click(function(){
        var especie = $("#especie").val();
        $.post('variedades.php', { especie: especie}, function(data){
            $("#variedade").html(data);
        })
    });

    $("#variedade").click(function(){
        var variedade = $("#variedade").val();
        $.post('mutacao.php', { variedade: variedade}, function(data){
            $("#mutacao").html(data);
        })
    });

    $("#email_enviar").click(function(){
        var continuar = 0;
        var email = $("#email_user").val();
        var assunto = $("#email_assunto").val();
        var texto = $("#email_texto").val();
        var id_user = $("#log_id").val();
        var id = $("#id_ave").val();
        var erro = "";
        if(id_user == ""){
            if(email != ""){
                if(email.match(/^[a-z0-9][a-z0-9.]+@+([a-z0-9])+.+[a-z]{2,3}$/i)){
                    continuar += 1;
                }else{
                    erro += "Formato de email errado<br>";
                }
            }else{
                erro += "Campo de email vazio<br>";
            }
        }
        if(assunto != ""){
            continuar += 1;
        }else{
            erro += "Campo de assunto vazio<br>";
        }
        if(texto != ""){
            continuar += 1;
        }else{
            erro += "Campo de mensagem vazio<br>";
        }
        if(continuar == 3){
            $.post('enviar_email.php', {email: email, assunto: assunto, texto: texto, id: id, id_user: id_user}, function(data){
                $("#mensagem").removeClass("text-danger").addClass("text-primary");
                $("#mensagem").html(data);
            })
        }else{

            $("#mensagem").removeClass("text-primary").addClass("text-danger");
            $("#mensagem").html(erro);
            erro="";
        }
    });

    //empréstimo
    $("#pesq_palavra").keyup(function(){
        var texto = $('#pesq_palavra').val().length;
        if(texto > 1) {
            $("#mostra_ave").show();
            $("#mostra_ave_default").hide();
            var search = $(this).val();
            if (search != "") {
                $.ajax({url : "mostra_emprestimo.php",type: "POST",data:{pesquisa:search},success:function(response){
                    $("#mostra_ave").html(response);
                }
                });
            }
        } else {
            $("#mostra_ave").hide();
            $("#mostra_ave_default").show();
        }
    });

    //venda
    $("#pesq_palavra_venda").keyup(function(){
        var texto = $('#pesq_palavra_venda').val().length;
        if(texto > 1) {
            $("#mostra_ave").show();
            $("#mostra_ave_default").hide();
            var search = $(this).val();
            if (search != "") {
                $.ajax({url : "mostra_venda.php",type: "POST",data:{pesquisa:search},success:function(response){
                    $("#mostra_ave").html(response);
                }
                });
            }
        } else {
            $("#mostra_ave").hide();
            $("#mostra_ave_default").show();
        }
    });

    //geral
    $("#pesq_palavra_main").keyup(function(){
        var texto = $('#pesq_palavra_main').val().length;
        if(texto > 1) {
            
            $("#main_pesquisa").show();
            $("#main").hide();
            var search = $(this).val();
            if (search != "") {
                
                $.ajax({url : "pesquisa_main.php",type: "POST",data:{pesquisa:search},success:function(response){
                    $("#main_pesquisa").html(response);
                }
                });
            }
        } else {
            $("#main_pesquisa").hide();
            $("#main").show();
        }
    });

    $("#pesq_palavra_perdido").keyup(function(){
        //alert($(this).val());
        var texto = $('#pesq_palavra_perdido').val().length;
        if(texto > 1) {
            $("#mostra_ave").show();
            $("#mostra_ave_default").hide();
            var search = $(this).val();
            if (search != "") {
                $.ajax({url : "mostra_perdido.php",type: "POST",data:{pesquisa:search},success:function(response){
                    $("#mostra_ave").html(response);
                }
                });
            }
        } else {
            $("#mostra_ave").hide();
            $("#mostra_ave_default").show();
        }
    });
    $("#columbofila_result").show();
    $("#ornitologica_result").hide();
    $("#columbofila").click(function(){
        $("#ornitologica_result").hide().fadeOut(100);
        $("#columbofila_result").fadeIn(500);
    });
    $("#ornitologica").click(function(){
        $("#columbofila_result").hide().fadeOut(100);
        $("#ornitologica_result").fadeIn(500);
    });
});

/*var ativerIntervalo = function() {
    var intervalo = setInterval(function() {
    setTimeout(ativerIntervalo, 1000);
    var id = $('#num_id').val();
    $.ajax({
        url : "status.php",
        type: "POST",
        data:{query:id},
        success:function(response){
        $("#status").html(response);
        }
    });
  }, 1000);
};
ativerIntervalo();*/