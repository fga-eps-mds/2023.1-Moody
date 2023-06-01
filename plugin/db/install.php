//<?php
//function xmldb_local_plugin_install() {
//    global $DB;
//
//    $table = new xmldb_table('nome_da_tabela');
//
//    $field_id = new xmldb_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
//    $table->addField($field_id);
//
//    $field_nome = new xmldb_field('nome', XMLDB_TYPE_CHAR, '100', null, XMLDB_NOTNULL);
//    $table->addField($field_nome);
//
//    // Cria a tabela.
//    $dbman = $DB->get_manager();
//    $dbman->create_table($table);
//    
//}
