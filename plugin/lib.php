<?php
defined('MOODLE_INTERNAL') || die();

function local_plugin_exibir_url() {
    global $PAGE, $USER;

    // Obtém a URL atual
    $url = $PAGE->url;

    // Exibe a URL
    $url_string = strval($url);

    // Exibe a URL
    echo $url_string;
    $parsed_url = parse_url($url_string);
    $path = $parsed_url['path'];

    $context = context_user::instance($USER->id);

// Verifica se o usuário possui a função de administrador
if (has_capability('moodle/site:config', $context)) {
    echo "Usuário é um administrador";
} 
// Verifica se o usuário possui a função de professor
elseif (has_capability('moodle/course:update', $context)) {
    echo "Usuário é um professor";
} 
// Verifica se o usuário possui a função de estudante
elseif (has_capability('moodle/course:view', $context)) {
    echo "Usuário é um estudante";
} 
// Caso contrário, assume que o usuário possui uma função padrão
else {
    echo "Usuário possui uma função padrão";
}

    // Verifica se o caminho da URL corresponde ao valor desejado
    if ($path === '/course/view.php') {
        echo 'A URL atual corresponde a http://localhost/course/view.php';
    } else {
        echo 'A URL atual não corresponde a http://localhost/course/view.php';
    }

}

function local_plugin_before_footer() {
    $url = new moodle_url('/local/plugin/pag.php');
    $link = html_writer::link($url, 'Ir para outra página');
    echo $link;
    local_plugin_exibir_url();
}

//function meu_plugin_curso_acessado(\core\event\course_viewed $event) {
//    \core\notification::add('testando', \core\output\notification::NOTIFY_SUCCESS);
//}
//
//// Registra o observador de evento 'course_viewed'
//$observers = array(
//    array(
//        'eventname' => '\core\event\course_viewed',
//        'callback' => 'meu_plugin_curso_acessado',
//    ),
//);


// Função para obter e exibir a URL atual



// Chama a função para exibir a URL




