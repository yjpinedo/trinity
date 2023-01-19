<?php

namespace App\Traits;

trait WithRangeTypeNetworkTrait
{
    public $rangeFrom = 0;
    public $rangeTo = 0;

    public function rangeByNetwork($type_network_search)
    {
        if ($type_network_search == 'children') {
            $this->rangeFrom = 0;
            $this->rangeTo = 13;
        } elseif ($type_network_search == 'teenagers') {
            $this->rangeFrom = 14;
            $this->rangeTo = 18;
        } elseif ($type_network_search == 'youths') {
            $this->rangeFrom = 19;
            $this->rangeTo = 30;
        } elseif ($type_network_search == 'adults') {
            $this->rangeFrom = 30;
            $this->rangeTo = 200;
        } else {
            $this->rangeFrom = 0;
            $this->rangeTo = 0;
        }
    }
}
