<?php
/**
 * This is the ..... [Description]
 *
 * @category App
 * @package Commands
 *
 * @author Claudia Hüttenrauch <claudia.huettenrauch@fashion4home.de>
 *
 * @copyright (c) 2014 by fashion4home GmbH <www.fashionforhome.de>
 * @license GPL-3.0
 * @license http://opensource.org/licenses/GPL-3.0 GNU GENERAL PUBLIC LICENSE
 *
 * @version 1.0.0
 *
 * Date: 17.06.2014
 * Time: 22:04
 */

use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ImportDishCommand extends AbstractImportCommand
{

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'import:dishes';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Import dishes from csv';

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
        $file = $this->argument('file');
        $storeId = $this->argument('storeId');

        if (file_exists($file) === false || is_readable($file) === false) {
            $this->error('"' . $file . '" does not exist or is not readable.');
            return;
        }

        if (Store::find($storeId)->getKey() === null) {
            $this->error('A store with ID "' . $storeId . '" does not exist.');
            return;
        }

        $this->info('Importing dishes from "' . $file . '" to store with ID ' . $storeId . '...');

        $header = $this->readLine();
        while (($line = $this->readLine()) !== FALSE) {
            $dish = $this->getNewObject($this->mergeData($header, $line));

            $dish->save();
            $this->comment(' - "' . $dish->name . '" ID: ' . $dish->getKey());
        }

        $this->info('Importing stores completed.');
	}

    private function getNewObject(array $data)
    {
        $dish = new Dish($data);
        $dish->store_id = $this->argument('storeId');
        return $dish;
    }

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array_merge(
            parent::getArguments(),
            array(
                array('storeId', InputArgument::OPTIONAL, 'The name of the store, the dishes should be imported to.')
		    )
        );
	}

}
