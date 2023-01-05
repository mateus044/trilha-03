<?php

namespace Webjump\WorldPet\Helper\Utils;

use Webjump\WorldPet\Helper\ConstMessage\ConstMessage;

class PatterReturn
{

    /**
     * @param string $message
     * @param int $code
     * @return array
     */
    public function messageError(string $message, int $code): array
    {
        return ['message'=>$message, 'code'=> $code];
    }

    /**
     * @param string $message
     * @param int $code
     * @return array
     */
    public static function messageSucesso(string $message, int $code): array
    {
        return ['message'=> $message, 'code' => $code];
    }

}
