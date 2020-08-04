<?php

declare(strict_types=1);

namespace GildedRose\Items;

use GildedRose\Item;

class DefaultItem
{
    /**
     * @var Item
     */
    protected $item;

    /**
     * @param Item $item
     */
    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    public function updateQuality(): void
    {
        if ($this->item->quality > 0) {
            --$this->item->quality;
        }

        --$this->item->sell_in;

        if ($this->item->sell_in < 0 && $this->item->quality > 0) {
            --$this->item->quality;
        }
    }
}
