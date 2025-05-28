<?php
namespace Xcrud\Model;

use CodeIgniter\Model;

class XcrudModel extends Model
{

    function __construct()
    {
        parent::__construct();
    }

    function query($query)
    {
        $r = $this->db->query($query, false);
        if (! $r) {
            return $this->db->error();
        }
        return $r;
    }

    function affected_rows()
    {
        return $this->db->affected_rows();
    }

    function insert_id()
    {
        return $this->db->insert_id();
    }

    function result($r)
    {
        return $r->result_array();
    }

    function row($r)
    {
        return $r->row_array();
    }

    function escape_str($value)
    {
        return $this->db->escape_str($value);
    }
}
