<?php

$version = 56;

return new  Detectors\DetectVersionSet($version, [
  new Detectors\DetectByFeature($version, 
    function ($node) {
      if ($node->kind !== ast\AST_PARAM) {
        return false;
      }
      return ($node->flags === ast\flags\PARAM_VARIADIC);
    }, 
    'Variadic'
  ),
  new Detectors\DetectByFeature($version, 
    function ($node) {
      if ($node->kind !== ast\AST_METHOD_CALL && $node->kind !== ast\AST_CALL) {
        return false;
      }

      foreach($node->children as $child) {
        if ($child->kind === ast\AST_UNPACK) {
          return true;
        }
      }

      return false;
    }, 
    'Unpacking in params'
  ),
  new Detectors\DetectByFeature($version, 
    function ($node) {
      if ($node->kind !== ast\AST_METHOD_CALL && $node->kind !== ast\AST_CALL) {
        return false;
      }

      if (!isset($node->children['args'])) {
        return false;
      }

      $args = $node->children['args'];
      if (empty($args->children)) {
        return false;
      }

      foreach($args->children as $child) {
        if ($child->kind === ast\AST_UNPACK) {
          return true;
        }
      }

      return false;
    }, 
    'Unpacking too'
  ),
  new Detectors\DetectByFunction($version, [
    'gmp_root',
    'gmp_rootrem',
    'hash_equals',
    'ldap_escape',
    'ldap_modify_batch',
    'mysqli_get_links_stats',
    'oci_get_implicit_resultset',
    'openssl_get_cert_locations',
    'openssl_x509_fingerprint',
    'openssl_spki_new',
    'openssl_spki_verify',
    'openssl_spki_export_challenge',
    'openssl_spki_export',
    'pg_connect_poll',
    'pg_consume_input',
    'pg_flush',
    'pg_socket',
    'session_abort',
    'session_reset',
  ]),
]);
