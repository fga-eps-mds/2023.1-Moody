<?php
defined('MOODLE_INTERNAL') || die();

function display_counter($username) {
    global $DB;

    // Verificar se o registro existe na tabela
    $salvo = $DB->get_record('local_plugin', array('username' => $username));

    if ($salvo) {
        // Exibir o valor do contador
        echo "O contador para o usuário " . $username . " é: " . $salvo->counter;
    } else {
      
        echo "Não foi encontrado nenhum registro para o usuário " . $username;
    }
}

function update_counter($username) {
    global $DB;

    // Verificar se o registro já existe na tabela
    $salvo = $DB->get_record('local_plugin', array('username' => $username));

    if ($salvo) {
        // Adiciona 1 ao contador
        $contador = $salvo->counter + 1;
        $DB->execute("UPDATE {local_plugin} SET counter = ? WHERE username = ?", array($contador, $username));
    } else {
        // Se não existe , cria e adiciona 1
        $DB->execute("INSERT INTO {local_plugin} (username, counter) VALUES (?, ?)", array($username, 1));
    }
}
function update_tempo($username, $tempo) {
    global $DB;

    $salvo = $DB->get_record('local_plugin', array('username' => $username));

    if ($salvo) {
        $tempo_acumulado = $salvo->tempo + $tempo;
        $contador = $salvo->counter;
        $tempo_medio = $tempo_acumulado / $contador;
        $DB->execute("UPDATE {local_plugin} SET tempo = ?, counter = ? WHERE username = ?", array($tempo_medio, $contador, $username));
        echo "o tempo medio é realmente e" . $tempo_medio;
    } else {
        
        $DB->execute("INSERT INTO {local_plugin} (username, tempo, counter) VALUES (?, ?, ?)", array($username, $tempo, 1));
    }
}


function contarAtividadesConcluidas($userid, $courseid) {
    global $DB , $USER;

    // Consulta SQL para buscar as atividades concluídas do usuário no curso
    $sql = "SELECT COUNT(*) AS count
            FROM {course_modules_completion} cmc
            INNER JOIN {course_modules} cm ON cm.id = cmc.coursemoduleid
            INNER JOIN {modules} m ON m.id = cm.module
            WHERE cmc.userid = :userid
            AND cm.course = :courseid
            AND cmc.completionstate = 1";

    // Parâmetros da consulta
    $params = [
        'userid' => $userid,
        'courseid' => $courseid
    ];

  // Atividades marcadas como concluidas
    $resultados = $DB->get_record_sql($sql, $params);


    echo "quantidade concluida" .  $resultados->count;

        $user = $USER;
        $username = fullname($user);
        $username = normal_username($username);
       
        $salvo = $DB->get_record('local_plugin', array('username' => $username));
        if($salvo){
            $DB->execute("UPDATE {local_plugin} SET concluidos = ? WHERE username = ?", array($resultados->count, $username));
            
       }
        else{echo "Usuario não encontrado" ;}
       
    $contadorAtividade = 0;

    // Obter o número de atividades do curso
    $contadorAtividade = $DB->count_records('course_modules', array('course' => $courseid));
    echo "quantidade total de atividades é " .  $contadorAtividade;
}

function normal_username($username) {
    // Remove espaços em branco e converte para letras minúsculas
    $simplesUsername = strtolower(str_replace(' ', '', $username));
    return $simplesUsername;
}




function local_plugin() {
    global $PAGE, $USER;

    // Obtém a URL atual
    $url = $PAGE->url;

 
    $url_string = strval($url);

    // Exibe a URL
    //echo $url_string;
    $parsed_url = parse_url($url_string);
    $path = $parsed_url['path'];

    $context = context_user::instance($USER->id);



    // Verifica se o caminho da URL corresponde ao valor desejado e se o usuario é um aluno
    if ($path === '/course/view.php' && ! has_capability('moodle/course:update', $context)) {
        $_SESSION['tempoEntrada'] = time();
       
        echo $_SESSION['tempoEntrada'] ; 
        $_SESSION['foiAcessado'] = 1;
       

        //echo 'A URL atual corresponde a http://localhost/course/view.php'; //caso queira verificar as mudanças
        $context = context_system::instance();

    // Obter o objeto do usuário atualmente logado
        $user = $USER;
       
    // Obter o nome completo do usuário
        $username = fullname($user);
        $username = normal_username($username);
        $_SESSION['username'] = $username ;
       
        
        update_counter($username);
        display_counter($username); //caso queira verificar a atualização
      
        $_SESSION['courseid'] = $_GET['id'];
       
      

    } else {
      
        if($_SESSION['foiAcessado'] == 1){
            $_SESSION['foiAcessado'] = 0; 
            $tempoSaida = time();
          
           $tempo = round(($tempoSaida - $_SESSION['tempoEntrada']) / 60);
           
           echo "o tempo medio é " . $tempo;
            $user = $USER;
    
            $username = fullname($user);
            $username = normal_username($username);
           update_tempo($username , $tempo);
           $userid = $user->id;
           $courseid = $_SESSION['courseid'] ;
         
           contarAtividadesConcluidas($userid, $courseid);
            
           
           
        }
        //echo 'A URL atual não corresponde a http://localhost/course/view.php'; //caso queira verificar as mudanças
    }

}
//botão de redirecionamento para o moody
function local_plugin_before_footer() {
    global $PAGE;
    
     if ($PAGE->pagetype == 'site-index'){
    $url = new moodle_url('/local/plugin/pag.php');
    $link = html_writer::link($url, 'Ir para outra página');
    echo $link;}
    local_plugin();
}



