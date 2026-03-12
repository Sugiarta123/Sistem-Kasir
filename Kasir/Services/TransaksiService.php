<?php

namespace Services;

class TransaksiService{

    public function hitungTotal($harga,$qty){
        return $harga * $qty;
    }

}

?>