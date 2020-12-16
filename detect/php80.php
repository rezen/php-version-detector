<?php

$version = 80;

return new Detectors\DetectVersionSet($version, [
    new Detectors\DetectByFeature($version,  function($node) {
        return in_array($node->kind, [
            ast\AST_MATCH, ast\AST_MATCH_ARM, ast\AST_MATCH_ARM_LIST
        ]);
        return false;
    }, 'Pattern matching match()'),
    new Detectors\DetectByFeature($version,  function($node) {
        return in_array($node->kind, [
            ast\AST_ATTRIBUTE_GROUP,
            ast\AST_ATTRIBUTE_LIST, 
            ast\AST_ATTRIBUTE
        ]);
        return false;
    }, 'Attributes'),
    new Detectors\DetectByFeature($version, function($node) {
       return ($node->kind === ast\AST_NAMED_ARG);
    }, 'Named arguments'),
    new Detectors\DetectByFeature($version, function($node) {
        if ($node->kind !== ast\AST_PARAM) {
            return false;
        }

        return ($node->flags === ast\flags\PARAM_MODIFIER_PUBLIC);

     }, 'Property promition'),

    new Detectors\DetectByFeature($version, function($node) {
        # ast\AST_NULLSAFE_METHOD_CALL
        return false;
            
    }, 'Null safe method call'),
    new Detectors\DetectByFeature($version, function($node) {
        # ast\AST_NULLSAFE_PROP
        return false;
    }, 'Null safe method prop'),
    new Detectors\DetectByFeature($version, function($node) {
        # ast\AST_ATTRIBUTE_LIST, AST_ATTRIBUTE_GROUP, AST_ATTRIBUTE, AST_CLASS_CONST_GROUP
        return false;
    }, 'Attributes'),

  new Detectors\DetectByFunction($version, [
    'str_contains',
    'str_starts_with',
    'str_ends_with',
    'fdiv', 
    'get_resource_id', 
    'get_debug_type', 
    'preg_last_error_msg', 
  ]),
  new Detectors\DetectByConst($version, [

  ]),
  new Detectors\DetectByClass($version, [
    'CurlHandle',
    'CurlMultiHandle',
    'CurlShareHandle', 
    'GdImage',
    'Socket',
    'AddressInfo',
    'OpenSSLAsymmetricKey',
    'OpenSSLCertificate',
    'OpenSSLCertificateSigningRequest',
    'XMLWriter',
    'XMLParser',
    ]),
]);