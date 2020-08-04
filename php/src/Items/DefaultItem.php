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

    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    public function updateQuality(): void
    {
        if ($this->item->quality > 0) {
            $this->decreaseQuality();
        }

        $this->decreaseSellIn();

        if ($this->item->sell_in < 0 && $this->item->quality > 0) {
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
