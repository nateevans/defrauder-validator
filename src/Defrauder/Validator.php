<?php
namespace Defrauder;

class Validator
{
    /**
     * Check whether the given amount is greater than
     * a multiple of the average
     *
     * @param int|float $average Average value
     * @param int|float $amount Incoming value
     * @param int|float $multiplier
     * @return bool True if the amount is valid, False otherwise
     */
    public function amountIsValid($average, $amount, $multiplier)
    {
        return !($amount > $average * $multiplier);
    }

    /**
     * Check whether the incoming zipcode is within a valid distance
     * from a previous set of zipcodes
     *
     * @param array $previous_zipcodes
     * @param int $incoming_zipcode
     * @return bool
     */
    public function locationIsValid($previous_zipcodes, $incoming_zipcode)
    {
        /*
          assume that we can connect to an API with geographic data,
          such as https://market.mashape.com/mapfruition/spatialoperations#zip-distance.

          The idea is that you could loop through each of the previous zipcodes and check if the
          distance of incoming zipcode from those previous zipcodes is greater than the valid amount.

          For the sake of simplicity, we will check if the first digit of the incoming zipcode is
          not in the set of previous zipcodes.
         */

        $first_numbers = array_map(function($val) {
            // make sure we have an actual number...
            // note: this wont work with negative numbers,
            // but we shouldn't have any of those
            $number = (int) $val;
            return substr($number, 0, 1);
        }, $previous_zipcodes);

        $first_incoming = substr((int)$incoming_zipcode, 0, 1);

        return in_array($first_incoming, $first_numbers);
    }
}