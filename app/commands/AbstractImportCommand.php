<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

abstract class AbstractImportCommand extends Command
{

    const DEFAULT_DELIMITER = ';';
    const DEFAULT_ENCLOSURE = '"';
    const DEFAULT_LINE_LENGTH = 2000;

    private $fileHandle;

    private $header;

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array(
            array('file', InputArgument::REQUIRED, 'The path to the CSV-file.'),
        );
    }

    protected function getFileHandle()
    {
        if ($this->fileHandle === null) {
            $this->fileHandle = fopen($this->argument('file'), 'r');
        }
        return $this->fileHandle;
    }

    protected function readLine()
    {
        return fgetcsv($this->getFileHandle(), self::DEFAULT_LINE_LENGTH, self::DEFAULT_DELIMITER, self::DEFAULT_ENCLOSURE);
    }

    protected function mergeData($keys, $values)
    {
        return array_combine($keys, $values);
    }

    public function __destruct()
    {
        if ($this->fileHandle !== null) {
            fclose($this->fileHandle);
        }
    }

}
