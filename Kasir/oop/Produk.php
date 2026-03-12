<?php

class Produk{

    public $nama_produk;
    public $harga;

    public function __construct($nama_produk,$harga){
        $this->nama_produk = $nama_produk;
        $this->harga = $harga;
    }

}

?>