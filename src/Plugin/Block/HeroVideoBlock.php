<?php

namespace Drupal\hero_banner\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;

/**
 * Provides a 'HeroVideoBlock' block.
 *
 * @Block(
 *  id = "hero_video_block",
 *  admin_label = @Translation("Hero video block"),
 * )
 */
class HeroVideoBlock extends BlockBase {

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
      '#title' => $this->t('Titulo'),
      '#description' => $this->t('Titulo del banner'),
      '#default_value' => $this->configuration['titulo'],
      '#maxlength' => 64,
      '#size' => 64,
      '#weight' => '1',
    ];
    $form['texto'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Texto'),
      '#description' => $this->t('Texto del banner'),
      '#default_value' => $this->configuration['texto'],
      '#maxlength' => 128,
      '#size' => 64,
      '#weight' => '2',
    ];
    $form['texto_link'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Texto link'),
      '#description' => $this->t('Texto del link'),
      '#default_value' => $this->configuration['texto_link'],
      '#maxlength' => 128,
      '#size' => 64,
      '#weight' => '3',
    ];
    $form['link'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Link'),
      '#description' => $this->t('Enlace a contenido'),
      '#default_value' => $this->configuration['link'],
      '#weight' => '4',
    ];
    $form['imagen'] = [
      '#type' => 'managed_file',
      '#title' => $this->t('Imagen'),
      '#description' => $this->t('Imagen de fondo para el hero banner'),
      '#default_value' => $this->configuration['imagen'],
      '#weight' => '10',
      '#upload_validators' => ['file_validate_extensions' => ['jpg', 'png', 'jpeg'],],
      '#upload_location' => 'public://banner/',
    ];
/*    $form['mp4_video'] = [
      '#type' => 'managed_file',
      '#title' => $this->t('Video MP4'),
      '#description' => $this->t('Video en formato MP4'),
      '#default_value' => $this->configuration['mp4_video'],
      '#weight' => '12',
      '#upload_validators' => ['file_validate_extensions' => ['mp4'],],
      '#upload_location' => 'public://banner/',
    ];
    $form['ogg_video'] = [
      '#type' => 'managed_file',
      '#title' => $this->t('Video OGV'),
      '#description' => $this->t('Video en formato OGV'),
      '#default_value' => $this->configuration['ogg_video'],
      '#weight' => '14',
      '#upload_validators' => [
        'file_validate_extensions' => ['ogv'],
        'file_validate_size' => [256000000],
      ],
      '#upload_location' => 'public://banner/',
    ];
    $form['webm_video'] = [
      '#type' => 'managed_file',
      '#title' => $this->t('Video WEBM'),
      '#description' => $this->t('Video en formato WEBM'),
      '#default_value' => $this->configuration['webm_video'],
      '#weight' => '16',
      '#upload_validators' => ['file_validate_extensions' => ['webm'],],
      '#upload_location' => 'public://banner/',
    ]; */
    $form['mp4_video'] = [
      '#type' => 'textfield',
      '#title' => $this->t('MP4 Video'),
      '#description' => $this->t('Enlace a video MP4'),
      '#default_value' => $this->configuration['mp4_video'],
      '#weight' => '4',
    ];
    $form['ogg_video'] = [
      '#type' => 'textfield',
      '#title' => $this->t('OGG Video'),
      '#description' => $this->t('Enlace a video OGG'),
      '#default_value' => $this->configuration['ogg_video'],
      '#weight' => '4',
    ];
    $form['webm_video'] = [
      '#type' => 'textfield',
      '#title' => $this->t('WEBM Video'),
      '#description' => $this->t('Enlace a video WEBM'),
      '#default_value' => $this->configuration['webm_video'],
      '#weight' => '4',
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    // Save image as permanent.
    $image = $form_state->getValue('imagen');
    if ($image != $this->configuration['imagen']) {
      if (!empty($image[0])) {
        $file = File::load($image[0]);
        $file->setPermanent();
        $file->save();
      }
    }
/*   $mp4 = $form_state->getValue('mp4_video');
    if ($mp4 != $this->configuration['mp4_video']) {
      if (!empty($mp4[0])) {
        $file = File::load($mp4[0]);
        $file->setPermanent();
        $file->save();
      }
    }
    $ogg = $form_state->getValue('ogg_video');
    if ($ogg != $this->configuration['ogg_video']) {
      if (!empty($ogg[0])) {
        $file = File::load($ogg[0]);
        $file->setPermanent();
        $file->save();
      }
    }
    $webm = $form_state->getValue('webm_video');
    if ($webm != $this->configuration['webm_video']) {
      if (!empty($webm[0])) {
        $file = File::load($webm[0]);
        $file->setPermanent();
        $file->save();
      }
    } */
    $this->configuration['titulo'] = $form_state->getValue('titulo');
    $this->configuration['texto'] = $form_state->getValue('texto');
    $this->configuration['texto_link'] = $form_state->getValue('texto_link');
    $this->configuration['link'] = $form_state->getValue('link');
    $this->configuration['imagen'] = $form_state->getValue('imagen');
    $this->configuration['mp4_video'] = $form_state->getValue('mp4_video');
    $this->configuration['ogg_video'] = $form_state->getValue('ogg_video');
    $this->configuration['webm_video'] = $form_state->getValue('webm_video');
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $image = $this->configuration['imagen'];
    if (!empty($image[0])) {
      if ($file = File::load($image[0])) {
        $uri = $file->getFileUri();
      }
    }
/*    $mp4 = $this->configuration['mp4_video'];
    if (!empty($mp4[0])) {
      if ($file = File::load($mp4[0])) {
        $uri_mp4 = $file->getFileUri();
      }
    }
    $ogg = $this->configuration['ogg_video'];
    if (!empty($ogg[0])) {
      if ($file = File::load($ogg[0])) {
        $uri_ogg = $file->getFileUri();
      }
    }
    $webm = $this->configuration['webm_video'];
    if (!empty($webm[0])) {
      if ($file = File::load($webm[0])) {
        $uri_webm = $file->getFileUri();
      }
    } */
    $build = [];
    $build['video_block'] = [
      '#theme' => 'video_banner',
      '#titulo' => $this->configuration['titulo'],
      '#texto' => $this->configuration['texto'],
      '#texto_link' => $this->configuration['texto_link'],
      '#link' => $this->configuration['link'],
      '#imagen' => file_url_transform_relative(file_create_url($uri)),
/*      '#mp4_video' => file_url_transform_relative(file_create_url($uri_mp4)),
      '#ogg_video' => file_url_transform_relative(file_create_url($uri_ogg)),
      '#webm_video' => file_url_transform_relative(file_create_url($uri_webm)), */
      '#mp4_video' => $this->configuration['mp4_video'],
      '#ogg_video' => $this->configuration['ogg_video'],
      '#webm_video' => $this->configuration['webm_video'],
    ];

    return $build;
  }

}
