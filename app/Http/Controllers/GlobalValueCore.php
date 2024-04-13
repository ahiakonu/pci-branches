<?php
 

 class GlobalValuesCore
{
    public static function getMonths()
    {
        return
            collect([
                collect(['month' => 'January', 'monthkey' => 1]),
                collect(['month' => 'February', 'monthkey' => 2]),
                collect(['month' => 'March', 'monthkey' => 3]),
                collect(['month' => 'April', 'monthkey' => 4]),
                collect(['month' => 'May', 'monthkey' => 5]),
                collect(['month' => 'June', 'monthkey' => 6]),
                collect(['month' => 'July', 'monthkey' => 7]),
                collect(['month' => 'August', 'monthkey' => 8]),
                collect(['month' => 'September', 'monthkey' => 9]),
                collect(['month' => 'October', 'monthkey' => 10]),
                collect(['month' => 'November', 'monthkey' => 11]),
                collect(['month' => 'December', 'monthkey' => 12]),
            ]);
    }
}


?>