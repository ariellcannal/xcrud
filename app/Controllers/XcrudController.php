<?php
namespace Xcrud\Controller;

use App\Controllers\BaseController;
use Xcrud\Libraries\Xcrud;

class XcrudController extends BaseController
{

    public function ajax()
    {
        return Xcrud::get_requested_instance();
    }

    protected function get_instance($name = false): Xcrud
    {
        return Xcrud::get_instance($name);
    }

    protected function store_session()
    {
        $_SESSION['xcrud_sess'] = Xcrud::export_session();
    }

    protected function restore_session()
    {
        Xcrud::import_session($_SESSION['xcrud_sess']);
    }
}