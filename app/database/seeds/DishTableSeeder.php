<?php

/**
 * @author Claudia Hüttenrauch <claudia.huettenrauch@fashionforhome.de>
 * @copyright Fashion For Home 2014
 * @link http://www.fashionforhome.de
 */
class DishTableSeeder extends DatabaseSeeder
{

    /**
     * Number of rows per store to be inserted
     * @const int
     */
    const ROW_COUNT_PER_STORE = 5;

    public function run()
    {
        $this->command->info('Inserting ' . self::ROW_COUNT_PER_STORE . ' sample dishes per store...');

        foreach ($this->getStoreIds() as $storeId) {
            $this->createDishes($storeId);
        }

    }

    /**
     * @param int $storeId
     * @param int $count
     */
    private function createDishes($storeId, $count = self::ROW_COUNT_PER_STORE)
    {
        for ($i = 0; $i < $count; $i++) {
            $this->createNewDish($storeId);
        }
    }

    /**
     * @param int $storeId
     */
    private function createNewDish($storeId)
    {
        $faker = $this->getFakeGenerator();

        Dish::create(
            array(
                'store_id' => $storeId,
                'store_dish_id' => $faker->numberBetween(1, 99),
                'name' => $faker->word,
                'price' => $faker->randomFloat(2, '2.00', '12.99') * 100
            )
        );
    }

}
