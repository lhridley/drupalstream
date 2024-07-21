<?php

namespace Drupal\debugstream\Decorator;

use Drupal\Component\Utility\Unicode;
use Drupal\Core\File\Exception\FileException;
use Drupal\Core\File\Exception\FileWriteException;
use Drupal\Core\File\Exception\InvalidStreamWrapperException;
use Drupal\Core\File\FileExists;
use Drupal\Core\File\FileSystem;
use Drupal\Core\File\FileSystemInterface;
use Drupal\Core\Site\Settings;
use Drupal\Core\StreamWrapper\StreamWrapperManager;
use Drupal\Core\StreamWrapper\StreamWrapperManagerInterface;

/**
 * Decorates \Drupal::service('file_system').
 *
 * Unmodified public methods:
 * - ::basename
 * - ::getTempDirectory.
 *
 * The trait FlysystemFileSystemTrait contains the logic that is passed to the
 * Flysystem Stream Wrapper instance.
 *
 * @see Drupal\Core\File\FileSystemInteface
 * @see Drupal\Core\File\FileSystem
 */
class DebugDrupalFileSystem extends FileSystem implements FileSystemInterface {

/**
   * The inner service.
   *
   * @var \Drupal\Core\File\FileSystem
   */
  protected $decoratedService;

  /**
   * The site settings.
   *
   * @var \Drupal\Core\Site\Settings
   */
  protected $settings;

  /**
   * The stream wrapper manager.
   *
   * @var \Drupal\Core\StreamWrapper\StreamWrapperManagerInterface
   */
  protected $streamWrapperManager;

  /**
   * Constructs a new FileSystem with Debug insight.
   *
   * Leverages Drupal's existing FileSystem object.
   *
   * @param \Drupal\Core\File\FileSystem $decorated_service
   *   Drupal Core's FileSystem service, which is being decorated here.
   * @param \Drupal\Core\StreamWrapper\StreamWrapperManagerInterface $stream_wrapper_manager
   *   The stream wrapper manager.
   * @param \Drupal\Core\Site\Settings $settings
   *   The site settings.
   */
  public function __construct(FileSystem $decorated_service, StreamWrapperManagerInterface $stream_wrapper_manager, Settings $settings) {
    $this->decoratedService = $decorated_service;
    $this->streamWrapperManager = $stream_wrapper_manager;
    $this->settings = $settings;
  }

  /**
   * @inheritdoc
   */
  public function moveUploadedFile($filename, $uri) {
    \Drupal::logger('DebugDrupalFileSystem')->notice('Calling ' . __METHOD__ . ': filename: ' . $filename . ' uri: ' . $uri);
    return $this->decoratedService->moveUploadedFile($filename, $uri);

  }

  /**
   * @inheritdoc
   */
  public function chmod($uri, $mode = NULL) {
    \Drupal::logger('DebugDrupalFileSystem')->notice('Calling ' . __METHOD__ . ': uri: ' . $uri . ' mode: ' . $mode);
    return $this->decoratedService->chmod($uri, $mode);
  }

  /**
   * @inheritdoc
   */
  public function unlink($uri, $context = NULL) {
    \Drupal::logger('DebugDrupalFileSystem')->notice('Calling ' . __METHOD__ . ': uri: ' . $uri . ' context: ' . $context);
    return $this->decoratedService->unlink($uri, $context);
  }

  /**
   * @inheritdoc
   */
  public function realpath($uri) {
    \Drupal::logger('DebugDrupalFileSystem')->notice('Calling ' . __METHOD__ . ': uri: ' . $uri);
    return $this->decoratedService->realpath($uri);

  }
  /**
   * @inheritdoc
   */
  public function dirname($uri) {
    \Drupal::logger('DebugDrupalFileSystem')->notice('Calling ' . __METHOD__ . ': uri: ' . $uri);
    return $this->decoratedService->dirname($uri);
  }

