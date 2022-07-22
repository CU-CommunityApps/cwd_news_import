<?php

namespace Drupal\cwd_news_import;

use Drupal\Core\Entity\EntityTypeManager;

class CwdNewsImportService {

  protected $entityTypeManager;

  public function __construct(EntityTypeManager $entity_type_manager) {
    $this->entityTypeManager = $entity_type_manager;
  }

  /*
   * Get all imported unmoderated nodes of the specified type.
   */
  public function loadUnmoderatedNodes($type) {
    $storage = $this->entityTypeManager->getStorage('node');
    $query = $storage->getQuery()
      ->condition('type', $type)
      ->notExists('moderation_state.target_id')
      ->condition('field_imported', 1);
    $nids = $query->execute();
    $nodes = !empty($nids) ? $storage->loadMultiple($nids) : [];
    return $nodes;
  }

  /*
   * Publish the nodes.
   */
  function publishNodes($nodes) {
    foreach($nodes as $node) {
      $node->setNewRevision(TRUE);
      $node->status = TRUE;
      $node->moderation_state->target_id = 'published';
      $node->setRevisionLogMessage(t('Setting moderation state from import.'));
      $node->save();
    }
  }

}
