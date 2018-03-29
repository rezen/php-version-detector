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
      return ($node->kind === ast\AST_UNPACK);
    }, 
    'Unpacking'
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
