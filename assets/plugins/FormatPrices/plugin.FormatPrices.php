<?php
/**
 * Format prices
 *
 * plugin
 *
 * @category        plugin
 * @version         0.1
 * @author          hkyss
 * @documentation   empty
 * @lastupdate      18.05.2021
 * @internal    	@modx_category Resources
 * @internal    	@events OnDocFormSave
 * @internal    	@properties &tvs=Наименования TV-параметров;string;price &templates=Шаблоны;string;9
 *
 */

if(!defined('MODX_BASE_PATH')) die('What are you doing? Get out of here!');

if(!function_exists('format')) {
  function format($number,$cents = 1) {
    if (is_numeric($number)) {
      if (!$number) {
        $money = ($cents == 2 ? '0.00' : '0');
      } else {
        if (floor($number) == $number) {
          $money = number_format($number, ($cents == 2 ? 2 : 0));
        } else {
          $money = number_format(round($number, 2), ($cents == 0 ? 0 : 2));
        }
      }
      return $money;
    }
  }
}

global $template;

include_once MODX_BASE_PATH.'assets/lib/MODxAPI/modResource.php';
$modResource = new modResource($modx);

$template = !empty($template) ? $template : $doc['template'];
$templates = !empty($templates) ? explode(',',$templates) : array();

if($modx->event->name == 'OnDocFormSave' && array_search($template,$templates) !== false) {
  if(!empty($tvs)) {
    $tvs = explode(',',$tvs);

    foreach($tvs as $item) {
      $modResource->edit((int)$id);
      ${$item} = format($modResource->get($item));
      $modResource->set($item, '');
      $modResource->save(false,false);
      $modResource->close();

      $modResource->edit((int)$id);
      if((float)${$item} !== 0.00) {
        $modResource->set($item, ${$item});
      }
      else {
        $modResource->set($item, '');
      }
      $modResource->save(false,false);
      $modResource->close();
    }
  }
}