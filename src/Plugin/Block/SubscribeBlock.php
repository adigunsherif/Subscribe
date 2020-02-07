<?php

namespace Drupal\subscribe\Plugin\Block;
use Drupal\Core\Link;
use Drupal\Core\Url;
use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Subscribe' Block.
 *
 * @Block(
 *   id = "subscribe",
 *   admin_label = @Translation("Subscribe block"),
 * )
 */
class SubscribeBlock extends BlockBase
{
  /**
   * {@inheritdoc}
   */
  public function build(){
    $gettypes = node_type_get_names();
    $types = [];

    foreach($gettypes as $key => $type){
      $query = ['type' => $key];
      $subscribe_link = Link::fromTextAndUrl(t("Subscribe to $type contents."), Url::fromRoute('subscribe.subscribe', $query))->toString();
      $types[] = $subscribe_link;
    }

    return [
      '#theme' => 'item_list',
      '#list_type' => 'ul',
      '#items' => $types,
    ];
  }
}
