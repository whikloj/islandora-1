<?php

namespace Drupal\islandora\Plugin\Action;

use Drupal\Core\Form\FormStateInterface;

/**
 * Emits a Node for generating video derivatives event.
 *
 * @Action(
 *   id = "generate_video_derivative",
 *   label = @Translation("Generate a video derivative"),
 *   type = "node"
 * )
 */
class GenerateVideoDerivative extends AbstractGenerateDerivative {

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    $config = parent::defaultConfiguration();
    $config['path'] = '[date:custom:Y]-[date:custom:m]/[node:nid].mp4';
    $config['mimetype'] = 'video/mp4';
    return $config;
  }

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildConfigurationForm($form, $form_state);
    $form['mimetype']['#description'] = t('Mimetype to convert to (e.g. video/mp4, video/quicktime, etc...)');
    $form['args']['#description'] = t('Additional command line parameters for FFMpeg');
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateConfigurationForm(array &$form, FormStateInterface $form_state) {
    parent::validateConfigurationForm($form, $form_state);
    $exploded_mime = explode('/', $form_state->getValue('mimetype'));
    if ($exploded_mime[0] != 'video') {
      $form_state->setErrorByName(
        'mimetype',
        t('Please enter a video mimetype (e.g. video/mp4, video/quicktime, etc...)')
      );
    }
  }

}