  /**
   * @inheritdoc
   */
  public function basename($uri, $suffix = NULL) {
    \Drupal::logger('DebugDrupalFileSystem')->notice('Calling ' . __METHOD__ . ': uri: ' . $uri . ' suffix: ' . $suffix);
    return $this->decoratedService->basename($uri);
  }
   /**
   * @inheritdoc
   */
  public function mkdir($uri, $mode = NULL, $recursive = FALSE, $context = NULL) {
    \Drupal::logger('DebugDrupalFileSystem')->notice('Calling ' . __METHOD__ . ': uri: ' . $uri . ' mode: ' . $mode . 'recursive: ' . $recursive . ' context: ' . $context);
    return $this->decoratedService->mkdir($uri, $mode, $recursive, $context);

  }
  /**
   * @inheritdoc
   */
  public function rmdir($uri, $context = NULL) {
    \Drupal::logger('DebugDrupalFileSystem')->notice('Calling ' . __METHOD__ . ': uri: ' . $uri . ' context: ' . $context);
    return $this->decoratedService->rmdir($uri, $context);

  }

  /**
   * @inheritdoc
   */
  public function tempnam($directory, $prefix) {
    \Drupal::logger('DebugDrupalFileSystem')->notice('Calling ' . __METHOD__ . ': directory: ' . $directory . ' prefix: ' . $prefix);
    return $this->decoratedService->tempnam($directory, $prefix);
  }

  /**
   * @inheritdoc
   */
  public function copy($source, $destination, /* FileExists */$fileExists = FileExists::Rename) {
    \Drupal::logger('DebugDrupalFileSystem')->notice('Calling ' . __METHOD__ . ': source: ' . $source . ' destination: ' . $destination , ' fileExists: ' . serialize($fileExists));
    return $this->decoratedService->copy($source, $destination, $fileExists);
  }

  /**
   * @inheritdoc
   */
  public function delete($path) {
    \Drupal::logger('DebugDrupalFileSystem')->notice('Calling ' . __METHOD__ . ': path: ' . $path);
    return $this->decoratedService->delete($path);
  }

  /**
   * @inheritdoc
   */
  public function deleteRecursive($path, ?callable $callback = NULL) {
    \Drupal::logger('DebugDrupalFileSystem')->notice('Calling ' . __METHOD__ . ': path: ' . $path . ' callback: ' . $callback);
    return $this->decoratedService->deleteRecursive($path, $callback);
  }

  /**
   * @inheritdoc
   */
  public function move($source, $destination, /* FileExists */$fileExists = FileExists::Rename) {
    \Drupal::logger('DebugDrupalFileSystem')->notice('Calling ' . __METHOD__ . ': source: ' . $source . ' destination: ' . $destination . ' fileExists: ' . serialize($fileExists));
    return $this->decoratedService->move($source, $destination, $fileExists);
  }

  /**
   * @inheritdoc
   */
  public function saveData($data, $destination, /* FileExists */$fileExists = FileExists::Rename) {
    \Drupal::logger('DebugDrupalFileSystem')->notice('Calling ' . __METHOD__ . ': data: ' . $data . ' destination: ' . $destination . ' fileExists: ' . serialize($fileExists));
    return $this->decoratedService->saveData($data, $destination, $fileExists);
  }

  /**
   * @inheritdoc
   */
  public function prepareDirectory(&$directory, $options = self::MODIFY_PERMISSIONS) {
    \Drupal::logger('DebugDrupalFileSystem')->notice('Calling ' . __METHOD__ . ': directory: ' . $directory . ' options: ' . $options);
    return $this->decoratedService->prepareDirectory($directory, $options);
  }

  /**
   * @inheritdoc
   */
  public function createFilename($basename, $directory) {
    \Drupal::logger('DebugDrupalFileSystem')->notice('Calling ' . __METHOD__ . ': basename: ' . $basename . ' directory: ' . $directory);
    return $this->decoratedService->createFilename($basename, $directory);
  }

  /**
   * @inheritdoc
   */
  public function getDestinationFilename($destination, /* FileExists */$fileExists) {
    \Drupal::logger('DebugDrupalFileSystem')->notice('Calling ' . __METHOD__ . ': destination: ' . serialize($fileExists) . ' directory: ' . $directory);
    return $this->decoratedService->getDestinationFilename($destination, $fileExists);
  }

  /**
   * @inheritdoc
   */
  public function getTempDirectory() {
    \Drupal::logger('DebugDrupalFileSystem')->notice('Calling ' . __METHOD__);
    return $this->decoratedService->getTempDirectory();
  }

  /**
   * @inheritdoc
   */
  public function scanDirectory($dir, $mask, array $options = []) {
    \Drupal::logger('DebugDrupalFileSystem')->notice('Calling ' . __METHOD__ . ' dir: ' . $dir . ' mask: ' . $mask . ' options:' . serialize($options));
    return $this->decoratedService->scanDirectory($dir, $mask, $options);
  }

}
