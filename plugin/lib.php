<?php
defined('MOODLE_INTERNAL') || die();

function display_counter($professor, $turma, $username) {
    global $DB;

    // Verificar se o registro existe na tabela
    $salvo = $DB->get_record('local_plugin', array('professor' => $professor , 'turma' => $turma , 'username' => $username));

    if ($salvo) {
        // Exibir o valor do contador
        echo "O contador para o usuário " . $username . " é: " . $salvo->counter;
    } else {
      
        echo "Não foi encontrado nenhum registro para o usuário " . $username;
    }
}

function update_counter($professor, $turma, $username) {
    global $DB;

    // Verificar se o registro já existe na tabela
    $salvo = $DB->get_record('local_plugin', array('professor' => $professor , 'turma' => $turma , 'username' => $username));

    if ($salvo) {
        // Adiciona 1 ao contador
        $contador = $salvo->counter + 1;
        $DB->execute("UPDATE {local_plugin} SET counter = ? WHERE professor = ? AND turma = ? AND username = ?", array($contador, $professor, $turma, $username));
    } 
    else{
        $salvo = $DB->get_record('local_plugin', array('professor' => $professor ));

        $DB->execute("INSERT INTO {local_plugin} (professor, turma, username, counter) VALUES (? , ? , ? , ? )", array($professor, $turma, $username, 1));
                    
        }
    }
function update_tempo($professor, $turma, $username, $tempo) {
    global $DB;

    $salvo = $DB->get_record('local_plugin', array('professor' => $professor , 'turma' => $turma , 'username' => $username));

    if ($salvo) {
        $tempo_acumulado = $salvo->tempo + $tempo;
        $contador = $salvo->counter;
        $tempo_medio = $tempo_acumulado / $contador;
        $DB->execute("UPDATE {local_plugin} SET tempo = ?, counter = ? WHERE professor = ? AND turma = ? AND username = ?", array($tempo_medio, $contador, $professor, $turma, $username));
        //echo "o tempo medio é realmente e" . $tempo_medio;
    } else {
        
        $DB->execute("INSERT INTO {local_plugin} (professor, turma,username, tempo, counter) VALUES (? , ?, ?, ?, ?)", array($professor, $turma, $username, $tempo, 1));
    }
}


function contarAtividadesConcluidas($professor, $turma, $userid, $courseid) {
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


    //echo "quantidade concluida" .  $resultados->count;

        $user = $USER;
        $username = fullname($user);
        $username = normal_username($username);
       
        $salvo = $DB->get_record('local_plugin', array('professor' => $professor , 'turma' => $turma , 'username' => $username));
        if($salvo){
            $DB->execute("UPDATE {local_plugin} SET concluidos = ? WHERE professor = ? AND turma = ? AND username = ?", array($resultados->count, $professor, $turma, $username));
            
       }
        else{echo "Usuario não encontrado" ;}
       
    $contadorAtividade = 0;

    // Obter o número de atividades do curso
    $contadorAtividade = $DB->count_records('course_modules', array('course' => $courseid));
    //echo "quantidade total de atividades é " .  $contadorAtividade;
}

function normal_username($username) {
    // Remove espaços em branco e converte para letras minúsculas
    $simplesUsername = strtolower(str_replace(' ', '', $username));
    return $simplesUsername;
}




