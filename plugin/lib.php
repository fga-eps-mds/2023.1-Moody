<?php
defined('MOODLE_INTERNAL') || die();

function local_plugin_exibir_url() {
    global $PAGE, $USER;

    // Obtém a URL atual
    $url = $PAGE->url;

   //Converte para string
    $url_string = strval($url);

    // Exibe a URL
    echo $url_string;
    $parsed_url = parse_url($url_string);
    $path = $parsed_url['path'];

    $context = context_user::instance($USER->id);

// Verifica o tipo de usuário
if (has_capability('moodle/site:config', $context)) {
    echo "Usuário é um administrador";
} 

elseif (has_capability('moodle/course:update', $context)) {
    echo "Usuário é um professor";
} 

elseif (has_capability('moodle/course:view', $context)) {
    echo "Usuário é um estudante";
} 

else {
    echo "Usuário possui uma função padrão";
}

   
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






