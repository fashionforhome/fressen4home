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

	    // explizit login user
	    User::create([
			'email'     => 'tester@fashionforhome.de',
		    'password'  => Hash::make('tester')
	    ]);

	    User::create([
			'email'     => 'tester2@fashionforhome.de',
		    'password'  => Hash::make('tester')
	    ]);
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
