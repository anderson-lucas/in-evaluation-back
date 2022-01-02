<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class BalancedBrackets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'balanced-brackets {brackets}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
        $brackets = $this->argument('brackets');

        $isBracketsBalanced = $this->isBracketsBalanced($brackets);

        if ($isBracketsBalanced) {
            $this->info("{$brackets} is balanced!");
        } else {
            $this->error("{$brackets} isn't balanced!");
        }
    }
    
    /**
     * isBracketsBalanced
     *
     * @param string brackets
     *
     * @return bool
     */
    public function isBracketsBalanced(string $brackets): bool
    {
        // Validate string to match only brackets
        $validCharacters = ['(', ')', '{', '}', '[', ']'];

        $replaced = '';
        for ($i = 0; $i < strlen($brackets); $i++) {
            $char = $brackets[$i];
            if (in_array($char, $validCharacters)) {
                $replaced .= $char;
            }
        }

        $brackets = $replaced;

        $openingBrackets = ['(', '[', '{'];
        $arr = [];

        foreach (str_split($brackets) as $bracket) {
            if (in_array($bracket, $openingBrackets)) {
                $arr[] = $bracket;
                continue;
            }

            // None opening brackets found
            if (count($arr) === 0) {
                return false;
            }
            
            switch ($bracket) {
                case ')':
                    $lastBracket = array_pop($arr);
                    if ($lastBracket === '{' || $lastBracket === '[') {
                        return false;
                    }
                    break;
        
                case '}':
                    $lastBracket = array_pop($arr);
                    if ($lastBracket === '(' || $lastBracket === '[') {
                        return false;
                    }
                    break;
        
                case ']':
                    $lastBracket = array_pop($arr);
                    if ($lastBracket === '(' || $lastBracket === '{') {
                        return false;
                    }
                    break;
            }
        }

        // If $arr is empty, all brackets are balanced
        if (count($arr) === 0) {
            return true;
        } else {
            return false;
        }
    }
}
 