function local_plugin() {
    global $PAGE, $USER , $DB;

    // Obtém a URL atual
    $url = $PAGE->url;

 
    $url_string = strval($url);

    // Exibe a URL
    //echo $url_string;
    $parsed_url = parse_url($url_string);
    $path = $parsed_url['path'];

    $context = context_user::instance($USER->id);



    // Verifica se o caminho da URL corresponde ao valor desejado e se o usuario é um aluno
    if ($path === '/course/view.php' /*&& ! has_capability('moodle/course:update', $context)*/) {
        $_SESSION['tempoEntrada'] = time();
       
       
        $_SESSION['foiAcessado'] = 1;
       

        //echo 'A URL atual corresponde a http://localhost/course/view.php'; //caso queira verificar as mudanças
        $context = context_system::instance();

    // Obter o objeto do usuário atualmente logado
        $user = $USER;
       
    // Obter o nome completo do usuário
        $username = fullname($user);
        $username = normal_username($username);
        $_SESSION['username'] = $username ;
        $_SESSION['courseid'] = $_GET['id'];
        $turma = $DB->get_record('course', array('id' => $_SESSION['courseid']) , '*' , MUST_EXIST);

        if ($turma) {
            // Obter o nome do curso
            $NomeTurma = $turma->fullname;
            $sql = "SELECT u.id
                FROM {role_assignments} ra
                JOIN {context} ctx ON ra.contextid = ctx.id
                JOIN {user} u ON ra.userid = u.id
                WHERE ctx.contextlevel = :contextlevel
                AND ctx.instanceid = :courseid
                AND ra.roleid = :roleid";

        $params = array(
            'contextlevel' => CONTEXT_COURSE,
            'courseid' => $_SESSION['courseid'],
            'roleid' => 3 
        );

        $professorId = $DB->get_field_sql($sql, $params);
        $PerfilProfessor = $DB->get_record('user', array('id' => $professorId), '*', MUST_EXIST);
        $PerfilProfessor = fullname($PerfilProfessor);
        $NomeProfessor= normal_username($PerfilProfessor);
        
        
        
    }
        $_SESSION['professor'] = $NomeProfessor ;
        $_SESSION['turma'] = $NomeTurma ;
        update_counter($_SESSION['professor'], $_SESSION['turma'], $_SESSION['username']);
        //display_counter($_SESSION['professor'], $_SESSION['turma'], $_SESSION['username']); //caso queira verificar a atualização
      
      
       
      

    } else {
      
        if($_SESSION['foiAcessado'] == 1){
            $_SESSION['foiAcessado'] = 0; 
            $tempoSaida = time();
          
           $tempo = round(($tempoSaida - $_SESSION['tempoEntrada']) / 60);
           
           //echo "o tempo medio é " . $tempo;
            $user = $USER;
    
            $username = fullname($user);
            $username = normal_username($username);
           update_tempo($_SESSION['professor'], $_SESSION['turma'],$username , $tempo);
           $userid = $user->id;
           $courseid = $_SESSION['courseid'] ;
         
           contarAtividadesConcluidas($_SESSION['professor'], $_SESSION['turma'], $userid, $courseid);
            
           
           
        }
        //echo 'A URL atual não corresponde a http://localhost/course/view.php'; //caso queira verificar as mudanças
    }

}
function download_trigger($professor) {
    global $DB;
    $table = 'local_plugin';
    $filename = 'dados_moodle.csv';
    $sql = "SELECT id, professor, turma, username, counter, tempo, concluidos FROM {" . $table . "} WHERE professor = :professor";

    // Executar a consulta com o parâmetro do professor
    $result = $DB->get_records_sql($sql, ['professor' => $professor]);

    // Criar o conteúdo do arquivo CSV
    $content = "ID,Professor,Turma,Username,Counter,Tempo,Concluídos\n";
    // Adicionar dados ao CSV
    foreach ($result as $row) {
        $content .= $row->id . "," . $row->professor . "," . $row->turma . "," . $row->username . "," . $row->counter . "," . $row->tempo . "," . $row->concluidos . "\n";
    }

    // Criar um link de download usando JavaScript
    echo '
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var estatisticaAnchor = document.querySelector("a.Estatistica");

            estatisticaAnchor.addEventListener("click", function(event) {
                event.preventDefault();
                var element = document.createElement("a");
                element.setAttribute("href", "data:text/csv;charset=utf-8;base64,' . base64_encode($content) . '");
                element.setAttribute("download", "' . $filename . '");
                element.style.display = "none";
                document.body.appendChild(element);
                element.click();
                document.body.removeChild(element);
            });
        });
    </script>';
}




function local_plugin_before_footer() {
    global $PAGE, $USER;

    //botão de redirecionamento para o moody
     if ($PAGE->pagetype == 'site-index'){
    $url = new moodle_url('/local/plugin/pag.php');
    $link = html_writer::link($url, 'Moody');
    echo $link;
    

    }
    local_plugin();
    $url = $PAGE->url;
    $url_string = strval($url);
    $parsed_url = parse_url($url_string);
    $path = $parsed_url['path'];
    $context = context_user::instance($USER->id);
    if ( $path ==='/local/plugin/pag.php' && has_capability('moodle/course:update', $context)){
            $user = $USER;
    
            $username = fullname($user);
            $username = normal_username($username);
    
    download_trigger($username);
}
}


