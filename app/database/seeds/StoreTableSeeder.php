<?php

/**
 * @author Claudia Hüttenrauch <claudia.huettenrauch@fashionforhome.de>
 * @copyright Fashion For Home 2014
 * @link http://www.fashionforhome.de
 */
class StoreTableSeeder extends DatabaseSeeder
{

    /**
     * Number of rows to be inserted
     * @const int
     */
    const ROW_COUNT = 5;

    public function run()
    {
        $this->command->info('Inserting ' . self::ROW_COUNT . ' sample stores...');

        for ($i = 0; $i < self::ROW_COUNT; $i++) {
            $this->createNewStore();
        }
    }

    private function createNewStore()
    {
        $faker = $this->getFakeGenerator();

        Store::create(
            array(
                'name' => $faker->company,
                'phone_number' => $faker->phoneNumber,
                'street' => $faker->streetAddress,
                'postcode' => $faker->postcode,
                'city' => $faker->city
            )
        );
    }

}
  