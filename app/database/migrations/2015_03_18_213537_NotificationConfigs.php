<?php
/**
 * This is the ..... [Description]
 *
 * @category App
 * @package Database
 * @subpackage Migrations
 *
 * @author @author Eduard Bess <eduard.bess@fashion4home.de>
 *
 * @copyright (c) 2015 by fashion4home GmbH <www.fashionforhome.de>
 * @license GPL-3.0
 * @license http://opensource.org/licenses/GPL-3.0 GNU GENERAL PUBLIC LICENSE
 *
 * @version 1.0.0
 *
 * Date: 24.03.2015
 * Time: 22:04
 */
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NotificationConfigs extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('users', function($table)
        {
            $table->boolean('notify_created')->default(true);
            $table->boolean('notify_incoming')->default(true);
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('users', function($table)
        {
            $table->dropColumn('notify_created');
            $table->dropColumn('notify_incoming');
        });
	}

}
