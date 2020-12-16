<?php

$version = 74;

return new Detectors\DetectVersionSet($version, [
 new Detectors\DetectByFeature($version, 
 function($node) {
  if ($node->kind !== ast\AST_ASSIGN_OP) {
    return false;
  }

  return ($node->flags === ast\flags\BINARY_COALESCE);
    
 }, 'Null coalescing assignment operator (??=)'
),
new Detectors\DetectByFeature($version, 
 function($node) {
  if ($node->kind !== ast\AST_PROP_DECL) {
    return false;
  }

  return ($node->flags === ast\AST_TYPE);
    
 }, 'Typed property'
),
new Detectors\DetectByFeature($version, 
 function($node) {
   if ($node->kind === ast\AST_ARROW_FUNC) {
    return true;
   }
   return false;        
 }, 'Arrow function'
),
new Detectors\DetectByFeature($version, 
    function ($node) {

      if ($node->kind !== ast\AST_ARRAY) {
        return false;
      }

      foreach($node->children as $child) {
        if ($child->kind === ast\AST_UNPACK) {
          return true;
        }
      }
    
      return  false;
    }, 
    'Unpacking inside arrays'
  ),
new Detectors\DetectByFeature($version,     
    function ($node) {
      if ($node->kind !== ast\AST_METHOD) {
        return false;
      }

      $name = $node->children['name'] ?? '';
      return in_array($name, ['__serialize', '__unserialize']);
    },
    'new magic methods for __serialize, __unserialize'
  ),
  new Detectors\DetectByFunction($version, [
    'get_mangled_object_vars',
    'password_algos',
    'sapi_windows_set_ctrl_handler',
    'imagecreatefromtga',
    'openssl_x509_verify',
    'pcntl_unshare',
    'SQLite3::backup',
    'SQLite3Stmt::getSQL',
  ]),
  new Detectors\DetectByConst($version, [
    'PHP_WINDOWS_EVENT_CTRL_C',
    'PHP_WINDOWS_EVENT_CTRL_BREAK',
    'MB_ONIGURUMA_VERSION',
    'SO_LABEL',
    'SO_PEERLABEL',
    'SO_LISTENQLIMIT',
    'SO_LISTENQLEN',
    'SO_USER_COOKIE',
    'TIDY_TAG_ARTICLE',
    'TIDY_TAG_ASIDE',
    'TIDY_TAG_AUDIO',
    'TIDY_TAG_BDI',
    'TIDY_TAG_CANVAS',
    'TIDY_TAG_COMMAND',
    'TIDY_TAG_DATALIST',
    'TIDY_TAG_DETAILS',
    'TIDY_TAG_DIALOG',
    'TIDY_TAG_FIGCAPTION',
    'TIDY_TAG_FIGURE',
    'TIDY_TAG_FOOTER',
    'TIDY_TAG_HEADER',
    'TIDY_TAG_HGROUP',
    'TIDY_TAG_MAIN',
    'TIDY_TAG_MARK',
    'TIDY_TAG_MENUITEM',
    'TIDY_TAG_METER',
    'TIDY_TAG_NAV',
    'TIDY_TAG_OUTPUT',
    'TIDY_TAG_PROGRESS',
    'TIDY_TAG_SECTION',
    'TIDY_TAG_SOURCE',
    'TIDY_TAG_SUMMARY',
    'TIDY_TAG_TEMPLATE',
    'TIDY_TAG_TIME',
    'TIDY_TAG_TRACK',
    'TIDY_TAG_VIDEO',
  ]),
]);