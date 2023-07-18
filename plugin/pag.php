<?php

require_once(__DIR__ . '/../../config.php');
$PAGE->set_url(new moodle_url('/local/plugin/pag.php'));
$PAGE->requires->css('/local/plugin/styles.css');
$PAGE->set_title(title : 'estatisticas');
$context = context_system::instance();
echo $OUTPUT->header();
$templatecontext = (object)[
    'texttodisplay' => 'Utilize Estatísticas para baixar as informaçoes e Sobre para saber mais sobre o moody',
];

echo $OUTPUT->render_from_template('local_plugin/page', $templatecontext);
echo $OUTPUT->footer();


?>