<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class StringToCsv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'string2csv';

    // test arguments and options with description
    // protected $signature = 'string2csv {inputsrt : input string} {--config : configuration}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '
Input:
    Enter any string in command
Output:
    1. Converts input string to uppercase
    2. Converts input string to alternate upperand lower case
    3. Generate each input string characters into CSV file';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $string = $this->ask('Please input a string');

        // Converts input string to uppercase
        $stringUp = Str::upper($string);

        // Converts input string to alternate upperand lower case
        for ( $i = 0; $i <= strlen($string) - 1; $i += 1) {
            if ( $i % 2) {
                $arrAlt[]=Str::upper($string[$i]);
            }
            else {
                $arrAlt[]=Str::lower($string[$i]);
            }

            $arr4csv[]=$string[$i];
        }

        $stringAlt = implode($arrAlt);

        // Generate each input string characters into CSV file
        $this->createCsv($arr4csv);

        $this->info("1. $stringUp");
        $this->info("2. $stringAlt");
        $this->info("3. CSV created!");

        // $this->info("argument: ".$this->argument('inputsrt'));
        // $this->info("option: ".$this->option('char'));

    }

    private function createCsv(array $columns) {
        $file_name = 'string.csv';
        
        $fp = fopen($file_name, 'w');
        fputcsv($fp, $columns);
        fclose($fp);
    }
}
