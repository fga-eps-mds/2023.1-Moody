<?php

function local_plugin_before_footer() {
    $url = new moodle_url('/local/plugin/pag.php');
    $link = html_writer::link($url, 'Ir para outra página');
    echo $link;
}