
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Producto_model');
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->library('session');
    }


    // ==========================
    // CATÁLOGO
    // ==========================

    public function index()
    {
        $data['titulo'] = 'Catálogo de productos';

        $data['productos'] =
            $this->Producto_model->catalogo();

        $this->load->view(
            'layouts/header',
            $data
        );

        $this->load->view(
            'productos/index',
            $data
        );

        $this->load->view(
            'layouts/footer'
        );
    }


    // ==========================
    // FORMULARIO NUEVO
    // ==========================

    public function nuevo()
    {
        $data['titulo'] = 'Agregar producto';

        // Líneas activas
        $data['lineas'] = $this->db
            ->where('estatus_linea', 'ALTA')
            ->order_by(
                'descripcion_linea',
                'ASC'
            )
            ->get('linea')
            ->result();

        // Proveedores activos
        $data['proveedores'] = $this->db
            ->where('estatusprov', 'ALTA')
            ->order_by(
                'nombreprov',
                'ASC'
            )
            ->get('proveedores')
            ->result();

        $this->load->view(
            'layouts/header',
            $data
        );

        $this->load->view(
            'productos/form',
            $data
        );

        $this->load->view(
            'layouts/footer'
        );
    }


    // ==========================
    // GUARDAR
    // ==========================

    public function guardar()
    {
        $this->form_validation->set_rules(
            'claveprod',
            'Clave del producto',
            'required'
        );

        $this->form_validation->set_rules(
            'descripcion',
            'Descripción',
            'required'
        );

        $this->form_validation->set_rules(
            'linea',
            'Línea',
            'required'
        );

        $this->form_validation->set_rules(
            'idprov',
            'Proveedor',
            'required'
        );

        $this->form_validation->set_rules(
            'preciocompra',
            'Precio de compra',
            'required|numeric'
        );

        $this->form_validation->set_rules(
            'precioventa',
            'Precio de venta',
            'required|numeric'
        );


        if ($this->form_validation->run() == FALSE)
        {
            $this->nuevo();

            return;
        }


        // ==========================
        // INICIAR TRANSACCIÓN
        // ==========================

        $this->db->trans_start();


        // ==========================
        // PRODUCTO
        // ==========================

        $producto = array(

            'claveprod' =>
                $this->input->post('claveprod'),

            'descripcion' =>
                $this->input->post('descripcion'),

            'linea' =>
                $this->input->post('linea'),

            'idprov' =>
                $this->input->post('idprov'),

            'estatus_prod' =>
                'ALTA'
        );


        $this->db->insert(
            'productos',
            $producto
        );


        $idprod =
            $this->db->insert_id();


        // ==========================
        // PRECIO
        // ==========================

        $precio = array(

            'idprod' =>
                $idprod,

            'precioventa' =>
                $this->input->post('precioventa'),

            'preciocompra' =>
                $this->input->post('preciocompra')
        );


        $this->db->insert(
            'precios',
            $precio
        );


        // ==========================
        // STOCK INICIAL
        // ==========================

        $stock = array(

            'idprod' =>
                $idprod,

            'stock' =>
                0
        );


        $this->db->insert(
            'stock',
            $stock
        );


        $this->db->trans_complete();


        // ==========================
        // MENSAJE
        // ==========================

        $this->session->set_flashdata(
            'mensaje',
            'Producto agregado correctamente.'
        );


        redirect('productos');
    }


    // ==========================
    // EDITAR
    // ==========================

    public function editar($id)
    {
        $data['titulo'] =
            'Modificar producto';


        $data['producto'] =
            $this->Producto_model->obtener($id);


        if (!$data['producto'])
        {
            show_404();
        }


        // Líneas activas
        $data['lineas'] = $this->db
            ->where('estatus_linea', 'ALTA')
            ->order_by(
                'descripcion_linea',
                'ASC'
            )
            ->get('linea')
            ->result();


        // Proveedores activos
        $data['proveedores'] = $this->db
            ->where('estatusprov', 'ALTA')
            ->order_by(
                'nombreprov',
                'ASC'
            )
            ->get('proveedores')
            ->result();


        $this->load->view(
            'layouts/header',
            $data
        );

        $this->load->view(
            'productos/form',
            $data
        );

        $this->load->view(
            'layouts/footer'
        );
    }


    // ==========================
    // ACTUALIZAR
    // ==========================

    public function actualizar($id)
    {
        $this->form_validation->set_rules(
            'claveprod',
            'Clave',
            'required'
        );

        $this->form_validation->set_rules(
            'descripcion',
            'Descripción',
            'required'
        );

        $this->form_validation->set_rules(
            'linea',
            'Línea',
            'required'
        );

        $this->form_validation->set_rules(
            'idprov',
            'Proveedor',
            'required'
        );

        $this->form_validation->set_rules(
            'preciocompra',
            'Precio de compra',
            'required|numeric'
        );

        $this->form_validation->set_rules(
            'precioventa',
            'Precio de venta',
            'required|numeric'
        );


        if ($this->form_validation->run() == FALSE)
        {
            $this->editar($id);

            return;
        }


        // ==========================
        // INICIAR TRANSACCIÓN
        // ==========================

        $this->db->trans_start();


        // ==========================
        // ACTUALIZAR PRODUCTO
        // ==========================

        $producto = array(

            'claveprod' =>
                $this->input->post('claveprod'),

            'descripcion' =>
                $this->input->post('descripcion'),

            'linea' =>
                $this->input->post('linea'),

            'idprov' =>
                $this->input->post('idprov'),

            'estatus_prod' =>
                $this->input->post('estatus_prod')
        );


        $this->db
            ->where('idprod', $id)
            ->update(
                'productos',
                $producto
            );


        // ==========================
        // ACTUALIZAR PRECIO
        // ==========================

        $precio = array(

            'precioventa' =>
                $this->input->post('precioventa'),

            'preciocompra' =>
                $this->input->post('preciocompra')
        );


        $existe = $this->db
            ->where('idprod', $id)
            ->get('precios')
            ->row();


        if ($existe)
        {
            $this->db
                ->where('idprod', $id)
                ->update(
                    'precios',
                    $precio
                );
        }
        else
        {
            $precio['idprod'] = $id;

            $this->db->insert(
                'precios',
                $precio
            );
        }


        // ==========================
        // TERMINAR TRANSACCIÓN
        // ==========================

        $this->db->trans_complete();


        $this->session->set_flashdata(
            'mensaje',
            'Producto actualizado correctamente.'
        );


        redirect('productos');
    }


    // ==========================
    // ELIMINAR
    // ==========================

    public function eliminar($id)
    {
        $this->db
            ->where('idprod', $id)
            ->delete('productos');


        $this->session->set_flashdata(
            'mensaje',
            'Producto eliminado correctamente.'
        );


        redirect('productos');
    }
}
