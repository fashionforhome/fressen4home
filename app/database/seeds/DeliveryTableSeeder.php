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
class DeliveryTableSeeder extends DatabaseSeeder
{

    /**
     * Number of rows to be inserted
     * @const int
     */
    const ROW_COUNT = 10;

    public function run()
    {
        $this->command->info('Inserting ' . self::ROW_COUNT . ' sample deliveries...');

        for ($i = 0; $i < self::ROW_COUNT; $i++) {
            $this->createNewDelivery();
        }
    }

    private function createNewDelivery()
    {
        $faker = $this->getFakeGenerator();

        Delivery::create(
            array(
                'store_id' => $this->getRandomStoreId(),
                'user_id' => $this->getRandomUserId(),
                'closing_time' => $faker->dateTimeBetween('-2 hours', '+2 hours')
            )
        );
    }

}
