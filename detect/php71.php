<?php

$version = 71;

return new Detectors\DetectVersionSet($version, [
  new Detectors\DetectByFeature($version, 
    function ($node) {
      if ($node->kind !== ast\AST_FUNC_DECL) {
        return false;
      }

      if (!isset($node->children['returnType'])) {
        return false;
      }

      return $node->children['returnType']->flags === ast\flags\TYPE_VOID;
    },
    'Return void'
  ),
  new Detectors\DetectByFeature($version, 
    function ($node) {
      return ($node->kind === ast\AST_NULLABLE_TYPE);
    
    }, 
    'Nullable types'
  ),
  new Detectors\DetectByConst($version, [
    'PHP_FD_SETSIZE',
    'CURLMOPT_PUSHFUNCTION',
    'CURL_PUSH_OK',
    'CURL_PUSH_DENY',
    'FILTER_FLAG_EMAIL_UNICODE',
    'IMAGETYPE_WEBP',
    'JSON_UNESCAPED_LINE_TERMINATORS',
    'LDAP_OPT_X_SASL_NOCANON',
    'LDAP_OPT_X_SASL_USERNAME',
    'LDAP_OPT_X_TLS_CACERTDIR',
    'LDAP_OPT_X_TLS_CACERTFILE',
    'LDAP_OPT_X_TLS_CERTFILE',
    'LDAP_OPT_X_TLS_CIPHER_SUITE',
    'LDAP_OPT_X_TLS_KEYFILE',
    'LDAP_OPT_X_TLS_RANDOM_FILE',
    'LDAP_OPT_X_TLS_CRLCHECK',
    'LDAP_OPT_X_TLS_CRL_NONE',
    'LDAP_OPT_X_TLS_CRL_PEER',
    'LDAP_OPT_X_TLS_CRL_ALL',
    'LDAP_OPT_X_TLS_DHFILE',
    'LDAP_OPT_X_TLS_CRLFILE',
    'LDAP_OPT_X_TLS_PROTOCOL_MIN',
    'LDAP_OPT_X_TLS_PROTOCOL_SSL2',
    'LDAP_OPT_X_TLS_PROTOCOL_SSL3',
    'LDAP_OPT_X_TLS_PROTOCOL_TLS1_0',
    'LDAP_OPT_X_TLS_PROTOCOL_TLS1_1',
    'LDAP_OPT_X_TLS_PROTOCOL_TLS1_2',
    'LDAP_OPT_X_TLS_PACKAGE',
    'LDAP_OPT_X_KEEPALIVE_IDLE',
    'LDAP_OPT_X_KEEPALIVE_PROBES',
    'LDAP_OPT_X_KEEPALIVE_INTERVAL',
    'PGSQL_NOTICE_LAST',
    'PGSQL_NOTICE_ALL',
    'PGSQL_NOTICE_CLEAR',
    'MT_RAND_PHP',
  ]),
  new Detectors\DetectByFunction($version, [
    'sapi_windows_cp_get',
    'sapi_windows_cp_set',
    'sapi_windows_cp_conv',
    'sapi_windows_cp_is_utf8',
    'curl_multi_errno',
    'curl_share_errno',
    'curl_share_strerror',
    'openssl_get_curve_names',
    'session_create_id
    session_gc',
    'is_iterable',
    'pcntl_async_signals',
    'pcntl_signal_get_handler',
  ]),    
]);
