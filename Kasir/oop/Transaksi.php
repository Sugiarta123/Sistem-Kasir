<?php

require_once "Produk.php";
require_once "TransaksiInterface.php";

class Transaksi extends Produk implements TransaksiInterface{

    public $qty;

    public function __construct($nama_produk,$harga,$qty){
        parent::__construct($nama_produk,$harga);
        $this->qty = $qty;
    }

    public function hitungTotal($harga,$qty){
        return $harga * $qty;
    }

    public function totalPenjualan(){
        return $this->hitungTotal($this->harga,$this->qty);
    }

}

?>