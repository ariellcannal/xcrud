<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');

class Ajax extends SYS_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    public function xcrud()
    {
        $this->load->library('session');
        $this->load->helper(array(
            'url',
            'xcrud'
        ));
        Xcrud_config::$scripts_url = base_url('');
        $this->output->set_output(Xcrud::get_requested_instance($this));
    }
}

/* End of file ajax.php */
/* Location: ./application/controllers/ajax.php */