<?php

/**
 * This is the ..... [Description]
 *
 * @category App
 * @package Database
 * @subpackage Seeds
 *
 * @author Claudia Hüttenrauch <claudia.huettenrauch@fashion4home.de>
 *
 * @copyright (c) 2014 by fashion4home GmbH <www.fashionforhome.de>
 * @license GPL-3.0
 * @license http://opensource.org/licenses/GPL-3.0 GNU GENERAL PUBLIC LICENSE
 *
 * @version 1.0.0
 *
 * Date: 12.06.2014
 * Time: 22:04
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
