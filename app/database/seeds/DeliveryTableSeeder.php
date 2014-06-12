<?php

/**
 * @author Claudia Hüttenrauch <claudia.huettenrauch@fashionforhome.de>
 * @copyright Fashion For Home 2014
 * @link http://www.fashionforhome.de
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
