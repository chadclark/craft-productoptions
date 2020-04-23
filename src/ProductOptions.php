<?php
/**
 * Product Options plugin for Craft CMS 3.x
 *
 * Create options with price adjustments for Craft Commerce 3 products.
 *
 * @link      https://github.com/chadclark
 * @copyright Copyright (c) 2020 Chad Clark
 */

namespace chadclark\productoptions;

use Craft;
use craft\base\Plugin;

use craft\commerce\events\LineItemEvent;
use craft\commerce\services\LineItems;
//use craft\commerce\models\LineItem;

use yii\base\Event;

/**
 * Class ProductOptions
 *
 * @author    Chad Clark
 * @package   ProductOptions
 * @since     1.0.0
 *
 * @property  ProductoptionsService $productoptions
 */
class ProductOptions extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * @var ProductOptions
     */
    public static $plugin;

    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $schemaVersion = '1.0.0';

    /**
     * @var bool
     */
    public $hasCpSettings = false;

    /**
     * @var bool
     */
    public $hasCpSection = false;

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
      parent::init();
      self::$plugin = $this;

      Event::on(
        LineItems::class,
        LineItems::EVENT_POPULATE_LINE_ITEM,
        function (LineItemEvent $event) {
          // Get the line item's options
          // $isNew = $event->isNew;
          $lineItem = $event->lineItem;
          $snapshot = $lineItem->snapshot;
          $options = $snapshot['options'];
          
          // Check to see if product options are present
          // $productOptions = $options['productOptions-1'] ?? null;
          $productOptions = $lineItem->purchasable->product->orderMeat_options ?? null; 
          
          // If product options exist…
            if ($productOptions) {
            // Snapshot of price before doing option calcuation
            $productOptionsPrice = $snapshot['price'];

            // foreach ($productOptions as $block){
            //   if ($block->fieldHandle == "options"){
                
            //   }
            // }
            
            foreach ($productOptions as $productOption) {
              print_r($productOption);
              die();
            }
            
            // Calculate and set the price
            //$price = $productOptions + $productOptionsPrice;
            //$lineItem->salePrice = $price;
            //return $options;
          }
        }
      );

      Craft::info(
        Craft::t(
          'craft-productoptions',
          '{name} plugin loaded',
          ['name' => $this->name]
        ),
        __METHOD__
      );
    }

    // Protected Methods
    // =========================================================================

}
