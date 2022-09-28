<?php
echo 'Task 1' . '</br>';
echo '
Write a function which receives one (integer) argument. The result of the function should be a string with arrows (“<>”). 
Number of arrows should be equal to the argument number (on both sides).
';

function myArrowFunc(int $int): string
{
    $result = '';
    $l = '';
    $r = '';
    $i = 1;
    while ($i <= $int) {
        $l .= '<';
        $r .= '>';
        $result = $l . $r;
        $i++;
    }
    return $result;
}

echo 'Result: ' . myArrowFunc(4) ;

echo '</br>' . '</br>' . '</br>';


function myArrowFunc1(int $int): string
{
    $l = str_repeat('<', $int);
    $r = str_repeat('>', $int);
    return $l . $r;
}

echo 'Result: ' . myArrowFunc1(4);

echo '</br>' . '</br>' . '</br>';
echo '-------------------------------------------------------';
echo '</br>' . '</br>' . '</br>';

echo 'Task 2' . '</br>';
echo 'You need to write a function to sort array of delivery methods' . '</br>';
// you have
/*
    $deliveryMethodsArray = [
        [
            'code' => 'dhl',
            'customer_costs' => [
                22 => '1.000',
                11 => '3.000',
            ]
        ],
        [
            'code' => 'fedex',
            'customer_costs' => [
                22 => '4.000',
                11 => '6.000',
            ]
        ]
    ];
    $result = sortDeliveryMethods($deliveryMethodsArray);
*/

// The result of var_dump($result):

/*
    array(2) {
      [22]=>
      array(2) {
        ["dhl"]=>
        string(5) "1.000"
        ["fedex"]=>
        string(5) "4.000"
      }
      [11]=>
      array(2) {
        ["dhl"]=>
        string(5) "3.000"
        ["fedex"]=>
        string(5) "6.000"
      }
    }
 */


function sortDeliveryMethods($str)
{
    //var_dump( $str[1]['customer_costs']);
    $arr=[];
    foreach ($str as $r=>$v) {
        $nubr = array_keys($v['customer_costs']);

        foreach ($nubr as $k) {
            $arr[$k][$v['code']]= $v['customer_costs'][$k];

        }
    }
    return $arr;
}

$deliveryMethodsArray = [
    [
        'code' => 'dhl',
        'customer_costs' => [
            22 => '1.000',
            11 => '3.000',
        ]
    ],
    [
        'code' => 'fedex',
        'customer_costs' => [
            22 => '4.000',
            11 => '6.000',
        ]
    ]
];

$result = sortDeliveryMethods($deliveryMethodsArray);
echo '<br> --------------- ';

var_dump($result);
