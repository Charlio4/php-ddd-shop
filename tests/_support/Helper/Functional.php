<?php

declare(strict_types=1);

namespace Helper;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class Functional extends \Codeception\Module
{
    public static function existJsonPathElement($I, $jsonPath)
    {
        try {
            $grab = $I->grabDataFromResponseByJsonPath($jsonPath);

            return !empty($grab);
        } catch (\Exception $e) {
            return false;
        }
    }
}
