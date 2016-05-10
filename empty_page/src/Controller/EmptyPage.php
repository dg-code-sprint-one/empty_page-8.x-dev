<?php
/**
 * @file
 * Contains \Drupal\empty_page\Controller\EmptyPage.
 */
namespace Drupal\empty_page\Controller;
use Drupal\Core\Session\AccountInterface;

class EmptyPage {

  public function empty_callback() {
  	$output =array();
  	return $output;
  }

}
