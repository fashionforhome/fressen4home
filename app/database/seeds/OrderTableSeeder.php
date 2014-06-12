<?php

/**
 * @author Claudia Hüttenrauch <claudia.huettenrauch@fashionforhome.de>
 * @copyright Fashion For Home 2014
 * @link http://www.fashionforhome.de
 */
class OrderTableSeeder extends DatabaseSeeder
{

    /**
     * Number of rows to be inserted
     * @const int
     */
    const ROW_COUNT = 20;

    public function run()
    {
        $this->command->info('Inserting ' . self::ROW_COUNT . ' sample orders...');

        for ($i = 0; $i < self::ROW_COUNT; $i++) {
            $this->createNewOrder();
        }
    }

    private function createNewOrder()
    {
        $deliveryId = $this->getRandomDeliveryId();
        $delivery = Delivery::find($deliveryId);

        Order::create(
            array(
                'user_id' => $this->getRandomUserId(),
                'dish_id' => $this->getRandomDishId($delivery->storeId),
                'delivery_id' => $deliveryId,
            )
        );
    }

}
  