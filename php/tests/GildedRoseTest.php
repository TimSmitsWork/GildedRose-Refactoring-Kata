<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    public function testDecreasesQualityWhenBeforeSellDate(): void
    {
        $items = [new Item('+5 Dexterity Vest', 10, 10)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $this->assertSame($items[0]->sell_in, 9);
        $this->assertSame($items[0]->quality, 9);
    }

    public function testDecreasesQualityByTwoWhenOnSellDate(): void
    {
        $items = [new Item('+5 Dexterity Vest', 0, 10)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $this->assertSame($items[0]->sell_in, -1);
        $this->assertSame($items[0]->quality, 8);
    }

    public function testDoesNotUpdatesQualityWhenZero(): void
    {
        $items = [new Item('+5 Dexterity Vest', 0, 0)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $this->assertSame($items[0]->sell_in, -1);
        $this->assertSame($items[0]->quality, 0);
    }

    public function testIncreasesQualityOfAgedBrieWhenBeforeSellDate(): void
    {
        $items = [new Item('Aged Brie', 10, 10)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $this->assertSame($items[0]->quality, 11);
        $this->assertSame($items[0]->sell_in, 9);
    }

    public function testIncreasesQualityOfAgesBrieByTwoWhenOnSellDate(): void
    {
        $items = [new Item('Aged Brie', 0, 10)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $this->assertSame($items[0]->sell_in, -1);
        $this->assertSame($items[0]->quality, 12);
    }

    public function testDoesNotUpdatesQuantityOfAgesBrieWhenMaxQuantity(): void
    {
        $items = [new Item('Aged Brie', 0, 50)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $this->assertSame($items[0]->sell_in, -1);
        $this->assertSame($items[0]->quality, 50);
    }

    public function testIncreasesQualityOfBackstageWhenBeforeSellDate(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 15, 10)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $this->assertSame($items[0]->sell_in, 14);
        $this->assertSame($items[0]->quality, 11);
    }

    public function testIncreasesQualityOfBackstageByTwoWhenTenDaysBeforeSellDate(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 10, 10)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $this->assertSame($items[0]->sell_in, 9);
        $this->assertSame($items[0]->quality, 12);
    }

    public function testIncreasesQualityOfBackstageByThreeWhenFiveDaysBeforeSellDate(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 5, 10)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $this->assertSame($items[0]->sell_in, 4);
        $this->assertSame($items[0]->quality, 13);
    }

    public function testIncreasesQualityOfBackstageToZeroWhenOnSellDate(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 0, 10)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $this->assertSame($items[0]->sell_in, -1);
        $this->assertSame($items[0]->quality, 0);
    }

    public function testDoesNotUpdatesQualityOfBackstageWhenMaxQualityAndBeforeSellDate(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 10, 50)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $this->assertSame($items[0]->sell_in, 9);
        $this->assertSame($items[0]->quality, 50);
    }

    public function testUpdatesQualityOfBackstageToZeroWhenMaxQualityAndOnSellDate(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 0, 50)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $this->assertSame($items[0]->sell_in, -1);
        $this->assertSame($items[0]->quality, 0);
    }

    public function testDoesNotUpdatesSulfuras(): void
    {
        $items = [new Item('Sulfuras, Hand of Ragnaros', 10, 10)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $this->assertSame($items[0]->sell_in, 10);
        $this->assertSame($items[0]->quality, 10);
    }

    public function testDecreasesQualityOfConjuredByTwoWhenBeforeSellDate(): void
    {
        $items = [new Item('Conjured Mana Cake', 10, 10)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $this->assertSame($items[0]->sell_in, 9);
        $this->assertSame($items[0]->quality, 8);
    }
}
