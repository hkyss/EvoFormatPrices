<?php
if(!defined('MODX_BASE_PATH')) die('What are you doing? Get out of here!');

if(!function_exists('format')) {
  function format($value) {
    $value = trim($value);

    if(!empty($value)) {
      if(strpos($value, ',') !== false) {
        $value = str_replace(',','.',$value);
      }

      $value = str_replace(',','.',sprintf("%01.2f", $value));
    }

    //$value = round((float)$value, 2);

    return $value;
  }
}

global $template;

include_once MODX_BASE_PATH.'assets/lib/MODxAPI/modResource.php';
$modResource = new modResource($modx);

$template = !empty($template) ? $template : $doc['template'];
$templates = !empty($templates) ? explode(',',$templates) : array();

if($modx->event->name == 'OnDocFormSave' && array_search($template,$templates) !== false) {
  $modResource->edit((int)$id);

  if(!empty($tvs)) {
    $tvs = explode(',',$tvs);

    foreach($tvs as $item) {
      ${$item} = format($modResource->get($item));
      $modResource->set($item, ${$item});
    }
  }

  $modResource->save(false,false);
  $modResource->close();
}