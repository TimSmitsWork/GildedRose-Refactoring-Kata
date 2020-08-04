<?php

declare(strict_types=1);

namespace GildedRose\Items;

use GildedRose\Item;

class DefaultItem
{
    public const MAX_QUALITY = 50;

    public const MIN_QUALITY = 0;

    public const MIN_SELL_IN = 0;

    /**
     * @var Item
     */
    protected $item;

    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    public function updateQuality(): void
    {
        if ($this->item->quality > self::MIN_QUALITY) {
            $this->decreaseQuality();
        }

        $this->decreaseSellIn();

        if ($this->item->sell_in < self::MIN_SELL_IN && $this->item->quality > self::MIN_QUALITY) {
            $this->decreaseQuality();
        }
    }

    public function setQuality(int $quality): void
    {
        $this->item->quality = $quality;
    }

    public function increaseQuality(): void
    {
        ++$this->item->quality;
    }

    public function decreaseQuality(int $count = 1): void
    {
        $this->item->quality -= $count;
    }

    public function decreaseSellIn(): void
    {
        --$this->item->sell_in;
    }
}
