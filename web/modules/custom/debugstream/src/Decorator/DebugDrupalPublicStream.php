<?php

namespace Drupal\debugstream\Decorator;

use Drupal\Core\StreamWrapper\StreamWrapperInterface;
use Drupal\Core\StreamWrapper\PublicStream;

class DebugDrupalPublicStream extends PublicStream implements StreamWrapperInterface {

  /**
   * The inner service.
   *
   * @var \Drupal\Core\StreamWrapper\PublicStream;
   */
  protected $decoratedService;

  /**
   * Constructs a new PublicStream with Debug insight.
   *
   * Leverages Drupal's existing PublicStream object.
   *
   * @param \Drupal\Core\StreamWrapper\PublicStream $decorated_service
   *   Drupal Core's PublicStream service, which is being decorated here.
   */
  public function __construct(PublicStream $decorated_service) {
    $this->decoratedService = $decorated_service;
  }

  /**
   * @inheritdoc
   */
  public static function getType() {
    \Drupal::logger('DebugDrupalPublicStream')->notice('Calling ' . __METHOD__);
    return $this->decoratedService->getType();
  }

  /**
   * @inheritdoc
   */
  public function getName() {
    \Drupal::logger('DebugDrupalPublicStream')->notice('Calling ' . __METHOD__);
    return $this->decoratedService->getName();
  }

  /**
   * @inheritdoc
   */
  public function getDescription() {
    \Drupal::logger('DebugDrupalPublicStream')->notice('Calling ' . __METHOD__);
    return $this->decoratedService->getDescription();
  }

  /**
   * @inheritdoc
   */
  public function setUri($uri) {
    \Drupal::logger('DebugDrupalPublicStream')->notice('Calling ' . __METHOD__ . ': uri: ' . $uri);
    return $this->decoratedService->setUri($uri);
  }

  /**
   * @inheritdoc
   */
  public function getUri() {
    \Drupal::logger('DebugDrupalPublicStream')->notice('Calling ' . __METHOD__);
    return $this->decoratedService->getUri();
  }

  /**
   * @inheritdoc
   */
  public function getExternalUrl() {
    \Drupal::logger('DebugDrupalPublicStream')->notice('Calling ' . __METHOD__);
    return $this->decoratedService->getExternalUrl();
  }

  /**
   * @inheritdoc
   */
  public function realpath() {
    \Drupal::logger('DebugDrupalPublicStream')->notice('Calling ' . __METHOD__);
    return $this->decoratedService->realpath();
  }

  /**
   * @inheritdoc
   */
  public function dirname($uri = NULL) {
    \Drupal::logger('DebugDrupalPublicStream')->notice('Calling ' . __METHOD__ . ': uri: ' . $uri);
    return $this->decoratedService->dirname($uri);
  }

}
