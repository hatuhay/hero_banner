<?php

namespace Drupal\hero_banner\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'YoutubeBlock' block.
 *
 * @Block(
 *  id = "youtube_block",
 *  admin_label = @Translation("Youtube block"),
 * )
 */
class YoutubeBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [] + parent::defaultConfiguration();
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form['titulo'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Título'),
      '#default_value' => $this->configuration['titulo'],
      '#maxlength' => 64,
      '#size' => 64,
      '#weight' => '1',
    ];
    $form['texto'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Texto'),
      '#default_value' => $this->configuration['texto'],
      '#maxlength' => 128,
      '#size' => 64,
      '#weight' => '2',
    ];
    $form['url_video'] = [
      '#type' => 'textfield',
      '#title' => $this->t('URL Video'),
      '#default_value' => $this->configuration['url_video'],
      '#maxlength' => 128,
      '#size' => 64,
      '#weight' => '3',
    ];
    $form['texto_link'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Texto Link'),
      '#default_value' => $this->configuration['texto_link'],
      '#maxlength' => 64,
      '#size' => 64,
      '#weight' => '4',
    ];
    $form['link'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Link'),
      '#default_value' => $this->configuration['link'],
      '#maxlength' => 64,
      '#size' => 64,
      '#weight' => '6',
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['titulo'] = $form_state->getValue('titulo');
    $this->configuration['texto'] = $form_state->getValue('texto');
    $this->configuration['url_video'] = $form_state->getValue('url_video');
    $this->configuration['texto_link'] = $form_state->getValue('texto_link');
    $this->configuration['link'] = $form_state->getValue('link');
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $build['youtube_block'] = [
      '#theme' => 'youtube_banner',
      '#titulo' => $this->configuration['titulo'],
      '#texto' => $this->configuration['texto'],
      '#texto_link' => $this->configuration['texto_link'],
      '#link' => $this->configuration['link'],
      '#url_video' => $this->configuration['url_video'],
    ];

    return $build;
  }

}
