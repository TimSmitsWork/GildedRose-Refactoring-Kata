<?php

declare(strict_types=1);

namespace GildedRose;

use GildedRose\Items\AgedBrie;
use GildedRose\Items\Backstage;
use GildedRose\Items\DefaultItem;
use GildedRose\Items\Sulfuras;

final class GildedRose
{
    /**
     * @var Item[]
     */
    private $items;

    private static $itemClasses = [
        'Aged Brie' => AgedBrie::class,
        'Backstage passes to a TAFKAL80ETC concert' => Backstage::class,
        'Sulfuras, Hand of Ragnaros' => Sulfuras::class,
    ];

    /**
     * @param Item[] $items
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function updateQuality(): void
    {
        foreach ($this->items as $item) {
            switch ($item->name) {
                case 'Aged Brie':
                case 'Backstage passes to a TAFKAL80ETC concert':
                case 'Sulfuras, Hand of Ragnaros':
                    $newItem = new self::$itemClasses[$item->name]($item);
                    $newItem->updateQuality();
                    break;
                default:
                    $newItem = new DefaultItem($item);
                    $newItem->updateQuality();
                    break;
            }
        }
    }
}
