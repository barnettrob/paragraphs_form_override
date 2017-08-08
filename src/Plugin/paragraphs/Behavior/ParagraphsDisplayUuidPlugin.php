<?php

namespace Drupal\paragraphs_form_override\Plugin\paragraphs\Behavior;

use Drupal\Core\Annotation\Translation;
use Drupal\Core\Entity\Display\EntityViewDisplayInterface;
use Drupal\paragraphs\Annotation\ParagraphsBehavior;
use Drupal\paragraphs\Entity\Paragraph;
use Drupal\paragraphs\ParagraphsBehaviorBase;

/**
 * Provide a way to display the uuid on paragraph.
 *
 * @ParagraphsBehavior(
 *   id="display_uuid",
 *   label=@Translation("Display UUID"),
 *   description=@Translation("Display UUID for the paragraph for content editor to use unique id in various ways."),
 *   weight=0
 *   )
 */
class ParagraphsDisplayUuidPlugin extends ParagraphsBehaviorBase {

  /**
   * {@inheritdoc}
   */
  public function view(array &$build, Paragraph $paragraph, EntityViewDisplayInterface $display, $view_mode) {

    return $build;
  }

  public function buildBehaviorForm(Paragraph $paragraphs_entity) {
    // Get Form from parent from which to extend.
    $form = parent::buildBehaviorForm($paragraphs_entity);

    // Only show uuid if it's not nested.
    if ($paragraphs_entity->parent_type->value == 'node') {
      // Formatted UUID.
      $uuid = '<div align="right"><b>' . t('Target ID: ') . $paragraphs_entity->uuid() . '</b></div>';

      // Add UUID markup to paragraph form.
      $form['display_uuid'] = [
        '#markup' => $uuid,
      ];
    }

    return $form;
  }
}