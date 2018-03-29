<?php

$version = 54;

return new Detectors\DetectVersionSet($version, [
  new Detectors\DetectByFeature($version, 
    function ($node) {
      if ($node->kind !== ast\AST_ARRAY) {
        return false;
      }
      return $node->flags === ast\flags\ARRAY_SYNTAX_SHORT;   
    },
    'Short array syntax'
  ),
  new Detectors\DetectByFeature($version, 
    function($node) {
      if ($node->flags === ast\flags\CLASS_TRAIT) {
        return true;
      }

      return in_array($node->kind, [
        ast\AST_TRAIT_ALIAS,
        ast\AST_TRAIT_PRECEDENCE,
        ast\AST_USE_TRAIT,
      ]);
    },
    'Uses traits'
  ),
  new Detectors\DetectByClass($version, [
    'SPL',
    'CallbackFilterIterator',
    'RecursiveCallbackFilterIterator',
    'Reflection',
    'ReflectionZendExtension',
    'Json',
    'JsonSerializable',
    'SessionHandler',
    'SessionHandlerInterface',
    'Snmp',
    'SNMP',
    'Intl',
    'Transliterator',
    'Spoofchecker',
    'Session',
  ]),
  new Detectors\DetectByFunction($version, [
    'hex2bin',
    'http_response_code',
    'get_declared_traits',
    'getimagesizefromstring',
    'stream_set_chunk_size',
    'socket_import_stream',
    'trait_exists',
    'header_register_callback',
    'class_uses',
    'session_status',
    'session_register_shutdown',
    'mysqli_error_list',
    'mysqli_stmt_error_list',
    'libxml_set_external_entity_loader',
    'ldap_control_paged_result',
    'ldap_control_paged_result_response',
    'transliterator_create',
    'transliterator_create_from_rules',
    'transliterator_create_inverse',
    'transliterator_get_error_code',
    'transliterator_get_error_message',
    'transliterator_list_ids',
    'transliterator_transliterate',
    'zlib_decode',
    'zlib_encode'
  ]),
]);
