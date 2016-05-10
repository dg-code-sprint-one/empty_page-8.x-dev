<?php
/**
 * @file
 * Contains \Drupal\empty_page\Controller\EmptyPageController.
 */
namespace Drupal\empty_page\Controller;

use Drupal\Core\Url;
use Drupal\Core\Link;

class EmptyPageController {
	public function empty_page_list() {
		$header = array(
      t('INTERNAL PATH'),
      array(
        'data' => t('Operations'),
        'colspan' => 2
      )
    );
    $rows = array();
    $callbacks = self::empty_page_get_callbacks();
    if (!empty($callbacks)) {
      foreach ($callbacks as $cid => $callback) {
        $view_url = Url::fromRoute('empty_page.page_' . $cid);
        $edit_url = Url::fromRoute('empty_page.edit_callback', ['cid' => $cid]);
        $delete_url = Url::fromRoute('empty_page.delete_callback', ['cid' => $cid]);
        $title = $callback->page_title ?: 'No title';
        $row    = array(
          \Drupal::l(t($title), $view_url),
          Link::fromTextAndUrl(t('Edit'), $edit_url),
          Link::fromTextAndUrl(t('Delete'), $delete_url)
        );
        $rows[] = $row;
      }
    }
    $table = array(
      '#type' => 'table',
      '#header' => $header,
      '#rows' => $rows,
      '#empty' => t('No callbacks exist yet.')
    );
    $build = array(
      '#type' => 'details',
      '#title' => 'Manage',
      '#children' => $table,
      '#open' => true,
    );
    return $build;

	}
	/**
	 * Get all Empty Page callbacks.
	 *
	 * @return $callbacks
	 */
	public static function empty_page_get_callbacks() {
	  $callbacks = array();
	  $results = db_select('empty_page')
	    ->fields('empty_page', array('cid', 'path', 'page_title', 'data', 'changed', 'created'))
	    ->orderBy('changed', 'DESC')
	    ->execute();
	  foreach ($results as $callback) {
	    $callbacks[$callback->cid] = $callback;
	  }
	  return $callbacks;
	}

}
