<?php

namespace Drupal\commerce_stock_local;

use Drupal\commerce_stock\StockCheckInterface;
use Drupal\commerce_stock\StockServiceInterface;
use Drupal\commerce_stock\StockServiceConfig;
use Drupal\commerce_stock\StockUpdateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LocalStockService implements StockServiceInterface {

  /**
   * The stock checker.
   *
   * @var \Drupal\commerce_stock\StockCheckInterface
   */
  protected $stockChecker;

  /**
   * The stock updater.
   *
   * @var \Drupal\commerce_stock\StockUpdateInterface
   */
  protected $stockUpdater;

  /**
   * The stock configuration.
   *
   * @var \Drupal\commerce_stock\StockServiceConfigInterface
   */
  protected $stockServiceConfig;

  /**
   * Constructs a new LocalStockService object.
   *
   * @param StockCheckInterface $stock_checker
   *   The stock checker.
   * @param StockUpdateInterface $stock_updater
   *   The stock updater.
   */
  public function __construct(StockCheckInterface $stock_checker, StockUpdateInterface $stock_updater) {
    $this->stockChecker = $stock_checker;
    $this->stockUpdater = $stock_updater;
    $this->stockServiceConfig = new StockServiceConfig($this->stockChecker);
  }

  /**
   * @param ContainerInterface $container
   *   The DI container.
   *
   * @return static
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('commerce_stock.local_stock_checker'),
      $container->get('commerce_stock.local_stock_updater')
    );
  }

  /**
   * Get the name of the service.
   */
  public function getName() {
    return 'Local stock';
  }

  /**
   * Get the ID of the service.
   */
  public function getId() {
    return 'local_stock';
  }

  /**
   * Gets the stock checker.
   *
   * @return \Drupal\commerce_stock\StockCheckInterface
   *   The stock checker.
   */
  public function getStockChecker() {
    return $this->stockChecker;
  }

  /**
   * Gets the stock updater.
   *
   * @return \Drupal\commerce_stock\StockUpdateInterface
   *   The stock updater.
   */
  public function getStockUpdater() {
    return $this->stockUpdater;
  }

  /**
   * Gets the stock Configuration.
   *
   * @return \Drupal\commerce_stock\StockServiceConfigInterface
   *   The stock Configuration.
   */
  public function getConfiguration() {
    return $this->stockServiceConfig;
  }

}
