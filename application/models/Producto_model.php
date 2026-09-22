<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Producto_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();

        $this->load->database();
    }


    // Obtener todos los productos
    public function catalogo()
    {
        $this->db->select('
            productos.*,
            linea.descripcion_linea,
            precios.precioventa,
            precios.preciocompra,
            stock.stock
        ');

        $this->db->from('productos');

        $this->db->join(
            'linea',
            'linea.idlinea = productos.linea',
            'left'
        );

        $this->db->join(
            'precios',
            'precios.idprod = productos.idprod',
            'left'
        );

        $this->db->join(
            'stock',
            'stock.idprod = productos.idprod',
            'left'
        );

        $this->db->order_by(
            'productos.idprod',
            'DESC'
        );

        return $this->db->get()->result();
    }


    // Obtener un producto
    public function obtener($id)
    {
        $this->db->select('
            productos.*,
            linea.descripcion_linea,
            precios.precioventa,
            precios.preciocompra,
            stock.stock
        ');

        $this->db->from('productos');

        $this->db->join(
            'linea',
            'linea.idlinea = productos.linea',
            'left'
        );

        $this->db->join(
            'precios',
            'precios.idprod = productos.idprod',
            'left'
        );

        $this->db->join(
            'stock',
            'stock.idprod = productos.idprod',
            'left'
        );

        $this->db->where(
            'productos.idprod',
            $id
        );

        return $this->db->get()->row();
    }
}