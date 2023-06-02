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
        $counter = $salvo->counter + 1;
        $DB->execute("UPDATE {local_plugin} SET counter = ? WHERE username = ?", array($counter, $username));
    } else {
        // Se não existe , cria e adiciona 1
        $DB->execute("INSERT INTO {local_plugin} (username, counter) VALUES (?, ?)", array($username, 1));
    }
}



function normalize_username($username) {
    // Remove espaços em branco e converte para letras minúsculas
    $simplesUsername = strtolower(str_replace(' ', '', $username));
    return $simplesUsername;
}


function local_plugin_exibir_url() {
    global $PAGE, $USER;

    // Obtém a URL atual
    $url = $PAGE->url;

 
    $url_string = strval($url);

    // Exibe a URL
    //echo $url_string;
    $parsed_url = parse_url($url_string);
    $path = $parsed_url['path'];

    $context = context_user::instance($USER->id);

// Verifica a função do usuario
//if (has_capability('moodle/site:config', $context)) {
//    echo "Usuário é um administrador";
//} 
//
//elseif (has_capability('moodle/course:update', $context)) {
//    echo "Usuário é um professor";
//} 
//
//elseif (has_capability('moodle/course:view', $context)) {
//    echo "Usuário é um estudante";
//} 
//
//else {
//    echo "Usuário possui uma função padrão";
//}//caso queira verificar as mudanças

    // Verifica se o caminho da URL corresponde ao valor desejado
    if ($path === '/course/view.php') {
        //echo 'A URL atual corresponde a http://localhost/course/view.php'; //caso queira verificar as mudanças
        $context = context_system::instance();

    // Obter o objeto do usuário atualmente logado
        $user = $USER;
       
    // Obter o nome completo do usuário
        $username = fullname($user);
        $username = normalize_username($username);
       
        
        update_counter($username);
        display_counter($username); //caso queira verificar a atualização

    } else {
        //echo 'A URL atual não corresponde a http://localhost/course/view.php'; //caso queira verificar as mudanças
    }

}
//botão de redirecionamento para o moody
function local_plugin_before_footer() {
    $url = new moodle_url('/local/plugin/pag.php');
    $link = html_writer::link($url, 'Ir para outra página');
    echo $link;
    local_plugin_exibir_url();
}



