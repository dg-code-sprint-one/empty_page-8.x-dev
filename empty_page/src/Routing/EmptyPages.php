<?php
/**
 * @file
 * Contains Drupal\empty_page\Routing\EmptyPages
 */
namespace Drupal\empty_page\Routing;

use Symfony\Component\Routing\Route;
use Drupal\empty_page\Controller\EmptyPageController;

/**
 * Defines a route subscriber to register a url for serving image styles.
 */
class EmptyPages {

  /**
   * {@inheritdoc}
   */
  public function routes() {
    $routes = array();
    $callbacks = EmptyPageController::empty_page_get_callbacks();
    foreach ($callbacks as $cid => $callback) {
      $routes['empty_page.page_' . $cid] = new Route(
        // Path to attach this route to:
        $callback->path,
        // Route defaults:
        array(
          '_controller' => '\Drupal\empty_page\Controller\EmptyPage::empty_callback',
          '_title' => $callback->page_title,
        ),
        // Route requirements:
        array(
          '_permission'  => 'view empty pages',
        )
      );
    }
    return $routes;
  }

}
