<?php

declare(strict_types=1);

namespace GildedRose\Items;

class Conjured extends DefaultItem
{
    public function updateQuality(): void
    {
        if ($this->item->quality > 0) {
            $this->item->quality -= 2;
        }

        --$this->item->sell_in;

        if ($this->item->sell_in < 0 && $this->item->quality > 0) {
            $this->item->quality -= 2;
        }

        if ($this->item->quality < 0) {
            $this->item->quality = 0;
        }
    }
}
