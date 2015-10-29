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
  