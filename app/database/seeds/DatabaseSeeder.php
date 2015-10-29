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

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use \Faker\Generator as FakeGenerator;
use \Faker\Factory as FakeGeneratorFactory;

class DatabaseSeeder extends Seeder
{

    private $fakeGenerator;

    private $tables = array(
        'orders',
        'deliveries',
        'dishes',
        'stores',
        'users',
    );

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

        $this->clearTables();
        $this->call('UserTableSeeder');
        $this->call('StoreTableSeeder');
        $this->call('DishTableSeeder');
        $this->call('DeliveryTableSeeder');
        $this->call('OrderTableSeeder');
	}

    private function clearTables()
    {
        foreach ($this->tables as $table) {
            $this->command->info('Truncating ' . $table . ' table...');
            DB::table($table)->delete();
        }
    }

    /**
     * @return FakeGenerator
     */
    protected function getFakeGenerator()
    {
        if ($this->fakeGenerator === null) {
            $this->fakeGenerator = FakeGeneratorFactory::create('de_DE');
//        $this->fakeGenerator->seed(1234); //activating this will force faker to provide the same test data every time
        }
        return $this->fakeGenerator;
    }

    /**
     * Get all existing store ids
     *
     * @return array
     */
    protected function getStoreIds()
    {
        return DB::table('stores')->lists('id');
    }

    /**
     * Get all existing user ids
     *
     * @return array
     */
    protected function getUserIds()
    {
        return DB::table('users')->lists('id');
    }

    /**
     * Get all existing delivery ids
     *
     * @return array
     */
    protected function getDeliveryIds()
    {
        return DB::table('deliveries')->lists('id');
    }

    /**
     * Get all existing dish ids
     *
     * @param int|null $storeId
     * @return array
     */
    protected function getDishIds($storeId = null)
    {
        $table = DB::table('dishes');

        if ($storeId !== null) {
            $table->where('store_id', '=', $storeId);
        }

        return $table->lists('id');
    }

    /**
     * @return int
     */
    protected function getRandomStoreId()
    {
        return (int) $this->getFakeGenerator()->randomElement($this->getStoreIds());
    }

    /**
     * @return int
     */
    protected function getRandomUserId()
    {
        return (int) $this->getFakeGenerator()->randomElement($this->getUserIds());
    }

    /**
     * @return int
     */
    protected function getRandomDeliveryId()
    {
        return (int) $this->getFakeGenerator()->randomElement($this->getDeliveryIds());
    }

    /**
     * @param int|null $storeId
     * @return int
     */
    protected function getRandomDishId($storeId = null)
    {
        return (int) $this->getFakeGenerator()->randomElement($this->getDishIds($storeId));
    }

}
