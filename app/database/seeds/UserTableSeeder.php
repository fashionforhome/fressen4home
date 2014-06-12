<?php

/**
 * @author Claudia Hüttenrauch <claudia.huettenrauch@fashionforhome.de>
 * @copyright Fashion For Home 2014
 * @link http://www.fashionforhome.de
 */
class UserTableSeeder extends DatabaseSeeder
{

    /**
     * Number of rows to be inserted
     * @const int
     */
    const ROW_COUNT = 5;

    /**
     * Default user password
     * @const string
     */
    const USER_PASSWORD = 'fressen4home';

    public function run()
    {
        $this->command->info('Inserting ' . self::ROW_COUNT . ' sample users...');

        for ($i = 0; $i < self::ROW_COUNT; $i++) {
            $this->createNewUser();
        }
    }

    private function createNewUser()
    {
        $faker = $this->getFakeGenerator();

        User::create(
            array(
                'email' => $this->getFFHEmail($faker->firstName, $faker->lastName),
                'password' => Hash::make(self::USER_PASSWORD)
            )
        );
    }

    /**
     * Get @fashionforhome.de email for given first- and lastname
     *
     * @param string $firstname
     * @param string $lastname
     * @return string
     */
    private function getFFHEmail($firstname, $lastname)
    {
        return strtolower($firstname . '.' . $lastname . '@fashionforhome.de');
    }

}
