<?php
namespace Xcrud\Libraries;

use Xcrud\Config\XcrudConfig;
use Xcrud\Libraries\Database;

// direct access to DB driver and config
define('XCRUD_PATH', str_replace('\\', '/', dirname(__file__)));

// str_replace
// - windows
// trick
class Xcrud
{

    private $demo_mode = false;

    protected static $instance = array();

    protected static $css_loaded = false;

    protected static $js_loaded = false;

    protected static $classes = array();

    protected $ajax_request = false;

    public $instance_name;

    protected $instance_count;

    public $table;

    // ALTERADO PARA PUBLIC, NECESS�RIO NOS HELPERS CALLBACK'S
    protected $table_name;

    protected $primary_key;

    // name of primary
    protected $primary_val;

    // value of a primary
    protected $where = array();

    protected $order_by = array();

    protected $relation = array();

    protected $fields = array();

    protected $fields_create = array();

    protected $fields_edit = array();

    protected $fields_view = array();

    protected $fields_list = array();

    protected $columns_select = false;

    protected $fields_list_default = array();

    protected $fields_names = array();

    protected $labels = array();

    protected $columns = array();

    protected $columns_names = array();

    protected $is_create = true;

    protected $is_edit = true;

    protected $is_view = true;

    protected $is_remove = true;

    protected $is_csv = true;

    protected $is_search = true;

    protected $is_print = true;

    protected $is_title = true;

    protected $is_numbers = true;

    protected $is_duplicate = false;

    protected $is_inner = false;

    protected $is_pagination = true;

    protected $is_limitlist = true;

    protected $is_sortable = true;

    protected $is_list = true;

    protected $buttons_position = 'right';

    protected $buttons = array();

    protected $custom_buttons = array();

    protected $readonly = array();

    protected $disabled = array();

    protected $validation_required = array();

    protected $validation_pattern = array();

    protected $before_insert = array();

    protected $before_update = array();

    protected $before_remove = array();

    protected $after_insert = array();

    protected $after_update = array();

    protected $after_remove = array();

    protected $field_type = array();

    protected $field_attr = array();

    public $defaults = array();

    // ALTERADO PARA PUBLIC, NECESS�RIO NOS HELPERS
    // CALLBACK'S
    protected $limit = 20;

    protected $limit_list = array(
        '20',
        '50',
        '100',
        'all'
    );

    protected $column_cut = 50;

    protected $column_cut_list = array();

    protected $no_editor = array();

    protected $show_primary_ai_field = false;

    protected $show_primary_ai_column = false;

    protected $url;

    protected $key;

    protected $benchmark = false;

    protected $search_pattern = array(
        '%',
        '%'
    );

    protected $connection = false;

    protected $start_minimized = false;

    protected $remove_confirm = false;

    protected $upload_folder = array();

    protected $upload_config = array();

    protected $upload_folder_def = '../uploads';

    protected $upload_to_save = array();

    protected $upload_to_remove = array();

    protected $binary = array();

    protected $pass_var = array();

    protected $reverse_fields = array();

    protected $no_quotes = array();

    protected $join = array();

    protected $inner_where = array();

    protected $inner_table_instance = array();

    protected $condition = array();

    protected $theme = 'default';

    protected $unique = array();

    protected $fk_relation = array();

    protected $links_label = array();

    protected $emails_label = array();

    protected $sum = array();

    protected $alert_create;

    protected $alert_edit;

    protected $subselect = array();

    protected $subselect_before = array();

    protected $highlight = array();

    protected $highlight_row = array();

    protected $modal = array();

    protected $column_class = array();

    protected $no_select = array();

    // only subselect flag for correct sorting
    protected $primary_ai = false;

    protected $language = 'en';

    protected static $lang_arr = array();

    protected $subselect_query = array();

    protected $where_pri = array();

    protected $field_params = array();

    protected $mass_alert_create = array();

    protected $mass_alert_edit = array();

    protected $column_callback = array();

    protected $field_callback = array();

    protected $replace_insert = array();

    protected $replace_update = array();

    protected $replace_remove = array();

    protected $send_external_create = array();

    protected $send_external_edit = array();

    protected $locked_fields = array();

    // disallow save data in form fields
    protected $column_pattern = array();

    protected $field_tabs = array();

    protected $field_marker = array();

    protected $field_tooltip = array();

    protected $table_tooltip = array();

    protected $column_tooltip = array();

    protected $search_columns = array();

    protected $search_default = null;

    protected $column_width = array();

    protected $order_column = null;

    protected $order_direct = 'asc';

    protected $result_list = array();

    // DB grid result becomes glodal
    protected $result_row = array();

    // DB details result becomes glodal
    protected $result_total = 0;

    protected $is_get = false;

    public $after = null;

    protected $table_info = null;

    // fields information from database
    protected $before_upload = array();

    protected $before_download = array();

    protected $after_upload = array();

    protected $after_resize = array();

    protected $custom_vars = array();

    protected $tabdesc = array();

    public $column_name = array();

    public $search = 0;

    protected $hidden_columns = array();

    // allows to select non in grid data
    protected $hidden_fields = array();

    // allows save data in non in form fields
    protected $range = '';

    protected $task = '';

    protected $previous_task = '';

    protected $column = false;

    protected $column2 = false;

    protected $phrase = '';

    protected $phrase2 = '';

    protected $inner_value = false;

    protected $fields_output = array();

    protected $hidden_fields_output = array();

    protected $start = 0;

    protected $before = '';

    protected $bit_field = array();

    protected $point_field = array();

    protected $float_field = array();

    protected $text_field = array();

    protected $int_field = array();

    protected $grid_condition = array();

    // ***** remove *****
    protected $hide_button = array();

    protected $set_lang = array();

    public $table_ro = false;

    protected $load_view = array(
        'list' => 'xcrud_list_view.php',
        'create' => 'xcrud_detail_view.php',
        'edit' => 'xcrud_detail_view.php',
        'view' => 'xcrud_detail_view.php',
        'report' => 'xcrud_report_view.php'
    );

    protected $grid_restrictions = array();

    protected $direct_select_tags = array();

    // get unselectable {tags}
    protected $action = array();

    protected $exception = false;

    protected $exception_fields = array();

    protected $exception_text = '';

    protected $messages = array();

    protected $nested_rendered = array();

    protected $default_tab = false;

    protected $prefix = '';

    protected $query = '';

    protected $total_query = '';

    protected $condition_backup = array();

    protected static $sess_id = null;

    protected $is_rtl = true;

    protected $strip_tags = true;

    protected $safe_output = true;

    protected $before_list = array();

    protected $before_create = array();

    protected $before_edit = array();

    protected $before_view = array();

    protected $lists_null_opt = true;

    protected $custom_fields = array();

    protected $date_format = array();

    protected $cancel_file_saving = false;

    protected $parent = null;

    protected $alphabetical_filter = '';

    protected $alphabetical_field = '';

    protected $alphabetical_index = array();

    protected $custom_filter = array();

    protected $custom_filter_active = array();

    protected $custom_filter_all_label = array();

    protected $totalizers = array();

    protected $is_modal = false;

    protected $nested_readonly_on_view = true;

    protected $active_tab_id = null;

    protected $table_always_edit_mode = false;

    protected $record_changes = false;

    protected $custom_lists = false;

    protected $unset_custom_columns = array();

    protected $custom_lists_active = array();

    protected $custom_lists_static = array();

    protected $columns_default = '';

    protected $mass_actions = array();

    protected $opened_tab = false;

    protected $nested_default_render = 'list';

    protected $nested_default_render_primary = false;

    protected $join_relation = array();

    protected $parameters = array();

    protected $fields_report = array();

    protected $report = array();

    protected $report_reverse = array();

    protected $report_tabs = array();

    protected $report_values = array();

    protected $group_by = array();

    protected $search_submit = array();

    protected $search_lines = 2;

    public $ci = null;

    /**
     * constructor, sets basic xcrud vars (they can be changed by public
     * pethods)
     */
    protected function __construct()
    {
        XcrudConfig::$scripts_url = self::check_url(XcrudConfig::$scripts_url, true);
        XcrudConfig::$editor_url = self::check_url(XcrudConfig::$editor_url);
        XcrudConfig::$editor_init_url = self::check_url(XcrudConfig::$editor_init_url);

        $this->limit = XcrudConfig::$limit;
        $this->limit_list = XcrudConfig::$limit_list;
        $this->column_cut = XcrudConfig::$column_cut;
        $this->show_primary_ai_field = XcrudConfig::$show_primary_ai_field;
        $this->show_primary_ai_column = XcrudConfig::$show_primary_ai_column;

        $this->benchmark = XcrudConfig::$benchmark;
        $this->start_minimized = XcrudConfig::$start_minimized;
        $this->remove_confirm = XcrudConfig::$remove_confirm;
        $this->upload_folder_def = XcrudConfig::$upload_folder_def;

        $this->theme = XcrudConfig::$theme;
        $this->is_print = XcrudConfig::$enable_printout;
        $this->is_title = XcrudConfig::$enable_table_title;
        $this->is_csv = XcrudConfig::$enable_csv_export;
        $this->is_numbers = XcrudConfig::$enable_numbers;
        $this->is_pagination = XcrudConfig::$enable_pagination;
        $this->is_search = XcrudConfig::$enable_search;
        $this->is_limitlist = XcrudConfig::$enable_limitlist;
        $this->is_sortable = XcrudConfig::$enable_sorting;

        $this->language = \Config\App::$defaultLocale;

        $this->search_pattern = XcrudConfig::$search_pattern;

        $this->demo_mode = XcrudConfig::$demo_mode;

        $this->default_tab = XcrudConfig::$default_tab;

        $this->is_rtl = XcrudConfig::$is_rtl;

        $this->strip_tags = XcrudConfig::$strip_tags;
        $this->safe_output = XcrudConfig::$safe_output;

        $this->lists_null_opt = XcrudConfig::$lists_null_opt;

        $this->date_format = array(
            'php_d' => XcrudConfig::$php_date_format,
            'php_t' => XcrudConfig::$php_time_format
        );
        $this->nested_readonly_on_view = XcrudConfig::$nested_readonly_on_view;
    }

    protected function __clone()
    {}

    public function __toString()
    {
        return $this->render();
    }

    public static function get_instance($name = false)
    {
        self::init_prepare();
        if (! $name)
            $name = sha1(rand() . microtime());
        if (! isset(self::$instance[$name]) || null === self::$instance[$name]) {
            self::$instance[$name] = new self();
            self::$instance[$name]->instance_name = $name;
            self::$instance[$name]->ci = &$ci;
        }
        self::$instance[$name]->instance_count = count(self::$instance);
        return self::$instance[$name];
    }

    public static function get_requested_instance(&$ci)
    {
        if (isset($_POST['xcrud']['instance']) && isset($_POST['xcrud']['key']) && isset($_POST['xcrud']['task'])) {
            self::init_prepare('post');
            $key = $_POST['xcrud']['key'] ? $_POST['xcrud']['key'] : self::error('Security key cannot be empty');
            $inst_name = $_POST['xcrud']['instance'] ? $_POST['xcrud']['instance'] : self::error('Instance name cannot be empty');
            $is_get = false;
        } elseif (isset($_GET['xcrud']['instance']) && isset($_GET['xcrud']['key']) && isset($_GET['xcrud']['task']) && $_GET['xcrud']['task'] == 'file') {
            self::init_prepare('get');
            $key = $_GET['xcrud']['key'] ? $_GET['xcrud']['key'] : self::error('Security key cannot be empty');
            $inst_name = $_GET['xcrud']['instance'] ? $_GET['xcrud']['instance'] : self::error('Instance name cannot be empty');
            $is_get = true;
        } else {
            self::error('Wrong request!');
        }
        $ci = &get_instance();
        $xcrud_session = $ci->session->userdata('xcrud_session');

        // var_dump($xcrud_session[$inst_name]);
        // if (isset($xcrud_session[$inst_name]['key']) && $xcrud_session[$inst_name]['key'] == $key) {
        if (1 == 1) {
            self::$instance[$inst_name] = new self();
            self::$instance[$inst_name]->is_get = $is_get;
            self::$instance[$inst_name]->ajax_request = true;
            self::$instance[$inst_name]->instance_name = $inst_name;
            self::$instance[$inst_name]->ci = &$ci;
            self::$instance[$inst_name]->import_vars($key);
            self::$instance[$inst_name]->inner_where();
            return self::$instance[$inst_name]->render();
        } else
            self::error('<strong>The verification key is out of date</strong><br />
                This means that your browser cached a previous version of this page with an old key (for security reasons the verification key is generated every request)<br />
                Why? Maybe you pressed the back button in your browser or opened a bookmark from last session. <br /><strong>Just reload the page, nothing happened :)</strong>');
    }

    protected static function init_prepare($method = false)
    {
        $session = config('Session');
        switch ($method) {
            case 'post':
                $sess_name = (XcrudConfig::$dynamic_session && isset($_POST['xcrud']['sess_name']) && $_POST['xcrud']['sess_name']) ? $_POST['xcrud']['sess_name'] : $session->cookieName;
                break;
            case 'get':
                $sess_name = (XcrudConfig::$dynamic_session && isset($_GET['xcrud']['sess_name']) && $_GET['xcrud']['sess_name']) ? $_GET['xcrud']['sess_name'] : $session->cookieName;
                break;
            default:
                $sess_name = $session->cookieName;
                break;
        }
        self::session_start($sess_name);
        if (is_callable(XcrudConfig::$before_construct)) {
            call_user_func(XcrudConfig::$before_construct);
        }
    }

    public static function session_start($sess_name = false)
    {
        if (! session_id()) {
            if (! headers_sent()) {
                if ($sess_name) {
                    $sessionConfig = new \Config\Session();
                    $sessionConfig->cookieName = $sess_name;
                    service('session', $sessionConfig);
                } else {
                    session();
                }
            } else {
                self::error('xCRUD can not create session, because the output is already sent into browser.
                Try to define xCRUD instance before the output start or use session_start() at the beginning of your script');
            }
        }
    }

    public function connection($user = '', $pass = '', $table = '', $host = 'localhost', $encode = 'utf8')
    {
        if ($user && $table) {
            $this->connection = array(
                $user,
                $pass,
                $table,
                $host,
                $encode
            );
        }
        return $this;
    }

    public function start_minimized($bool = true)
    {
        $this->start_minimized = (bool) $bool;
        return $this;
    }

    public function remove_confirm($bool = true)
    {
        $this->remove_confirm = (bool) $bool;
        return $this;
    }

    public function theme($theme = 'default')
    {
        $this->theme = $theme;
    }

    public function limit($limit = 20)
    {
        $this->limit = $limit;
        return $this;
    }

    public function limit_list($limit_list = '')
    {
        if ($limit_list) {
            if (is_array($limit_list))
                $this->limit_list = array_unique($limit_list);
            else {
                $this->limit_list = array_unique($this->parse_comma_separated($limit_list));
            }
        }
        return $this;
    }

    public function show_primary_ai_field($bool = true)
    {
        $this->show_primary_ai_field = (bool) $bool;
        return $this;
    }

    public function show_primary_ai_column($bool = true)
    {
        $this->show_primary_ai_column = (bool) $bool;
        return $this;
    }

    public function table($table = '', $prefix = false)
    {
        if ($prefix !== false) {
            $this->prefix = $prefix;
        }
        $this->table = $this->prefix . $table;
        return $this;
    }

    public function table_name($name = '', $tooltip = false, $icon = false)
    {
        if ($name)
            $this->table_name = $name;
        if ($tooltip) {
            $this->table_tooltip = array(
                'tooltip' => $tooltip,
                'icon' => $icon
            );
        }
        return $this;
    }

    public function where($fields = false, $where_val = false, $glue = 'AND', $index = false)
    {
        if ($fields && $where_val !== false) {
            $fdata = $this->_parse_field_names($fields, 'where');
            foreach ($fdata as $fitem) {
                if ($index) {
                    $this->where[$index] = array(
                        'table' => $fitem['table'],
                        'field' => $fitem['field'],
                        'value' => isset($fitem['value']) ? $fitem['value'] : $where_val,
                        'glue' => $glue
                    );
                } else {
                    $this->where[] = array(
                        'table' => $fitem['table'],
                        'field' => $fitem['field'],
                        'value' => isset($fitem['value']) ? $fitem['value'] : $where_val,
                        'glue' => $glue
                    );
                }
            }
            unset($fields, $fdata);
        } elseif ($fields && ! is_array($fields) && $where_val === false) {
            if ($index) {
                $this->where[$index] = array(
                    'custom' => $fields,
                    'glue' => $glue
                );
            } else {
                $this->where[] = array(
                    'custom' => $fields,
                    'glue' => $glue
                );
            }
            unset($fields);
        } elseif (! $fields && $where_val) {
            if ($index) {
                $this->where[$index] = array(
                    'custom' => $where_val,
                    'glue' => $glue
                );
            } else {
                $this->where[] = array(
                    'custom' => $where_val,
                    'glue' => $glue
                );
            }
            unset($where_val);
        } elseif (! $fields && ! $where_val && $index && isset($this->where[$index])) {
            unset($this->where[$index]);
        }
        return $this;
    }

    public function or_where($fields = '', $where_val = false)
    {
        return $this->where($fields = '', $where_val = '', 'OR');
    }

    public function order_by($fields = '', $direction = 'asc')
    {
        if ($fields) {
            if ($direction === false && is_string($fields)) {
                $this->order_by[$fields] = false;
            } else {
                $fdata = $this->_parse_field_names($fields, 'order_by');
                foreach ($fdata as $key => $fitem) {
                    $this->order_by[$key] = isset($fitem['value']) ? $fitem['value'] : $direction;
                }
            }
        }
        unset($fields);
        return $this;
    }

    public function group_by($fields = '')
    {
        if ($fields) {
            $fdata = $this->_parse_field_names($fields, 'group_by');
            foreach ($fdata as $key => $fitem) {
                $this->group_by[$key] = $fitem['table'] . '.' . $fitem['field'];
            }
        } else {
            $this->group_by[$fields] = false;
        }
        unset($fields);
        return $this;
    }

    public function relation($fields = '', $rel_tbl = '', $rel_field = '', $rel_name = '', $rel_where = array(), $order_by = false, $multi = false, $rel_concat_separator = ' ',$join = null, $tree = false, $depend_field = '', $depend_on = '')
    {
        if ($fields && $rel_tbl && $rel_field && $rel_name) {
            if ($depend_on) {
                $fdata = $this->_parse_field_names($depend_on, 'relation');
                $depend_on = key($fdata) /*$fdata[0]['table'] . '.' . $fdata[0]['field']*/;
            }
            $fdata = $this->_parse_field_names($fields, 'relation');
            foreach ($fdata as $fitem) {
                $this->relation[$fitem['table'] . '.' . $fitem['field']] = array(
                    'rel_tbl' => $rel_tbl,
                    'rel_alias' => 'alias' . rand(),
                    'rel_field' => $rel_field,
                    'rel_name' => $rel_name,
                    'rel_where' => $rel_where,
                    'rel_separator' => $rel_concat_separator,
                    'order_by' => $order_by,
                    'multi' => $multi,
                    'join' => $join,
                    'table' => $fitem['table'],
                    'field' => $fitem['field'],
                    'tree' => $tree,
                    'depend_field' => $depend_field,
                    'depend_on' => $depend_on
                );
            }
        }
        return $this;
    }

    public function fk_relation($label = '', $fields = '', $fk_table = '', $in_fk_field = '', $out_fk_field = '', $rel_tbl = '', $rel_field = '', $rel_name = '', $rel_where = array(), $rel_orderby = '', $rel_concat_separator = ' ', $before = '', array $add_data = array())
    {
        if ($fields && $rel_tbl && $rel_field && $rel_name && $label) {
            $fdata = $this->_parse_field_names($fields, 'fk_relation');
            $fitem = reset($fdata);
            $table = $this->_get_table('subselect');
            // foreach ($fdata as $key => $fitem)
            // {
            // $alias = 'tfkalias' . base_convert(rand(), 10, 36);
            $alias = $table . '.' . $label;
            $this->fk_relation[$alias] = array(
                'table' => $fitem['table'],
                'field' => $fitem['field'],
                'label' => $label,
                'before' => $before ? key(reset($this->_parse_field_names($before, 'fk_relation'))) : '',
                'alias' => $alias,
                'rel_alias' => 'ralias' . rand(),
                'fk_alias' => 'fkalias' . rand(),
                'fk_table' => $fk_table,
                'in_fk_field' => $in_fk_field,
                'out_fk_field' => $out_fk_field,
                'rel_tbl' => $rel_tbl,
                'rel_field' => $rel_field,
                'rel_name' => $rel_name,
                'rel_where' => $rel_where,
                'rel_orderby' => $rel_orderby,
                'rel_separator' => $rel_concat_separator,
                'add_data' => $add_data
            );
            $this->field_type[$alias] = 'fk_relation';
            $this->defaults[$alias] = '';
            if (! isset($this->field_attr[$alias])) {
                $this->field_attr[$alias] = array();
            }

            // }
        }
        return $this;
    }

    /* Ariel Canal */
    public function join_custom($fields = '', $join_tbl = '', $join_field = '', $join_additional_cond = false, $alias = false, $not_insert = false)
    {
        $this->join($fields, $join_tbl, $join_field, $alias, $not_insert, $join_additional_cond);
    }

    public function join($fields = '', $join_tbl = '', $join_field = '', $alias = false, $not_insert = false, $join_additional_cond = false)
    {
        $fdata = $this->_parse_field_names($fields, 'join');
        $alias = $alias ? $alias : $join_tbl;
        $key = key($fdata);
        $this->join[$alias] = array(
            'table' => $fdata[$key]['table'],
            'field' => $fdata[$key]['field'],
            'join_table' => $this->prefix . $join_tbl,
            'join_field' => $join_field,
            'not_insert' => $not_insert,
            'additional_cond' => $join_additional_cond
        );
        // $this->field_type[$this->join[$alias]['join_table'] . '.' .
        // $this->join[$alias]['join_field']] = 'hidden';
        $this->pass_var($alias . '.' . $join_field, '{' . $key . '}', 'edit');
        return $this;
    }

    /**
     *
     * @author Ariel Canal
     *         Armazena quem � a nested m�e.
     */
    /**
     * nested table constructor
     */
    public function nested_table($instance_name = '', $field = '', $inner_tbl = '', $tbl_field = '')
    {
        if ($instance_name && $field && $inner_tbl && $tbl_field) {
            $fdata = $this->_parse_field_names($field, 'nested_table');
            foreach ($fdata as $fitem) {
                $this->inner_table_instance[$instance_name] = $fitem['table'] . '.' . $fitem['field']; // name
                                                                                                       // of
                                                                                                       // stored
                                                                                                       // in
                                                                                                       // parent
                                                                                                       // instance
                $instance = Xcrud::get_instance($instance_name, $this->ci); // just another
                                                                            // xcrud object
                $instance->table($this->prefix . $inner_tbl);
                $instance->table_name($instance_name);
                $instance->is_inner = true; // nested flag
                $instance->parent = $this->instance_name;

                $fdata2 = $this->_parse_field_names($tbl_field, 'nested_table', $inner_tbl);

                $instance->inner_where[$fitem['table'] . '.' . $fitem['field']] = key($fdata2); // this
                                                                                                // connects
                                                                                                // nested
                                                                                                // table
                                                                                                // with
                                                                                                // parent
                return $instance; // only one cycle
            }
        }
    }

    public function fields($fields = '', $reverse = false, $tabname = false, $mode = false)
    {
        $fdata = $this->_parse_field_names($fields, 'fields');
        switch ($mode) {
            case 'create':
                if (! $reverse && $tabname) {
                    $this->field_tabs['create'][$tabname] = $tabname;
                }
                break;
            case 'edit':
                if (! $reverse && $tabname) {
                    $this->field_tabs['edit'][$tabname] = $tabname;
                }
                break;
            case 'view':
                if (! $reverse && $tabname) {
                    $this->field_tabs['view'][$tabname] = $tabname;
                }
                break;
            default:
                if (! $reverse && $tabname) {
                    $this->field_tabs['create'][$tabname] = $tabname;
                    $this->field_tabs['edit'][$tabname] = $tabname;
                    $this->field_tabs['view'][$tabname] = $tabname;
                }
                break;
        }
        foreach ($fdata as $fitem) {
            $fitem['tab'] = $tabname;
            switch ($mode) {
                case 'create':
                    $this->fields_create[$fitem['table'] . '.' . $fitem['field']] = $fitem;
                    $this->reverse_fields['create'] = $reverse;
                    break;
                case 'edit':
                    $this->fields_edit[$fitem['table'] . '.' . $fitem['field']] = $fitem;
                    $this->reverse_fields['edit'] = $reverse;
                    break;
                case 'view':
                    $this->fields_view[$fitem['table'] . '.' . $fitem['field']] = $fitem;
                    $this->reverse_fields['view'] = $reverse;
                    break;
                default:
                    $this->fields_create[$fitem['table'] . '.' . $fitem['field']] = $fitem;
                    $this->fields_edit[$fitem['table'] . '.' . $fitem['field']] = $fitem;
                    $this->fields_view[$fitem['table'] . '.' . $fitem['field']] = $fitem;
                    $this->reverse_fields['create'] = $reverse;
                    $this->reverse_fields['edit'] = $reverse;
                    $this->reverse_fields['view'] = $reverse;
                    break;
            }
        }
        unset($fields, $fdata);
        return $this;
    }

    public function unique($fields = '')
    {
        $fdata = $this->_parse_field_names($fields, 'unique');
        foreach ($fdata as $fitem) {
            $this->unique[$fitem['table'] . '.' . $fitem['field']] = $fitem;
        }
        unset($fields);
        return $this;
    }

    public function label($fields = '', $label = '')
    {
        $fdata = $this->_parse_field_names($fields, 'label');
        foreach ($fdata as $fitem) {
            $this->labels[$fitem['table'] . '.' . $fitem['field']] = isset($fitem['value']) ? $fitem['value'] : $label;
        }
        return $this;
    }

    public function columns($columns = '', $reverse = false, $is_default = true)
    {
        $fdata = $this->_parse_field_names($columns, 'columns');
        $this->fields_list = array();
        foreach ($fdata as $fitem) {
            $this->fields_list_default[$fitem['table'] . '.' . $fitem['field']] = $fitem;
            $this->fields_list[$fitem['table'] . '.' . $fitem['field']] = $fitem;
        }
        if ($is_default)
            $this->columns_default = $columns;
        $this->reverse_fields['list'] = $reverse;
        unset($columns);
        return $this;
    }

    public function columns_active($columns = '')
    {
        if ($columns == "") {
            return $this;
        }
        $this->columns_select = true;
        $fdata = $this->_parse_field_names($columns, 'columns');
        $this->fields_list = array();
        foreach ($fdata as $fitem) {
            $this->fields_list[$fitem['table'] . '.' . $fitem['field']] = $fitem;
        }
        return $this;
    }

    public function render_columns_select()
    {
        if (! $this->columns_select)
            return null;
        $out = "";
        $out .= $this->open_tag('select', 'pull-right bootstrap-select xcrud-columnsList-select', array(
            'table_name' => $this->table_name,
            'multiple' => 'multiple',
            'title' => 'Colunas da Listagem',
            'data-selected-text-format' => 'static',
            'data-header' => 'Selecione as colunas da listagem'
        ));
        foreach ($this->fields_list_default as $field => $fdata) {
            $attr = array();
            if (array_key_exists($field, $this->fields_list)) {
                $attr['selected'] = 'selected';
            }
            $attr['value'] = $field;
            $out .= $this->open_tag('option', null, $attr) . $this->html_safe($this->labels[$field]) . $this->close_tag('option');
        }
        $out .= $this->close_tag('select');
        return $out;
    }

    public function unset_add($bool = true)
    {
        $this->is_create = ! (bool) $bool;
        return $this;
    }

    /**
     *
     * @author Ariel Canal
     *         Inserção do parametro $alt_task
     *         Possibilidade de armazenar mais de uma condição
     */
    public function unset_edit($bool = true, $field = false, $operand = false, $value = false, $alt_task = false)
    {
        $this->is_edit = ! (bool) $bool;
        if ($field && $operand && $value !== false) {
            $this->grid_restrictions['edit'][] = array(
                'bool' => $bool,
                'field' => $field,
                'operator' => $operand,
                'value' => $value,
                'alt' => $alt_task
            );
        }
        return $this;
    }

    /**
     *
     * @author Ariel Canal
     *         Inser��o do parametro $alt_task
     *         Possibilidade de armazenar mais de uma condição
     */
    public function unset_view($bool = true, $field = false, $operand = false, $value = false, $alt_task = false)
    {
        $this->is_view = ! (bool) $bool;
        if ($field && $operand && $value !== false) {
            $this->grid_restrictions['view'][] = array(
                'bool' => $bool,
                'field' => $field,
                'operator' => $operand,
                'value' => $value,
                'alt' => $alt_task
            );
        }
        return $this;
    }

    /**
     *
     * @author Ariel Canal
     *         Possibilidade de armazenar mais de uma condição
     */
    public function unset_remove($bool = true, $field = false, $operand = false, $value = false)
    {
        $this->is_remove = ! (bool) $bool;
        if ($field && $operand && $value !== false) {
            $this->grid_restrictions['remove'][] = array(
                'bool' => $bool,
                'field' => $field,
                'operator' => $operand,
                'value' => $value
            );
        }
        return $this;
    }

    /**
     *
     * @author Ariel Canal
     *         Possibilidade de armazenar mais de uma condição
     */
    public function duplicate_button($bool = true, $field = false, $operand = false, $value = false)
    {
        $this->is_duplicate = (bool) $bool;
        if ($field && $operand && $value !== false) {
            $this->grid_restrictions['duplicate'][] = array(
                'bool' => $bool,
                'field' => $field,
                'operator' => $operand,
                'value' => $value
            );
        }
        return $this;
    }

    public function unset_csv($bool = true)
    {
        $this->is_csv = ! (bool) $bool;
        return $this;
    }

    public function unset_print($bool = true)
    {
        $this->is_print = ! (bool) $bool;
        return $this;
    }

    public function unset_title($bool = true)
    {
        $this->is_title = ! (bool) $bool;
        return $this;
    }

    public function unset_numbers($bool = true)
    {
        $this->is_numbers = ! (bool) $bool;
        return $this;
    }

    public function unset_search($bool = true)
    {
        $this->is_search = ! (bool) $bool;
        return $this;
    }

    public function unset_limitlist($bool = true)
    {
        $this->is_limitlist = ! (bool) $bool;
        return $this;
    }

    public function unset_pagination($bool = true)
    {
        $this->is_pagination = ! (bool) $bool;
        return $this;
    }

    public function unset_sortable($bool = true)
    {
        $this->is_sortable = ! (bool) $bool;
        return $this;
    }

    public function unset_list($bool = true)
    {
        $this->is_list = ! (bool) $bool;
        return $this;
    }

    /**
     *
     * @author Ariel Canal
     *         Ao atribuir o array de configura��o do bot�o � $this->buttons, a
     *         chave �
     *         gravada tamb�m. Isso impede que sejam criados v�rios bot�es
     *         iguais quando h� mais de
     *         uma inst�ncia do CRUD na mesma p�gina.
     */
    public function button($link = '', $name = '', $icon = '', $class = '', $parameters = array(), $conditions = array(), $table_ro = true)
    {
        if ($link) {
            $this->buttons[$name] = array(
                'link' => $link,
                'name' => $name,
                'icon' => $icon,
                'class' => $class,
                'table_ro' => $table_ro,
                'params' => (array) $parameters
            );
        }
        foreach ($conditions as $condition) {
            if ($condition && is_array($condition) && count($condition) == 3 && $name) {
                list ($field, $operator, $value) = $condition;
                $this->grid_restrictions[$name][] = array(
                    'field' => $field,
                    'operator' => $operator,
                    'value' => $value,
                    'bool' => false
                );
            }
        }
        return $this;
    }

    public function custom_button($link = '', $label = '', $icon = '', $class = '', $tag = array())
    {
        if (! $link || ! $label) {
            return "";
        } else {
            $this->custom_buttons[$label] = array(
                'link' => $link,
                'label' => $label,
                'icon' => $icon,
                'class' => $class,
                'tag' => $tag
            );
        }
        return $this;
    }

    public function change_type($fields = '', $type = '', $default = false, $attr = array())
    {
        if ($type) {
            $fdata = $this->_parse_field_names($fields, 'change_type');
            foreach ($fdata as $fitem) {

                switch ($type) {
                    case 'file':
                    case 'image':
                        $this->upload_config[$fitem['table'] . '.' . $fitem['field']] = $attr;
                        break;
                    case 'price':
                        $def_attr = array(
                            'max' => 10,
                            'decimals' => 2,
                            'separator' => ',',
                            'prefix' => '',
                            'suffix' => '',
                            'point' => '.'
                        );
                        $this->field_attr[$fitem['table'] . '.' . $fitem['field']] = array_merge($def_attr, (array) $attr);
                        break;
                    case 'select':
                    case 'multiselect':
                    case 'radio':
                    case 'checkboxes':
                        if (! is_array($attr) or ! isset($attr['values'])) {
                            $this->field_attr[$fitem['table'] . '.' . $fitem['field']]['values'] = $attr;
                        } else {
                            $this->field_attr[$fitem['table'] . '.' . $fitem['field']] = $attr;
                        }
                        break;
                    case 'point':

                        // $this->field_attr[$fitem['table'] . '.' .
                        // $fitem['field']] = $map_attr;
                        $def_attr = array( // defaults
                            'text' => XcrudConfig::$default_text,
                            'search_text' => XcrudConfig::$default_search_text,
                            'zoom' => XcrudConfig::$default_zoom,
                            'width' => XcrudConfig::$default_width,
                            'height' => XcrudConfig::$default_height,
                            'search' => XcrudConfig::$default_coord,
                            'coords' => XcrudConfig::$default_search
                        );
                        $this->field_attr[$fitem['table'] . '.' . $fitem['field']] = array_merge($def_attr, (array) $attr);
                        break;
                    case 'remote_image':
                        if (is_array($attr) && ! isset($attr['link'])) {
                            $attr['link'] = '';
                        } elseif (is_string($attr)) {
                            $attr = array(
                                'link' => $attr
                            );
                        }
                        $this->field_attr[$fitem['table'] . '.' . $fitem['field']] = $attr;
                    default:
                        if ($attr && ! is_array($attr)) {
                            $attr = array(
                                'maxlength' => (int) $attr
                            );
                        }
                        $this->field_attr[$fitem['table'] . '.' . $fitem['field']] = $attr;
                        break;
                }
                $this->field_type[$fitem['table'] . '.' . $fitem['field']] = $type;
                $this->defaults[$fitem['table'] . '.' . $fitem['field']] = $default;
            }
        }
        return $this;
    }

    public function create_field($fields = '', $type = '', $default = false, $attr = array())
    {
        $fdata = $this->_parse_field_names($fields, 'create_field');
        foreach ($fdata as $fkey => $fitem) {
            $this->custom_fields[$fkey] = $fitem;
        }
        return $this->change_type($fields, $type, $default, $attr);
    }

    public function pass_default($fields = '', $value = '')
    {
        $fdata = $this->_parse_field_names($fields, 'pass_default');
        foreach ($fdata as $fitem) {
            $this->defaults[$fitem['table'] . '.' . $fitem['field']] = isset($fitem['value']) ? $fitem['value'] : $value;
        }
        return $this;
    }

    public function pass_var($fields = '', $value = '', $type = 'all', $eval = false)
    {
        $fdata = $this->_parse_field_names($fields, 'pass_var');
        $type = str_replace(' ', '', $type);
        $types = $this->parse_comma_separated($type);
        foreach ($fdata as $fitem) {
            $findex = $fitem['table'] . '.' . $fitem['field'];
            $pass_var = array(
                'table' => $fitem['table'],
                'field' => $fitem['field'],
                'value' => isset($fitem['value']) ? $fitem['value'] : $value,
                'eval' => $eval
            );
            foreach ($types as $tp) {
                if ($tp == 'all') {
                    $this->pass_var['create'][$findex] = $pass_var;
                    $this->pass_var['edit'][$findex] = $pass_var;
                    $this->pass_var['view'][$findex] = $pass_var;
                    break;
                } elseif ($tp == 'create' || $tp == 'edit' || $tp == 'view') {
                    $this->pass_var[$tp][$findex] = $pass_var;
                }
            }
        }
        return $this;
    }

    public function no_quotes($fields = '')
    {
        $fdata = $this->_parse_field_names($fields, 'no_quotes');
        foreach ($fdata as $fkey => $fitem) {
            $this->no_quotes[$fkey] = true;
        }
        return $this;
    }

    public function sum($fields = '', $class = '', $custom_text = '')
    {
        $fdata = $this->_parse_field_names($fields, 'sum');
        foreach ($fdata as $fkey => $fitem) {
            $this->sum[$fkey] = array(
                'table' => $fitem['table'],
                'column' => $fitem['field'],
                'class' => isset($fitem['value']) ? $fitem['value'] : $class,
                'custom' => $custom_text
            );
        }
        return $this;
    }

    public function readonly_on_create($field = '')
    {
        return $this->readonly($field, 'create');
    }

    public function disabled_on_create($field = '')
    {
        return $this->disabled($field, 'create');
    }

    public function readonly_on_edit($field = '')
    {
        return $this->readonly($field, 'edit');
    }

    public function disabled_on_edit($field = '')
    {
        return $this->disabled($field, 'edit');
    }

    public function readonly($fields = '', $mode = false) // needs to be
                                                           // re-written
    {
        $fdata = $this->_parse_field_names($fields, 'readonly');
        foreach ($fdata as $key => $fitem) {
            $this->readonly[$key] = $this->parse_mode($mode);
        }
        return $this;
    }

    public function disabled($fields = '', $mode = false)
    {
        $fdata = $this->_parse_field_names($fields, 'disabled');
        foreach ($fdata as $key => $fitem) {
            $this->disabled[$key] = $this->parse_mode($mode);
        }
        return $this;
    }

    public function condition($fields = '', $operator = '', $value = '', $method = '', $params = array(), $mode = false)
    {
        if ($fields && $method && $operator) {
            $fdata = $this->_parse_field_names($fields, 'condition');
            foreach ($fdata as $key => $fitem) {
                $this->condition[] = array(
                    'field' => $key,
                    'value' => $value,
                    'operator' => $operator,
                    'method' => $method,
                    'params' => (array) $params,
                    'mode' => $this->parse_mode($mode)
                );
            }
        }
        return $this;
    }

    public function instance_name()
    {
        return $this->instance_name;
    }

    public function benchmark($bool = true)
    {
        $this->benchmark = (bool) $bool;
        return $this;
    }

    public function column_cut($int = 50, $fields = false, $safe_output = false)
    {
        if ($fields === false) {
            $this->column_cut = (int) $int ? (int) $int : false;
            $this->safe_output = $safe_output;
        } else {
            $fdata = $this->_parse_field_names($fields, 'column_cut');
            foreach ($fdata as $fitem) {
                $this->column_cut_list[$fitem['table'] . '.' . $fitem['field']] = array(
                    'count' => $int,
                    'safe' => $safe_output
                );
            }
        }
        return $this;
    }

    public function links_label($text = '')
    {
        if ($text) {
            $this->links_label['text'] = trim($text);
        }
        return $this;
    }

    public function emails_label($text = '')
    {
        if ($text) {
            $this->emails_label['text'] = trim($text);
        }
        return $this;
    }

    public function no_editor($fields = '')
    {
        $fdata = $this->_parse_field_names($fields, 'no_editor');
        foreach ($fdata as $fitem) {
            $this->no_editor[$fitem['table'] . '.' . $fitem['field']] = true;
        }
        return $this;
    }

    public function validation_required($fields = '', $chars = 1)
    {
        $fdata = $this->_parse_field_names($fields, 'validation_required');
        foreach ($fdata as $fitem) {
            $this->validation_required[$fitem['table'] . '.' . $fitem['field']] = isset($fitem['value']) ? $fitem['value'] : $chars;
        }
        return $this;
    }

    public function validation_pattern($fields = '', $pattern = '')
    {
        $fdata = $this->_parse_field_names($fields, 'validation_pattern');
        foreach ($fdata as $fitem) {
            $this->validation_pattern[$fitem['table'] . '.' . $fitem['field']] = isset($fitem['value']) ? $fitem['value'] : $pattern;
        }
        return $this;
    }

    public function alert($column = '', $cc = '', $subject = '', $message = '', $link = false, $field = false, $value = false, $mode = 'all')
    {
        if ($cc) {
            if (! is_array($cc))
                $cc = $this->parse_comma_separated($cc);
        }
        if ($mode == 'all' or $mode == 'create')
            $this->alert_create[] = array(
                'column' => $column,
                'cc' => $cc,
                'subject' => $subject,
                'message' => $message,
                'link' => $link,
                'field' => $field,
                'value' => $value
            );
        if ($mode == 'all' or $mode == 'edit')
            $this->alert_edit[] = array(
                'column' => $column,
                'cc' => $cc,
                'subject' => $subject,
                'message' => $message,
                'link' => $link,
                'field' => $field,
                'value' => $value
            );
        return $this;
    }

    public function alert_create($column = '', $cc = '', $subject = '', $message = '', $link = false, $field = false, $value = false)
    {
        return $this->alert($column, $cc, $subject, $message, $link, $field, $value, 'create');
    }

    public function alert_edit($column = '', $cc = '', $subject = '', $message = '', $link = false, $field = false, $value = false)
    {
        return $this->alert($column, $cc, $subject, $message, $link, $field, $value, 'edit');
    }

    // NEEDS TO BE REWRITTEN
    public function mass_alert($email_table = '', $email_column = '', $emeil_where = '', $subject = '', $message = '', $link = false, $field = false, $value = false, $mode = 'all')
    {
        $table = $this->_get_table('mass_alert');
        $field = $this->table . '.' . $field;
        if ($mode == 'all' or $mode == 'create')
            $this->mass_alert_create[] = array(
                'email_table' => $email_table,
                'email_column' => $email_column,
                'where' => $emeil_where,
                'subject' => $subject,
                'message' => $message,
                'link' => $link,
                'field' => $field,
                'value' => $value,
                'table' => $table
            );
        if ($mode == 'all' or $mode == 'edit')
            $this->mass_alert_edit[] = array(
                'email_table' => $email_table,
                'email_column' => $email_column,
                'where' => $emeil_where,
                'subject' => $subject,
                'message' => $message,
                'link' => $link,
                'field' => $field,
                'value' => $value,
                'table' => $table
            );

        return $this;
    }

    public function mass_alert_create($email_table = '', $email_column = '', $emeil_where = '', $subject = '', $message = '', $link = false, $field = false, $value = false)
    {
        return $this->mass_alert($email_table, $email_column, $emeil_where, $subject, $message, $link, $field, $value, 'create');
    }

    public function mass_alert_edit($email_table = '', $email_column = '', $emeil_where = '', $subject = '', $message = '', $link = false, $field = false, $value = false)
    {
        return $this->mass_alert($email_table, $email_column, $emeil_where, $subject, $message, $link, $field, $value, 'edit');
    }

    public function send_external($path, $data = array(), $method = 'include', $mode = 'all', $where_field = '', $where_val = '')
    {
        if ($where_field) {
            $fdata = $this->_parse_field_names($where_field, 'send_external');
            $where_field = key($fdata) /*$fdata[0]['table'] . '.' . $fdata[0]['field']*/;
        }
        if ($mode == 'all' or $mode == 'create')
            $this->send_external_create = array(
                'data' => $data,
                'path' => $path,
                'method' => $method,
                'where_field' => $where_field,
                'where_val' => $where_val
            );
        if ($mode == 'all' or $mode == 'edit')
            $this->send_external_edit = array(
                'data' => $data,
                'path' => $path,
                'method' => $method,
                'where_field' => $where_field,
                'where_val' => $where_val
            );
        return $this;
    }

    public function page_call($url = '', $data = array(), $where_param = '', $where_value = '', $method = 'get')
    {
        return $this->send_external($url, $data, $method, 'all', $where_param, $where_value);
    }

    public function page_call_create($url = '', $data = array(), $where_param = '', $where_value = '', $method = 'get')
    {
        return $this->send_external($url, $data, $method, 'create', $where_param, $where_value);
    }

    public function page_call_edit($url = '', $data = array(), $where_param = '', $where_value = '', $method = 'get')
    {
        return $this->send_external($url, $data, $method, 'edit', $where_param, $where_value);
    }

    public function subselect($column_name = '', $sql = '', $before = false)
    {
        if ($column_name && $sql) {
            $table = $this->_get_table('subselect');
            $column_alias = $table . '.' . $column_name;
            if ($before) {
                $fdata = $this->_parse_field_names($before, 'subselect');
                $before = key($fdata) /*$fdata[0]['table'] . '.' . $fdata[0]['field']*/;
            }
            $this->subselect[$column_alias] = $sql;
            $this->subselect_before[$column_alias] = $before;
            // $this->no_select[$column_alias] = true;
            $this->labels[$column_alias] = $column_name;
            $this->field_type[$column_alias] = 'none';
            $this->defaults[$column_alias] = '';
        }
        return $this;
    }

    public function highlight($columns = '', $operator = '', $value = '', $color = '', $class = '')
    {
        if ($columns && $operator) {
            $fdata = $this->_parse_field_names($columns, 'highlight');
            foreach ($fdata as $fitem) {
                $this->highlight[$fitem['table'] . '.' . $fitem['field']][] = array(
                    'value' => $value,
                    'operator' => $operator,
                    'color' => $color,
                    'class' => $class
                );
            }
        }
        return $this;
    }

    public function highlight_row($columns = '', $operator = '', $value = '', $color = '', $class = '')
    {
        if ($columns && $operator) {
            $fdata = $this->_parse_field_names($columns, 'highlight_row');
            foreach ($fdata as $fitem) {
                $this->highlight_row[] = array(
                    'field' => $fitem['table'] . '.' . $fitem['field'],
                    'value' => $value,
                    'operator' => $operator,
                    'color' => $color,
                    'class' => $class
                );
            }
        }
        return $this;
    }

    public function modal($columns = '', $icon = false)
    {
        $fdata = $this->_parse_field_names($columns, 'modal');
        foreach ($fdata as $fitem) {
            $this->modal[$fitem['table'] . '.' . $fitem['field']] = isset($fitem['value']) ? $fitem['value'] : $icon;
        }
        return $this;
    }

    public function column_class($columns = '', $class = '')
    {
        $fdata = $this->_parse_field_names($columns, 'column_class');
        foreach ($fdata as $fitem) {
            $this->column_class[$fitem['table'] . '.' . $fitem['field']][] = isset($fitem['value']) ? $fitem['value'] : $class;
        }
        return $this;
    }

    public function language($lang = 'en')
    {
        $this->language = $lang;
        return $this;
    }

    public function field_tooltip($fields = '', $tooltip = '', $icon = false)
    {
        if ($fields && $tooltip) {
            $fdata = $this->_parse_field_names($fields, 'column_class');
            foreach ($fdata as $fitem) {
                $this->field_tooltip[$fitem['table'] . '.' . $fitem['field']] = array(
                    'tooltip' => isset($fitem['value']) ? $fitem['value'] : $tooltip,
                    'icon' => $icon
                );
            }
        }
        return $this;
    }

    public function search_columns($fields = false, $default = false)
    {
        if ($fields) {
            $fdata = $this->_parse_field_names($fields, 'search_columns');
            foreach ($fdata as $fkey => $fitem) {
                $this->search_columns[$fkey] = $fitem;
            }
        }
        if ($default !== false) {
            if ($default == '') {
                $this->search_default = false;
            } else {
                $fdata = $this->_parse_field_names($default, 'search_columns');
                $this->search_default = key($fdata) /*$fdata[0]['table'] . '.' . $fdata[0]['field']*/;
            }
        }
        return $this;
    }

    public function column_width($fields = '', $width = '')
    {
        if ($fields && $width) {
            $fdata = $this->_parse_field_names($fields, 'column_width');
            foreach ($fdata as $fitem) {
                $this->column_width[$fitem['table'] . '.' . $fitem['field']] = $width;
            }
        }
        return $this;
    }

    /**
     *
     * @author Ariel Canal
     *         COMPATIBILIZAÇÃO COM A ARQUITETURA DO CODEIGINITER
     */
    public function before_insert($callable = '', $path = 'functions.php')
    {
        if ($callable && $path) {
            $this->before_insert['callable'] = $callable;
            $this->before_insert['path'] = "/../../helpers/" . $path;
        }
        return $this;
    }

    /**
     *
     * @author Ariel Canal
     *         COMPATIBILIZAÇÃO COM A ARQUITETURA DO CODEIGINITER
     */
    public function before_update($callable = '', $path = 'functions.php')
    {
        if ($callable && $path) {
            $this->before_update['callable'] = $callable;
            $this->before_update['path'] = "/../../helpers/" . $path;
        }
        return $this;
    }

    /**
     *
     * @author Ariel Canal
     *         COMPATIBILIZAÇÃO COM A ARQUITETURA DO CODEIGINITER
     */
    public function before_remove($callable = '', $path = 'functions.php')
    {
        if ($callable && $path) {
            $this->before_remove['callable'] = $callable;
            $this->before_remove['path'] = "/../../helpers/" . $path;
        }
        return $this;
    }

    /**
     *
     * @author Ariel Canal
     *         COMPATIBILIZAÇÃO COM A ARQUITETURA DO CODEIGINITER
     */
    public function after_insert($callable = '', $path = 'functions.php')
    {
        if ($callable && $path) {
            $this->after_insert['callable'] = $callable;
            $this->after_insert['path'] = "/../../helpers/" . $path;
        }
        return $this;
    }

    /**
     *
     * @author Ariel Canal
     *         COMPATIBILIZAÇÃO COM A ARQUITETURA DO CODEIGINITER
     */
    public function after_update($callable = '', $path = 'functions.php')
    {
        if ($callable && $path) {
            $this->after_update['callable'] = $callable;
            $this->after_update['path'] = "/../../helpers/" . $path;
        }
        return $this;
    }

    /**
     *
     * @author Ariel Canal
     *         COMPATIBILIZAÇÃO COM A ARQUITETURA DO CODEIGINITER
     */
    public function after_remove($callable = '', $path = 'functions.php')
    {
        if ($callable && $path) {
            $this->after_remove['callable'] = $callable;
            $this->after_remove['path'] = "/../../helpers/" . $path;
        }
        return $this;
    }

    /**
     *
     * @author Ariel Canal
     *         COMPATIBILIZAÇÃO COM A ARQUITETURA DO CODEIGINITER
     */
    public function after_upload($callable = '', $path = 'functions.php')
    {
        if ($callable && $path) {
            $this->after_upload['callable'] = $callable;
            $this->after_upload['path'] = "/../../helpers/" . $path;
        }
        return $this;
    }

    /**
     *
     * @author Ariel Canal
     *         COMPATIBILIZAÇÃO COM A ARQUITETURA DO CODEIGINITER
     */
    public function before_upload($callable = '', $path = 'functions.php')
    {
        if ($callable && $path) {
            $this->before_upload['callable'] = $callable;
            $this->before_upload['path'] = "/../../helpers/" . $path;
        }
        return $this;
    }

    public function before_download($callable = '', $path = 'functions.php')
    {
        if ($callable && $path) {
            $this->before_download['callable'] = $callable;
            $this->before_download['path'] = "/../../helpers/" . $path;
        }
        return $this;
    }

    /**
     *
     * @author Ariel Canal
     *         COMPATIBILIZAÇÃO COM A ARQUITETURA DO CODEIGINITER
     */
    public function column_callback($fields = '', $callback = '', $path = 'functions.php')
    {
        if ($fields && $callback && $path) {
            $fdata = $this->_parse_field_names($fields, 'column_callback');
            foreach ($fdata as $fitem) {
                $this->column_callback[$fitem['table'] . '.' . $fitem['field']] = array(
                    'name' => $fitem['table'] . '.' . $fitem['field'],
                    'path' => rtrim("/../../helpers/" . $path, '/'),
                    'callback' => $callback
                );
            }
        }
        return $this;
    }

    /**
     *
     * @author Ariel Canal
     *         COMPATIBILIZAÇÃO COM A ARQUITETURA DO CODEIGINITER
     */
    public function field_callback($fields = '', $callback = '', $path = 'functions.php')
    {
        if ($fields && $callback && $path) {
            $fdata = $this->_parse_field_names($fields, 'field_callback');
            foreach ($fdata as $fitem) {
                $this->field_callback[$fitem['table'] . '.' . $fitem['field']] = array(
                    'name' => $fitem['table'] . '.' . $fitem['field'],
                    'path' => rtrim("/../../helpers/" . $path, '/'),
                    'callback' => $callback
                );
            }
        }
        return $this;
    }

    /**
     *
     * @author Ariel Canal
     *         COMPATIBILIZAÇÃO COM A ARQUITETURA DO CODEIGINITER
     */
    public function replace_insert($callable = '', $path = 'functions.php')
    {
        if ($callable) {
            $this->replace_insert = array(
                'callable' => $callable,
                'path' => "/../../helpers/" . $path
            );
        }
        return $this;
    }

    /**
     *
     * @author Ariel Canal
     *         COMPATIBILIZAÇÃO COM A ARQUITETURA DO CODEIGINITER
     */
    public function replace_update($callable = '', $path = 'functions.php')
    {
        if ($callable) {
            $this->replace_update = array(
                'callable' => $callable,
                'path' => "/../../helpers/" . $path
            );
        }
        return $this;
    }

    /**
     *
     * @author Ariel Canal
     *         COMPATIBILIZAÇÃO COM A ARQUITETURA DO CODEIGINITER
     */
    public function replace_remove($callable = '', $path = 'functions.php')
    {
        if ($callable) {
            $this->replace_remove = array(
                'callable' => $callable,
                'path' => "/../../helpers/" . $path
            );
        }
        return $this;
    }

    /**
     *
     * @author Ariel Canal
     *         COMPATIBILIZAÇÃO COM A ARQUITETURA DO CODEIGINITER
     */
    public function before_list($callable = '', $path = 'functions.php')
    {
        if ($callable && $path) {
            $this->before_list['callable'] = $callable;
            $this->before_list['path'] = "/../../helpers/" . $path;
        }
        return $this;
    }

    /**
     *
     * @author Ariel Canal
     *         COMPATIBILIZAÇÃO COM A ARQUITETURA DO CODEIGINITER
     */
    public function before_create($callable = '', $path = 'functions.php')
    {
        if ($callable && $path) {
            $this->before_create['callable'] = $callable;
            $this->before_create['path'] = "/../../helpers/" . $path;
        }
        return $this;
    }

    /**
     *
     * @author Ariel Canal
     *         COMPATIBILIZAÇÃO COM A ARQUITETURA DO CODEIGINITER
     */
    public function before_edit($callable = '', $path = 'functions.php')
    {
        if ($callable && $path) {
            $this->before_edit['callable'] = $callable;
            $this->before_edit['path'] = "/../../helpers/" . $path;
        }
        return $this;
    }

    /**
     *
     * @author Ariel Canal
     *         COMPATIBILIZAÇÃO COM A ARQUITETURA DO CODEIGINITER
     */
    public function before_view($callable = '', $path = 'functions.php')
    {
        if ($callable && $path) {
            $this->before_view['callable'] = $callable;
            $this->before_view['path'] = "/../../helpers/" . $path;
        }
        return $this;
    }

    public function call_update($postdata, $primary)
    {
        if (! $this->task) {
            self::error('Sorry, but you must use <strong>call_update()</strong> only in callbacks');
        }
        return $this->_update($postdata->to_array(), $primary);
    }

    public function set_var($name = null, $value = null)
    {
        if ($name) {
            $this->custom_vars[$name] = $value;
        }
        return $this;
    }

    public function get_var($name = null)
    {
        if ($name) {
            return isset($this->custom_vars[$name]) ? $this->custom_vars[$name] : false;
        } else {
            return false;
        }
    }

    public function unset_var($name)
    {
        if (isset($this->custom_vars[$name])) {
            unset($this->custom_vars[$name]);
        }
        return $this;
    }

    public function column_name($fields = '', $text = '')
    {
        $fdata = $this->_parse_field_names($fields, 'column_name');
        foreach ($fdata as $fitem) {
            $this->column_name[$fitem['table'] . '.' . $fitem['field']] = $text;
        }
        unset($fields);
        return $this;
    }

    public function column_pattern($fields, $patern)
    {
        if ($fields && $patern) {
            $fdata = $this->_parse_field_names($fields, 'column_pattern');
            foreach ($fdata as $fkey => $fitem) {
                $this->column_pattern[$fkey] = $patern;
            }
        }
        return $this;
    }

    public function column_tooltip($fields = '', $tooltip = '', $icon = false)
    {
        if ($fields && $tooltip) {
            $fdata = $this->_parse_field_names($fields, 'column_tooltip');
            foreach ($fdata as $fkey => $fitem) {
                $this->column_tooltip[$fkey] = array(
                    'tooltip' => isset($fitem['value']) ? $fitem['value'] : $tooltip,
                    'icon' => $icon
                );
            }
        }
        return $this;
    }

    public function buttons_position($position = 'left')
    {
        switch ($position) {
            case 'left':
            case 'right':
            case 'none':
                $this->buttons_position = $position;
                break;
        }
        return $this;
    }

    /* INCLUIDO O PARÂMETRO $remove */
    public function hide_button($names = '', $remove = false)
    {
        foreach ($this->parse_comma_separated($names) as $name) {
            if ($remove) {
                unset($this->hide_button[$name]);
            } else {
                $this->hide_button[$name] = 1;
            }
        }
        return $this;
    }

    public function set_lang($var = '', $translate = '')
    {
        if ($var) {
            $this->set_lang[$var] = $translate;
        }
        return $this;
    }

    public function search_pattern($left = '%', $right = '%')
    {
        $this->search_pattern = array(
            $left,
            $right
        );
        return $this;
    }

    /**
     *
     * @author Ariel Canal
     *         COMPATIBILIZAÇÃO COM CONDEIGNITER
     *        
     */
    public function load_view($mode = '', $file = '')
    {
        if ($mode && $file) {
            switch ($mode) {
                case 'list':
                case 'create':
                case 'edit':
                case 'view':
                    $this->load_view[$mode] = '../' . $file;
                    break;
                default:
                    self::error('Incorrect mode.');
            }
        }
        return $this;
    }

    /**
     *
     * @author Ariel Canal
     *         Alterado o path default para os helpers.
     *         Incluido o par�metro icon.
     *         Incluido o par�metro button_attr
     *         Incluido os par�metros conditions.
     *         Incluido o mode.
     */
    public function create_action($name = '', $callable = '', $path = 'functions.php', $icon = null, $button_attr = null, $cond_field = null, $cond_operator = null, $cond_value = null, $mode = null)
    {
        if ($callable && $name) {
            if ($cond_field && ! is_array($cond_field)) {
                $conditions[0][0] = $cond_field;
                $conditions[0][1] = $cond_operator;
                $conditions[0][2] = $cond_value;
            } else if ($cond_field) {
                $conditions = $cond_field;
            } else {
                $conditions = array();
            }
            $this->action[$name] = array(
                'callable' => $callable,
                'path' => "/../../helpers/" . $path,
                'icon' => $icon,
                'button_attr' => $button_attr,
                'conditions' => $conditions,
                'mode' => $mode
            );
        }
        return $this;
    }

    public function get($name = '')
    {
        if (! $this->task) {
            self::error('Sorry, but you must use <strong>get()</strong> only in callbacks');
        }
        if ($this->_get('key')) {
            return $this->_get($name);
        } else {
            return $this->_post($name);
        }
    }

    public function default_tab($name = false)
    {
        $this->default_tab = $name;
        return $this;
    }

    public function query($query = '')
    {
        $this->query = $query;
        return $this;
    }

    public function check()
    {
        $array = array();
        $phpvers = phpversion();
        $array['PHP version'] = array(
            'value' => $phpvers,
            'state' => ((int) $phpvers >= 5 ? 'passed' : 'error')
        );
    }

    public function set_attr($fields = '', array $attr = array())
    {
        if ($fields && $attr) {
            $fdata = $this->_parse_field_names($fields, 'set_attr');
            foreach ($fdata as $fkey => $fitem) {
                if (isset($this->field_attr[$fkey])) {
                    $this->field_attr[$fkey] = array_merge((array) $this->field_attr[$fkey], $attr);
                } else {
                    $this->field_attr[$fkey] = $attr;
                }
            }
        }
        return $this;
    }

    public function lists_null_opt($bool = true)
    {
        $this->lists_null_opt = $bool;
        return $this;
    }

    /**
     * public renderer, final instance method
     */
    public function render($task = false, $primary = false)
    {
        $this->benchmark_start();
        $this->_receive_post($task, $primary);
        $this->_regenerate_key();
        $this->_remove_and_save_uploads();
        $this->_get_language();
        $this->_get_theme_config();
        if ($this->query) {
            return $this->render_custom_query_task();
        }
        $this->_get_table_info();
        return $this->_run_task();
    }

    /**
     * main task trigger
     */
    protected function _run_task()
    {
        if ($this->after && $this->after == $this->task) {
            return self::error('Task recursion!');
        }
        if (! $this->task) {
            $this->task = 'list';
        }
        switch ($this->task) {
            case 'create':
                $this->_set_field_types('create');
                // $this->_sort_defaults();
                return $this->_create();
                break;
            case 'edit':
                $this->_set_field_types('edit');
                return $this->_entry('edit');
                break;
            case 'save':
                if (! $this->before) {
                    return self::error('Restricted task!');
                }
                $this->_set_field_types($this->before);
                return $this->_save();

                /*
                 * $this->task = $this->after;
                 * $this->after = null;
                 * return $this->_run_task();
                 */
                break;
            case 'remove':
                $this->set_custom_lists();
                $this->_set_field_types('list');
                $this->_remove();
                return $this->_list();
                break;
            case 'mass':
                return $this->_mass_action();
                break;
            case 'upload':
                ini_set('post_max_size', '64M');
                ini_set('upload_max_filesize', '64M');
                return $this->_upload();
                break;
            case 'remove_upload':
                return $this->_remove_upload();
                break;
            case 'crop_image':
                return $this->manual_crop();
                break;
            case 'unique':
                $this->_set_field_types('edit');
                return $this->_check_unique_value();
                break;
            case 'clone':
                $this->set_custom_lists();
                $this->_set_field_types('list');
                $this->_clone_row();
                return $this->_list();
                break;
            case 'print':
                if (! $this->is_print) {
                    return self::error('Restricted');
                }
                $this->_set_field_types('list', XcrudConfig::$print_all_fields);
                $this->theme = 'printout';
                $this->set_custom_lists();
                return $this->_list();
                break;
            case 'depend':
                return $this->create_relation($this->_post('name', false, 'base64'), $this->_post('value'), $this->get_field_attr($this->_post('name', false, 'base64'), 'edit'), $this->_post('dependval'));
                break;
            case 'view':
                $this->_set_field_types('view');
                return $this->_entry('view');
                break;
            case 'query':

                break;
            case 'external':

                break;
            case 'action':
                return $this->_call_action();
                break;
            case 'file':
                $this->_set_field_types('list');
                return $this->_render_file();
                break;
            case 'csv':
                $this->set_custom_lists();
                $this->_set_field_types('list', XcrudConfig::$csv_all_fields);
                return $this->_csv();
                break;
            case 'relation_search':
                $this->ci->output->enable_profiler(false);
                return $this->relation_search($this->_post('name', false, 'base64'), $this->_post('dependval'));
                break;
            case 'join_relation':
                return $this->join_relation_data($this->_post('jr_field', false, 'base64'), $this->_post('jr_value', false));
                break;
            case 'report':
                $this->unset_add();
                $this->unset_remove();
                $this->unset_edit();
                $this->unset_view();
                $this->mass_remove(false);
                $this->unset_sortable(false);
                $this->unset_csv(false);
                $this->unset_print();
                $this->unset_list(false);
                $this->_set_field_types('report');
                return $this->_report();
                break;
            case 'make_report':
                $this->_set_field_types('list');
                $this->_save_report_values();
                return $this->_list();
                break;
            case 'change_columns':
                $this->columns_active($this->_post('columns'));
                $this->_set_field_types('list');
                return $this->_list();
            case 'list':
            default:
                $this->set_custom_lists();
                $this->_set_field_types('list');
                return $this->_list();
                break;
        }
    }

    protected function render_custom_query_task()
    {
        $this->is_edit = false;
        $this->is_remove = false;
        $this->is_create = false;
        $this->is_view = false;
        $this->is_search = false;
        switch ($this->task) {
            case 'print':
                if (! $this->is_print) {
                    return self::error('Restricted');
                }
                $this->theme = 'printout';
                $this->start = 0;
                $this->limit = 0;
                return $this->render_custom_datagrid();
                break;
            case 'action':
                return $this->_call_action();
                break;
            case 'csv':
                return $this->render_custom_csv();
                break;
            default:
                return $this->render_custom_datagrid();
                break;
        }
    }

    protected function render_custom_datagrid()
    {
        $query = $this->parse_query_params();
        $db = Database::get_instance($this->connection, $this->ci);
        $db->query('SELECT COUNT(*) as `count` FROM (SELECT NULL' . $this->total_query . ') counts');
        $this->sum_row = $db->row();
        $this->result_total = $this->sum_row['count'];
        $order_by = $this->_build_order_by();
        $limit = $this->_build_limit($this->result_total);
        $db->query($query . ' ' . $order_by . ' ' . $limit);
        $this->result_list = $db->result();
        $this->columns = reset($this->result_list);
        unset($this->columns['primary_key']);
        foreach ($this->columns as $key => $tmp) {
            $this->columns[$key] = array(
                'table' => '',
                'field' => $key
            );
            if (! isset($this->field_type[$key])) {
                $this->field_type[$key] = 'text';
            }
        }
        $this->fields_list = $this->columns;
        $this->_set_column_names();
        if (! $this->table_name) {
            $this->table_name = '&nbsp;';
        }
        return $this->_render_list();
    }

    protected function render_custom_csv()
    {
        if (! $this->is_csv) {
            return self::error('Restricted');
        }
        $this->columns = $this->fields_list;
        $query = $this->parse_query_params();
        $db = Database::get_instance($this->connection, $this->ci);
        $order_by = $this->_build_order_by();
        $this->_set_column_names();
        ini_set('auto_detect_line_endings', true);
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: public");
        header("Content-type: application/octet-stream");
        $table_name = $this->_clean_file_name(trim(html_entity_decode($this->table_name, ENT_QUOTES, 'utf-8')));
        header("Content-Disposition: attachment; filename=\"" . ($table_name ? $table_name : 'table') . ".csv\"");
        header("Content-Transfer-Encoding: binary");
        $output = fopen('php://output', 'w');
        fwrite($output, chr(0xEF) . chr(0xBB) . chr(0xBF)); // bom
        fputcsv($output, $this->columns_names, XcrudConfig::$csv_delimiter, XcrudConfig::$csv_enclosure);
        $db->query($query . ' ' . $order_by);
        foreach ($db->result() as $row) {
            $out = array();
            foreach ($this->columns as $field => $fitem) {
                $out[] = htmlspecialchars_decode(strip_tags($this->_render_export_item($field, $row[$field], $row['primary_key'], $row)), ENT_QUOTES);
            }
            fputcsv($output, $out, XcrudConfig::$csv_delimiter, XcrudConfig::$csv_enclosure);
        }
    }

    protected function parse_query_params()
    {
        $query = preg_replace('/\s+/u', ' ', $this->query);
        $query = preg_replace('/[\)`\s]from[\(`\s]/ui', ' FROM ', $query);

        if (preg_match('/(limit([0-9\s\,]+)){1}$/ui', $query, $matches)) {
            $query = str_ireplace($matches[0], '', $query);
            if (! $this->ajax_request) {
                $tmp = explode(',', $matches[2]);
                if (isset($tmp[1])) {
                    $this->start = (int) trim($tmp[0]);
                    $this->limit = (int) trim($tmp[1]);
                } else {
                    $this->start = 0;
                    $this->limit = (int) trim($tmp[0]);
                }
            }
        }
        if (preg_match('/(order\sby([^\(\)]+)){1}$/ui', $query, $matches)) {
            $query = str_ireplace($matches[0], '', $query);
            if (! $this->ajax_request) {
                $tmp = explode(',', $matches[2]);
                foreach ($tmp as $item) {
                    $item = trim($item);
                    $direct = (mb_strripos($item, ' desc') == (mb_strlen($item) - 5) || mb_strripos($item, '`desc') == (mb_strlen($item) - 5)) ? 'desc' : 'asc';
                    $item = str_ireplace(array(
                        ' asc',
                        ' desc',
                        '`asc',
                        '`desc',
                        '`'
                    ), '', $item);
                    $this->order_by[$item] = $direct;
                }
            }
        }
        $tmp = preg_replace_callback('/\( (?> [^)(]+ | (?R) )+ \)/xui', array(
            $this,
            'query_params_callback'
        ), $query);
        $from_pos = mb_strpos($tmp, ' FROM ');
        $this->total_query = mb_substr($query, $from_pos);
        $query = mb_substr($query, 0, $from_pos) . ',(0) AS `primary_key`' . mb_substr($query, $from_pos);
        return $query;
    }

    protected function query_params_callback($matches)
    {
        return preg_replace('/./Uui', '*', $matches[0]);
    }

    /**
     * main output
     */
    protected function render_output()
    {
        if ($this->ajax_request) {
            $contents = $this->render_control_fields() . $this->data;
            $this->after_render();
        } else {
            $contents = '';
            if (! self::$css_loaded && ! XcrudConfig::$manual_load) {
                $contents .= self::load_css();
            }
            ob_start();
            include (XCRUD_PATH . '/' . XcrudConfig::$themes_path . '/' . $this->theme . '/xcrud_container.php');
            $contents .= ob_get_contents();
            ob_end_clean();
            unset($this->data);
            if (! self::$js_loaded && ! XcrudConfig::$manual_load) {
                $contents .= self::load_js();
            }
            $this->after_render();
        }
        if (in_array($this->task, [
            'create',
            'edit'
        ])) {
            return $this->open_tag('form') . $contents . $this->close_tag('form');
        } else {
            return $contents;
        }
    }

    protected function after_render()
    {
        switch ($this->task) {
            case 'file':
            case 'depend':
            case 'print':
            case 'csv':
                break;
            default:
                if (self::$instance) {
                    foreach (self::$instance as $i) {
                        $i->_export_vars();
                    }
                }
                break;
        }
        if (is_callable(XcrudConfig::$after_render)) {
            call_user_func(XcrudConfig::$after_render);
        }
    }

    /**
     * returns current view into main container
     */
    protected function render_view()
    {
        return $this->render_control_fields() . $this->data;
    }

    /**
     * files and images rendering
     */
    protected function _render_file()
    {
        $field = str_replace('`', '', $this->_get('field'));
        if (! $field)
            exit();
        $thumb = $this->_get('thumb', false);
        $crop = (bool) $this->_get('crop', false);
        $settings = $this->upload_config[$field];
        $blob = false;

        $image = array_search($field, array_reverse($this->upload_to_save));
        if (! $image) {
            list ($tmp1, $tmp2) = explode('.', $field);
            $db = Database::get_instance($this->connection, $this->ci);

            $this->where_pri($this->primary_key, $this->primary_val);
            $where = $this->_build_where();
            $table_join = $this->_build_table_join();

            $db = Database::get_instance($this->connection, $this->ci);
            $db->query("SELECT `$tmp1`.`$tmp2`\r\n FROM `{$this->table}`\r\n {$table_join}\r\n {$where}\r\n LIMIT 1");
            $row = $db->row();
            $image = $row[$tmp2];
            if (isset($this->upload_config[$field]['blob']) && $this->upload_config[$field]['blob'] === true) {
                $blob = true;
            } else {
                if ($thumb !== false) {
                    if (isset($settings['thumbs'][$thumb])) {
                        $thumb_set = $settings['thumbs'][$thumb];
                        $path = $this->get_thumb_path($image, $field, $thumb_set);
                    } else {
                        $folder = $this->get_image_folder($field);
                        $path = $folder . '/' . $image;
                    }
                } else {
                    $folder = $this->get_image_folder($field);
                    $path = $folder . '/' . $image;
                }
                // $image = ($thumb ? substr_replace($image, $marker,
                // strrpos($image, '.'), 0) : $image);
                // $path = $this->check_folder($folder, 'render_image') . '/' .
                // $image;
                if (! is_file($path)) {
                    header("HTTP/1.0 404 Not Found");
                    exit('Not Found');
                }
                // $output = file_get_contents($path);
            }
        } else {
            // $folder = $this->upload_folder[$field];
            if ($crop) {
                $folder = $this->get_image_folder($field);
                $tmp_filename = substr($image, 0, strrpos($image, '.')) . '.tmp';
                $path = $folder . '/' . $tmp_filename;
            } elseif ($thumb !== false) {
                $thumb_set = $settings['thumbs'][$thumb];
                $path = $this->get_thumb_path($image, $field, $thumb_set);
            } else {
                $folder = $this->get_image_folder($field);
                $path = $folder . '/' . $image;
            }
            // $image = ($thumb ? substr_replace($image, $marker,
            // strrpos($image, '.'), 0) : $image);
            // $path = $this->check_folder($folder, 'render_image') . '/' .
            // $image;
            if (! is_file($path)) {
                header("HTTP/1.0 404 Not Found");
                exit('Not Found');
            }
            // $output = file_get_contents($path);
        }
        if ($this->before_download) {
            $path = $this->check_file($this->before_download['path'], 'before_download');
            include_once ($path);
            $callable = $this->before_download['callable'];
            if (is_callable($callable)) {
                call_user_func_array($callable, array(
                    $field,
                    $this->filter_file_name($image),
                    $settings,
                    $this
                ));
                if ($this->exception) {
                    $out = $this->call_exception();
                }
            }
        }

        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: public");
        if ($this->field_type[$field] == 'image' && ! $blob) {
            $size = getimagesize($path);
            switch ($size[2]) {
                case 1:
                    header("Content-type: image/gif");
                    break;
                case 2:
                    header("Content-type: image/jpeg");
                    break;
                case 3:
                    header("Content-type: image/png");
                    break;
            }
        } elseif ($blob && $this->field_type[$field] == 'image') {
            header("Content-type: image/jpeg");
        } elseif ($blob) {
            header("Content-type: application/octet-stream");
            header("Content-Disposition: attachment; filename=\"" . (isset($settings['filename']) ? $settings['filename'] : 'binary_data') . "\"");
            header("Content-Transfer-Encoding: binary");
        } else {
            if (trim(strtolower(strrchr($path, '.')), '.') == 'pdf') {
                header("Content-type: application/pdf");
                header("Content-Disposition: inline; filename=\"" . (isset($settings['filename']) ? $settings['filename'] : $this->filter_file_name($image)) . "\"");
            } else {
                header("Content-type: application/octet-stream");
                header("Content-Disposition: attachment; filename=\"" . (isset($settings['filename']) ? $settings['filename'] : $this->filter_file_name($image)) . "\"");
            }

            header("Content-Transfer-Encoding: binary");
        }
        if ($blob)
            header("Content-Length: " . strlen($image));
        else
            header("Content-Length: " . filesize($path));
        @ob_clean();
        flush();
        if ($blob) {
            return $image;
        } else {
            readfile($path);
        }
        exit();
    }

    public function filter_file_name($name)
    {
        $pos = strpos($name, '_@XCRUD');
        if ($pos === false) {
            return $name;
        } else if ($pos === 0) {
            return substr($name, 7, strlen($name) - 7);
        } else {
            $ext = substr($name, strrpos($name, '.'), strlen($name) - strrpos($name, '.'));
            return substr($name, 0, $pos) . $ext;
        }
    }

    public function _csv()
    {
        if (! $this->is_csv) {
            return self::error('Restricted');
        }
        $db = Database::get_instance($this->connection, $this->ci);
        $select = $this->_build_select_list(true);
        $table_join = $this->_build_table_join();
        $where = $this->_build_where();
        $order_by = $this->_build_order_by();
        $this->_set_column_names();
        $headers = array();
        foreach ($this->columns as $field => $fitem) {
            if (isset($this->field_type[$field]) && ($this->field_type[$field] == 'password' or $this->field_type[$field] == 'hidden'))
                continue;
            $headers[] = $this->columns_names[$field];
        }
        // print "SELECT {$select} FROM `{$this->table}` {$table_join} {$where} {$order_by}";exit;
        $db->query("SELECT {$select} FROM `{$this->table}` {$table_join} {$where} {$order_by}");
        if ($db->result->num_rows > XcrudConfig::$csv_limit)
            return self::error('A quantidade de registros excede o maximo permitido para esta operacao.');
        ini_set('auto_detect_line_endings', true);
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: public");
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=\"" . $this->_clean_file_name($this->table_name ? $this->table_name : $this->table) . '_' . date('Ymd_His') . ".csv\"");
        header("Content-Transfer-Encoding: binary");
        $output = fopen('php://output', 'w');
        fwrite($output, chr(0xEF) . chr(0xBB) . chr(0xBF)); // bom
        fputcsv($output, $headers, XcrudConfig::$csv_delimiter, XcrudConfig::$csv_enclosure);

        foreach ($db->result() as $row) {
            $out = array();
            foreach ($this->columns as $field => $fitem) {
                if (isset($this->field_type[$field]) && ($this->field_type[$field] == 'password' or $this->field_type[$field] == 'hidden'))
                    continue;
                $out[] = htmlspecialchars_decode(strip_tags($this->_render_export_item($field, $row[$field], $row['primary_key'], $row)), ENT_QUOTES);
            }
            fputcsv($output, $out, XcrudConfig::$csv_delimiter, XcrudConfig::$csv_enclosure);
        }
    }

    /**
     * returns request variable
     */
    protected function _post($field = '', $default = false, $filter = false)
    {
        if (isset($_POST['xcrud'][$field])) {
            if (get_magic_quotes_gpc()) {
                if (is_array($_POST['xcrud'][$field])) {
                    array_walk_recursive($_POST['xcrud'][$field], array(
                        $this,
                        'stripslashes_callback'
                    ));
                } else {
                    $_POST['xcrud'][$field] == stripslashes($_POST['xcrud'][$field]);
                }
            }
            if (XcrudConfig::$auto_xss_filtering) {
                $xss = $this->load_core_class('xss');
            } else {
                $xss = false;
            }
            if (($field == 'postdata' or $field == 'unique') && $_POST['xcrud'][$field]) {
                $data_keys = array_keys($_POST['xcrud'][$field]);
                foreach ($data_keys as $k => $key) {
                    $data_keys[$k] = $xss ? $xss->xss_clean($this->fieldname_decode($key)) : $this->fieldname_decode($key);
                    if ($xss) {
                        $_POST['xcrud'][$field][$key] = $xss->xss_clean($_POST['xcrud'][$field][$key]);
                    }
                }
                return array_combine($data_keys, $_POST['xcrud'][$field]);
            } elseif ($filter) {
                switch ($filter) {
                    case 'key':
                        return str_replace('`', '', $xss ? $xss->xss_clean($_POST['xcrud'][$field]) : $_POST['xcrud'][$field]);
                        break;
                    case 'int':
                        return (int) $_POST['xcrud'][$field];
                        break;
                    case 'trim':
                        return trim($xss ? $xss->xss_clean($_POST['xcrud'][$field]) : $_POST['xcrud'][$field]);
                        break;
                    case 'base64':
                        return $xss ? $xss->xss_clean($this->fieldname_decode($_POST['xcrud'][$field])) : $this->fieldname_decode($_POST['xcrud'][$field]);
                        break;
                    default:
                        return $xss ? $xss->xss_clean($_POST['xcrud'][$field]) : $_POST['xcrud'][$field];
                        break;
                }
            } else {
                return $xss ? $xss->xss_clean($_POST['xcrud'][$field]) : $_POST['xcrud'][$field];
            }
        } else
            return $default;
    }

    protected function _get($field = '', $default = false, $filter = false)
    {
        if (isset($_GET['xcrud'][$field])) {
            if (get_magic_quotes_gpc()) {
                if (is_array($_GET['xcrud'][$field])) {
                    array_walk_recursive($_GET['xcrud'][$field], array(
                        $this,
                        'stripslashes_callback'
                    ));
                } else {
                    $_GET['xcrud'][$field] == stripslashes($_GET['xcrud'][$field]);
                }
            }
            if (XcrudConfig::$auto_xss_filtering) {
                $xss = $this->load_core_class('xss');
            } else {
                $xss = false;
            }
            if ($filter) {
                switch ($filter) {
                    case 'key':
                        return str_replace('`', '', $xss ? $xss->xss_clean($_GET['xcrud'][$field]) : $_GET['xcrud'][$field]);
                        break;
                    case 'int':
                        return (int) $_GET['xcrud'][$field];
                        break;
                    case 'trim':
                        return trim($xss ? $xss->xss_clean($_GET['xcrud'][$field]) : $_GET['xcrud'][$field]);
                        break;
                    default:
                        return $xss ? $xss->xss_clean($_GET['xcrud'][$field]) : $_GET['xcrud'][$field];
                        break;
                }
            } else {
                return $xss ? $xss->xss_clean($_GET['xcrud'][$field]) : $_GET['xcrud'][$field];
            }
        } else
            return $default;
    }

    protected function stripslashes_callback(&$item, $key)
    {
        $item = stripslashes($item);
    }

    /**
     * creates fieldlist for adding record
     */
    protected function _create($postdata = array())
    {
        if (! $this->is_create || $this->table_ro)
            return self::error('Forbidden');

        $this->primary_val = null;
        $this->result_row = array_merge($this->defaults, $postdata);

        if ($this->before_create) {
            $path = $this->check_file($this->before_create['path'], 'before_create');
            include_once ($path);
            if (is_callable($this->before_create['callable'])) {
                $postdata = new Xcrud_postdata($this->result_row, $this);
                call_user_func_array($this->before_create['callable'], array(
                    $postdata,
                    $this
                ));
                $this->result_row = $postdata->to_array();
            }
        }

        $this->_set_field_names();

        /**
         * conditions process
         */
        if ($this->condition) {
            foreach ($this->condition as $params) {
                if (! isset($params['mode']['create']))
                    continue;

                $params['value'] = $this->replace_text_variables($params['value'], $this->result_row);
                if (array_key_exists($params['field'], $this->result_row) && $this->_compare($this->result_row[$params['field']], $params['operator'], $params['value'])) {
                    if (is_array($params['method']) && is_callable($params['method'])) {
                        call_user_func_array($params['method'], $params['params']);
                    } elseif (is_callable(array(
                        $this,
                        $params['method']
                    ))) {
                        $this->condition_backup($params['method']);
                        call_user_func_array(array(
                            $this,
                            $params['method']
                        ), $params['params']);
                    } elseif (is_callable($params['method'])) {
                        call_user_func_array($params['method'], $params['params']);
                    }
                }
            }
        }

        return $this->_render_details($this->task);
    }

    /**
     *
     * @author Ariel Canal
     *         EXECUTA A PRIMEIRA TAREFA ALTERNATIVA SE A PRIM�RIA ESTIVER
     *         BLOQUEADA
     *         compatibilizada com reports
     */
    /**
     * creates fieldlist for editing or viewing record
     */
    protected function _entry($mode = 'edit', $postdata = array())
    {
        $this->where_pri($this->primary_key, $this->primary_val);
        $select = $this->_build_select_details($mode);
        $where = $this->_build_where();
        $table_join = $this->_build_table_join();
        $db = Database::get_instance($this->connection, $this->ci);
        $db->query("SELECT {$select}\r\n FROM `{$this->table}`\r\n {$table_join}\r\n {$where}\r\n LIMIT 1");
        $this->result_row = array_merge((array) $db->row(), $postdata);

        // moved here to support conditions for buttons
        if (((! $this->is_edit($this->result_row) || $this->table_ro) && $mode == 'edit') or (! $this->is_view($this->result_row) && $mode == 'view'))
            if ($this->grid_restrictions[$mode][0]['alt']) {
                $this->task = $this->grid_restrictions[$mode][0]['alt'];
                return $this->_run_task();
            } else {
                return self::error('Forbidden');
            }

        $callback_method = 'before_' . $mode;
        if ($mode != "report" && $this->{$callback_method}) {
            $path = $this->check_file($this->{$callback_method}['path'], $callback_method);
            include_once ($path);
            if (is_callable($this->{$callback_method}['callable'])) {
                $postdata = new Xcrud_postdata($this->result_row, $this);
                call_user_func_array($this->{$callback_method}['callable'], array(
                    $postdata,
                    $this->primary_val,
                    $this
                ));
                $this->result_row = $postdata->to_array();
            }
        }

        $this->_set_field_names();

        /**
         * conditions process
         */
        if ($this->condition) {
            foreach ($this->condition as $params) {
                if (! isset($params['mode'][$mode]))
                    continue;

                $params['value'] = $this->replace_text_variables($params['value'], $this->result_row);
                if (isset($this->result_row[$params['field']]) && $this->_compare($this->result_row[$params['field']], $params['operator'], $params['value'])) {
                    if (is_array($params['method']) && is_callable($params['method'])) {
                        call_user_func_array($params['method'], $params['params']);
                    } elseif (is_callable(array(
                        $this,
                        $params['method']
                    ))) {
                        $this->condition_backup($params['method']);
                        call_user_func_array(array(
                            $this,
                            $params['method']
                        ), $params['params']);
                    } elseif (is_callable($params['method'])) {
                        call_user_func_array($params['method'], $params['params']);
                    }
                }
            }
        }
        /**
         * hidden fields pass_var_process *
         */
        if ($mode == 'edit' && isset($this->pass_var['edit'])) {
            $data = array();
            foreach ($this->result_row as $key => $val) {
                if (! isset($this->fields[$key])) {

                    foreach ($this->pass_var['edit'] as $pkey => $param) {
                        $data[$key] = $val;
                    }
                }
            }
            if ($data)
                $this->pass_var['edit'][$pkey]['tmp_value'] = $this->replace_text_variables($param['value'], $data);
        }

        return $this->_render_details($mode);
    }

    protected function prepare_query_field($val, $key, $action, $no_processing = false)
    {
        $db = Database::get_instance($this->connection, $this->ci);
        if ($no_processing) {
            if (isset($this->no_quotes[$key]) && isset($this->pass_var[$action][$key])) {
                return $db->escape($val, true);
            } else {
                return $db->escape($val, false, $this->field_type[$key], $this->field_null[$key], isset($this->bit_field[$key]));
            }
        } else {
            if (is_array($val)) {
                return $db->escape(implode(',', $val), false, $this->field_type[$key], $this->field_null[$key], isset($this->bit_field[$key]));
            } elseif (isset($this->point_field[$key])) {
                return 'Point(' . $db->escape($val, true, 'point', $this->field_null[$key], isset($this->bit_field[$key])) . ')';
            } elseif (isset($this->int_field[$key])) {
                return $db->escape($val, false, 'int', $this->field_null[$key], isset($this->bit_field[$key]));
            } elseif (isset($this->float_field[$key]) && $this->field_type[$key] == 'price') {
                $val = str_replace($this->field_attr[$key]['prefix'], '', $val);
                $val = str_replace($this->field_attr[$key]['suffix'], '', $val);
                $val = str_replace($this->field_attr[$key]['separator'], '', $val);
                $val = str_replace($this->field_attr[$key]['point'], '.', $val);
                return $db->escape($val, false, 'float', $this->field_null[$key], isset($this->bit_field[$key]));
            } elseif (isset($this->no_quotes[$key]) && isset($this->pass_var[$action][$key])) {
                return $db->escape($val, true);
            } else {
                return $db->escape($val, false, $this->field_type[$key], $this->field_null[$key], isset($this->bit_field[$key]));
            }
        }
    }

    /**
     *
     * @author Ariel Canal
     *         Se um campo est� 'disabled' ou 'readonly', a fun��o ignora ele
     *         ao montar a SQL, mesmo que
     *         haja um pass_var[create] para este campo.
     *         CORRE��O: a fun��o s� ignorar� o campo, se n�o houver
     *         pass_var[create] nele.
     *        
     *         Corrigido a inserção do fk_relation quando há o atributo add_data e mais de um campo para a mesma tabela
     */
    /**
     * main insert constructor
     */
    protected function _insert($postdata, $no_processing = false, $no_processing_fields = array())
    {
        if (! $postdata) {
            self::error('$postdata array is empty');
        }
        $set = array();
        $db = Database::get_instance($this->connection, $this->ci);
        $fields = array_merge($this->fields, $this->hidden_fields);
        $fk_queries = array();
        foreach ($postdata as $key => $val) {
            if (isset($fields[$key]) && ! isset($this->locked_fields[$key]) && ! isset($this->custom_fields[$key]) && ((! isset($this->disabled[$key]['create']) && ! isset($this->readonly[$key]['create'])) || isset($this->pass_var['create'][$key]))) {
                if (isset($this->field_type[$key])) {
                    switch ($this->field_type[$key]) {
                        case 'password':
                            if (trim($val) == '') {
                                continue 2;
                            } elseif ($this->defaults[$key]) {
                                $val = hash($this->defaults[$key], $val);
                            }
                            break;
                        case 'fk_relation': //
                            continue 2;
                            break;
                    }
                }

                $set[$fields[$key]['table']]['`' . $fields[$key]['field'] . '`'] = $this->prepare_query_field($val, $key, 'create');

                /*
                 * if (is_array($val))
                 * {
                 * $set[$fields[$key]['table']]['`' . $fields[$key]['field'] .
                 * '`'] = $db->escape(implode(',', $val), false, $this->
                 * field_type[$key], $this->field_null[$key],
                 * isset($this->bit_field[$key]));
                 * }
                 * elseif (isset($this->point_field[$key]))
                 * {
                 * $set[$fields[$key]['table']]['`' . $fields[$key]['field'] .
                 * '`'] = 'Point(' . $db->escape($val, true, 'point', $this->
                 * field_null[$key], isset($this->bit_field[$key])) . ')';
                 * }
                 * elseif (isset($this->float_field[$key]))
                 * {
                 * }
                 * elseif (isset($this->float_field[$key]))
                 * {
                 * }
                 * else
                 * $set[$fields[$key]['table']]['`' . $fields[$key]['field'] .
                 * '`'] = ((isset($this->no_quotes[$key]) && isset($this->
                 * pass_var['create'][$key])) ? $db->escape($val, true) :
                 * $db->escape($val, false, $this->field_type[$key], $this->
                 * field_null[$key], isset($this->bit_field[$key])));
                 */
            } elseif ($no_processing) {
                /*
                 * $set[$no_processing_fields[$key]['table']]['`' .
                 * $no_processing_fields[$key]['field'] . '`'] =
                 * ((isset($this->no_quotes[$key]) &&
                 * isset($this->pass_var['create'][$key])) ? $db->escape($val,
                 * true) : $db->escape($val, false, $this->field_type[$key],
                 * $this->
                 * field_null[$key], isset($this->bit_field[$key])));
                 */
                $set[$no_processing_fields[$key]['table']]['`' . $no_processing_fields[$key]['field'] . '`'] = $this->prepare_query_field($val, $key, 'create', true);
            }
        }
        // $keys = array_keys($set[$this->table]);
        if (! $set) {
            self::error('Nothing to insert');
        }
        if (! $this->primary_ai && ! isset($postdata[$this->table . '.' . $this->primary_key])) {
            self::error('Can\'t insert a row. No primary value.');
        }
        if (! $this->demo_mode)
            $db->query('INSERT INTO `' . $this->table . '` (' . implode(',', array_keys($set[$this->table])) . ') VALUES (' . implode(',', $set[$this->table]) . ')');
        if ($this->primary_ai) {
            $ins_id = $db->insert_id();
            $set[$this->table]['`' . $this->primary_key . '`'] = $ins_id;
            $postdata[$this->table . '.' . $this->primary_key] = $ins_id;
        } else {
            $ins_id = $postdata[$this->table . '.' . $this->primary_key];
        }
        if ($this->join) {
            foreach ($this->join as $alias => $param) {
                @$set[$alias]['`' . $param['join_field'] . '`'] = $set[$param['table']]['`' . $param['field'] . '`'];
                if (! $this->demo_mode && ! $param['not_insert']) {
                    $db->query("INSERT INTO `{$param['join_table']}` (" . implode(',', array_keys($set[$alias])) . ") VALUES (" . implode(',', $set[$alias]) . ")");
                }
            }
        }

        if ($this->fk_relation) {
            foreach ($this->fk_relation as $fk) {
                $field = $fk['table'] . '.' . $fk['field'];
                if (array_key_exists($fk['alias'], $postdata) && array_key_exists($field, $postdata)) {
                    $in_val = $db->escape($postdata[$field], false, $this->field_type[$field], $this->field_null[$field], isset($this->bit_field[$field]));
                    unset($where_q);
                    if (count($fk['add_data'])) {
                        foreach ($fk['add_data'] as $k => $v) {
                            $where_q[] = "`" . $k . "` = '" . $v . "'";
                        }
                        $where_q = " AND (" . implode(' AND ', $where_q) . ")";
                    } else {
                        $where_q = '';
                    }
                    $db->query('DELETE FROM `' . $fk['fk_table'] . '` WHERE `' . $fk['in_fk_field'] . '` = ' . $in_val . ' ' . $where_q);
                    $fkids = $this->parse_comma_separated($postdata[$fk['alias']]);
                    if ($fkids) {
                        $ins_vals = array();
                        $ins_keys = array();
                        $ins_add = array();
                        if ($fk['add_data']) {
                            foreach ($fk['add_data'] as $add_key => $add_val) {
                                $ins_keys[] = '`' . $add_key . '`';
                                $ins_add[] = $db->escape($add_val);
                            }
                        }
                        $ins_add[] = /*$db->escape(*/ $in_val /*)*/;
                        $ins_keys[] = '`' . $fk['in_fk_field'] . '`';
                        $ins_keys[] = '`' . $fk['out_fk_field'] . '`';
                        foreach ($fkids as $fkid) {
                            $ins_vals[] = '(' . implode(',', $ins_add) . ',' . $db->escape($fkid) . ')';
                        }
                        $db->query('INSERT INTO `' . $fk['fk_table'] . '` (' . implode(',', $ins_keys) . ') VALUES ' . implode(',', $ins_vals));
                    }
                }
            }
        }

        unset($set, $postdata);
        return $ins_id;
    }

    protected function make_fk_remove($rel, $primary)
    {
        $db = Database::get_instance($this->connection, $this->ci);
    }

    protected function make_fk_insert($rel, $val, $primary)
    {
        $db = Database::get_instance($this->connection, $this->ci);
    }

    /**
     *
     * @author Ariel Canal
     *         Se um campo est� 'disabled' ou 'readonly', a fun��o ignora ele
     *         ao montar a SQL, mesmo que
     *         haja um pass_var[create] para este campo.
     *         CORRE��O: a fun��o s� ignorar� o campo, se n�o houver
     *         pass_var[create] nele.
     *        
     *         Compatibilizado com join_relation
     *         main update constructor
     */
    protected function _update($postdata, $primary)
    {
        if (! $postdata) {
            self::error('$postdata array is empty');
        }
        $res = false;
        $set = array();
        $db = Database::get_instance($this->connection, $this->ci);
        $fields = array_merge($this->fields, $this->hidden_fields);
        foreach ($postdata as $key => $val) {
            if (isset($fields[$key]) && ! isset($this->locked_fields[$key]) && ! isset($this->custom_fields[$key]) && ((! isset($this->disabled[$key]['edit']) && ! isset($this->readonly[$key]['edit'])) || isset($this->pass_var['edit'][$key]))) {
                if (isset($this->field_type[$key])) {
                    switch ($this->field_type[$key]) {
                        case 'password':
                            if (trim($val) == '') {
                                continue 2;
                            } elseif ($this->defaults[$key]) {
                                $val = hash($this->defaults[$key], $val);
                            }
                            break;
                        case 'fk_relation': //
                            continue 2;
                            break;
                    }
                }
                /*
                 * if (is_array($val))
                 * {
                 * $set[] = '`' . $fields[$key]['table'] . '`.`' .
                 * $fields[$key]['field'] . '` = ' . $db->escape(implode(',',
                 * $val), false,
                 * $this->field_type[$key], $this->field_null[$key],
                 * isset($this->bit_field[$key]));
                 * }
                 * elseif (isset($this->point_field[$key]) && trim($val))
                 * {
                 * $set[] = '`' . $fields[$key]['table'] . '`.`' .
                 * $fields[$key]['field'] . '` = Point(' . $db->escape($val,
                 * true, 'point',
                 * $this->field_null[$key], isset($this->bit_field[$key])) .
                 * ')';
                 * }
                 * else
                 * $set[] = '`' . $fields[$key]['table'] . '`.`' .
                 * $fields[$key]['field'] . '` = ' .
                 * ((isset($this->no_quotes[$key]) &&
                 * isset($this->pass_var['edit'][$key])) ? $db->escape($val,
                 * true) : $db->escape(trim($val), false,
                 * $this->field_type[$key],
                 * $this->field_null[$key], isset($this->bit_field[$key])));
                 */
                $set[] = '`' . $fields[$key]['table'] . '`.`' . $fields[$key]['field'] . '` = ' . $this->prepare_query_field($val, $key, 'edit');
            }
        }
        if (! $set) {
            self::error('Nothing to update');
        }
        $this->apply_record_changes($set);
        if (! $this->join && ! $this->join_relation) {
            if (! $this->demo_mode)
                $res = $db->query("UPDATE `{$this->table}` SET " . implode(",\r\n", $set) . " WHERE `{$this->primary_key}` = " . $db->escape($primary) . " LIMIT 1");
        } else {
            // $tables = array('`' . $this->table . '`');
            $joins = array();
            foreach ($this->join as $alias => $param) {
                // $tables[] = '`' . $alias . '`';
                $joins[] = "INNER JOIN `{$param['join_table']}` AS `{$alias}`
                    ON `{$param['table']}`.`{$param['field']}` = `{$alias}`.`{$param['join_field']}` " . $param['additional_cond'];
            }
            if (count($this->join_relation)) {
                foreach ($this->join_relation as $field => $params) {
                    if (isset($this->relation[$field])) {
                        $r_params = $this->relation[$field];
                        $joins[] = "INNER JOIN `{$r_params['rel_tbl']}` AS `{$r_params['rel_tbl']}`
						ON $field = `{$r_params['rel_tbl']}`.`{$r_params['rel_field']}` ";
                    }
                }
            }
            if (! $this->demo_mode)
                $res = $db->query("UPDATE `{$this->table}` AS `{$this->table}` " . implode(' ', $joins) . " SET " . implode(",\r\n", $set) . " WHERE `{$this->table}`.`{$this->primary_key}` = " . $db->escape($primary));
        }
        if (isset($postdata[$this->table . '.' . $this->primary_key]) && $res)
            $primary = $postdata[$this->table . '.' . $this->primary_key];
        else {
            $postdata[$this->table . '.' . $this->primary_key] = $primary;
        }

        if ($this->fk_relation) {
            foreach ($this->fk_relation as $fk) {
                $field = $fk['table'] . '.' . $fk['field'];
                if (array_key_exists($fk['alias'], $postdata) && array_key_exists($field, $postdata)) {
                    $in_val = $db->escape($postdata[$field], false, $this->field_type[$field], $this->field_null[$field], isset($this->bit_field[$field]));
                    $db->query('DELETE FROM `' . $fk['fk_table'] . '` WHERE `' . $fk['in_fk_field'] . '` = ' . $in_val . ' AND ' . $this->_build_rel_ins_where($fk['alias']));
                    $fkids = $this->parse_comma_separated($postdata[$fk['alias']]);
                    if ($fkids) {
                        $ins_vals = array();
                        $ins_keys = array();
                        $ins_add = array();
                        if ($fk['add_data']) {
                            foreach ($fk['add_data'] as $add_key => $add_val) {
                                $ins_keys[] = '`' . $add_key . '`';
                                $ins_add[] = $db->escape($add_val);
                            }
                        }
                        $ins_add[] = /*$db->escape(*/ $in_val /*)*/;
                        $ins_keys[] = '`' . $fk['in_fk_field'] . '`';
                        $ins_keys[] = '`' . $fk['out_fk_field'] . '`';
                        foreach ($fkids as $fkid) {
                            $ins_vals[] = '(' . implode(',', $ins_add) . ',' . $db->escape($fkid) . ')';
                        }
                        $db->query('INSERT INTO `' . $fk['fk_table'] . '` (' . implode(',', $ins_keys) . ') VALUES ' . implode(',', $ins_vals));
                    }
                }
            }
        }

        unset($set, $postdata);
        return $primary;
    }

    /**
     * main delete
     */
    protected function _remove()
    {
        $del = false;
        if ($this->table_ro)
            return self::error('Forbidden');
        if ($this->before_remove) {
            $path = $this->check_file($this->before_remove['path'], 'before_remove');
            include_once ($path);
            if (is_callable($this->before_remove['callable'])) {
                call_user_func_array($this->before_remove['callable'], array(
                    $this->primary_val,
                    $this
                ));
                if ($this->exception) {
                    $this->task = 'list';
                    $this->primary_val = null;
                    return false;
                }
            }
        }
        if ($this->replace_remove) {
            $path = $this->check_file($this->replace_remove['path'], 'replace_remove');
            include_once ($path);
            if (is_callable($this->replace_remove['callable'])) {
                $this->primary_val = call_user_func_array($this->replace_remove['callable'], array(
                    $this->primary_val,
                    $this
                ));
            }
        } else {
            // remove case
            $db = Database::get_instance($this->connection, $this->ci);
            $del_row = array();
            $del = false;
            $fields = array();
            $this->find_details_text_variables();
            if ($this->direct_select_tags) // tags for unset condition
            {
                foreach ($this->direct_select_tags as $key => $dsf) {
                    if (! $dsf['table'] == $this->table || (isset($this->join[$dsf['table']]) && $this->join[$dsf['table']]['not_insert'] != true)) {
                        $fields[$key] = "`{$dsf['table']}`.`{$dsf['field']}` AS `{$key}`";
                    }
                }
            }
            if (in_array('image', $this->field_type) or in_array('file', $this->field_type) or in_array('fk_relation', $this->field_type)) // images
                                                                                                                                            // &&
                                                                                                                                            // fk
            {
                foreach ($this->field_type as $key => $type) {
                    switch ($type) {
                        case 'image':
                        case 'file':
                            $tmp = explode('.', $key);
                            $fields[$key] = '`' . $tmp[0] . '`.`' . $tmp[1] . '` AS `' . $key . '`';
                            break;
                        case 'fk_relation':
                            $fields[$this->fk_relation[$key]['table'] . '.' . $this->fk_relation[$key]['field']] = '`' . $this->fk_relation[$key]['table'] . '`.`' . $this->fk_relation[$key]['field'] . '` AS `' . $this->fk_relation[$key]['table'] . '.' . $this->fk_relation[$key]['field'] . '`';
                            break;
                    }
                    if ($type == 'image' or $type == 'file') {
                        $tmp = explode('.', $key);
                        $fields[$key] = "`{$tmp[0]}`.`{$tmp[1]}` AS `{$key}`";
                    }
                }
            }
            if (! $this->join) {
                if ($fields) {
                    $db->query('SELECT ' . implode(',', $fields) . " FROM `{$this->table}` WHERE `{$this->primary_key}` = " . $db->escape($this->primary_val) . ' LIMIT 1');
                    $del_row = $db->row();
                }
                if (! $this->is_remove($del_row)) {
                    return self::error('Forbidden');
                }
                if (! $this->demo_mode) {
                    $del = $db->query("DELETE FROM `{$this->table}` WHERE `{$this->primary_key}` = " . $db->escape($this->primary_val) . " LIMIT 1");
                }
            } else {
                $tables = array(
                    '`' . $this->table . '`'
                );
                $joins = array();
                foreach ($this->join as $alias => $param) {
                    if (! $param['not_insert']) {
                        $tables[] = '`' . $alias . '`';
                        $joins[] = "INNER JOIN `{$param['join_table']}` AS `{$alias}`ON `{$param['table']}`.`{$param['field']}` = `{$alias}`.`{$param['join_field']}` " . $param['additional_cond'];
                    }
                }
                if ($fields) {
                    $db->query('SELECT ' . implode(',', $fields) . " FROM `{$this->table}` AS `{$this->table}` " . implode(' ', $joins) . " WHERE `{$this->table}`.`{$this->primary_key}` = " . $db->escape($this->primary_val));
                    $del_row = $db->row();
                }
                if (! $this->is_remove($del_row)) {
                    return self::error('Forbidden');
                }
                if (! $this->demo_mode)
                    $del = $db->query("DELETE " . implode(',', $tables) . " FROM `{$this->table}` AS `{$this->table}` " . implode(' ', $joins) . " WHERE `{$this->table}`.`{$this->primary_key}` = " . $db->escape($this->primary_val));
            }
            if ($del_row && ! $this->demo_mode) {
                foreach ($del_row as $key => $val) {
                    if ($val && isset($this->upload_config[$key]) && ! isset($this->upload_config[$key]['blob'])) {
                        $this->remove_file($val, $key);
                    }
                }
            }
            if ($this->fk_relation) // removing FK relations
            {
                foreach ($this->fk_relation as $fk) {
                    $field = $fk['table'] . '.' . $fk['field'];
                    if (array_key_exists($field, $del_row)) {
                        $in_val = $db->escape($del_row[$field], false, $this->field_type[$field], $this->field_null[$field], isset($this->bit_field[$field]));
                        $db->query('DELETE FROM `' . $fk['fk_table'] . '` WHERE `' . $fk['in_fk_field'] . '` = ' . $in_val);
                    }
                }
            }
            // end of remove case
        }
        if ($this->after_remove) {
            $path = $this->check_file($this->after_remove['path'], 'after_remove');
            include_once ($path);
            if (is_callable($this->after_remove['callable'])) {
                call_user_func_array($this->after_remove['callable'], array(
                    $this->primary_val,
                    $this
                ));
            }
        }
        $this->task = 'list';
        $this->primary_val = null;
        return $del;
    }

    /*
     * @author Ariel Canal
     * Compatibilização com a funcionalidade auto_insert para join_relations
     */
    protected function check_postdata($postdata, $primary)
    {
        $mode = $primary ? 'edit' : 'create';
        foreach ($postdata as $key => $val) {
            if (isset($this->disabled[$key][$mode]) && ! isset($this->readonly[$key][$mode])) {
                unset($postdata[$key]);
                continue;
            }
            if (isset($this->field_type[$key])) {
                switch ($this->field_type[$key]) {
                    case 'password':
                        if (trim($val) == '') {
                            unset($postdata[$key]);
                        }
                        break;
                    case 'datetime':
                        if ($val !== '') {
                            if (preg_match('/^\-{0,1}[0-9]+$/u', $val)) {
                                $postdata[$key] = gmdate('Y-m-d H:i:s', $val);
                            }
                            $postdata[$key] = $this->br2mysqldate($val);
                        } else {
                            if ($this->field_null[$key]) {
                                $postdata[$key] = null;
                            } else {
                                $postdata[$key] = '0000-00-00 00:00:00';
                            }
                        }
                        break;
                    case 'date':
                        if ($val !== '') {
                            if (preg_match('/^\-{0,1}[0-9]+$/u', $val)) {
                                $postdata[$key] = gmdate('Y-m-d', $val);
                            }
                            $postdata[$key] = $this->br2mysqldate($val);
                        } else {
                            if ($this->field_null[$key]) {
                                $postdata[$key] = null;
                            } else {
                                $postdata[$key] = '0000-00-00';
                            }
                        }
                        break;
                    case 'time':
                        if ($val !== '') {
                            if (preg_match('/^\-{0,1}[0-9]+$/u', $val)) {
                                $postdata[$key] = gmdate('H:i:s', $val);
                            }
                        } else {
                            if ($this->field_null[$key]) {
                                $postdata[$key] = null;
                            } else {
                                $postdata[$key] = '00:00:00';
                            }
                        }
                        break;
                }
            }
        }
        $postdata = $this->join_relation_tag($postdata);
        return $postdata;
    }

    /**
     * save events switcher
     */
    /**
     * FUN��O ALTERADA DO PADR�O
     *
     * @author Ariel Canal
     *         Fun��o make_upload_process() � chamada tamb�m durante a
     *         atualiza��o das informa��o, e n�o s� na inser��o.
     */
    protected function _save()
    {
        $postdata = $this->_post('postdata');
        if (! $postdata) {
            self::error('No data to save!');
        }

        $postdata = $this->check_postdata($postdata, $this->primary_val);

        if ($this->inner_value !== false) // is nested
        {
            $field = reset($this->inner_where);
            if (! isset($postdata[$field])) // nested table connection field MUST
                                             // be
                                             // defined
            {
                $fdata = $this->_parse_field_names($field, 'build_select_details');
                $this->hidden_fields = array_merge($this->hidden_fields, $fdata);
                // $this->hidden_fields[$field] = $fdata[0];
                $postdata[$field] = $this->inner_value;
            }
        }
        $this->validate_postdata($postdata);
        if ($this->exception) {
            return $this->call_exception($postdata);
        }
        if (! $this->primary_val) {
            if (! $this->is_create || $this->table_ro)
                return self::error('Forbidden');
            if (isset($this->pass_var['create'])) {
                foreach ($this->pass_var['create'] as $field => $param) {
                    if ($param['eval']) {
                        $param['value'] = eval($param['value']);
                    }
                    $postdata[$field] = $this->replace_text_variables($param['value'], $postdata);
                    $this->hidden_fields[$field] = array(
                        'table' => $param['table'],
                        'field' => $param['field']
                    );
                }
            }

            $pd = new Xcrud_postdata($postdata, $this);
            $this->make_upload_process($pd);
            $postdata = $pd->to_array();

            if ($this->alert_create) {
                foreach ($this->alert_create as $alert) {
                    if ($alert['field'] && $pd->get($alert['field']) != $alert['value'])
                        continue;

                    $send_to = $pd->get($alert['column']) ? $pd->get($alert['column']) : $alert['column'];
                    if (! $send_to or ! preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/', $send_to))
                        continue;
                    $alert['message'] = $this->replace_text_variables($alert['message'], $postdata);
                    if (XcrudConfig::$email_enable_html)
                        $message = $alert['message'] . '<br /><br />' . "\r\n" . ($alert['link'] ? '<a href="' . $alert['link'] . '" target="_blank">' . $alert['link'] . '</a>' : '');
                    else
                        $message = $alert['message'] . "\r\n\r\n" . ($alert['link'] ? $alert['link'] : '');
                    $this->send_email($send_to, $alert['subject'], $message, $alert['cc'], XcrudConfig::$email_enable_html);
                }
            }
            if ($this->mass_alert_create) {
                foreach ($this->mass_alert_create as $alert) {
                    if ($alert['field'] && isset($postdata[$alert['field']]) && $postdata[$alert['field']] != $alert['value'])
                        continue;
                    $alert['message'] = $this->replace_text_variables($alert['message'], $postdata);
                    $alert['where'] = $this->replace_text_variables($alert['where'], $postdata);
                    if (XcrudConfig::$email_enable_html)
                        $message = $alert['message'] . '<br /><br />' . "\r\n" . ($alert['link'] ? '<a href="' . $alert['link'] . '" target="_blank">' . $alert['link'] . '</a>' : '');
                    else
                        $message = $alert['message'] . "\r\n\r\n" . ($alert['link'] ? $alert['link'] : '');
                    $db = Database::get_instance($this->connection, $this->ci);
                    $db->query("SELECT `{$alert['email_column']}` FROM `{$alert['email_table']}`" . ($alert['where'] ? ' WHERE ' . $alert['where'] : ''));
                    foreach ($db->result() as $row) {
                        $this->send_email($row[$alert['email_column']], $alert['subject'], $message, array(), XcrudConfig::$email_enable_html);
                    }
                }
            }

            if ($this->before_insert) {
                $path = $this->check_file($this->before_insert['path'], 'before_insert');
                include_once ($path);
                if (is_callable($this->before_insert['callable'])) {
                    call_user_func_array($this->before_insert['callable'], array(
                        $pd,
                        $this
                    ));
                    $postdata = $pd->to_array();
                    if ($this->exception) {
                        return $this->call_exception($postdata);
                    }
                }
            }

            $this->make_upload_process($pd);

            if ($this->replace_insert) {
                $path = $this->check_file($this->replace_insert['path'], 'replace_insert');
                include_once ($path);
                if (is_callable($this->replace_insert['callable'])) {
                    $this->primary_val = call_user_func_array($this->replace_insert['callable'], array(
                        $pd,
                        $this
                    ));
                    $postdata = $pd->to_array();
                    if ($this->exception) {
                        return $this->call_exception($postdata);
                    }
                }
            } else {
                $this->primary_val = $this->_insert($postdata);
            }
            if ($this->after_insert) {
                $path = $this->check_file($this->after_insert['path'], 'after_insert');
                include_once ($path);
                if (is_callable($this->after_insert['callable'])) {
                    call_user_func_array($this->after_insert['callable'], array(
                        $pd,
                        $this->primary_val,
                        $this
                    ));
                    $postdata = $pd->to_array();
                    if ($this->exception) {
                        return $this->call_exception($postdata);
                    }
                }
            }

            $this->make_upload_process($pd);

            if ($this->send_external_create) {
                if (! $this->send_external_create['where_field'] or $postdata[$this->send_external_create['where_field']] == $this->send_external_create['where_val']) {
                    foreach ($this->send_external_create['data'] as $key => $value) {
                        $this->send_external_create['data'][$key] = $this->replace_text_variables($value, $postdata + array(
                            $this->table . '.' . $this->primary_key => $this->primary_val
                        ));
                    }
                    switch ($this->send_external_create['method']) {
                        case 'include':
                            $path = $this->check_file($this->send_external_create['path'], 'send_external_create');
                            ob_start();
                            extract($this->send_external_create['data']);
                            include ($path);
                            ob_end_clean();
                            break;
                        case 'get':
                        case 'post':
                            $this->send_http_request($this->send_external_create['path'], $this->send_external_create['data'], $this->send_external_create['method'], false);
                            break;
                    }
                }
            }
        } else {
            if ($this->table_ro)
                return self::error('Forbidden');
            $fields = array();
            $row = array();
            $this->find_details_text_variables();
            if ($this->direct_select_tags) {
                foreach ($this->direct_select_tags as $key => $dsf) {
                    $fields[$key] = "`{$dsf['table']}`.`{$dsf['field']}` AS `{$key}`";
                }
            }
            if ($fields) {
                $db = Database::get_instance($this->connection, $this->ci);
                if (! $this->join) {
                    $db->query('SELECT ' . implode(',', $fields) . " FROM `{$this->table}` WHERE `{$this->primary_key}` = " . $db->escape($this->primary_val) . " LIMIT 1");
                    $row = $db->row();
                } else {
                    $tables = array(
                        '`' . $this->table . '`'
                    );
                    $joins = array();
                    foreach ($this->join as $alias => $param) {
                        $tables[] = '`' . $alias . '`';
                        $joins[] = "INNER JOIN `{$param['join_table']}` AS `{$alias}`
                    ON `{$param['table']}`.`{$param['field']}` = `{$alias}`.`{$param['join_field']}` " . $param['additional_cond'];
                    }
                    $db->query('SELECT ' . implode(',', $fields) . " FROM `{$this->table}` AS `{$this->table}` " . implode(' ', $joins) . " WHERE `{$this->table}`.`{$this->primary_key}` = " . $db->escape($this->primary_val));
                    $row = $db->row();
                }
            }

            if (! $this->is_edit($row))
                return self::error('Forbidden');

            if (isset($this->pass_var['edit'])) {
                foreach ($this->pass_var['edit'] as $field => $param) {
                    if (isset($param['tmp_value'])) {
                        $param['value'] = $param['tmp_value'];
                        unset($this->pass_var['edit'][$field]['tmp_value']);
                    }
                    if ($param['eval']) {
                        $param['value'] = eval($param['value']);
                    }
                    $postdata[$field] = $this->replace_text_variables($param['value'], $postdata);
                    $postdata[$field] = $this->replace_text_variables($param['value'], $row);
                    $this->hidden_fields[$field] = array(
                        'table' => $param['table'],
                        'field' => $param['field']
                    );
                }
            }

            $pd = new Xcrud_postdata($postdata, $this);
            $this->make_upload_process($pd);
            $postdata = $pd->to_array();

            if ($this->alert_edit) {
                foreach ($this->alert_edit as $alert) {
                    if ($alert['field'] && $pd->get($alert['field']) != $alert['value'])
                        continue;
                    $send_to = $pd->get($alert['column']) ? $pd->get($alert['column']) : $alert['column'];
                    if (! $send_to or ! preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/', $send_to))
                        continue;
                    $alert['message'] = $this->replace_text_variables($alert['message'], $postdata);
                    if (XcrudConfig::$email_enable_html)
                        $message = $alert['message'] . '<br /><br />' . "\r\n" . ($alert['link'] ? '<a href="' . $alert['link'] . '" target="_blank">' . $alert['link'] . '</a>' : '');
                    else
                        $message = $alert['message'] . "\r\n\r\n" . ($alert['link'] ? $alert['link'] : '');
                    $this->send_email($send_to, $alert['subject'], $message, $alert['cc'], XcrudConfig::$email_enable_html);
                }
            }
            if ($this->mass_alert_edit) {
                foreach ($this->mass_alert_edit as $alert) {
                    if ($alert['field'] && isset($postdata[$alert['field']]) && $postdata[$alert['field']] != $alert['value'])
                        continue;
                    $alert['message'] = $this->replace_text_variables($alert['message'], $postdata);
                    $alert['where'] = $this->replace_text_variables($alert['where'], $postdata);
                    if (XcrudConfig::$email_enable_html)
                        $message = $alert['message'] . '<br /><br />' . "\r\n" . ($alert['link'] ? '<a href="' . $alert['link'] . '" target="_blank">' . $alert['link'] . '</a>' : '');
                    else
                        $message = $alert['message'] . "\r\n\r\n" . ($alert['link'] ? $alert['link'] : '');
                    $db = Database::get_instance($this->connection, $this->ci);
                    $db->query("SELECT `{$alert['email_column']}` FROM `{$alert['email_table']}`" . ($alert['where'] ? ' WHERE ' . $alert['where'] : ''));
                    foreach ($db->result() as $row) {
                        $this->send_email($row[$alert['email_column']], $alert['subject'], $message, array(), XcrudConfig::$email_enable_html);
                    }
                }
            }

            if ($this->before_update) {
                $path = $this->check_file($this->before_update['path'], 'before_update');
                include_once ($path);
                if (is_callable($this->before_update['callable'])) {
                    call_user_func_array($this->before_update['callable'], array(
                        $pd,
                        $this->primary_val,
                        $this
                    ));
                    $postdata = $pd->to_array();

                    if ($this->exception) {
                        return $this->call_exception($postdata);
                    }
                }
            }
            if ($this->replace_update) {
                $path = $this->check_file($this->replace_update['path'], 'replace_update');
                include_once ($path);
                if (is_callable($this->replace_update['callable'])) {
                    $this->primary_val = call_user_func_array($this->replace_update['callable'], array(
                        $pd,
                        $this->primary_val,
                        $this
                    ));
                    $postdata = $pd->to_array();
                    if ($this->exception) {
                        return $this->call_exception($postdata);
                    }
                }
            } else
                $this->primary_val = $this->_update($postdata, $this->primary_val);
            if ($this->after_update) {
                $path = $this->check_file($this->after_update['path'], 'after_update');
                include_once ($path);
                if (is_callable($this->after_update['callable'])) {
                    call_user_func_array($this->after_update['callable'], array(
                        $pd,
                        $this->primary_val,
                        $this
                    ));
                    $postdata = $pd->to_array();
                    if ($this->exception) {
                        return $this->call_exception($postdata);
                    }
                }
            }
            if ($this->send_external_edit) {
                if (! $this->send_external_edit['where_field'] or $postdata[$this->send_external_edit['where_field']] == $this->send_external_edit['where_val']) {
                    foreach ($this->send_external_edit['data'] as $key => $value) {
                        $this->send_external_edit['data'][$key] = $this->replace_text_variables($value, $postdata);
                    }
                    switch ($this->send_external_edit['method']) {
                        case 'include':
                            $path = $this->check_file($this->send_external_edit['path'], 'send_external_edit');
                            ob_start();
                            extract($this->send_external_edit['data']);
                            include ($path);
                            ob_end_clean();
                            break;
                        case 'get':
                        case 'post':
                            $this->send_http_request($this->send_external_edit['path'], $this->send_external_edit['data'], $this->send_external_edit['method'], false);
                            break;
                    }
                }
            }
        }
        unset($postdata);
        $this->previous_task = $this->task;
        $this->task = $this->after;
        $this->after = null;
        return $this->_run_task();
    }

    protected function validate_postdata($postdata)
    {
        foreach ($postdata as $key => $val) {
            if (isset($this->validation_required[$key]) && mb_strlen($val) < $this->validation_required[$key]) {
                $this->set_exception_fields($key, 'validation_error');
            } elseif (isset($this->validation_pattern[$key]) && mb_strlen($val) > 0) {
                switch ($this->validation_pattern[$key]) {
                    case 'email':
                        $reg = '/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/u';
                        break;
                    case 'alpha':
                        $reg = '/^([a-z])+$/ui';
                        break;
                    case 'alpha_numeric':
                        $reg = '/^([a-z0-9])+$/ui';
                        break;
                    case 'alpha_dash':
                        $reg = '/^([-a-z0-9_-])+$/ui';
                        break;
                    case 'numeric':
                        $reg = '/^[\-+]?[0-9]*\.?[0-9]+$/u';
                        break;
                    case 'integer':
                        $reg = '/^[\-+]?[0-9]+$/u';
                        break;
                    case 'decimal':
                        $reg = '/^[\-+]?[0-9]+\.[0-9]+$/u';
                        break;
                    case 'point':
                        $reg = '/^[\-+]?[0-9]+\.{0,1}[0-9]*\,[\-+]?[0-9]+\.{0,1}[0-9]*$/u';
                        break;
                    case 'natural':
                        $reg = '/^[0-9]+$/u';
                        break;
                    default:
                        $reg = '/' . $this->validation_pattern[$key] . '/u';
                        break;
                }
                if (! preg_match($reg, $val)) {
                    $this->set_exception_fields($key, 'validation_error');
                }
            }
        }
    }

    protected function call_exception($postdata = array())
    {
        $this->cancel_file_saving = true;
        switch ($this->task) {
            case 'upload':
                switch ($this->_post('type')) {
                    case 'image':
                        return $this->create_image($this->_post('field'), '') . $this->render_messages();
                        break;
                    case 'file':
                        return $this->create_file($this->_post('field'), '') . $this->render_messages();
                        break;
                    default:
                        return self::error('Upload Error');
                        break;
                }
                break;
        }

        $this->task = $this->before;
        switch ($this->before) {
            case 'create':
                return $this->_create($postdata);
                break;
            case 'edit':
            case 'view':
                return $this->_entry($this->before, $postdata);
                break;
            case 'upload':
                break;
            default:
                return $this->_list();
                break;
        }
    }

    /**
     * FUN��O ALTERADA DO PADR�O
     *
     * @author Ariel Canal
     *         Corre��o feita na substitui��o do conte�do de $pd.
     */
    protected function make_upload_process($pd)
    {
        if ($this->upload_config) {
            foreach ($this->upload_config as $key => $opts) {
                if (isset($opts['blob']) && $opts['blob'] && $pd->get($key)) {
                    if ($pd->get($key) == 'blob-storage') {
                        $pd->del($key);
                        continue;
                    } else {
                        $folder = $this->upload_folder[$key];
                        $path = $folder . '/' . $pd->get($key);
                        if (is_file($path)) {
                            $pd->set($key, file_get_contents($path));
                            unlink($path);
                        }
                    }
                }
            }
        }
    }

    public function set_exception_fields($fields = '', $message = '', $type = 'error')
    {
        return $this->set_notify($message, $type, true, $fields);
    }

    public function set_notify($message = '', $type = 'message', $exception = false, $fields = '')
    {
        if ($message) {
            $this->messages[] = [
                'type' => $type,
                'text' => $this->lang($message),
                'exception' => $exception
            ];
        }
        if ($exception) {
            $this->exception = true;
        }
        if ($fields) {
            $fdata = $this->_parse_field_names($fields, 'set_exception_fields');
            foreach ($fdata as $key => $fitem) {
                $fitem['exception'] = $message;
                $this->exception_fields[$key] = $fitem;
            }
        }

        return $this;
    }

    protected function render_messages()
    {
        $out = '';
        if (count($this->messages)) {
            foreach ($this->messages as $message) {
                $tag = [
                    'tag' => 'input',
                    'type' => 'hidden',
                    'class' => 'xcrud-callback-message',
                    'name' => $message['type'],
                    'value' => $message['text'],
                    'data-exception' => $message['exception']
                ];
                $out .= $this->single_tag($tag);
            }
        }
        return $out;
    }

    /**
     *
     * @author Ariel Canal
     *         Implementação de totalizadores
     */
    /**
     * grid processing
     */
    protected function _list($render = true)
    {
        if (! $this->is_list) {
            return self::error('Forbidden');
        }
        $this->_alphabetical();
        /*
         * if (!$this->search_columns)
         * {
         * $this->search_columns = $this->columns;
         * }
         */
        if (! $this->is_inner)
            $this->where_pri = array();
        $select = $this->_build_select_list();
        $table_join = $this->_build_table_join();
        $where = $this->_build_where();
        $order_by = $this->_build_order_by();
        $group_by = $this->_build_group_by();
        $sum_tmp = array();
        if ($this->sum) {
            foreach ($this->sum as $field => $param) {
                if (isset($this->subselect[$field]))
                    $sum_tmp[$field] = 'SUM(' . $this->subselect_where($field) . ') AS `' . $field . '`';
                else
                    $sum_tmp[$field] = 'SUM(`' . $param['table'] . '`.`' . $param['column'] . '`) AS `' . $field . '`';
            }
        }
        $sum = $sum_tmp ? ', ' . implode(', ', $sum_tmp) : '';
        $db = Database::get_instance($this->connection, $this->ci);
        // $db->query("SELECT COUNT(`{$this->table}`.`{$this->primary_key}`) AS
        // `count` {$sum} \r\n FROM `{$this->table}`\r\n {$table_join}\r\n
        // {$where}");
        $db->query("SELECT COUNT(*) AS `count` {$sum} \r\n FROM `{$this->table}`\r\n {$table_join}\r\n {$where}\r\n {$group_by}");
        $this->sum_row = $db->row();
        $this->result_total = $this->sum_row['count'];
        if (count($this->totalizers)) {
            foreach ($this->totalizers as $name => $totalizer_config) {
                $where_tot = $this->_build_where(false, $name);
                if ($totalizer_config['select'])
                    $select_tot = $totalizer_config['select'];
                else
                    $select_tot = 'COUNT(*)';
                $db->query("SELECT " . $select_tot . " AS `count` \r\n FROM `{$this->table}`\r\n {$table_join}\r\n {$where_tot}");
                $this->totalizers[$name]['total'] = $db->row();
                $this->totalizers[$name]['total'] = $this->totalizers[$name]['total']['count'];
            }
        }
        $limit = $this->_build_limit($this->result_total);
        // var_dump("SELECT {$select} \r\n FROM `{$this->table}`\r\n {$table_join}\r\n {$where}\r\n {$group_by}\r\n {$order_by}\r\n {$limit}");
        $db->query("SELECT {$select} \r\n FROM `{$this->table}`\r\n {$table_join}\r\n {$where}\r\n {$group_by}\r\n {$order_by}\r\n {$limit}");
        $this->result_list = $db->result();

        if ($this->before_list) {
            $path = $this->check_file($this->before_list['path'], 'before_list');
            include_once ($path);
            if (is_callable($this->before_list['callable'])) {
                call_user_func_array($this->before_list['callable'], array(
                    $this->result_list,
                    $this
                ));
            }
        }

        $this->_set_column_names();
        if ($render)
            return $this->_render_list();
    }

    /**
     * defines primary condition for internal usage
     */
    protected function where_pri($fields = false, $where_val = false, $glue = 'AND', $index = false)
    {
        if ($fields !== false && $where_val !== false) {
            $fdata = $this->_parse_field_names($fields, 'where_pri');
            foreach ($fdata as $fitem) {
                if ($index) {
                    $this->where_pri[$index] = array(
                        'table' => $fitem['table'],
                        'field' => $fitem['field'],
                        'value' => isset($fitem['value']) ? $fitem['value'] : $where_val,
                        'glue' => $glue
                    );
                } else {
                    $this->where_pri[] = array(
                        'table' => $fitem['table'],
                        'field' => $fitem['field'],
                        'value' => isset($fitem['value']) ? $fitem['value'] : $where_val,
                        'glue' => $glue
                    );
                }
            }
            unset($fields, $fdata);
        } elseif ($fields) {
            if ($index) {
                $this->where_pri[$index] = array(
                    'custom' => $fields,
                    'glue' => $glue
                );
            } else {
                $this->where_pri[] = array(
                    'custom' => $fields,
                    'glue' => $glue
                );
            }
            unset($where_val);
        }
        return $this;
    }

    /**
     * 'select' subquery for grid view
     */
    protected function _build_select_list($csv = false)
    {
        $this->find_grid_text_variables();
        $db = Database::get_instance($this->connection, $this->ci);
        $columns = array();

        // $subselect_before = $this->subselect_before;
        foreach ($this->columns as $field_index => $val) {

            if ($val) {
                // $field_index = $key;
                if (isset($this->subselect[$field_index])) {
                    $columns[] = $this->subselect_query($field_index);
                } elseif (isset($this->point_field[$field_index])) {
                    $columns[] = 'CONCAT(X(`' . $val['table'] . '`.`' . $val['field'] . '`),\',\',Y(`' . $val['table'] . '`.`' . $val['field'] . '`)) AS `' . $val['table'] . '.' . $val['field'] . '`' . "\r\n";
                } elseif (isset($this->relation[$field_index])) {
                    $join = '';
                    if (is_array($this->relation[$field_index]['join'])) {
                        foreach ($this->relation[$field_index]['join'] as $params) {
                            if (! is_null($params['lfield']) && ! is_null($params['table']) && ! is_null($params['rfield'])) {
                                $join .= 'INNER JOIN `' . $params['table'] . '` AS '.md5($params['table']).' ON `' . $this->relation[$field_index]['rel_tbl'] . '`.`' . $params['lfield'] . '` = `' . md5($params['table']) . '`.`' . $params['rfield'] . '` ';
                            }
                        }
                    }
                    if (is_array($this->relation[$field_index]['rel_name'])) {
                        $tmp_fields = array();

                        foreach ($this->relation[$field_index]['rel_name'] as $tmp) {
                            $tmp_fields[] = "`{$tmp}` \r\n";
                        }
                        if ($this->relation[$field_index]) {
                            $where = "FIND_IN_SET(`{$this->relation[$field_index]['rel_tbl']}`.`{$this->relation[$field_index]['rel_field']}`,`{$this->relation[$field_index]['table']}`.`{$this->relation[$field_index]['field']}`)";
                        } else {
                            $where = "`{$this->relation[$field_index]['rel_tbl']}`.`{$this->relation[$field_index]['rel_field']}` = `{$this->relation[$field_index]['table']}`.`{$this->relation[$field_index]['field']}`";
                        }
                        $columns[] = "(SELECT GROUP_CONCAT(DISTINCT (CONCAT_WS('{$this->relation[$field_index]['rel_separator']}'," . implode(',', $tmp_fields) . ")) SEPARATOR ', ')
                            FROM `{$this->relation[$field_index]['rel_tbl']}` {$join} 
                            WHERE {$where})
                            AS `rel.{$val['table']}.{$val['field']}`, \r\n `{$val['table']}`.`{$val['field']}` AS `{$val['table']}.{$val['field']}` \r\n";
                    } elseif ($this->relation[$field_index]['multi']) {
                        $columns[] = "(SELECT GROUP_CONCAT(DISTINCT `{$this->relation[$field_index]['rel_name']}` SEPARATOR ', ')
                        FROM `{$this->relation[$field_index]['rel_tbl']}`  {$join} WHERE
                        FIND_IN_SET(`{$this->relation[$field_index]['rel_tbl']}`.`{$this->relation[$field_index]['rel_field']}`,`{$this->relation[$field_index]['table']}`.`{$this->relation[$field_index]['field']}`)
                        ORDER BY `{$this->relation[$field_index]['rel_name']}` ASC)
                         AS `rel.{$val['table']}.{$val['field']}`, \r\n `{$val['table']}`.`{$val['field']}` AS `{$val['table']}.{$val['field']}` \r\n";
                    } else {
                        $columns[] = "(SELECT `{$this->relation[$field_index]['rel_alias']}`.`{$this->relation[$field_index]['rel_name']}`
                            FROM `{$this->relation[$field_index]['rel_tbl']}` AS `{$this->relation[$field_index]['rel_alias']}`  {$join}
                            WHERE `{$this->relation[$field_index]['rel_alias']}`.`{$this->relation[$field_index]['rel_field']}` = `{$this->relation[$field_index]['table']}`.`{$this->relation[$field_index]['field']}`
                            LIMIT 1)
                            AS `rel.{$val['table']}.{$val['field']}`, \r\n `{$val['table']}`.`{$val['field']}` AS `{$val['table']}.{$val['field']}` \r\n";
                    }
                } //
                elseif (isset($this->fk_relation[$field_index])) {
                    $fk = $this->fk_relation[$field_index];
                    if (is_array($fk['rel_name'])) {
                        foreach ($fk['rel_name'] as $tmp) {
                            $tmp_fields[] = '`' . $fk['rel_tbl'] . '`.`' . $tmp . '`';
                            $rel_name = 'CONCAT_WS(' . $db->escape($fk['rel_separator']) . ',' . implode(',', $tmp_fields) . ')';
                        }
                    } else {
                        $rel_name = '`' . $fk['rel_tbl'] . '`.`' . $fk['rel_name'] . '`';
                    }
                    $columns[] = '(SELECT GROUP_CONCAT(DISTINCT ' . $rel_name . ' SEPARATOR \', \')
                        FROM `' . $fk['rel_tbl'] . '`
						INNER JOIN `' . $fk['fk_table'] . '` ON `' . $fk['fk_table'] . '`.`' . $fk['out_fk_field'] . '` = `' . $fk['rel_tbl'] . '`.`' . $fk['rel_field'] . '` WHERE `' . $fk['fk_table'] . '`.`' . $fk['in_fk_field'] . '` = `' . $fk['table'] . '`.`' . $fk['field'] . '` AND ' . $this->_build_rel_where($field_index) . ')
                         AS `' . $fk['alias'] . '` ' . "\r\n";
                } elseif (isset($this->bit_field[$field_index])) {
                    $columns[] = "CAST(`{$val['table']}`.`{$val['field']}` AS UNSIGNED) AS `{$val['table']}.{$val['field']}` \r\n";
                } else {
                    $columns[] = "`{$val['table']}`.`{$val['field']}` AS `{$val['table']}.{$val['field']}` \r\n";
                }
            }
        }
        if ($this->hidden_columns) {
            foreach ($this->hidden_columns as $field_index => $val) {
                if (isset($this->subselect[$field_index])) {
                    $columns[] = $this->subselect_query($field_index);
                } else {
                    $columns[] = "`{$val['table']}`.`{$val['field']}` AS `{$field_index}` \r\n";
                }
            }
        }

        if (! $this->primary_key) {
            $columns[] = "(0) AS `primary_key` \r\n";
        } else {
            $columns[] = "`{$this->table}`.`{$this->primary_key}` AS `primary_key` \r\n";
        }
        return implode(',', $columns);
    }

    /**
     * creates subselect subquery for grid view
     */
    protected function subselect_query($name)
    {
        if (isset($this->subselect_query[$name])) {
            $sql = $this->subselect_query[$name];
        } else {
            $sql = preg_replace_callback('/\{(.+)\}/Uu', array(
                $this,
                'subselect_callback'
            ), $this->subselect[$name]);
            $this->subselect_query[$name] = $sql;
        }
        return "({$sql}) AS `{$name}`";
    }

    protected function subselect_where($name)
    {
        if (isset($this->subselect_query[$name])) {
            return '(' . $this->subselect_query[$name] . ')';
        } else {
            $this->subselect_query($name);
            return '(' . $this->subselect_query[$name] . ')';
        }
    }

    protected function subselect_callback($matches)
    {
        if (strpos($matches[1], '.')) {
            $tmp = explode('.', $matches[1]);
            if (isset($this->subselect[$this->prefix . $tmp[0] . '.' . $tmp[1]])) {
                return $this->subselect_where($this->prefix . $tmp[0] . '.' . $tmp[1]);
            } else
                return '`' . $this->prefix . $tmp[0] . '`.`' . $tmp[1] . '`';
        } else {
            if (isset($this->subselect[$this->table . '.' . $matches[1]])) {
                return $this->subselect_where($this->table . '.' . $matches[1]);
            } else
                return '`' . $this->table . '`.`' . $matches[1] . '`';
        }
    }

    /**
     * alterado - join_relation
     * 'select' subquery part for edit/details view
     */
    protected function _build_select_details($mode)
    {
        $this->find_details_text_variables();
        $fields = array();
        if ($this->inner_table_instance) { // nested table
            foreach ($this->inner_table_instance as $inst_name => $field) {
                if (! isset($this->fields[$field])) // nested table connection field
                                                     // MUST be extracted from DB,
                                                     // even if not
                                                     // defined
                {
                    $fdata = $this->_parse_field_names($field, 'build_select_details');
                    // $this->hidden_fields[$field] = $fdata[0];
                    $this->hidden_fields = array_merge($this->hidden_fields, $fdata);
                }
            }
        }

        if ($this->fields) {
            foreach ($this->fields as $key => $val) {
                if ($val && ! isset($this->custom_fields[$key])) {
                    if (isset($this->subselect[$key])) {
                        $fields[] = $this->subselect_query($key);
                    } elseif (isset($this->fk_relation[$key])) {
                        $fk = $this->fk_relation[$key];
                        $fields[] = '(SELECT GROUP_CONCAT(DISTINCT `' . $fk['rel_tbl'] . '`.`' . $fk['rel_field'] . '` SEPARATOR \',\')
	                        FROM `' . $fk['rel_tbl'] . '`
							INNER JOIN `' . $fk['fk_table'] . '` ON `' . $fk['fk_table'] . '`.`' . $fk['out_fk_field'] . '` = `' . $fk['rel_tbl'] . '`.`' . $fk['rel_field'] . '` WHERE `' . $fk['fk_table'] . '`.`' . $fk['in_fk_field'] . '` = `' . $fk['table'] . '`.`' . $fk['field'] . '` AND ' . $this->_build_rel_where($key) . ')
	                         AS `' . $fk['alias'] . '` ' . "\r\n";
                    } elseif (isset($this->point_field[$key])) {
                        $fields[] = 'CONCAT(X(`' . $val['table'] . '`.`' . $val['field'] . '`),\',\',Y(`' . $val['table'] . '`.`' . $val['field'] . '`)) AS `' . $val['table'] . '.' . $val['field'] . '`' . "\r\n";
                    } elseif (isset($this->bit_field[$key])) {
                        $fields[] = "CAST(`{$val['table']}`.`{$val['field']}` AS UNSIGNED) AS `$key`";
                    } else {
                        $fields[] = "`{$val['table']}`.`{$val['field']}` AS `$key`";
                    }
                }
            }
        }
        if ($this->hidden_fields) {
            foreach ($this->hidden_fields as $key => $val) {
                if ($val)
                    $fields[] = "`{$val['table']}`.`{$val['field']}` AS `{$key}`";
            }
        }
        if (count($this->join_relation)) {
            foreach ($this->join_relation as $f => $params) {
                $r_params = $this->relation[$f];
                foreach ($params['rel_additional_fields'] as $f => $p) {
                    $fields[] = "`{$p['table']}`.`{$p['field']}` AS `" . $p['table'] . "." . $p['field'] . "`";
                }
            }
        }
        $fields[] = "`{$this->table}`.`{$this->primary_key}` AS `primary_key`";
        return implode(',', $fields);
    }

    /* alterado - join_selection */
    protected function _build_table_join()
    {
        $join = '';
        if (count($this->join)) {
            $join_arr = array();
            foreach ($this->join as $alias => $params) {
                $join_arr[] = "INNER JOIN `{$params['join_table']}` AS `{$alias}`
                ON `{$params['table']}`.`{$params['field']}` = `{$alias}`.`{$params['join_field']}` " . $params['additional_cond'];
            }
        }
        if (count($this->join_relation)) {
            foreach ($this->join_relation as $field => $params) {
                if (isset($this->relation[$field])) {
                    // array('rel_tbl' => $rel_tbl,'rel_alias' => 'alias' . rand(),'rel_field' => $rel_field,'rel_name' => $rel_name,'rel_where' => $rel_where,'rel_separator' => $rel_concat_separator,'order_by' => $order_by,'multi' => $multi,'table' => $fitem['table'],'field' => $fitem['field'],'tree' => $tree,'depend_field' => $depend_field,'depend_on' => $depend_on);
                    $r_params = $this->relation[$field];

                    $join_arr[] = "INNER JOIN `{$r_params['rel_tbl']}` AS `{$r_params['rel_tbl']}`
					ON $field = `{$r_params['rel_tbl']}`.`{$r_params['rel_field']}` ";
                }
            }
        }
        if (isset($join_arr)) {
            $join .= implode(' ', $join_arr);
        }
        return $join;
    }

    /**
     *
     * @author Ariel Canal
     *         As condi��es definidas pelo controller e pelos filtros s� s�o
     *         consideradas caso a task n�o seja edit ou view.
     *         Isso evita que o formul�rio seja renderizado em branco caso, ap�s
     *         o
     *         'save', o registro n�o esteja mais na listagem filtrada pelo
     *         usu�rio.
     */
    /**
     * builds main where condition for query
     */
    protected function _build_where($build_alphabetical = true, $is_totalizer = false)
    {
        $db = Database::get_instance($this->connection, $this->ci);
        $where_arr = array();
        $where_arr_pri = array();

        // user defined conditions
        if ($this->where && ! in_array($this->task, array(
            'edit',
            'view'
        ))) {
            foreach ($this->where as $key => $params) {
                if ($where_arr)
                    $where_arr[] = $params['glue'];

                if (! isset($params['custom'])) {
                    $fieldkey = $this->_where_fieldkey($params);
                    if (is_array($params['value'])) {
                        $in_arr = array();
                        foreach ($params['value'] as $in_val) {
                            $in_arr[] = $db->escape($in_val);
                        }
                        if (isset($this->subselect[$fieldkey])) {
                            $where_arr[] = $this->subselect_where($fieldkey) . $this->_cond_from_where_in($params['field']) . '(' . implode(',', $in_arr) . ')';
                        } else {
                            $where_arr[] = $this->_where_field($params) . $this->_cond_from_where_in($params['field']) . '(' . implode(',', $in_arr) . ')';
                        }
                    } else {
                        if (isset($this->subselect[$fieldkey])) {
                            $where_arr[] = $this->subselect_where($fieldkey) . $this->_cond_from_where($params['field']) . $db->escape($params['value'], isset($this->no_quotes[$fieldkey]));
                        } elseif (isset($this->point_field[$fieldkey])) {
                            $where_arr[] = 'CONCAT(X(`' . $this->_where_field($params) . '`),\',\',Y(`' . $this->_where_field($params) . '`))' . $this->_cond_from_where($params['field']) . $db->escape($params['value'], isset($this->no_quotes[$fieldkey]));
                        } else {
                            $where_arr[] = $this->_where_field($params) . $this->_cond_from_where($params['field']) . $db->escape($params['value'], isset($this->no_quotes[$fieldkey]));
                        }
                    }
                } else {
                    $where_arr[] = '(' . $params['custom'] . ')';
                }
            }
        }

        // internal condition
        if ($this->where_pri) {
            foreach ($this->where_pri as $params) {
                if ($where_arr_pri)
                    $where_arr_pri[] = $params['glue'];
                if (isset($params['custom'])) {
                    $where_arr_pri[] = '(' . $params['custom'] . ')';
                } else {
                    $where_arr_pri[] = $this->_where_field($params) . $this->_cond_from_where($params['field']) . $db->escape($params['value']);
                }
            }
        }
        // search condition
        if ($this->search && ($this->task == 'list' or $this->task == 'make_report' or $this->task == 'print' or $this->task == 'csv' or $this->after == 'list')) {
            $search_columns = $this->search_columns ? $this->search_columns : $this->columns;
            if (is_array($this->search_submit) && count($this->search_submit)) {
                for ($i = 1; $i <= $this->search_lines; $i ++) {
                    if (isset($this->search_submit[$i]['phrase']) && $this->search_submit[$i]['phrase'] != "" && isset($this->search_submit[$i]) && is_array($this->search_submit[$i])) {
                        if ($this->search_submit[$i]['column'] && isset($search_columns[$this->search_submit[$i]['column']])) {
                            // if relation
                            if (isset($this->relation[$this->search_submit[$i]['column']])) {
                                $search_arr[] = $this->_build_relation_subwhere($this->search_submit[$i]['column'], $i);
                            } // if fk-relation
                            elseif (isset($this->fk_relation[$this->search_submit[$i]['column']])) {
                                $search_arr[] = $this->_build_fk_relation_subwhere($this->search_submit[$i]['column'], $i);
                            } // search in subselect
                            elseif (isset($this->subselect[$this->search_submit[$i]['column']])) {
                                $search_arr[] = '(' . $this->subselect_query[$this->search_submit[$i]['column']] . ') LIKE ' . $db->escape_like($this->search_submit[$i]['phrase'], $this->search_pattern);
                            } elseif (isset($this->point_field[$this->search_submit[$i]['column']])) {
                                $fdata = $this->_parse_field_names($this->search_submit[$i]['column'], 'build_where', false, false);
                                $fitem = reset($fdata);
                                $search_arr[] = 'CONCAT(X(`' . $fitem['table'] . '`.`' . $fitem['field'] . '`),\',\',Y(`' . $fitem['table'] . '`.`' . $fitem['field'] . '`))LIKE ' . $db->escape_like($this->search_submit[$i]['phrase'], $this->search_pattern);
                            } else {
                                $fdata = $this->_parse_field_names($this->search_submit[$i]['column'], 'build_where', false, false);
                                $fitem = reset($fdata);
                                $key = key($fdata);
                                // search via fild types
                                switch ($this->field_type[$this->search_submit[$i]['column']]) {
                                    case 'timestamp':
                                    case 'datetime':
                                    case 'date':
                                    case 'time':
                                        switch ($this->field_type[$this->search_submit[$i]['column']]) {
                                            case 'date':
                                                $format = 'Y-m-d';
                                                break;
                                            case 'time':
                                                $format = 'H:i:s';
                                                break;
                                            default:
                                                $format = 'Y-m-d H:i:s';
                                                break;
                                        }
                                        if ($this->search_submit[$i]['phrase']['from'] && $this->search_submit[$i]['phrase']['to']) {
                                            $search_arr[] = '(`' . $fitem['table'] . '`.`' . $fitem['field'] . '` BETWEEN ' . $db->escape($this->br2mysqldate($this->search_submit[$i]['phrase']['from'])) . ' AND ' . $db->escape($this->br2mysqldate($this->search_submit[$i]['phrase']['to'])) . ')';
                                        } elseif ($this->search_submit[$i]['phrase']['from']) {
                                            $search_arr[] = '(`' . $fitem['table'] . '`.`' . $fitem['field'] . '` >= ' . $db->escape($this->br2mysqldate($this->search_submit[$i]['phrase']['from'])) . ')';
                                        } elseif ($this->search_submit[$i]['phrase']['to']) {
                                            $search_arr[] = '(`' . $fitem['table'] . '`.`' . $fitem['field'] . '` <= ' . $db->escape($this->br2mysqldate($this->search_submit[$i]['phrase']['to'])) . ')';
                                        }
                                        break;
                                    case 'select':
                                    case 'radio':
                                        $search_arr[] = '(`' . $fitem['table'] . '`.`' . $fitem['field'] . '` = ' . $db->escape($this->search_submit[$i]['phrase']) . ')';
                                        break;
                                    /*
                                     * case 'multiselect':
                                     * case 'checkboxes':
                                     * break;
                                     */
                                    case 'bool':
                                        if (isset($this->bit_field[$key])) {
                                            $search_arr[] = 'CAST(`' . $fitem['table'] . '`.`' . $fitem['field'] . '` AS UNSIGNED) = ' . ((int) $this->search_submit[$i]['phrase']);
                                        } else {
                                            $search_arr[] = '(`' . $fitem['table'] . '`.`' . $fitem['field'] . '` = ' . ((int) $this->search_submit[$i]['phrase']) . ')';
                                        }
                                        break;
                                    default:
                                        if (isset($this->point_field[$key])) {
                                            $search_arr[] = 'CONCAT(X(`' . $fitem['table'] . '`.`' . $fitem['field'] . '`),\',\',Y(`' . $fitem['table'] . '`.`' . $fitem['field'] . '`)) LIKE ' . $db->escape_like($this->search_submit[$i]['phrase'], $this->search_pattern);
                                        } elseif (isset($this->bit_field[$key])) {
                                            $search_arr[] = 'CAST(`' . $fitem['table'] . '`.`' . $fitem['field'] . '` AS UNSIGNED) LIKE ' . $db->escape_like($this->search_submit[$i]['phrase'], $this->search_pattern);
                                        } else {
                                            $search_arr[] = '(`' . $fitem['table'] . '`.`' . $fitem['field'] . '` LIKE ' . $db->escape_like($this->search_submit[$i]['phrase'], $this->search_pattern) . ')';
                                        }
                                        break;
                                }
                            }
                        } else if ($this->search_submit[$i]['phrase']) {
                            // multicolumn search
                            // $f_array = array();
                            $or_array = array();
                            // $search_columns = $this->search_columns ?
                            // $this->search_columns : $this->columns;
                            foreach ($search_columns as $key => $fitem) {
                                if (isset($this->relation[$key])) {
                                    $or_array[] = $this->_build_relation_subwhere($key, $i);
                                } elseif (isset($this->fk_relation[$key])) {
                                    $or_array[] = $this->_build_fk_relation_subwhere($key, $i);
                                } elseif (isset($this->subselect[$key])) {
                                    $or_array[] = '(' . $this->subselect_query[$key] . ') LIKE ' . $db->escape_like($this->search_submit[$i]['phrase'], $this->search_pattern);
                                } elseif ($this->field_type[$key] == 'date' || $this->field_type[$key] == 'datetime' || $this->field_type[$key] == 'timestamp' || $this->field_type[$key] == 'time') {
                                    if (preg_match('/^[0-9\-\:\s]+$/', $this->search_submit[$i]['phrase'])) {
                                        $or_array[] = '`' . $fitem['table'] . '`.`' . $fitem['field'] . '` LIKE ' . $db->escape_like($this->search_submit[$i]['phrase'], $this->search_pattern);
                                    }
                                } elseif (isset($this->point_field[$key])) {
                                    $or_array[] = 'CONCAT(X(`' . $fitem['table'] . '`.`' . $fitem['field'] . '`),\',\',Y(`' . $fitem['table'] . '`.`' . $fitem['field'] . '`)) LIKE ' . $db->escape_like($this->search_submit[$i]['phrase'], $this->search_pattern);
                                } elseif (isset($this->bit_field[$key])) {
                                    $or_array[] = 'CAST(`' . $fitem['table'] . '`.`' . $fitem['field'] . '` AS UNSIGNED) LIKE ' . $db->escape_like($this->search_submit[$i]['phrase'], $this->search_pattern);
                                } else {
                                    // $f_array[] = '`' . $fitem['table'] . '`.`' .
                                    // $fitem['field'] . '`';
                                    $or_array[] = '`' . $fitem['table'] . '`.`' . $fitem['field'] . '` LIKE ' . $db->escape_like($this->search_submit[$i]['phrase'], $this->search_pattern);
                                }
                            }
                            $where = '(';
                            /*
                             * if ($f_array)
                             * {
                             * $where .= 'CONCAT_WS(\' \',' . implode(',', $f_array) . ')
                             * LIKE ' . $db->escape_like($this->phrase, $this->
                             * search_pattern);
                             * }
                             * if ($f_array && $or_array)
                             * {
                             * $where .= ' OR ';
                             * }
                             */
                            if ($or_array) {
                                $where .= implode(' OR ', $or_array);
                            }
                            $where .= ')';
                            $search_arr[] = $where;
                        }
                        $search_conditions[] = implode(' AND ', $search_arr);
                        $search_arr = array();
                    }
                }
            }
            if (isset($search_conditions) && count($search_conditions)) {
                if ($where_arr) {
                    $where_arr[] = 'AND';
                }
                $search_operator = 'AND';
                $where_arr[] = '(' . implode(' ' . $search_operator . ' ', $search_conditions) . ')';
            }
        }

        // alphabetical condidion
        if ($build_alphabetical && $this->alphabetical_filter != "" && ! in_array($this->task, array(
            'edit',
            'view'
        ))) {
            if (count($where_arr))
                $where_arr[] = 'AND';
            if ($this->alphabetical_filter == "#")
                $where_arr[] = 'SUBSTRING(`' . $this->table . '`.`' . $this->alphabetical_field . '`,1,1) NOT IN (\'' . implode("','", range('A', 'Z')) . '\')';
            else
                $where_arr[] = 'SUBSTRING(`' . $this->table . '`.`' . $this->alphabetical_field . '`,1,1) = \'' . substr(strtoupper($this->alphabetical_filter), 0, 1) . '\'';
        }

        // custom filters
        if (! in_array($this->task, array(
            'edit',
            'view'
        ))) {
            foreach ($this->custom_filter as $filter_name => $opts) {
                unset($current_label);
                if (isset($this->custom_filter_active[$filter_name])) {
                    $current_label = $this->custom_filter_active[$filter_name];
                    $custom_filter = $this->custom_filter[$filter_name][$current_label];

                    if ($is_totalizer && $filter_name == 'totalizer') {} else {
                        if (is_string($custom_filter)) {
                            $glue = "AND";
                            $cond = $custom_filter;
                        } else if (is_array($custom_filter) && isset($custom_filter['where']) && isset($custom_filter['glue'])) {
                            $glue = $custom_filter['glue'];
                            $cond = $custom_filter['where'];
                        } else if (is_array($custom_filter) && isset($custom_filter['where'])) {
                            $glue = "AND";
                            $cond = $custom_filter['where'];
                        }

                        if ($glue && count($where_arr))
                            $where_arr[] = $glue;
                        if ($cond)
                            $where_arr[] = '(' . $cond . ')';
                    }
                }
            }
        }

        // totalizers
        if ($is_totalizer && isset($this->totalizers[$is_totalizer]) && ! in_array($this->task, array(
            'edit',
            'view'
        ))) {
            $totalizer = $this->totalizers[$is_totalizer]['where'];
            if (is_string($totalizer)) {
                $glue = "AND";
                $cond = $totalizer;
            } else if (is_array($totalizer) && isset($totalizer['where']) && isset($totalizer['glue'])) {
                $glue = $totalizer['glue'];
                $cond = $totalizer['where'];
            } else if (is_array($totalizer) && isset($totalizer['where'])) {
                $glue = "AND";
                $cond = $totalizer['where'];
            }

            if ($glue && count($where_arr))
                $where_arr[] = $glue;
            if ($cond)
                $where_arr[] = '(' . $cond . ')';
        }

        // reports
        if (count($this->report_values)) {
            foreach ($this->parameters as $name => $attr) {
                if (in_array($attr['field'], array_keys($this->custom_fields))) {
                    // continue;
                }
                if (isset($this->report_values[$attr['field']])) {
                    switch ($attr['operator']) {
                        case "=":
                            $w[] = $attr['field'] . " = " . $db->escape($this->report_values[$attr['field']]);
                            break;
                        case "FIND_IN_SET":
                            if (is_string($this->report_values[$attr['field']])) {
                                $this->report_values[$attr['field']] = explode(',', $this->report_values[$attr['field']]);
                            }

                            $values = array();
                            foreach ($this->report_values[$attr['field']] as $k => $v) {
                                $values[] = "FIND_IN_SET(" . $db->escape($v) . "," . $attr['field'] . ")";
                            }
                            $w[] = "(" . implode(' OR ', $values) . ")";

                            break;
                        case "IN":
                            if (is_string($this->report_values[$attr['field']])) {
                                $this->report_values[$attr['field']] = explode(',', $this->report_values[$attr['field']]);
                            }
                            $values = array();
                            foreach ($this->report_values[$attr['field']] as $k => $v) {
                                $values[] = $db->escape($v);
                            }
                            $w[] = $attr['field'] . " IN (" . implode(',', $values) . ")";
                            break;
                        case "between":
                            if (isset($this->report_values[$attr['field'] . '_to'])) {
                                $w[] = $attr['field'] . " BETWEEN " . $db->escape($this->report_values[$attr['field']]) . " AND " . $db->escape($this->report_values[$attr['field'] . '_to']);
                            } else {
                                $w[] = $attr['field'] . " >= " . $db->escape($this->report_values[$attr['field']]);
                            }
                            break;
                        case "_to":
                            if (! isset($this->report_values[$attr['field']])) {
                                $w[] = $attr['field'] . " <= " . $db->escape($this->report_values[$attr['field']]);
                            }
                            break;
                    }
                }
            }
            if (isset($w)) {
                if (count($where_arr)) {
                    $where_arr[] = 'AND';
                }
                $where_arr[] = '(' . implode(' AND ', $w) . ')';
            }
        }
        if (sizeof($where_arr) === 1 && trim($where_arr[0]) == "()")
            $where_arr = false;
        // final part
        if ($where_arr or $where_arr_pri) {
            $return = 'WHERE ' . (($where_arr) ? '(' . implode(' ', $where_arr) . ')' : '') . ($where_arr_pri ? ($where_arr ? ' AND ' : '') . implode(' ', $where_arr_pri) : '');
            // var_dump($return);
            return $return;
        } else {
            return '';
        }
    }

    /**
     * relation values will be searched by displayed name (not by id)
     */
    protected function _build_relation_subwhere($key, $i = 1) // multicolumn name
    {
        $db = Database::get_instance($this->connection, $this->ci);

        if ($key) {
            $rel = $this->relation[$key];
            
            $join = '';
            if (is_array($rel['join'])) {
                foreach ($rel['join'] as $params) {
                    if (! is_null($params['lfield']) && ! is_null($params['table']) && ! is_null($params['rfield'])) {
                        $join .= 'INNER JOIN `' . $params['table'] . '` AS '.md5($params['table']).' ON `' . $rel['rel_tbl'] . '`.`' . $params['lfield'] . '` = `' . md5($params['table']) . '`.`' . $params['rfield'] . '` ';
                    }
                }
            }
            if (is_array($rel['rel_name'])) {
                $tmp_fields = array();
                
                foreach ($rel['rel_name'] as $tmp) {
                    $tmp_fields[] = '`' . $tmp . '`' . "\r\n";
                }
                // multiselect relation
                if ($rel['multi']) {
                    $where = '`' . $rel['rel_tbl'] . '`.`' . $rel['rel_field'] . '` LIKE `' . $rel['table'] . '`.`' . $rel['field'] . '`';
                } else {
                    $where = '`' . $rel['rel_tbl'] . '`.`' . $rel['rel_field'] . '` = `' . $rel['table'] . '`.`' . $rel['field'] . '`';
                }
                $select = "(SELECT GROUP_CONCAT(DISTINCT (CONCAT_WS('{$rel['rel_separator']}'," . implode(',', $tmp_fields) . ")) SEPARATOR ', ')
                            FROM `{$rel['rel_tbl']}` {$join}
                            WHERE {$where})\r\n";
            } // multiselect relation
            elseif ($rel['multi']) {
                $select = "(SELECT GROUP_CONCAT(DISTINCT `{$rel['rel_name']}` SEPARATOR ', ')
                        FROM `{$rel['rel_tbl']}` {$join} WHERE
                        FIND_IN_SET(`{$rel['rel_tbl']}`.`{$rel['rel_field']}`,`{$rel['table']}`.`{$rel['field']}`)
                        ORDER BY `{$rel['rel_name']}` ASC)\r\n";
            } else {
                $select = "(SELECT `{$rel['rel_alias']}`.`{$rel['rel_name']}`
                            FROM `{$rel['rel_tbl']}` AS `{$rel['rel_alias']}` {$join}
                            WHERE `{$rel['rel_alias']}`.`{$rel['rel_field']}` = `{$rel['table']}`.`{$rel['field']}`
                            LIMIT 1) \r\n";
            }
            return "{$select} LIKE " . $db->escape_like($this->search_submit[$i]['phrase'], $this->search_pattern);
        }
        /*
         * else
         * {
         * $or_where = array();
         * foreach ($this->relation as $column => $param)
         * {
         * if (is_array($this->relation[$column]['rel_name']))
         * {
         * $tmp_fields = array();
         * foreach ($this->relation[$column]['rel_name'] as $tmp)
         * {
         * $tmp_fields[] = '`' . $tmp . '`' . "\r\n";
         * }
         * // multiselect relation
         * if ($this->relation[$column]['multi'])
         * {
         * $where = '`' . $this->relation[$column]['rel_tbl'] . '`.`' .
         * $this->relation[$column]['rel_field'] . '` LIKE `' . $this->
         * relation[$column]['table'] . '`.`' .
         * $this->relation[$column]['field'] . '`';
         * }
         * else
         * {
         * $where = '`' . $this->relation[$column]['rel_tbl'] . '`.`' .
         * $this->relation[$column]['rel_field'] . '` = `' . $this->
         * relation[$column]['table'] . '`.`' .
         * $this->relation[$column]['field'] . '`';
         * }
         * $select = "(SELECT GROUP_CONCAT(DISTINCT
         * (CONCAT_WS('{$this->relation[$column]['rel_separator']}'," .
         * implode(',', $tmp_fields) .
         * ")) SEPARATOR ', ')
         * FROM `{$this->relation[$column]['rel_tbl']}`
         * WHERE {$where})\r\n";
         * }
         * // multiselect relation
         * elseif ($this->relation[$column]['multi'])
         * {
         * $select = "(SELECT GROUP_CONCAT(DISTINCT
         * `{$this->relation[$column]['rel_name']}` SEPARATOR ', ')
         * FROM `{$this->relation[$column]['rel_tbl']}` WHERE
         * FIND_IN_SET(`{$this->relation[$column]['rel_tbl']}`.`{$this->relation[$column]['rel_field']}`,`{$this->relation[$column]['table']}`.`{$this->relation[$column]['field']}`)
         * ORDER BY `{$this->relation[$column]['rel_name']}` ASC)\r\n";
         * }
         * else
         * {
         * $select = "(SELECT
         * `{$this->relation[$column]['rel_alias']}`.`{$this->relation[$column]['rel_name']}`
         * FROM `{$this->relation[$column]['rel_tbl']}` AS
         * `{$this->relation[$column]['rel_alias']}`
         * WHERE
         * `{$this->relation[$column]['rel_alias']}`.`{$this->relation[$column]['rel_field']}`
         * =
         * `{$this->relation[$column]['table']}`.`{$this->relation[$column]['field']}`
         * LIMIT 1) \r\n";
         * }
         * $or_where[] = $select . ' LIKE ' . $db->escape_like($this->phrase,
         * $this->search_pattern);
         * }
         * return implode(' OR ', $or_where);
         * }
         */
    }

    protected function _build_fk_relation_subwhere($key, $i = 1) // multicolumn name
    {
        $db = Database::get_instance($this->connection, $this->ci);
        $fk = $this->fk_relation[$key];

        if (is_array($fk['rel_name'])) {
            foreach ($fk['rel_name'] as $tmp) {
                $tmp_fields[] = '`' . $fk['rel_tbl'] . '`.`' . $tmp . '`';
                $rel_name = 'CONCAT_WS(' . $db->escape($fk['rel_separator']) . ',' . implode(',', $tmp_fields) . ')';
            }
        } else {
            $rel_name = '`' . $fk['rel_tbl'] . '`.`' . $fk['rel_name'] . '`';
        }
        $select = '(SELECT GROUP_CONCAT(DISTINCT ' . $rel_name . ' SEPARATOR \', \')
            FROM `' . $fk['rel_tbl'] . '`
            INNER JOIN `' . $fk['fk_table'] . '` ON `' . $fk['fk_table'] . '`.`' . $fk['out_fk_field'] . '` = `' . $fk['rel_tbl'] . '`.`' . $fk['rel_field'] . '` WHERE `' . $fk['fk_table'] . '`.`' . $fk['in_fk_field'] . '` = `' . $fk['table'] . '`.`' . $fk['field'] . '` AND ' . $this->_build_rel_where($key) . ')' . "\r\n";
        return $select . ' LIKE ' . $db->escape_like($this->search_submit[$i]['phrase'], $this->search_pattern);
    }

    protected function _build_rel_where($name)
    {
        $where_arr = array();
        if ($this->fk_relation[$name]['rel_where']) {
            $db = Database::get_instance($this->connection, $this->ci);
            if (is_array($this->fk_relation[$name]['rel_where'])) {
                foreach ($this->fk_relation[$name]['rel_where'] as $field => $val) {
                    $val = preg_replace_callback('/\{(.+)\}/Uu', array(
                        $this,
                        'rel_where_callback'
                    ), $val);
                    $where_arr[] = $this->_field_from_where($field) . $this->_cond_from_where($field) . $db->escape($val);
                }
            } else {
                $where_arr[] = preg_replace_callback('/\{(.+)\}/Uu', array(
                    $this,
                    'rel_where_callback'
                ), $this->fk_relation[$name]['rel_where']);
            }
            return implode(' AND ', $where_arr);
        } else {
            return 1;
        }
    }

    protected function _build_rel_ins_where($name)
    {
        $where_arr = array();
        if ($this->fk_relation[$name]['add_data']) {
            $db = Database::get_instance($this->connection, $this->ci);
            if (is_array($this->fk_relation[$name]['add_data'])) {
                foreach ($this->fk_relation[$name]['add_data'] as $field => $val) {
                    $val = preg_replace_callback('/\{(.+)\}/Uu', array(
                        $this,
                        'rel_where_callback'
                    ), $val);
                    $where_arr[] = $this->_field_from_where($field) . $this->_cond_from_where($field) . $db->escape($val);
                }
            } else {
                $where_arr[] = preg_replace_callback('/\{(.+)\}/Uu', array(
                    $this,
                    'rel_where_callback'
                ), $this->fk_relation[$name]['add_data']);
            }
            return implode(' AND ', $where_arr);
        } else {
            return 1;
        }
    }

    protected function rel_where_callback($matches)
    {
        if (strpos($matches[1], '.')) {
            $tmp = explode('.', $matches[1]);
            return '`' . $this->prefix . $tmp[0] . '`.`' . $tmp[1] . '`';
        } else {
            return '`' . $this->table . '`.`' . $matches[1] . '`';
        }
    }

    /**
     * FUN��O ALTERADA DO PADR�O
     * compatibilizada com reports
     */
    /**
     * receiving user data
     */
    protected function _receive_post($task = false, $primary = false)
    {
        if (! $this->table_name && ! $this->query)
            $this->table_name = $this->_humanize(mb_substr($this->table, mb_strlen($this->prefix)));
        if ($task) {
            switch ($task) {
                case 'create':
                    $this->task = $task;
                    $this->before = $task;
                    return;
                    break;
                case 'edit':
                case 'view':
                    if ($primary !== false) {
                        $this->task = $task;
                        $this->before = $task;
                        $this->primary_val = $primary;
                        return;
                    }
                    break;
                case 'list':
                    $this->task = $task;
                    return;
                    break;
                case 'report':
                    $this->task = $task;
                    return;
                    break;
            }
        } else {
            $this->task = $this->_post('task', 'list');
        }
        if ($this->is_get) {
            $this->task = $this->_get('task');
            $this->primary_val = $this->_get('primary');
        } else {
            $this->order_column = $this->_post('orderby', false, 'key');
            // var_dump($this->order_column);
            $this->order_direct = $this->_post('order') == 'desc' ? 'desc' : 'asc';
            if ($this->order_column) {
                if (! $this->query)
                    $this->order_column = key($this->_parse_field_names($this->order_column, 'receive_post', false, false));
                if (isset($this->order_by[$this->order_column]))
                    unset($this->order_by[$this->order_column]);
                $this->order_by = array_merge(array(
                    $this->order_column => $this->order_direct
                ), $this->order_by);
            }
            // var_dump($this->order_column);
            $this->is_modal = $this->_post('is_modal', false);

            if (isset($_POST['xcrud']['search']) && $this->_post('search', $this->search, 'int') === 0) {
                // clicou em limpar busca
                $this->search = $this->_post('search', $this->search, 'int');
                $this->search_submit = array();
            } else if (isset($_POST['xcrud']['search']) && $this->_post('search', $this->search, 'int') === 1) {
                // nova busca
                $this->search = $this->_post('search', $this->search, 'int');
                $this->search_submit = $this->_post('search_submit', false, array());
            } else if ($this->search) {} else {
                $this->search = $this->_post('search', $this->search, 'int');
                $this->search_submit = array();
            }
            $this->start = $this->_post('start', 0, 'int');
            $this->limit = $this->_post('limit', ($this->limit ? $this->limit : XcrudConfig::$limit));
            $this->after = $this->_post('after');
            $this->primary_val = $this->_post('primary');
            $this->active_tab_id = $this->_post('active_tab_id');

            $xcrud_session = $this->ci->session->userdata('xcrud_session');

            if (isset($xcrud_session[$this->instance_name]))
                $this->alphabetical_filter = $this->_post('alphabetical', $xcrud_session[$this->instance_name]['alphabetical_filter']);
            if ($this->search && ! $this->_post('alphabetical', false))
                $this->alphabetical_filter = '';

            $filter = $this->_post('filter', false);
            $filter_label = $this->_post('label', false);
            if ($filter && $filter_label) {
                switch ($filter_label) {
                    case "all":
                        unset($this->custom_filter_active[$filter]);
                        break;
                    default:
                        $this->custom_filter_active[$filter] = $filter_label;
                }
            }
        }
    }

    protected function _build_order_by()
    {
        if (count($this->order_by)) {
            $order_arr = array();
            foreach ($this->order_by as $field => $direction) {
                if (! array_key_exists($field, $this->columns)) {
                    continue;
                }
                if ($direction === false) {
                    $order_arr[] = $field;
                } elseif (isset($this->relation[$field])) {
                    $order_arr[] = '`rel.' . $field . '` ' . $direction;
                } elseif (isset($this->subselect[$field]) or isset($this->columns[$field]) or isset($this->no_select[$field]) or ! strpos($field, '.') or isset($this->fk_relation[$field])) {
                    $order_arr[] = '`' . $field . '` ' . $direction;
                } else {
                    $tmp = explode('.', $field);
                    $order_arr[] = '`' . $tmp[0] . '`.`' . $tmp[1] . '` ' . $direction;
                }
            }
            if (count($order_arr)) {
                return 'ORDER BY ' . implode(',', $order_arr);
            } else {
                return '';
            }
        } else {
            /*
             * if (isset($this->columns[$this->table . '.' .
             * $this->primary_key]))
             * {
             * $this->order_by[$this->table . '.' . $this->primary_key] = 'ASC';
             * return "ORDER BY `{$this->table}.{$this->primary_key}` ASC";
             * }
             * else
             * return "ORDER BY `{$this->table}`.`{$this->primary_key}` ASC";
             */
            return '';
        }
    }

    protected function _build_group_by()
    {
        if (count($this->group_by)) {
            $group_arr = array();
            foreach ($this->group_by as $field) {
                if (isset($this->subselect[$field]) or isset($this->no_select[$field]) or ! strpos($field, '.') or isset($this->fk_relation[$field])) {
                    $group_arr[] = '`' . $field . '` ';
                } else {
                    $tmp = explode('.', $field);
                    $group_arr[] = '`' . $tmp[0] . '`.`' . $tmp[1] . '` ';
                }
            }
            return 'GROUP BY ' . implode(',', $group_arr);
        }
        return false;
    }

    protected function _build_limit($total)
    {
        if ($this->limit != 'all' && $this->theme != 'printout') {
            if ($this->start > 0 && $this->start >= $this->result_total) {
                $this->start = $this->result_total > $this->limit ? $this->result_total - $this->limit : 0;
            }
            $this->start = floor($this->start / $this->limit) * $this->limit;
            return "LIMIT {$this->start},{$this->limit}";
        } else {
            $this->start = 0;
            return '';
        }
    }

    /**
     * alterado do padrão - JOIN_RELATION
     * informatiuon about table columns
     */
    protected function _get_table_info()
    {
        $this->table_info = array();
        $db = Database::get_instance($this->connection, $this->ci);
        $db->query("SHOW COLUMNS FROM `{$this->table}`");
        $this->table_info[$this->table] = $db->result();
        if ($this->join) {
            foreach ($this->join as $alias => $join) {
                $db->query("SHOW COLUMNS FROM `{$join['join_table']}`");
                $this->table_info[$alias] = $db->result();
            }
        }
        if ($this->join_relation) {
            foreach ($this->join_relation as $item) {
                $db->query("SHOW COLUMNS FROM `{$item['rel_table']}`");
                $this->table_info[$item['rel_table']] = $db->result();
            }
        }
        return true;
    }

    protected function _set_field_types($mode = 'create', $all_fields = false)
    {
        if (is_array($this->table_info) && count($this->table_info)) {
            $uni = false;
            $this->primary_ai = false;
            $fields = array();
            // var_dump($this->table_info);
            foreach ($this->table_info as $table => $types) {
                foreach ($types as $row) {
                    $field_index = $table . '.' . $row['Field'];
                    if (! $all_fields) {
                        $fields_object_name = 'fields_' . $mode;
                        $fields_object = $this->$fields_object_name;
                    } else {
                        $fields_object = array();
                    }
                    $this->field_null[$field_index] = $row['Null'] == 'YES' ? true : false;
                    if (! $this->field_null[$field_index] && XcrudConfig::$not_null_is_required && ! isset($this->validation_required[$field_index])) {
                        $this->validation_required[$field_index] = 1;
                    }
                    if ($row['Type'] == 'point') {
                        $this->point_field[$field_index] = true;
                    }

                    if ($row['Key'] == 'PRI' or $row['Key'] == 'UNI') {
                        $this->unique[$field_index] = true;
                        if ($table == $this->table && ! $uni) {
                            $uni = $row['Field'];
                        }
                    }

                    if ($row['Key'] == 'PRI' && $row['Extra'] == 'auto_increment' && $mode != "report") {
                        if ($table == $this->table) {
                            $this->primary_ai = true;
                            if (! $this->primary_key) {
                                $this->primary_key = $row['Field'];
                            }
                        }

                        if (((! $this->show_primary_ai_column && $mode == 'list') or (! $this->show_primary_ai_field && $mode != 'list')) && ! isset($fields_object[$field_index])) {
                            if (! isset($this->field_type[$field_index])) {
                                $this->_define_field_type($row, $field_index);
                            }
                            continue;
                        } else {
                            $this->disabled[$field_index] = $this->parse_mode(false);
                        }
                    }

                    if ($this->join && isset($this->join[$table]) && $this->join[$table]['join_field'] == $row['Field']) {
                        if (! isset($this->field_type[$field_index])) {
                            $this->_define_field_type($row, $field_index);
                        }
                        continue;
                    }

                    if (! $fields_object) {
                        $fields[$field_index] = array(
                            'table' => $table,
                            'field' => $row['Field'],
                            'tab' => ''
                        );
                    } elseif ($fields_object && isset($this->reverse_fields[$mode]) && $this->reverse_fields[$mode]) {
                        if (! isset($fields_object[$field_index])) {
                            $fields[$field_index] = array(
                                'table' => $table,
                                'field' => $row['Field'],
                                'tab' => ''
                            );
                        }
                    } elseif (isset($fields_object[$field_index])) {
                        $fields[$field_index] = $fields_object[$field_index];
                    }

                    if (isset($this->relation[$field_index])) {
                        $this->field_type[$field_index] = 'relation';
                        if (! isset($this->defaults[$field_index])) {
                            $this->defaults[$field_index] = $row['Default'];
                        }
                        $this->_define_field_type($row, $field_index);
                        continue;
                    }

                    $this->_define_field_type($row, $field_index);
                }
            }

            // resorting
            if ($fields_object && (! isset($this->reverse_fields[$mode]) || ! $this->reverse_fields[$mode])) {
                $fields = array_merge($fields_object, $fields);
                if ($mode == 'list') {
                    $this->columns = $fields;
                } else {
                    $this->fields = $fields;
                }
            } else {
                if ($mode !== 'view' && $mode != 'list') {
                    $fields = array_merge($fields, $this->custom_fields);
                }

                $fk_before = array();
                if ($this->fk_relation) {
                    foreach ($this->fk_relation as $fk) {
                        $fk_before[$fk['alias']] = $fk['before'];
                    }
                }

                if ($mode == 'list') {
                    $subselect_before = $this->subselect_before;

                    foreach ($fields as $field_index => $field) {
                        // subselect
                        if ($name = array_search($field_index, $subselect_before)) {
                            if (! isset($fields_object[$name])) {
                                $fdata = $this->_parse_field_names($name, 'set_field_types');
                                $this->columns[$name] = reset($fdata);
                            }
                            unset($subselect_before[$name]);
                        }
                        if ($name = array_search($field_index, $fk_before)) {
                            if (! isset($fields_object[$name])) {
                                $fdata = $this->_parse_field_names($name, 'set_field_types');
                                $this->columns[$name] = reset($fdata);
                            }
                            unset($fk_before[$name]);
                        }
                        $this->columns[$field_index] = $field;
                    }
                    if (count($subselect_before)) {
                        foreach ($subselect_before as $name => $before) {
                            if (! isset($fields_object[$name])) {
                                $fdata = $this->_parse_field_names($name, 'set_field_types');
                                $this->columns[$name] = reset($fdata);
                            }
                            unset($subselect_before[$name]);
                        }
                    }
                    if (count($fk_before)) {
                        foreach ($fk_before as $name => $before) {
                            if (! isset($fields_object[$name])) {
                                $fdata = $this->_parse_field_names($name, 'set_field_types');
                                $this->columns[$name] = reset($fdata);
                            }
                            unset($fk_before[$name]);
                        }
                    }
                } elseif ($mode != 'create') {
                    $subselect_before = $this->subselect_before;
                    foreach ($fields as $field_index => $field) {
                        // subselect
                        if ($name = array_search($field_index, $subselect_before)) {
                            if (! isset($fields_object[$name])) {
                                $fdata = $this->_parse_field_names($name, 'set_field_types');
                                $this->fields[$name] = reset($fdata);
                            }
                            unset($subselect_before[$name]);
                        }
                        if ($name = array_search($field_index, $fk_before)) {
                            if (! isset($fields_object[$name])) {
                                $fdata = $this->_parse_field_names($name, 'set_field_types');
                                $this->fields[$name] = reset($fdata);
                            }
                            unset($fk_before[$name]);
                        }
                        $this->fields[$field_index] = $field;
                    }
                    if (count($subselect_before)) {
                        foreach ($subselect_before as $name => $before) {
                            if (! isset($fields_object[$name])) {
                                $fdata = $this->_parse_field_names($name, 'set_field_types');
                                $this->fields[$name] = reset($fdata);
                            }
                            unset($subselect_before[$name]);
                        }
                    }
                    if (count($fk_before)) {
                        foreach ($fk_before as $name => $before) {
                            if (! isset($fields_object[$name])) {
                                $fdata = $this->_parse_field_names($name, 'set_field_types');
                                $this->fields[$name] = reset($fdata);
                            }
                            unset($fk_before[$name]);
                        }
                    }
                } elseif ($fk_before) {
                    foreach ($fields as $field_index => $field) {
                        if ($name = array_search($field_index, $fk_before)) {
                            if (! isset($fields_object[$name])) {
                                $fdata = $this->_parse_field_names($name, 'set_field_types');
                                $this->fields[$name] = reset($fdata);
                            }
                            unset($fk_before[$name]);
                        }
                        $this->fields[$field_index] = $field;
                    }
                    if (count($fk_before)) {
                        foreach ($fk_before as $name => $before) {
                            if (! isset($fields_object[$name])) {
                                $fdata = $this->_parse_field_names($name, 'set_field_types');
                                $this->fields[$name] = reset($fdata);
                            }
                            unset($fk_before[$name]);
                        }
                    }
                } else {
                    $this->fields = $fields;
                }
            }

            // echo'<pre>'.print_r($fields,true).'</pre>';

            if (! $this->primary_key) {
                if ($uni)
                    $this->primary_key = $uni;
                else { // changed to prevent data rewriting
                       // $this->primary_key =
                       // $this->table_info[$this->table][0]['Field'];
                    switch ($this->task) {
                        case 'list':
                        case 'action':
                        case 'print':
                        case 'csv':
                            $this->is_edit = false;
                            $this->is_remove = false;
                            $this->is_create = false;
                            $this->is_view = false;
                            // $this->is_search = false;
                            break;
                        default:
                            self::error('<strong>Table "' . $this->table . '" has no any primary or unique key!</strong><br />
                                This error was made to prevent loss of your data.
                                You must create primary key (the best - primary autoincrement) for this table.
                                See documentation for more info.');
                            break;
                    }
                }
            }
            unset($fields);
        }
    }

    protected function _define_field_type($row, $field_index)
    {
        if (preg_match('/^([A-Za-z]+)\((.+)\)/u', $row['Type'], $matches)) {
            $type = strtolower($matches[1]);
            $max_l = $matches[2];
        } else {
            $type = strtolower($row['Type']);
            $max_l = null;
        }
        if (! isset($this->field_attr[$field_index])) {
            $this->field_attr[$field_index] = array();
        }
        if ($max_l && (! isset($this->field_attr[$field_index]['maxlength']) or ! $this->field_attr[$field_index]['maxlength'])) {
            $this->field_attr[$field_index]['maxlength'] = (int) $max_l;
        }

        switch ($type) {
            case 'tinyint':
            case 'bit':
            case 'bool':
            case 'boolean':
                if ($type == 'bit') {
                    $this->bit_field[$field_index] = 1;
                } else {
                    $this->int_field[$field_index] = 1;
                }

                if (isset($this->field_type[$field_index])) {
                    return;
                }
                if ($max_l == 1 && XcrudConfig::$make_checkbox) {
                    $this->field_type[$field_index] = 'bool';
                    if (! isset($this->defaults[$field_index]))
                        $this->defaults[$field_index] = $row['Default'];
                } else {
                    $this->field_type[$field_index] = 'int';
                    // $this->field_attr[$field_index]['maxlength'] =
                    // (int)$max_l;
                    if (! isset($this->defaults[$field_index]))
                        $this->defaults[$field_index] = $row['Default'];
                }
                break;
            case 'smallint':
            case 'mediumint':
            case 'int':
            case 'bigint':
            case 'serial':
                $this->int_field[$field_index] = 1;
                if (isset($this->field_type[$field_index])) {
                    return;
                }
                $this->field_type[$field_index] = 'int';
                // $this->field_attr[$field_index]['maxlength'] = (int)$max_l;
                if (! isset($this->defaults[$field_index]))
                    $this->defaults[$field_index] = $row['Default'];
                break;
            case 'decimal':
            case 'numeric':
            case 'float':
            case 'double':
            case 'real':
                $this->float_field[$field_index] = 1;
                if (isset($this->field_type[$field_index])) {
                    return;
                }
                $this->field_type[$field_index] = 'float';
                // if ($max_l)
                // $this->field_attr[$field_index]['maxlength'] = (int)$max_l +
                // 1;
                if (! isset($this->defaults[$field_index]))
                    $this->defaults[$field_index] = $row['Default'];
                break;
            case 'char':
            case 'varchar':
            case 'binary':
            case 'varbinary':
            default:
                $this->text_field[$field_index] = 1;
                if (isset($this->field_type[$field_index])) {
                    return;
                }
                $this->field_type[$field_index] = 'text';
                // $this->field_attr[$field_index]['maxlength'] = (int)$max_l;
                if (! isset($this->defaults[$field_index]))
                    $this->defaults[$field_index] = $row['Default'];
                break;
            case 'text':
            case 'tinytext':
            case 'mediumtext':
            case 'longtext':
                $this->text_field[$field_index] = 1;
                if (isset($this->field_type[$field_index])) {
                    return;
                }
                if (! isset($this->no_editor[$field_index]) && XcrudConfig::$auto_editor_insertion)
                    $this->field_type[$field_index] = 'texteditor';
                else
                    $this->field_type[$field_index] = 'textarea';
                if (! isset($this->defaults[$field_index]))
                    $this->defaults[$field_index] = $row['Default'];
                break;
            case 'blob':
            case 'tinyblob':
            case 'mediumblob':
            case 'longblob':
                if (isset($this->field_type[$field_index])) {
                    return;
                }
                $this->field_type[$field_index] = 'binary';
                $this->defaults[$field_index] = '';
                break;
            case 'date':
                if (isset($this->field_type[$field_index])) {
                    return;
                }
                $this->field_type[$field_index] = 'date';
                if (! isset($this->defaults[$field_index]))
                    $this->defaults[$field_index] = $row['Default'];
                break;
            case 'datetime':
            case 'timestamp':
                if (isset($this->field_type[$field_index])) {
                    return;
                }
                $this->field_type[$field_index] = 'datetime';
                if (! isset($this->defaults[$field_index])) {
                    if ($row['Default'] == 'CURRENT_TIMESTAMP') {
                        $db = Database::get_instance($this->connection, $this->ci);
                        $db->query('SELECT NOW() AS `now`');
                        $tmstmp = $db->row();
                        $this->defaults[$field_index] = $tmstmp['now'];
                    } else
                        $this->defaults[$field_index] = $row['Default'];
                }
                break;
            case 'time':
                if (isset($this->field_type[$field_index])) {
                    return;
                }
                $this->field_type[$field_index] = 'time';
                if (! isset($this->defaults[$field_index]))
                    $this->defaults[$field_index] = $row['Default'];
                break;
            case 'year':
                if (isset($this->field_type[$field_index])) {
                    return;
                }
                $this->field_type[$field_index] = 'year';
                if (! isset($this->defaults[$field_index]))
                    $this->defaults[$field_index] = $row['Default'];
                break;
            case 'enum':
                if (isset($this->field_type[$field_index])) {
                    return;
                }
                $this->field_type[$field_index] = XcrudConfig::$enum_as_radio ? 'radio' : 'select';
                $this->field_attr[$field_index]['values'] = $max_l;
                if (! isset($this->defaults[$field_index]))
                    $this->defaults[$field_index] = $row['Default'];
                break;
            case 'set':
                if (isset($this->field_type[$field_index])) {
                    return;
                }
                $this->field_type[$field_index] = XcrudConfig::$set_as_checkboxes ? 'checkboxes' : 'multiselect';
                $this->field_attr[$field_index]['values'] = $max_l;
                if (! isset($this->defaults[$field_index]))
                    $this->defaults[$field_index] = $row['Default'];
                break;
            case 'point':
                if (isset($this->field_type[$field_index])) {
                    return;
                }
                $this->field_type[$field_index] = 'point';
                $this->field_attr[$field_index] = array( // defaults
                    'text' => XcrudConfig::$default_text,
                    'search_text' => XcrudConfig::$default_search_text,
                    'zoom' => XcrudConfig::$default_zoom,
                    'width' => XcrudConfig::$default_width,
                    'height' => XcrudConfig::$default_height,
                    'search' => XcrudConfig::$default_coord,
                    'coords' => XcrudConfig::$default_search
                );
                $this->validation_pattern[$field_index] = 'point';
                if (! isset($this->defaults[$field_index]))
                    $this->defaults[$field_index] = XcrudConfig::$default_point ? XcrudConfig::$default_point : '0,0';
                break;
        }
    }

    protected function _set_column_names()
    {
        $subselect_before = $this->subselect_before;
        foreach ($this->columns as $key => $col) {
            if ($name = array_search($key, $subselect_before)) {
                $this->columns_names[$name] = $this->html_safe($this->labels[$name]);
                unset($subselect_before[$name]);
            }
            if (isset($this->column_name[$key])) {
                $this->columns_names[$key] = $this->html_safe($this->column_name[$key]);
            } elseif (isset($this->labels[$key])) {
                $this->columns_names[$key] = $this->html_safe($this->labels[$key]);
            } elseif ($this->fk_relation && isset($this->fk_relation[$key])) {
                $this->columns_names[$key] = $this->fk_relation[$key]['label'];
            } else {
                $this->columns_names[$key] = $this->html_safe($this->_humanize($col['field']));
            }
        }
        if ($subselect_before) {
            foreach ($this->subselect_before as $name => $none) {
                $this->columns_names[$name] = $this->html_safe($this->labels[$name]);
                unset($subselect_before[$name]);
            }
        }
    }

    /* ALTERADA DO PADRÃO - join_fields */
    protected function _set_field_names()
    {
        foreach ($this->fields as $key => $value) {
            $render_fields[$key] = $value;
            if (array_key_exists($key, $this->join_relation) && is_array($this->join_relation[$key]['rel_additional_fields'])) {
                foreach ($this->join_relation[$key]['rel_additional_fields'] as $k => $v) {
                    $render_fields[$k] = $v;
                }
            }
        }
        foreach ($render_fields as $key => $field) {
            if (isset($this->labels[$key])) {
                $this->fields_names[$key] = $this->html_safe($this->labels[$key]);
            } else {
                $this->fields_names[$key] = $this->html_safe($this->_humanize($field['field']));
            }
        }
    }

    protected function _render_list()
    {
        if (count($this->order_by)) {
            reset($this->order_by);
            $this->order_column = key($this->order_by);
            $this->order_direct = strtolower($this->order_by[$this->order_column]);
        } else {
            // $this->order_column = $this->table . '.' . $this->primary_key;
            // $this->order_direct = 'asc';
        }

        if ($this->column === false) {
            if ($this->search_default) {
                $this->column = $this->search_default;
            } elseif (! XcrudConfig::$search_all) {
                if ($this->search_columns) {
                    $this->column = key($this->search_columns);
                } else {
                    $this->column = key($this->columns);
                }
            }
        }
        $mode = 'list';
        $view_file = XcrudConfig::$themes_path . '/' . $this->theme . '/' . $this->load_view['list'];
        $view_file = $this->check_file($view_file, 'render');
        ob_start();
        include ($view_file);
        $this->data = ob_get_contents();
        ob_end_clean();
        return $this->render_output();
    }

    /**
     *
     * @author Ariel Canal
     *         Se a função field_callback retornar falso, rederiza o field
     *         padr�o.
     *         Mesmo com Field Calback, cria o campo.
     */
    /**
     * renders details view template
     */
    protected function _render_details($mode)
    {
        if (count($this->order_by)) {
            $order_direct = strtolower(reset($this->order_by));
            $order_column = key($this->order_by);
        } else {
            $order_column = $this->table . '.' . $this->primary_key;
            $order_direct = 'asc';
        }

        /*
         * if ($mode == 'create')
         * {
         * $this->disabled = $this->disabled_on_create;
         * $this->readonly = $this->readonly_on_create;
         * }
         * elseif ($mode == 'edit')
         * {
         * $this->disabled = $this->disabled_on_edit;
         * $this->readonly = $this->readonly_on_edit;
         * }
         */
        if (isset($this->result_row['primary_key'])) {
            $this->primary_val = $this->result_row['primary_key'];
        }
        if ($this->result_row) {
            foreach ($this->fields as $key => $value) {
                $this->fields[$key] = $value;
                if (array_key_exists($key, $this->join_relation) && is_array($this->join_relation[$key]['rel_additional_fields'])) {
                    foreach ($this->join_relation[$key]['rel_additional_fields'] as $k => $v) {
                        $this->fields[$k] = $v;
                        $temp[] = $k;
                        $parents[$k] = $key;
                        if (isset($value['tab'])) {
                            $this->fields[$k]['tab'] = $value['tab'];
                        }
                    }
                    foreach ($this->field_tabs as $k => $v) {}
                }
            }
            foreach ($this->fields as $field => $fitem) {
                if (isset($this->custom_fields[$field])) {
                    $this->result_row[$field] = $this->defaults[$field];
                }
                if ($this->field_type[$field] == 'hidden') {
                    $this->hidden_fields_output[$field] = $this->create_hidden($field, $this->result_row[$field]);
                } else {

                    if ($mode == 'view') {
                        $func = 'create_view_' . $this->field_type[$field];
                    } else {
                        $func = 'create_' . $this->field_type[$field];
                    }
                    if (isset($this->field_callback[$field]) && $mode != 'view') {
                        $path = $this->check_file($this->field_callback[$field]['path'], 'field_callback');
                        include_once ($path);
                        if (is_callable($this->field_callback[$field]['callback'])) {
                            $attr = $this->get_field_attr($field, $mode);
                            $field_default = call_user_func_array(array(
                                $this,
                                $func
                            ), array(
                                $field,
                                $this->result_row[$field],
                                $attr
                            ));
                            $field_rendered = call_user_func_array($this->field_callback[$field]['callback'], array(
                                $this->result_row[$field],
                                $field,
                                $mode,
                                $this->result_row,
                                $this,
                                $field_default
                            ));
                            if (! $field_rendered)
                                $field_rendered = call_user_func_array(array(
                                    $this,
                                    $func
                                ), array(
                                    $field,
                                    $this->result_row[$field],
                                    $attr
                                ));
                            $this->fields_output[$field] = array(
                                'label' => $this->fields_names[$field],
                                'field' => $field_rendered,
                                'name' => $field,
                                'value' => $this->result_row[$field]
                            );
                            if (array_key_exists($field, $this->exception_fields)) {
                                $this->fields_output[$field]['exception'] = $this->exception_fields[$field]['exception'];
                            }
                        }
                    } elseif (isset($this->column_callback[$field]) && $mode == 'view') {
                        $path = $this->check_file($this->column_callback[$field]['path'], 'column_callback');
                        include_once ($path);
                        if (is_callable($this->column_callback[$field]['callback']) && $this->result_row) {
                            @$field_rendered = call_user_func_array($this->column_callback[$field]['callback'], array(
                                $this->result_row[$field],
                                $field,
                                $mode,
                                $this->result_row,
                                $this
                            ));
                            if (! $field_rendered)
                                $field_rendered = call_user_func_array($this->column_callback[$field]['callback'], array(
                                    $this->result_row[$field],
                                    $field,
                                    $this->primary_val,
                                    $this->result_row,
                                    $this
                                ));
                            $this->fields_output[$field] = array(
                                'label' => $this->fields_names[$field],
                                'field' => $field_rendered,
                                'name' => $field,
                                'value' => $this->result_row[$field]
                            );
                            if (array_key_exists($field, $this->exception_fields)) {
                                $this->fields_output[$field]['exception'] = $this->exception_fields[$field]['exception'];
                            }
                        }
                    } else {
                        $attr = $this->get_field_attr($field, $mode);
                        if (isset($temp) && in_array($field, $temp)) {
                            $attr['class'] .= ' jr_additional';
                            $attr['jr-parent'] = $this->fieldname_encode($parents[$field]);
                        }
                        if (! method_exists($this, $func))
                            continue;

                        $this->fields_output[$field] = array(
                            'label' => $this->fields_names[$field],
                            'field' => call_user_func_array(array(
                                $this,
                                $func
                            ), array(
                                $field,
                                $this->result_row[$field],
                                $attr
                            )),
                            'name' => $field,
                            'value' => $this->result_row[$field]
                        );
                        if ($this->exception_fields[$field]) {
                            $this->fields_output[$field]['exception'] = $this->exception_fields[$field]['exception'];
                        }
                        if (isset($this->column_pattern[$field]) && $mode == 'view') {
                            $this->fields_output[$field]['field'] = str_ireplace('{value}', $this->fields_output[$field]['field'], $this->column_pattern[$field]);
                            $this->fields_output[$field]['field'] = $this->replace_text_variables($this->fields_output[$field]['field'], $this->result_row, true);
                        }
                    }
                }
            }
        }

        if ($this->inner_table_instance && ($mode == 'view' or $mode == 'edit')) // restoring
                                                                                  // nested
                                                                                  // objects
        {
            foreach ($this->inner_table_instance as $inst_name => $field) {
                if (isset($this->result_row[$field])) {
                    $instance = self::get_instance($inst_name, $this->ci);
                    $instance->ajax_request = true;
                    $instance->import_vars();
                    $instance->inner_where($this->result_row[$field]);
                    if ($mode == 'view' && $this->nested_readonly_on_view && ! $instance->table_always_edit_mode) {

                        $instance->table_ro = true;
                    } else {
                        $instance->table_ro = false;
                    }
                    $this->nested_rendered[$instance->table_name] = '<div class="xcrud-nested-container xcrud-container"><div class="xcrud-ajax" id="xcrud-ajax-' . base_convert(rand(), 10, 36) . '">' . $instance->render($instance->nested_default_render, $instance->nested_default_render_primary) . '</div></div>';
                }
            }
        }

        $view_file = XcrudConfig::$themes_path . '/' . $this->theme . '/' . $this->load_view[$mode];
        $view_file = $this->check_file($view_file, 'render');
        ob_start();
        include ($view_file);
        $this->data = $this->render_search_hidden() . ob_get_contents();
        ob_end_clean();
        /*
         * if ($this->inner_table_instance && ($mode == 'view' or $mode ==
         * 'edit')) // restoring nested objects
         * {
         * foreach ($this->inner_table_instance as $inst_name => $field)
         * {
         * if (isset($this->result_row[$field]))
         * {
         * $instance = self::get_instance($inst_name);
         * $instance->ajax_request = true;
         * $instance->import_vars();
         * $instance->inner_where($this->result_row[$field]);
         * if ($mode == 'view' && XcrudConfig::$nested_readonly_on_view)
         * {
         * $instance->table_ro = true;
         * }
         * else
         * {
         * $instance->table_ro = false;
         * }
         * //$this->data .= '<div class="xcrud-nested-container
         * xcrud-container"><div class="xcrud-ajax" id="xcrud-ajax-' .
         * // base_convert(rand(), 10, 36) . '">' . $instance->render('list') .
         * '</div></div>';
         * $this->nested_rendered[$inst_name] = '<div
         * class="xcrud-nested-container xcrud-container"><div
         * class="xcrud-ajax" id="xcrud-ajax-' .
         * base_convert(rand(), 10, 36) . '">' . $instance->render('list') .
         * '</div></div>';
         * }
         * }
         * }
         */
        if ($this->nested_rendered) {
            $this->data .= implode('', $this->nested_rendered);
        }
        return $this->render_output();
    }

    /**
     * defines nested main condition, must be public.
     * Only for internal usage.
     */
    public function inner_where($value = false)
    {
        if ($value !== false) {
            $this->inner_value = $value;
        }
        // nested table connection
        if ($this->is_inner && $this->inner_where) {
            $field = reset($this->inner_where);
            $this->where_pri($field, $this->inner_value, 'AND', 'nstd_tbl');
            $this->pass_default($field, $this->inner_value);
        }
    }

    protected function _pagination($total, $start, $limit, $numpos = 10, $numlr = 2)
    {
        if ($total > $limit) {
            $pages = ceil($total / $limit);
            $curent = ceil(($start + $limit) / $limit);
            $links = array();
            /*
             * for ($i = 1; $i <= $pages; ++$i)
             * {
             * $limit1 = $i * $limit - $limit;
             * if ($i == $curent)
             * $links[$i] = '<li class="' .
             * $this->theme_config('pagination_active') . '"><span>' . $i .
             * '</span></li>';
             * else
             * {
             * $links[$i] = '<li class="' .
             * $this->theme_config('pagination_item') .
             * '"><a href="javascript:;" class="xcrud-action" data-start="' .
             * $limit1 . '">' . $i . '</a></li>';
             * }
             * }
             */
            $html = '<ul class="' . $this->theme_config('pagination_container') . '">';
            if ($pages > $numpos) {

                if ($curent <= $numlr + 3) {
                    for ($i = 1; $i <= $numpos - $numlr - 1; ++ $i) {
                        $html .= $this->_pagination_item($i, $curent, $limit);
                    }
                    $html .= '<li class="' . $this->theme_config('pagination_dots') . '"><a class="' . $this->theme_config('pagination_link') . '">&#133;</a></li>';
                    for ($i = $pages - $numlr + 1; $i <= $pages; ++ $i) {
                        $html .= $this->_pagination_item($i, $curent, $limit);
                    }
                } else if ($curent >= $pages - $numlr - 2) {
                    for ($i = 1; $i <= $numlr; ++ $i) {
                        $html .= $this->_pagination_item($i, $curent, $limit);
                    }
                    $html .= '<li class="' . $this->theme_config('pagination_dots') . '"><a class="' . $this->theme_config('pagination_link') . '">&#133;</a></li>';
                    for ($i = $pages - $numpos + $numlr + 2; $i <= $pages; ++ $i) {
                        $html .= $this->_pagination_item($i, $curent, $limit);
                    }
                } else {
                    for ($i = 1; $i <= $numlr; ++ $i) {
                        $html .= $this->_pagination_item($i, $curent, $limit);
                    }
                    $html .= '<li class="' . $this->theme_config('pagination_dots') . '"><a class="' . $this->theme_config('pagination_link') . '">&#133;</a></li>';
                    $offset = floor(($numpos - $numlr - $numlr - 1) / 2);
                    for ($i = $curent - $offset; $i <= $curent + $offset; ++ $i) {
                        $html .= $this->_pagination_item($i, $curent, $limit);
                    }

                    $html .= '<li class="' . $this->theme_config('pagination_dots') . '"><a class="' . $this->theme_config('pagination_link') . '">&#133;</a></li>';
                    for ($i = $pages - $numlr + 1; $i <= $pages; ++ $i) {
                        $html .= $this->_pagination_item($i, $curent, $limit);
                    }
                }
            } else {
                // $html .= implode('', $links);
                for ($i = 1; $i <= $pages; ++ $i) {
                    $html .= $this->_pagination_item($i, $curent, $limit);
                }
            }
            $html .= '</ul>';
            return $html;
        }
    }

    protected function _pagination_item($i, $curent, $limit)
    {
        $limit1 = $i * $limit - $limit;
        if ($i == $curent)
            return '<li class="' . $this->theme_config('pagination_active') . '"><a href="javascript:;" class="' . $this->theme_config('pagination_link') . '" aria-current="page" data-start="' . $limit1 . '">' . $i . '</a></li>';
        else {
            return '<li class="' . $this->theme_config('pagination_item') . '"><a href="javascript:;" class="xcrud-action ' . $this->theme_config('pagination_link') . '" data-start="' . $limit1 . '">' . $i . '</a></li>';
        }
    }

    protected function _cut($string, $field, $wordsafe = true, $dots = true)
    {
        if (isset($this->column_cut_list[$field])) {
            $len = $this->column_cut_list[$field]['count'];
            $safe = $this->column_cut_list[$field]['safe'];
        } else {
            $len = $this->column_cut;
            $safe = $this->safe_output;
        }

        if (! is_null($string)) {
            $string = html_entity_decode($string, ENT_QUOTES, \Config\App::$charset);
        }

        if (! $len) {
            return $this->output_string($string, $this->strip_tags, $safe);
        }
        if (! is_null($string)) {
            $strip_string = trim(strip_tags($string));
        }

        $slen = mb_strlen($strip_string, \Config\App::$charset);
        if ($slen <= $len || (XcrudConfig::$print_full_texts && $this->theme == 'printout')) {
            return $this->output_string($string, $this->strip_tags, $safe);
        }
        if ($wordsafe) {
            $end = $len;
            while ((mb_substr($strip_string, -- $len, 1, \Config\App::$charset) != ' ') && ($len > 0)) {}
            if ($len == 0) {
                $len = $end;
            }
            return $this->output_string(mb_substr($strip_string, 0, $len, \Config\App::$charset), false, $safe) . ($dots ? '&#133;' : '');
        }
        return $this->output_string(mb_substr($strip_string, 0, $len, \Config\App::$charset), false, $safe) . ($dots ? '&#133;' : '');
    }

    protected function output_string($string, $strip, $safe)
    {
        if ($strip) {
            $string = strip_tags($string);
        }
        if ($safe) {
            $string = $this->html_safe($string);
        }
        return $string;
    }

    protected function _humanize($text)
    {
        return mb_convert_case(str_replace('_', ' ', $text), MB_CASE_TITLE, \Config\App::$charset);
    }

    protected function _regenerate_key()
    {
        switch ($this->task) {
            case 'file':
            case 'depend':
            case 'print':
            case 'csv':
            case 'upload':
            case 'remove_upload':
            case 'crop_image':
            case 'unique':
                break;
            default:
                $this->key = sha1(microtime() . rand());
                break;
        }
    }

    public function _export_vars()
    {
        $inst_name = $this->instance_name;
        $this->time = $time = time();

        $xcrud_session = $this->ci->session->userdata('xcrud_session');

        // session auto-clearing, must start on first instance
        if ($this->instance_count == 1 && ! $this->ajax_request) {
            if (isset($xcrud_session) && $xcrud_session) {
                foreach ($xcrud_session as $s_key => $s_val) {
                    // workaround on some servers session duplication
                    $old_time = isset($s_val['time']) ? (int) $s_val['time'] : 0;
                    if ($time > $old_time + XcrudConfig::$autoclean_timeout) {
                        // autocleaner
                        unset($xcrud_session[$s_key]);
                    }
                }
            }
        }
        $this->condition_restore();

        foreach ($this->params2save() as $item) {
            $xcrud_session[$inst_name][$item] = $this->{$item};
        }
        $xcrud_session[$inst_name]['before'] = $this->find_prev_task();

        $this->ci->session->set_userdata('xcrud_session', $xcrud_session);
        if (XcrudConfig::$alt_session) {
            $data = $this->encrypt($_SESSION['lists']['xcrud_session']);

            if (class_exists('Memcache')) {
                $mc = new Memcache();
                $mc->connect(XcrudConfig::$mc_host, XcrudConfig::$mc_port);
                $res = $mc->set(self::$sess_id, $data, false, XcrudConfig::$alt_lifetime * 60);
            } elseif (class_exists('Memcached')) {
                $mc = new Memcached();
                $mc->connect(XcrudConfig::$mc_host, XcrudConfig::$mc_port);
                $res = $mc->set(self::$sess_id, $data, XcrudConfig::$alt_lifetime * 60);
            } else {
                self::error('Can\'t use alternative session. Memcache(d) is not available');
            }
            unset($_SESSION['lists']['xcrud_session']);
            if (! $res) {
                self::error('Can\'t use alternative session. Memcache(d) has invalid parameters or broken. Storing failed');
            }
        }
    }

    protected function params2save()
    {
        return array(
            'key',
            'time',
            'table',
            'table_name',
            'where',
            'order_by',
            'relation',
            'fields_create',
            'fields_edit',
            'fields_view',
            'fields_list',
            'columns_select',
            'fields_list_default',
            'labels',
            'columns_names',
            'is_create',
            'is_edit',
            'is_remove',
            'is_csv',
            'buttons',
            'validation_required',
            'validation_pattern',
            'before_insert',
            'before_update',
            'before_remove',
            'after_insert',
            'after_update',
            'after_remove',
            'field_type',
            'field_attr',
            'limit',
            'limit_list',
            'column_cut',
            'column_cut_list',
            'no_editor',
            'show_primary_ai_field',
            'show_primary_ai_column',
            'disabled',
            'readonly',
            'benchmark',
            'search_pattern',
            'connection',
            'remove_confirm',
            'upload_folder',
            'upload_config',
            'pass_var',
            'reverse_fields',
            'no_quotes',
            'inner_table_instance',
            'inner_where',
            'unique',
            'theme',
            'is_duplicate',
            'links_label',
            'emails_label',
            'sum',
            'alert_create',
            'alert_edit',
            'is_search',
            'is_print',
            'is_pagination',
            'is_limitlist',
            'is_sortable',
            'is_list',
            'subselect',
            'subselect_before',
            'subselect_query',
            'highlight',
            'highlight_row',
            'modal',
            'column_class',
            'no_select',
            'is_inner',
            'join',
            'fk_relation',
            'is_title',
            'is_numbers',
            'language',
            'field_params',
            'mass_alert_create',
            'mass_alert_edit',
            'column_callback',
            'field_callback',
            'replace_insert',
            'replace_update',
            'replace_remove',
            'send_external_create',
            'send_external_edit',
            'column_pattern',
            'field_tabs',
            'field_marker',
            'is_view',
            'field_tooltip',
            'table_tooltip',
            'column_tooltip',
            'search_columns',
            'search_default',
            'column_width',
            'before',
            'before_upload',
            'after_upload',
            'after_resize',
            'custom_vars',
            'tabdesc',
            'column_name',
            'upload_to_save',
            'upload_to_remove',
            'defaults',
            'search',
            'inner_value',
            'bit_field',
            'point_field',
            'buttons_position',
            'grid_condition',
            'condition',
            'hide_button',
            'set_lang',
            'table_ro',
            'grid_restrictions',
            'load_view',
            'action',
            'prefix',
            'query',
            'default_tab',
            'strip_tags',
            'safe_output',
            'before_list',
            'before_create',
            'before_edit',
            'before_view',
            'lists_null_opt',
            'custom_fields',
            'date_format',
            'alphabetical_filter',
            'alphabetical_field',
            'alphabetical_index',
            'custom_filter',
            'custom_filter_active',
            'custom_filter_all_label',
            'totalizers',
            'start_minimized',
            'nested_readonly_on_view',
            'active_tab_id',
            'parent',
            'table_always_edit_mode',
            'record_changes',
            'custom_lists',
            'custom_lists_active',
            'custom_lists_static',
            'columns_default',
            'unset_custom_columns',
            'mass_actions',
            'opened_tab',
            'nested_default_render',
            'nested_default_render_primary',
            'join_relation',
            'parameters',
            'fields_report',
            'report',
            'report_reverse',
            'report_tabs',
            'report_values',
            'group_by',
            'search_lines',
            'search_submit',
            'custom_buttons'
        );
    }

    protected function find_prev_task()
    {
        switch ($this->task) {
            case 'create':
            case 'view':
            case 'edit':
            case 'list':
                return $this->task;
                break;
            case '':
                return 'list';
                break;
            default:
                return ($this->before ? $this->before : 'list');
                break;
        }
    }

    public function import_vars($key = false)
    {
        if (XcrudConfig::$alt_session) {
            if (class_exists('Memcache')) {
                $mc = new Memcache();
                $mc->connect(XcrudConfig::$mc_host, XcrudConfig::$mc_port);
                $data = $mc->get(self::$sess_id);
            } elseif (class_exists('Memcached')) {
                $mc = new Memcached();
                $mc->connect(XcrudConfig::$mc_host, XcrudConfig::$mc_port);
                $data = $mc->get(self::$sess_id);
            } else {
                self::error('Can\'t use alternative session. Memcache(d) is not available');
            }
            if (! $data) {
                self::error('Can\'t use alternative session. Data is not exist');
            }
            $_SESSION['lists']['xcrud_session'] = $this->decrypt($data[0], $data[1]);
            unset($data);
            if (! $_SESSION['lists']['xcrud_session']) {
                self::error('Can\'t use alternative session. Data is invalid');
            }
        }

        $inst_name = $this->instance_name;
        $this->ci = &get_instance();
        $xcrud_session = $this->ci->session->userdata('xcrud_session');
        foreach ($this->params2save() as $item) {
            /**
             *
             * @author Ariel Canal
             *         O original contém um erro de
             *         lógica. Caso o atributo desejado não esteja armazenado
             *         na sessão, ele atribui NULL no atributo da classe,
             *         fazendo com que a instância não funcione
             *         e apresente o erro: Incorrect table name '' SHOW COLUMNS FROM ``
             *         Correção: Só sobrescreve o atributo inicial pelo da
             *         sessão, caso este exista, na sessão.
             */
            if (isset($xcrud_session[$inst_name][$item])) {
                $this->{$item} = $xcrud_session[$inst_name][$item];
            }
        }
        if ($key) {
            $this->key = $key;
        }
    }

    protected function get_field_attr($name, $mode)
    {
        $tag = array(
            'class' => 'xcrud-input',
            'name' => $this->fieldname_encode($name),
            'id' => $this->fieldname_encode($name)
        );
        if (! empty($this->field_attr[$name]['class'])) {
            $tag['class'] .= ' ' . $this->field_attr[$name]['class'];
        }
        if (isset($this->validation_required[$name])) {
            $tag['data-required'] = $this->validation_required[$name];
            $tag['required'] = 'required';
        }
        if (isset($this->exception_fields[$name])) {
            $tag['class'] .= ' ' . $this->theme_config('validation_error_field');
        }
        if (isset($this->validation_pattern[$name])) {
            $tag['data-pattern'] = $this->validation_pattern[$name];
        }
        if (isset($this->readonly[$name][$mode])) {
            $tag['readonly'] = '';
        }
        if (isset($this->disabled[$name][$mode])) {
            $tag['disabled'] = '';
        }
        if (isset($this->unique[$name])) {
            $tag['data-unique'] = '';
        }
        if (isset($this->relation[$name]['depend_on']) && $this->relation[$name]['depend_on']) {
            $tag['data-depend'] = $this->relation[$name]['depend_on'];
        }
        return $tag;
    }

    protected function create_none($name, $value = '', $tag = array())
    {
        return '<span class="xcrud-none">' . $value . '</span>';
    }

    protected function create_view_none($name, $value = '')
    {
        return '<span class="xcrud-none">' . $value . '</span>';
    }

    protected function create_bool($name, $value = '', $tag = array())
    {
        if (isset($this->subselect[$name])) {
            return $this->create_view_bool($name, $value);
        }
        $tag = $tag + array(
            'tag' => 'input',
            'type' => 'checkbox',
            'data-type' => 'bool',
            'value' => 1
        );
        if ($value) {
            $tag['checked'] = '';
        }
        $out = '';

        $out .= $this->open_tag('div', $this->theme_config('bool_container'));
        $out .= $this->single_tag($tag, $this->theme_config('bool_field'), $this->field_attr[$name]);
        $out .= $this->single_tag('label', $this->theme_config('bool_label'));
        $out .= $this->close_tag('div');

        return $out;
    }

    protected function create_view_bool($name, $value = '', $tag = array())
    {
        return (int) $value ? $this->lang('bool_on') : $this->lang('bool_off');
    }

    protected function create_int($name, $value = '', $tag = array())
    {
        if (isset($this->subselect[$name])) {
            return $this->create_view_int($name, $value);
        }
        $tag = $tag + array(
            'tag' => 'input',
            'type' => 'text',
            'data-type' => 'int',
            'value' => $value,
            'data-pattern' => 'integer'
        );

        return $this->single_tag($tag, $this->theme_config('int_field'), $this->field_attr[$name]);
    }

    protected function create_view_int($name, $value = '', $tag = array())
    {
        return $value;
    }

    protected function create_float($name, $value = '', $tag = array())
    {
        if (isset($this->subselect[$name])) {
            return $this->create_view_float($name, $value);
        }
        $tag = $tag + array(
            'tag' => 'input',
            'type' => 'text',
            'data-type' => 'float',
            'value' => $value,
            'data-pattern' => 'numeric'
        );

        return $this->single_tag($tag, $this->theme_config('float_field'), $this->field_attr[$name]);
    }

    protected function create_view_float($name, $value = '', $tag = array())
    {
        return $value;
    }

    protected function create_price($name, $value = '', $tag = array())
    {
        if (isset($this->subselect[$name])) {
            return $this->create_view_price($name, $value);
        }
        $tag = $tag + array(
            'tag' => 'input',
            'type' => 'text',
            'data-type' => 'price',
            'value' => $this->cast_number_format($value, $name, true),
            'data-plugin' => 'currency',
            'data-prefix' => $this->field_attr[$name]['prefix'],
            'data-thousands' => $this->field_attr[$name]['separator'],
            'data-decimal' => $this->field_attr[$name]['point']
        );

        return $this->single_tag($tag, $this->theme_config('price_field'), $this->field_attr[$name]);
    }

    protected function create_view_price($name, $value = '', $tag = array())
    {
        $out = '';
        $out .= $this->cast_number_format($value, $name);
        return $out;
    }

    protected function create_number($name, $value = '', $tag = array())
    {
        if (isset($this->subselect[$name])) {
            return $this->create_view_text($name, $value);
        }
        $tag = $tag + array(
            'tag' => 'input',
            'type' => 'number',
            'data-type' => 'text',
            'value' => $value
        );

        return $this->single_tag($tag, $this->theme_config('text_field'), $this->field_attr[$name]);
    }

    protected function create_view_number($name, $value = '', $tag = array())
    {
        return $value;
    }

    protected function create_tel($name, $value = '', $tag = array())
    {
        if (isset($this->subselect[$name])) {
            return $this->create_view_text($name, $value);
        }
        $tag = $tag + array(
            'tag' => 'input',
            'type' => 'tel',
            'data-type' => 'text',
            'value' => $value
        );

        return $this->single_tag($tag, $this->theme_config('text_field'), $this->field_attr[$name]);
    }

    protected function create_view_tel($name, $value = '', $tag = array())
    {
        return $value;
    }

    protected function create_email($name, $value = '', $tag = array())
    {
        if (isset($this->subselect[$name])) {
            return $this->create_view_text($name, $value);
        }
        $tag = $tag + array(
            'tag' => 'input',
            'type' => 'email',
            'data-type' => 'text',
            'value' => $value
        );

        return $this->single_tag($tag, $this->theme_config('text_field'), $this->field_attr[$name]);
    }

    protected function create_view_email($name, $value = '', $tag = array())
    {
        if (XcrudConfig::$clickable_list_links) {
            $value = $this->make_links($value);
            $value = $this->make_mailto($value);
        }
        return $value;
    }

    protected function create_text($name, $value = '', $tag = array())
    {
        if (isset($this->subselect[$name])) {
            return $this->create_view_text($name, $value);
        }
        $tag = $tag + array(
            'tag' => 'input',
            'type' => 'text',
            'data-type' => 'text',
            'value' => $value
        );

        return $this->single_tag($tag, $this->theme_config('text_field'), $this->field_attr[$name]);
    }

    protected function create_view_text($name, $value = '', $tag = array())
    {
        if (XcrudConfig::$clickable_list_links) {
            $value = $this->make_links($value);
            $value = $this->make_mailto($value);
        }
        return $value;
    }

    /**
     *
     * @author Ariel Canal
     *         Caso o campo esteja desabilitado, renderiza em modo view.
     */
    protected function create_textarea($name, $value = '', $tag = array())
    {
        if (isset($this->subselect[$name]) || isset($this->disabled[$name][$this->task])) {
            return $this->create_view_textarea($name, $value);
        }
        $tag = $tag + array(
            'tag' => 'textarea',
            'data-type' => 'textarea'
        );

        return $this->open_tag($tag, $this->theme_config('textarea_field'), $this->field_attr[$name], true) . $this->html_safe($value) . $this->close_tag($tag);
    }

    protected function create_view_textarea($name, $value = '', $tag = array())
    {
        return $value;
    }

    /**
     *
     * @author Ariel Canal
     *         Caso o campo esteja desabilitado, renderiza em modo view.
     */
    protected function create_texteditor($name, $value = '', $tag = array())
    {
        if (isset($this->subselect[$name]) || isset($this->disabled[$name][$this->task])) {
            return $this->create_view_texteditor($name, $value, $tag = array());
        }
        $tag = $tag + array(
            'tag' => 'textarea',
            'data-type' => 'texteditor',
            'id' => 'editor_' . base_convert(rand(), 10, 36)
        );
        $tag['class'] .= ' xcrud-texteditor';

        return $this->open_tag($tag, $this->theme_config('texteditor_field'), $this->field_attr[$name], true) . $this->html_safe($value) . $this->close_tag($tag);
    }

    protected function create_view_texteditor($name, $value = '', $tag = array())
    {
        return $value;
    }

    protected function create_date($name, $value = '', $tag = array())
    {
        if (isset($this->subselect[$name])) {
            return $this->create_view_date($name, $value, $tag = array());
        }
        $tag = $tag + array(
            'tag' => 'input',
            'type' => 'text',
            'data-type' => 'date',
            'value' => $this->mysql2date($value)
        );
        $tag['class'] .= ' xcrud-datepicker';

        $r = isset($this->field_attr[$name]) ? $this->field_attr[$name] : '';
        if ($r) {
            if (isset($r['range_end'])) {
                $fdata = $this->_parse_field_names($r['range_end'], 'create_date');
                $tag['data-rangeend'] = key($fdata) /*$fdata[0]['table'] . '.' . $fdata[0]['field']*/;
            }
            if (isset($r['range_start'])) {
                $fdata = $this->_parse_field_names($r['range_start'], 'create_date');
                $tag['data-rangestart'] = key($fdata) /*$fdata[0]['table'] . '.' . $fdata[0]['field']*/;
            }
        }
        return $this->single_tag($tag, $this->theme_config('date_field'), $this->field_attr[$name]);
    }

    protected function create_view_date($name, $value = '', $tag = array())
    {
        return $this->mysql2date($value);
    }

    protected function create_datetime($name, $value = '', $tag = array())
    {
        if (isset($this->subselect[$name])) {
            return $this->create_view_datetime($name, $value, $tag = array());
        }
        $tag = $tag + array(
            'tag' => 'input',
            'type' => 'text',
            'data-type' => 'datetime',
            'value' => $this->mysql2datetime($value)
        );
        $tag['class'] .= ' xcrud-datepicker';

        return $this->single_tag($tag, $this->theme_config('datetime_field'), $this->field_attr[$name]);
    }

    protected function create_view_datetime($name, $value = '', $tag = array())
    {
        return $this->mysql2datetime($value);
    }

    protected function create_timestamp($name, $value = '', $tag = array())
    {
        if (isset($this->subselect[$name])) {
            return $this->create_view_timestamp($name, $value, $tag = array());
        }
        $tag = $tag + array(
            'tag' => 'input',
            'type' => 'text',
            'data-type' => 'timestamp',
            'value' => $this->mysql2datetime($value)
        );
        $tag['class'] .= ' xcrud-datepicker';

        return $this->single_tag($tag, $this->theme_config('timestamp_field'), $this->field_attr[$name]);
    }

    protected function create_view_timestamp($name, $value = '', $tag = array())
    {
        return $this->mysql2datetime($value);
    }

    protected function create_time($name, $value = '', $tag = array())
    {
        if (isset($this->subselect[$name])) {
            return $this->create_view_time($name, $value, $tag);
        }
        $tag = $tag + array(
            'tag' => 'input',
            'type' => 'text',
            'data-type' => 'time',
            'value' => $this->mysql2time($value)
        );
        $tag['class'] .= ' xcrud-datepicker';

        return $this->single_tag($tag, $this->theme_config('time_field'), $this->field_attr[$name]);
    }

    protected function create_view_time($name, $value = '', $tag = array())
    {
        return $this->mysql2time($value);
    }

    protected function create_year($name, $value = '', $tag = array())
    {
        if (isset($this->subselect[$name])) {
            return $this->create_view_year($name, $value, $tag);
        }
        $tag = $tag + array(
            'tag' => 'input',
            'type' => 'text',
            'data-type' => 'year',
            'value' => (int) $value
        );
        $tag['class'] .= ' xcrud-datepicker';

        return $this->single_tag($tag, $this->theme_config('year_field'), $this->field_attr[$name]);
    }

    protected function create_view_year($name, $value = '', $tag = array())
    {
        return $value;
    }

    protected function create_select($name, $value = '', $tag = array())
    {
        if (isset($this->subselect[$name])) {
            return $this->create_view_select($name, $value, $tag);
        }
        $out = '';
        $tag = $tag + array(
            'tag' => 'select',
            'data-type' => 'select'
        );

        $out .= $this->open_tag($tag, $this->theme_config('select_field'), $this->field_attr[$name]);

        if (is_array($this->field_attr[$name]['values'])) {
            foreach ($this->field_attr[$name]['values'] as $optkey => $opt) {
                if (is_array($opt)) {
                    $out .= $this->open_tag(array(
                        'tag' => 'optgroup',
                        'label' => $optkey
                    ));
                    foreach ($opt as $k_key => $k_opt) {
                        $opt_tag = array(
                            'tag' => 'option',
                            'value' => $k_key
                        );
                        if ($k_key == $value) {
                            $opt_tag['selected'] = '';
                        }
                        $out .= $this->open_tag($opt_tag) . $this->html_safe($k_opt) . $this->close_tag($opt_tag);
                    }
                    $out .= $this->close_tag('optgroup');
                } else {
                    $opt_tag = array(
                        'tag' => 'option',
                        'value' => $optkey
                    );
                    if ($optkey == $value) {
                        $opt_tag['selected'] = '';
                    }
                    $out .= $this->open_tag($opt_tag) . $this->html_safe($opt) . $this->close_tag($opt_tag);
                }
            }
        } else {
            $tmp = $this->parse_comma_separated($this->field_attr[$name]['values']);
            foreach ($tmp as $opt) {
                $opt = trim($opt, '\'');
                $opt_tag = array(
                    'tag' => 'option',
                    'value' => $opt
                );
                if ($opt == $value) {
                    $opt_tag['selected'] = '';
                }
                $out .= $this->open_tag($opt_tag) . $this->html_safe($opt) . $this->close_tag($opt_tag);
            }
        }
        $out .= $this->close_tag($tag);
        return $out;
    }

    protected function create_radio($name, $value = '', $tag = array())
    {
        if (isset($this->subselect[$name])) {
            return $this->create_view_radio($name, $value, $tag);
        }
        $out = '';
        $tag = $tag + array(
            'tag' => 'input',
            'type' => 'radio',
            'data-type' => 'radio'
        );

        $label_tag = array(
            'tag' => 'label',
            'class' => 'xcrud-radio-label'
        );

        if (is_array($this->field_attr[$name]['values'])) {
            foreach ($this->field_attr[$name]['values'] as $optkey => $opt) {
                $out .= $this->open_tag('div', $this->theme_config('radio_container')) . $this->open_tag($label_tag);
                $attr = array(
                    'value' => $optkey
                );
                if ($optkey == $value) {
                    $attr['checked'] = '';
                }
                $out .= $this->single_tag($tag, $this->theme_config('radio_field'), array_merge($this->field_attr[$name], $attr));
                $out .= $this->html_safe($opt) . $this->close_tag($label_tag) . $this->close_tag('div');
            }
        } else {
            $tmp = $this->parse_comma_separated($this->field_attr[$name]['values']);
            foreach ($tmp as $opt) {
                $opt = trim(trim($opt, '\''));
                $out .= $this->open_tag('div', $this->theme_config('radio_container')) . $this->open_tag($label_tag);
                $attr = array(
                    'value' => $opt
                );
                if ($opt == $value) {
                    $attr['checked'] = '';
                }
                $out .= $this->single_tag($tag, $this->theme_config('radio_field'), array_merge($this->field_attr[$name], $attr));
                $out .= $this->html_safe($opt) . $this->close_tag($label_tag) . $this->close_tag('div');
            }
        }
        $out .= $this->close_tag($tag);
        return $out;
    }

    protected function create_view_select($name, $value = '', $tag = array())
    {
        if (is_array($this->field_attr[$name]['values'])) {
            if (is_array(reset($this->field_attr[$name]['values']))) {
                foreach ($this->field_attr[$name]['values'] as $tmp) {
                    if (isset($tmp[$value])) {
                        return $tmp[$value];
                    }
                }
            } else {
                if (isset($this->field_attr[$name]['values'][$value])) {
                    return $this->field_attr[$name]['values'][$value];
                }
            }
        } else {
            return $value;
        }
    }

    protected function create_view_radio($name, $value = '', $tag = array())
    {
        return $this->create_view_select($name, $value, $tag);
    }

    protected function create_multiselect($name, $value = '', $tag = array())
    {
        if (isset($this->subselect[$name])) {
            return $this->create_view_multiselect($name, $value, $tag);
        }
        $out = '';
        $values = $this->parse_comma_separated($value);
        $tag = $tag + array(
            'tag' => 'select',
            'data-type' => 'select',
            'multiple' => ''
        );

        if (is_array($this->field_attr[$name]['values'])) {
            if (is_array(reset($this->field_attr[$name]['values']))) {
                $size = 0;
                foreach ($this->field_attr[$name]['values'] as $tmp) {
                    $size += (count($tmp) + 1);
                }
            } else {
                $size = count($this->field_attr[$name]['values']);
            }
        } else {
            $tmp = $this->parse_comma_separated($this->field_attr[$name]['values']);
            $size = count($tmp);
        }
        $tag['size'] = $size > 10 ? 10 : $size;

        $out .= $this->open_tag($tag, $this->theme_config('multiselect_field'), $this->field_attr[$name]);

        if (is_array($this->field_attr[$name]['values'])) {
            foreach ($this->field_attr[$name]['values'] as $optkey => $opt) {
                if (is_array($opt)) {
                    $out .= $this->open_tag(array(
                        'tag' => 'optgroup',
                        'label' => $optkey
                    ));
                    foreach ($opt as $k_key => $k_opt) {
                        $opt_tag = array(
                            'tag' => 'option',
                            'value' => $k_key
                        );
                        if (in_array($k_key, $values)) {
                            $opt_tag['selected'] = '';
                        }
                        $out .= $this->open_tag($opt_tag) . $this->html_safe($k_opt) . $this->close_tag($opt_tag);
                    }
                    $out .= $this->close_tag('optgroup');
                } else {
                    $opt_tag = array(
                        'tag' => 'option',
                        'value' => $optkey
                    );
                    if (in_array($optkey, $values)) {
                        $opt_tag['selected'] = '';
                    }
                    $out .= $this->open_tag($opt_tag) . $this->html_safe($opt) . $this->close_tag($opt_tag);
                }
            }
        } else {
            $tmp = $this->parse_comma_separated($this->field_attr[$name]['values']);
            foreach ($tmp as $opt) {
                $opt = trim(trim($opt, '\''));
                $opt_tag = array(
                    'tag' => 'option',
                    'value' => $opt
                );
                if (in_array($opt, $values)) {
                    $opt_tag['selected'] = '';
                }
                $out .= $this->open_tag($opt_tag) . $this->html_safe($opt) . $this->close_tag($opt_tag);
            }
        }
        $out .= $this->close_tag($tag);
        return $out;
    }

    protected function create_checkboxes($name, $value = '', $tag = array())
    {
        if (isset($this->subselect[$name])) {
            return $this->create_view_checkboxes($name, $value, $tag);
        }
        $out = '';
        $values = $this->parse_comma_separated($value);
        $tag = $tag + [
            'tag' => 'input',
            'type' => 'checkbox'
        ];

        $label_tag = [
            'tag' => 'label'
        ];

        if (! is_array($this->field_attr[$name]['values'])) {
            $this->field_attr[$name]['values'] = $this->parse_comma_separated($this->field_attr[$name]['values']);
        }
        foreach ($this->field_attr[$name]['values'] as $optkey => $opt) {
            $opt = trim(trim($opt, '\''));
            $out .= $this->open_tag('div', $this->theme_config('checkboxes_container'));

            /* INPUT */
            $attr = array(
                'value' => $opt,
                'id' => $optkey
            );
            if (in_array($opt, $values)) {
                $attr['checked'] = '';
            }
            $out .= $this->single_tag($tag, $this->theme_config('checkboxes_field'), array_merge($this->field_attr[$name], $attr));

            /* LABEL */
            $out .= $this->open_tag($label_tag, $this->theme_config('checkboxes_label'), [
                'for' => $optkey
            ]);
            $out .= $this->html_safe($opt);
            $out .= $this->close_tag($label_tag);

            $out .= $this->close_tag('div');
        }
        return $out;
    }

    protected function create_view_multiselect($name, $value = '', $tag = array())
    {
        $out = array();
        $values = $this->parse_comma_separated($value);
        foreach ($values as $val) {
            if (is_array($this->field_attr[$name]['values'])) {
                if (is_array(reset($this->field_attr[$name]['values']))) {
                    foreach ($this->field_attr[$name]['values'] as $tmp) {
                        if (isset($tmp[$val])) {
                            $out[] = $tmp[$val];
                        }
                    }
                } else {
                    if (isset($this->field_attr[$name]['values'][$val])) {
                        $out[] = $this->field_attr[$name]['values'][$val];
                    }
                }
            } else {
                $out[] = $val;
            }
        }
        return implode(', ', $out);
    }

    protected function create_view_checkboxes($name, $value = '', $tag = array())
    {
        return $this->create_view_multiselect($name, $value, $tag);
    }

    protected function create_hidden($name, $value = '', $tag = array())
    {
        return $this->single_tag($tag + array(
            'tag' => 'input',
            'type' => 'hidden',
            'value' => $value
        ), 'xcrud-input', $this->field_attr[$name]);
    }

    protected function create_password($name, $value = '', $tag = array())
    {
        if (isset($this->subselect[$name])) {
            return $this->create_view_password($name, $value, $tag);
        }
        $tag = $tag + array(
            'tag' => 'input',
            'type' => 'password',
            'data-type' => 'password',
            'value' => '',
            'placeholder' => $value ? '*****' : ''
        );

        return $this->single_tag($tag, $this->theme_config('password_field'), $this->field_attr[$name]);
    }

    protected function create_view_password($name, $value = '', $tag = array())
    {
        return '*****';
    }

    /**
     *
     * @author Ariel Canal
     *         Fun��o alterada do padr�o.
     *         Compatibilizada com relation AJAX.
     *         Compatibilizada com join_relation.
     */
    protected function create_relation($name, $value = '', $tag = array(), $dependval = false)
    {
        if (! isset($this->relation[$name])) {
            return 'Restricted.';
        }
        $out = "";
        // if ($dependval === false &&
        // $this->result_row[$this->relation[$name]['depend_on']])
        // $dependval = $this->result_row[$this->relation[$name]['depend_on']];
        $tag = $tag + array(
            'tag' => 'select',
            'data-type' => 'select'
        );

        if ($this->relation[$name]['multi']) {
            $tag['multiple'] = '';
            $tag['size'] = 10;
            $values = ! is_array($value) ? $this->parse_comma_separated($value) : $value;
            $tag['class'] .= ' ' . $this->theme_config('multiselect_field');
        } else {
            $values = ! is_array($value) ? array(
                $value
            ) : $value;

            $tag['class'] .= ' ' . $this->theme_config('select_field');
        }
        $db = Database::get_instance($this->connection, $this->ci);
        $where_arr = array();
        if ($this->relation[$name]['rel_where']) {
            if (is_array($this->relation[$name]['rel_where'])) {
                foreach ($this->relation[$name]['rel_where'] as $field => $val) {
                    $val = $this->replace_text_variables($val, $this->result_row);
                    $fdata = $this->_parse_field_names($field, 'create_relation', $this->relation[$name]['rel_tbl']);
                    $fitem = reset($fdata);
                    $where_arr[] = $this->_where_field($fitem) . $this->_cond_from_where($field) . $db->escape($val);
                }
            } else {
                $where_arr[] = $this->replace_text_variables($this->relation[$name]['rel_where'], $this->result_row);
            }
        }
        if ($dependval !== false) {
            if (is_array($dependval) && count($dependval)) {
                foreach ($dependval as $k => $v) {
                    $dependval[$k] = $db->escape($v);
                }
                $where_arr[] = $this->_field_from_where($this->relation[$name]['depend_field']) . ' IN ' . "(" . implode(',', $dependval) . ")";
            } else if (is_string($dependval)) {
                // $dependval = $db->escape($dependval);
                $where_arr[] = $this->_field_from_where($this->relation[$name]['depend_field']) . $this->_cond_from_where($this->relation[$name]['depend_field']) . $db->escape($dependval);
            }
        }

        if ($where_arr)
            $where = 'WHERE ' . implode(' AND ', $where_arr);
        else
            $where = '';

        if (is_array($this->relation[$name]['rel_name'])) {
            $name_select = 'CONCAT_WS(' . $db->escape($this->relation[$name]['rel_separator']) . ',`' . implode('`,`', $this->relation[$name]['rel_name']) . '`) AS `name`';
        } else {
            $name_select = '`' . $this->relation[$name]['rel_name'] . '` AS `name`';
        }
        $db->query('SELECT COUNT(*) as total FROM `' . $this->relation[$name]['rel_tbl'] . '` ' . $where);
        $total = $db->row();
        unset($this->field_attr[$name]['data-relationajax']);
        $this->field_attr[$name]['class'] = $tag['class'];
        if ($total['total'] >= XcrudConfig::$relation_ajax) {
            $this->field_attr[$name]['data-relationajax'] = $this->fieldname_encode($name);
            $this->field_attr[$name]['class'] = $tag['class'] . ' select2-ajax';
        }
        if (array_key_exists($name, $this->join_relation) && is_array($this->join_relation[$name]['rel_additional_fields']) && count($this->join_relation[$name]['rel_additional_fields'])) {
            $this->field_attr[$name]['class'] .= " join_relation";
            $this->field_attr[$name]['data-jr_field'] = base64_encode($name);
        }
        $out .= $this->open_tag($tag, $this->theme_config('relation_field'));

        if ($this->relation[$name]['depend_on'] && $dependval === false) {
            $options = false;
            // if ($this->lists_null_opt) {
            foreach ($values as $val) {
                $out .= $this->open_tag(array(
                    'tag' => 'option',
                    'value' => $val,
                    'selected' => ''
                )) . $this->lang('null_option') . $this->close_tag('option');
            }
            // }
        } else {
            if ($total['total'] > XcrudConfig::$relation_ajax) {
                $where = "WHERE `" . $this->relation[$name]['rel_field'] . "` IS NULL";
            }
            $vals = implode("','", $values);
            if (is_array($values) && $vals != "") {
                $or_values = '(`' . $this->relation[$name]['rel_field'] . '` IN (\'' . $vals . '\') ';
                if ($dependval !== false && is_string($dependval)) {
                    $or_values .= " AND " . $this->_field_from_where($this->relation[$name]['depend_field']) . $this->_cond_from_where($this->relation[$name]['depend_field']) . $db->escape($dependval);
                } elseif ($dependval !== false && is_array($dependval)) {
                    $or_values .= " AND " . $this->_field_from_where($this->relation[$name]['depend_field']) . ' IN  (' . implode(',', $dependval) . ')';
                }
                $or_values .= ")";

                if ($where != "") {
                    $where = "WHERE (" . substr($where, 6) . ") OR " . $or_values;
                } else if ($where_arr) {
                    $where = "WHERE " . $or_values;
                }
            }
            $join = '';
            if (is_array($this->relation[$name]['join'])) {
                foreach ($this->relation[$name]['join'] as $params) {
                    if (! is_null($params['lfield']) && ! is_null($params['table']) && ! is_null($params['rfield'])) {
                        $join .= 'INNER JOIN `' . $params['table'] . '` AS '.md5($params['table']).' ON `' . $this->relation[$name]['rel_tbl'] . '`.`' . $params['lfield'] . '` = `' . md5($params['table']) . '`.`' . $params['rfield'] . '` ';
                    }
                }
            }
            $query = 'SELECT `' . $this->relation[$name]['rel_field'] . '` AS `field`,' . $name_select . $this->get_relation_tree_fields($this->relation[$name]) . ' FROM `' . $this->relation[$name]['rel_tbl'] . '` ' . $join . ' ' . $where . ' GROUP BY `field` ORDER BY ' . $this->get_relation_ordering($this->relation[$name]);

            $db->query($query);
            $options = $this->resort_relation_opts($db->result(), $this->relation[$name]);
            if ($this->lists_null_opt) {
                $out .= $this->open_tag(array(
                    'tag' => 'option',
                    'value' => ''
                )) . $this->lang('null_option') . $this->close_tag('option');
            }
        }
        if ($options) {
            foreach ($options as $opt) {
                unset($attr_opt);
                $attr_opt['value'] = $opt['field'];
                if (in_array($opt['field'], $values)) {
                    $attr_opt['selected'] = "selected";
                }
                $out .= $this->open_tag('option', '', $attr_opt) . $this->html_safe($opt['name']) . $this->close_tag('option');
            }
        }
        $out .= $this->close_tag($tag);
        unset($options);
        return $out;
    }

    protected function create_view_relation($name, $value = '', $tag = array(), $dependval = false)
    {
        if ($value === null || $value === '') {
            return '';
        }
        $db = Database::get_instance($this->connection, $this->ci);
        if (is_array($this->relation[$name]['rel_name'])) {
            $field = 'CONCAT_WS(' . $db->escape($this->relation[$name]['rel_separator']) . ',`' . implode('`,`', $this->relation[$name]['rel_name']) . '`) as `name`';
        } else {
            $field = '`' . $this->relation[$name]['rel_name'] . '` as `name`';
        }
        if ($this->relation[$name]['multi']) {
            $values = $this->parse_comma_separated($value);
            foreach ($values as $key => $val) {
                $values[$key] = $db->escape($val);
            }
            $where = 'IN(' . implode(',', $values) . ')';
        } else {
            $where = ' = ' . $db->escape($value);
        }
        $db->query('SELECT ' . $field . ' FROM `' . $this->relation[$name]['rel_tbl'] . '` WHERE `' . $this->relation[$name]['rel_field'] . '` ' . $where . ' GROUP BY `' . $this->relation[$name]['rel_field'] . '`');
        $options = $db->result();
        $out = array();
        foreach ($options as $opt) {
            $out[] = $opt['name'];
        }
        return implode(', ', $out);
    }

    protected function get_relation_ordering($rel)
    {
        if ($rel['tree'] && isset($rel['tree']['left_key']) && isset($rel['tree']['level_key'])) {
            return '`' . $rel['tree']['left_key'] . '` ASC';
        } elseif ($rel['tree'] && isset($rel['tree']['parent_key']) && isset($rel['tree']['primary_key'])) {
            return ($rel['order_by'] ? $rel['order_by'] : '`name` ASC');
        } elseif ($rel['order_by']) {
            return $rel['order_by'];
        } else
            return '`name` ASC';
    }

    protected function get_relation_tree_fields($rel)
    {
        if ($rel['tree'] && isset($rel['tree']['left_key']) && isset($rel['tree']['level_key'])) {
            return ',`' . $rel['tree']['left_key'] . '`,`' . $rel['tree']['level_key'] . '`';
        } elseif ($rel['tree'] && isset($rel['tree']['parent_key']) && isset($rel['tree']['primary_key'])) {
            return ',`' . $rel['tree']['parent_key'] . '` AS `pk`, `' . $rel['tree']['primary_key'] . '` AS `pri`';
        } else
            return '';
    }

    protected function resort_relation_opts($options, $rel)
    {
        if ($rel['tree'] && isset($rel['tree']['left_key']) && isset($rel['tree']['level_key'])) {
            foreach ($options as $key => $opt) {
                $level = (int) $opt[$rel['tree']['level_key']];
                $out = '';
                for ($i = 0; $i < $level; ++ $i) {
                    $out .= '. ';
                }
                if ($out)
                    $out .= ' └ ';
                $out .= $opt['name'];
                $options[$key]['name'] = $out;
            }
        } elseif ($rel['tree'] && isset($rel['tree']['parent_key']) && isset($rel['tree']['primary_key'])) {
            $opts_multiarr = array();
            foreach ($options as $key => $opt) {
                $opt['children'] = array();
                $opts_multiarr[] = $opt;
            }
            foreach ($opts_multiarr as $key => $opt) {
                $this->recursive_push($opts_multiarr, $opts_multiarr[$key]);
            }
            $new_opts = array();
            $this->recursive_opts($new_opts, $opts_multiarr, 0);
            $options = $new_opts;
        }
        return $options;
    }

    protected function recursive_push(&$options, &$insert)
    {
        foreach ($options as $key => $opt) {
            if (! $opt) {
                continue;
            }
            if ($opt['pri'] == $insert['pk']) {
                $options[$key]['children'][] = $insert;
                $insert = null;
            } elseif ($options[$key]['children']) {
                $this->recursive_push($options[$key]['children'], $insert);
            }
        }
    }

    protected function recursive_opts(&$options, $array, $level)
    {
        $level = $level + 1;
        foreach ($array as $opt) {
            if (! $opt) {
                continue;
            }
            $out = '';
            for ($i = 1; $i < $level; ++ $i) {
                $out .= '. ';
            }
            if ($out)
                $out .= ' └ ';
            $opt['name'] = $out . $opt['name'];
            $options[] = $opt;
            if (count($opt['children'])) {
                $this->recursive_opts($options, $opt['children'], $level);
            }
        }
    }

    protected function create_fk_relation($name, $value = '', $tag = array())
    {
        if (! isset($this->fk_relation[$name])) {
            return 'Restricted.';
        }
        $out = '';
        $tag = $tag + array(
            'tag' => 'select',
            'data-type' => 'select',
            'multiple' => '',
            'size' => 10
        );
        $tag['class'] .= ' ' . $this->theme_config('multiselect_field');
        $values = $this->parse_comma_separated($value);

        $db = Database::get_instance($this->connection, $this->ci);
        $where_arr = array();
        if ($this->fk_relation[$name]['rel_where']) {
            if (is_array($this->fk_relation[$name]['rel_where'])) {
                foreach ($this->fk_relation[$name]['rel_where'] as $field => $val) {
                    $val = $this->replace_text_variables($val, $this->result_row);
                    $fitem = reset($this->_parse_field_names($field, 'create_fk_relation', $this->fk_relation[$name]['rel_tbl']));
                    $where_arr[] = $this->_where_field($fitem) . $this->_cond_from_where($field) . $db->escape($val);
                }
            } else {
                $where_arr[] = $this->replace_text_variables($this->fk_relation[$name]['rel_where'], $this->result_row);
            }
        }
        $out .= $this->open_tag($tag, '', $this->field_attr[$name]);

        if ($where_arr)
            $where = 'WHERE ' . implode(' AND ', $where_arr);
        else
            $where = '';

        if (is_array($this->fk_relation[$name]['rel_name'])) {
            $optnames = array();
            foreach ($this->fk_relation[$name]['rel_name'] as $optnms) {
                $optnames[] = '`' . $this->fk_relation[$name]['rel_tbl'] . '`.`' . $optnms . '`';
            }
            $name_select = 'CONCAT_WS(' . $db->escape($this->fk_relation[$name]['rel_separator']) . ',' . implode(',', $optnames) . ') AS `name`';
        } else {
            $name_select = '`' . $this->fk_relation[$name]['rel_tbl'] . '`.`' . $this->fk_relation[$name]['rel_name'] . '` AS `name`';
        }

        if ($this->fk_relation[$name]['rel_orderby']) {
            $order_by = $this->fk_relation[$name]['rel_orderby'];
        } else {
            $order_by = '`name` ASC';
        }

        $db->query('SELECT `' . $this->fk_relation[$name]['rel_tbl'] . '`.`' . $this->fk_relation[$name]['rel_field'] . '` AS `field`,' . $name_select . ' FROM `' . $this->fk_relation[$name]['rel_tbl'] . '` ' . $where . ' GROUP BY `field` ORDER BY ' . $order_by);
        $options = $db->result();

        if ($this->lists_null_opt) {
            $out .= $this->open_tag(array(
                'tag' => 'option',
                'value' => ''
            )) . $this->lang('null_option') . $this->close_tag('option');
        }
        if ($options) {
            foreach ($options as $opt) {
                $opt_tag = array(
                    'tag' => 'option',
                    'value' => $opt['field']
                );
                if (in_array($opt['field'], $values)) {
                    $opt_tag['selected'] = "";
                }
                $out .= $this->open_tag($opt_tag) . $this->html_safe($opt['name']) . $this->close_tag($opt_tag);
            }
        }
        $out .= $this->close_tag($tag);
        unset($options);
        return $out;
    }

    protected function create_view_fk_relation($name, $value = '', $tag = array())
    {
        if (! isset($this->fk_relation[$name])) {
            return 'Restricted.';
        }

        if (! $value) {
            return '';
        }

        $db = Database::get_instance($this->connection, $this->ci);
        if (is_array($this->fk_relation[$name]['rel_name'])) {
            $optnames = array();
            foreach ($this->fk_relation[$name]['rel_name'] as $optnms) {
                $optnames[] = '`' . $this->fk_relation[$name]['rel_tbl'] . '`.`' . $optnms . '`';
            }
            $name_select = 'CONCAT_WS(' . $db->escape($this->fk_relation[$name]['rel_separator']) . ',' . implode(',', $optnames) . ') AS `name`';
        } else {
            $name_select = '`' . $this->fk_relation[$name]['rel_tbl'] . '`.`' . $this->fk_relation[$name]['rel_name'] . '` AS `name`';
        }

        $values = $this->parse_comma_separated($value);
        foreach ($values as $key => $val) {
            $values[$key] = $db->escape($val);
        }
        $where = 'IN(' . implode(',', $values) . ')';

        if ($this->fk_relation[$name]['rel_orderby']) {
            $order_by = $this->fk_relation[$name]['rel_orderby'];
        } else {
            $order_by = '`name` ASC';
        }

        $db->query('SELECT `' . $this->fk_relation[$name]['rel_tbl'] . '`.`' . $this->fk_relation[$name]['rel_field'] . '` AS `field`,' . $name_select . ' FROM `' . $this->fk_relation[$name]['rel_tbl'] . '` WHERE `' . $this->fk_relation[$name]['rel_tbl'] . '`.`' . $this->fk_relation[$name]['rel_field'] . '` ' . $where . ' GROUP BY `field` ORDER BY ' . $order_by);

        $options = $db->result();
        $out = array();
        foreach ($options as $opt) {
            $out[] = $opt['name'];
        }
        return implode(', ', $out);
    }

    protected function create_file($name, $value = '', $tag = array(), $is_upload = false)
    {
        if (isset($this->subselect[$name])) {
            return $this->create_view_file($name, $value, $tag);
        }
        $out = ''; // upload container
        $out .= $this->open_tag('div', 'xcrud-upload-container'); // file and
                                                                  // delete button
        $out .= $this->open_tag('div', $this->theme_config('grid_button_group'));
        if ($value) {
            // $out .= $this->open_tag('span', 'xcrud-file-name');
            $binary = isset($this->upload_config[$name]['blob']) ? true : false;
            if ($binary && ! $is_upload) {
                $file_size = $this->_file_size_bin($value);
                $value = 'blob-storage';
                $ext = 'binary';
            } else {
                $path = $this->get_image_folder($name);
                $file_size = $this->_file_size($path . '/' . $value);
                $ext = trim(strtolower(strrchr($value, '.')), '.');
            }

            $attr = array(
                'href' => (isset($this->upload_config[$name]['url']) ? $this->real_file_link($value, $this->upload_config[$name], true) : $this->file_link($name, $this->primary_val)),
                'class' => 'xcrud-file-name xcrud-' . $ext,
                'target' => '_blank'
            );

            $out .= $this->open_tag('a', $this->theme_config('file_name'), $attr);
            $out .= $this->open_tag('strong');
            $out .= (isset($this->upload_config[$name]['text']) ? $this->upload_config[$name]['text'] : $this->filter_file_name($value));
            $out .= $this->close_tag('strong');
            $out .= ' ' . $file_size . $this->close_tag('a');

            // $out .= $this->close_tag('span');
            if (! isset($tag['readonly']) && ! isset($tag['disabled'])) {
                $out .= $this->remove_upload_button($name);
            }
        } else {
            $out .= $this->open_tag('span', 'xcrud-nofile ' . $this->theme_config('no_file'));
            $out .= $this->lang('no_file') . $this->close_tag('span');
        }

        if (! isset($tag['readonly']) && ! isset($tag['disabled'])) {
            // hidden field
            $attr = $tag + array(
                'value' => $value,
                'type' => 'hidden'
            );
            $out .= $this->single_tag('input', 'xcrud-input', $attr);
            // upload button
            $out .= $this->upload_file_button($name, $value, $tag);
        }

        // close upload container
        $out .= $this->close_tag('div');
        $out .= $this->close_tag('div');

        return $out;
    }

    protected function upload_file_button($name, $value, $tag = array())
    {
        $out = '';
        $out .= $this->open_tag('span', $this->theme_config('upload_button'), array(
            'class' => 'xcrud-add-file'
        ));
        if (! $this->is_rtl && $this->theme_config('upload_button_icon')) {
            $out .= $this->open_tag('i', $this->theme_config('upload_button_icon')) . $this->close_tag('i') . ' ';
        }
        if ($value) {
            $out .= $this->lang('replace_file');
        } else {
            $out .= $this->lang('add_file');
        }
        if ($this->is_rtl && $this->theme_config('upload_button_icon')) {
            $out .= ' ' . $this->open_tag('i', $this->theme_config('upload_button_icon')) . $this->close_tag('i');
        }
        $attr = array(
            'id' => 'xfupl' . rand(),
            'value' => '',
            'type' => 'file',
            'data-type' => 'file',
            'data-field' => $name,
            'class' => 'xcrud-upload',
            'name' => 'xcrud-attach'
        );
        if (isset($tag['data-required']) && ! $value) {
            $attr['data-required'] = '';
        }
        $out .= $this->single_tag('input', '', $attr);
        $out .= $this->close_tag('span');
        return $out;
    }

    protected function upload_image_button($name, $value, $tag = array())
    {
        $out = '';
        $out .= $this->open_tag('span', $this->theme_config('upload_button'), array(
            'class' => 'xcrud-add-file'
        ));
        if (! $this->is_rtl && $this->theme_config('upload_button_icon')) {
            $out .= $this->open_tag('i', $this->theme_config('upload_button_icon')) . $this->close_tag('i') . ' ';
        }
        if ($value) {
            $out .= $this->lang('replace_image');
        } else {
            $out .= $this->lang('add_image');
        }
        if ($this->is_rtl && $this->theme_config('upload_button_icon')) {
            $out .= ' ' . $this->open_tag('i', $this->theme_config('upload_button_icon')) . $this->close_tag('i');
        }
        $attr = array(
            'id' => 'xfupl' . rand(),
            'value' => '',
            'type' => 'file',
            'data-type' => 'image',
            'data-field' => $name,
            'class' => 'xcrud-upload',
            'accept' => 'image/jpeg,image/png,image/gif',
            'name' => 'xcrud-attach',
            'capture' => 'camera'
        );
        if (isset($tag['data-required']) && ! $value) {
            $attr['data-required'] = '';
        }
        $out .= $this->single_tag('input', '', $attr);
        $out .= $this->close_tag('span');
        return $out;
    }

    protected function remove_upload_button($name)
    {
        $out = '';
        $attr = array(
            'href' => 'javascript:;',
            'class' => 'xcrud-remove-file',
            'data-field' => $name
        );
        $out .= $this->open_tag('a', $this->theme_config('remove_button'), $attr);
        if (! $this->is_rtl && $this->theme_config('remove_button_icon')) {
            $out .= $this->open_tag('i', $this->theme_config('remove_button_icon')) . $this->close_tag('i') . ' ';
        }
        $out .= $this->lang('remove');
        if ($this->is_rtl && $this->theme_config('remove_button_icon')) {
            $out .= ' ' . $this->open_tag('i', $this->theme_config('remove_button_icon')) . $this->close_tag('i');
        }
        $out .= $this->close_tag('a');
        return $out;
    }

    protected function create_view_file($name, $value = '', $tag = array(), $is_upload = false)
    {
        $out = '';
        if ($value) {
            $binary = isset($this->upload_config[$name]['blob']) ? true : false;
            if ($binary && ! $is_upload) {
                $file_size = $this->_file_size_bin($value);
                $value = 'blob-storage';
                $ext = 'binary';
            } else {
                $path = $this->get_image_folder($name);
                $file_size = $this->_file_size($path . '/' . $value);
                $ext = trim(strtolower(strrchr($value, '.')), '.');
            }
            $attr = array(
                'href' => isset($this->upload_config[$name]['url']) ? $this->real_file_link($value, $this->upload_config[$name], true) : $this->file_link($name, $this->primary_val),
                'class' => 'xcrud-file xcrud-' . $ext,
                'target' => '_blank'
            );
            $out .= $this->open_tag('span', 'xcrud-file-name');
            $out .= $this->open_tag('a', '', $attr);
            $out .= (isset($this->upload_config[$name]['text']) ? $this->upload_config[$name]['text'] : $value) . $this->close_tag('a');
            $out .= ' ' . $file_size;
            $this->close_tag('span');
        } else {
            $out .= $this->open_tag('span', 'xcrud-nofile');
            $out .= $this->lang('no_file') . $this->close_tag('span');
        }
        return $out;
    }

    protected function create_image($name, $value = '', $tag = array(), $is_upload = false)
    {
        if (isset($this->subselect[$name])) {
            return $this->create_view_image($name, $value, $tag = array());
        }
        $out = ''; // upload container
        $out .= $this->open_tag('div', 'xcrud-upload-container'); // image and
                                                                  // delete button
        if ($value) {
            $binary = isset($this->upload_config[$name]['blob']) ? true : false;
            if ($binary && ! $is_upload) {
                $value = 'blob-storage';
            } else {}
            $attr = array(
                'src' => isset($this->upload_config[$name]['url']) ? $this->real_file_link($value, $this->upload_config[$name], true) : $this->file_link($name, $this->primary_val, (isset($this->upload_config[$name]['detail_thumb']) ? $this->upload_config[$name]['detail_thumb'] : false), false, $value),
                'alt' => ''
            );
            $out .= $this->single_tag('img', $this->theme_config('image'), $attr);

            if (! isset($tag['readonly']) && ! isset($tag['disabled'])) {
                $out .= $this->open_tag('div', $this->theme_config('grid_button_group'));
                // delete button
                $out .= $this->remove_upload_button($name);
            }
        } else {
            $out .= $this->open_tag('div', $this->theme_config('grid_button_group'));
            $out .= $this->open_tag('span', 'xcrud-noimage ' . $this->theme_config('no_file'));
            $out .= $this->lang('no_image') . $this->close_tag('span') . $this->close_tag('div');
        }

        if (! isset($tag['readonly']) && ! isset($tag['disabled'])) {
            // hidden field
            $attr = $tag + array(
                'value' => $value,
                'type' => 'hidden'
            );
            $out .= $this->single_tag('input', 'xcrud-input', $attr, true);
            // upload button
            $out .= $this->upload_image_button($name, $value, $tag);
            // close upload container
            if ($value) {
                $out .= $this->close_tag('div');
            }
        }
        $out .= $this->close_tag('div');

        return $out;
    }

    protected function create_view_image($name, $value = '', $tag = array())
    {
        $out = ''; // image and delete button
        if ($value) {
            /*
             * $binary = isset($this->upload_config[$name]['blob']) ? true :
             * false;
             * if ($binary)
             * {
             * $value = 'blob-storage';
             * }
             * else
             * {
             * }
             */
            $attr = array(
                'src' => isset($this->upload_config[$name]['url']) ? $this->real_file_link($value, $this->upload_config[$name], true) : $this->file_link($name, $this->primary_val, (isset($this->upload_config[$name]['detail_thumb']) ? $this->upload_config[$name]['detail_thumb'] : false), false, $value),
                'alt' => ''
            );
            $out .= $this->single_tag('img', $this->theme_config('image'), $attr);
        } else {
            $out .= $this->open_tag('span', 'xcrud-noimage');
            $out .= $this->lang('no_image') . $this->close_tag('span');
        }

        return $out;
    }

    protected function create_binary($name, $value = '', $tag = array())
    {
        return $value ? '[binary data]' : '[binary null]';
    }

    protected function create_view_binary($name, $value = '', $tag = array())
    {
        return $value ? '[binary data]' : '[binary null]';
    }

    protected function create_remote_image($name, $value = '', $tag = array())
    {
        if (isset($this->subselect[$name])) {
            return $this->create_view_remote_image($name, $value, $tag);
        }
        $out = '';

        $attr = $this->field_attr[$name];

        $tag = $tag + array(
            'tag' => 'input',
            'type' => 'text',
            'value' => $value
        );

        if ($value) {
            $img = array(
                'tag' => 'img',
                'alt' => '',
                'src' => $attr['link'] . $value
            );
            $out .= $this->single_tag($img, $this->theme_config('remote_image'));
        }
        unset($attr['link']);
        $out .= $this->single_tag($tag, $this->theme_config('remote_image_field'), $attr, true);
        return $out;
    }

    protected function create_view_remote_image($name, $value = '', $tag = array())
    {
        if ($value) {
            $attr = $this->field_attr[$name];
            $img = array(
                'tag' => 'img',
                'alt' => '',
                'src' => $attr['link'] . $value
            );
            return $this->single_tag($img, $this->theme_config('remote_image'));
        }
    }

    protected function create_point($name, $value = '', $tag = array())
    {
        if (isset($this->subselect[$name])) {
            return $this->create_view_point($name, $value, $tag);
        }
        $out = '';
        $attr = $this->field_attr[$name];
        if (! $value) {
            $value = XcrudConfig::$default_point ? XcrudConfig::$default_point : '0,0';
        }

        $tag = $tag + array(
            'tag' => 'input',
            'value' => $value,
            'data-type' => 'point'
        );
        if ($attr['search']) {
            $search = array(
                'tag' => 'input',
                'type' => 'text',
                'autocomplete' => 'off',
                'placeholder' => $this->lang($attr['search_text']),
                'name' => $this->fieldname_encode($name . '.search'),
                'class' => 'xcrud-map-search xcrud-input'
            );
            if (isset($this->disabled[$name])) {
                $search['disabled'] = '';
            }
        } else {
            $search = false;
        }

        if (isset($this->exception_fields[$name])) {
            $tag['class'] .= ' ' . $this->theme_config('validation_error_field');
        }

        if ($attr['coords']) {
            $tag['type'] = 'text';
        } else {
            $tag['type'] = 'hidden';
        }

        $map = array(
            'tag' => 'div',
            'class' => 'xcrud-map',
            'data-text' => $this->lang($attr['text']),
            'data-zoom' => $attr['zoom'],
            'style' => 'width:' . $attr['width'] . 'px;height:' . $attr['height'] . 'px;'
        );

        if (isset($this->readonly[$name]) or isset($this->disabled[$name])) {
            $map['data-draggable'] = '0';
        } else {
            $map['data-draggable'] = '1';
        }
        unset($attr['text'], $attr['zoom'], $attr['width'], $attr['height'], $attr['search_text']);

        $out .= $this->single_tag($tag, $this->theme_config('point_field'), $attr);
        if ($search) {
            $out .= $this->single_tag($search, $this->theme_config('point_search'));
        }
        $out .= $this->open_tag($map, $this->theme_config('point_map')) . $this->close_tag($map);

        return $out;
    }

    protected function create_view_point($name, $value = '', $tag = array())
    {
        $out = '';
        $attr = $this->field_attr[$name];
        if (! $value) {
            $value = XcrudConfig::$default_point;
        }
        if ($value) {
            $tag = array(
                'tag' => 'input',
                'value' => $value,
                'class' => 'xcrud-input',
                'data-type' => 'point',
                'type' => 'hidden'
            );
            $map = array(
                'tag' => 'img',
                'class' => 'xcrud-map',
                'style' => 'width:' . $attr['width'] . 'px;height:' . $attr['height'] . 'px;',
                'src' => 'https://maps.googleapis.com/maps/api/staticmap?center=' . $value . '&zoom=' . $attr['zoom'] . '&size=' . '2000x' . $attr['height'] . '&maptype=roadmap&markers=color:red%7C' . $value . '&key=' . XcrudConfig::$maps_api_key
            );
            unset($attr['text'], $attr['zoom'], $attr['width'], $attr['height'], $attr['search_text']);
            $out .= $this->single_tag($tag, $this->theme_config('point_field'), $attr);
            $out .= $this->open_tag($map, $this->theme_config('point_map'));
        }
        return $out;
    }

    protected function benchmark_start()
    {
        if ($this->benchmark) {
            $start = explode(' ', microtime());
            $this->time_start = (float) ($start[1] + $start[0]);
            $this->memory_start = memory_get_usage();
        }
    }

    protected function benchmark_end()
    {
        if ($this->benchmark) {
            $end = explode(' ', microtime());
            $this->time_end = (float) ($end[1] + $end[0]);
            $this->memory_end = memory_get_usage();
            $out = '<span>' . $this->lang('exec_time') . ' ' . (number_format($this->time_end - $this->time_start, 3, '.', '')) . ' s</span>';
            $out .= '<span>' . $this->lang('memory_usage') . ' ' . (number_format(($this->memory_end - $this->memory_start) / 1024 / 1024, 2, '.', '')) . ' MB</span>';
            return $out;
        }
    }

    protected static function error($text = 'Error!')
    {
        exit('<div class="xcrud-error" style="position:relative;line-height:1.25;padding:15px;color:#BA0303;margin:10px;border:1px solid #BA0303;border-radius:4px;font-family:Arial,sans-serif;background:#FFB5B5;box-shadow:inset 0 0 80px #E58989;">
            <span style="position:absolute;font-size:10px;bottom:3px;right:5px;">xCRUD</span>' . $text . '</div>');
    }

    protected function _upload()
    {
        switch ($this->_post('type')) {
            case 'image':
                return $this->_upload_image();
                break;
            case 'file':
                return $this->_upload_file();
                break;
            default:
                return self::error('Upload Error');
                break;
        }
    }

    protected function _clone_file($field, $filename)
    {
        $file_path = $this->get_image_folder($field);
        if (is_file($file_path . '/' . $filename)) {
            $new_filename = substr_replace($filename, substr(base64_encode($filename . time()), 0, 8), strpos($filename, '.'), 0);
            copy($file_path . '/' . $filename, $file_path . '/' . $new_filename);
            $filename = $new_filename;
        }
        return $filename;
    }

    protected function _upload_file()
    {
        $field = $this->_post('field');
        $oldfile = $this->_post('oldfile', 0);
        if (isset($_FILES) && isset($_FILES['xcrud-attach']) && ! $_FILES['xcrud-attach']['error']) {
            $file = $_FILES['xcrud-attach'];
            $this->check_file_folders($field);
            $filename = $this->safe_file_name($file, $field);
            $filename = $this->get_filename_noconfict($filename, $field);

            if ($this->before_upload) {
                $path = $this->check_file($this->before_upload['path'], 'before_upload');
                include_once ($path);
                $callable = $this->before_upload['callable'];
                if (is_callable($callable)) {
                    call_user_func_array($callable, array(
                        $field,
                        $filename,
                        $this->upload_config[$field],
                        $this
                    ));
                    if ($this->exception) {
                        $out = $this->call_exception();
                        $this->after_render();
                        return $out;
                    }
                }
            }

            $this->save_file($file, $filename, $field);
            if ($this->exception) {
                $out = $this->call_exception();
                $this->upload_to_remove[$oldfile] = $field;
                $this->after_render();
                return $out;
            }
            if ($oldfile != $filename)
                $this->upload_to_remove[$oldfile] = $field;
            $this->upload_to_save[$filename] = $field;
            $attr = $this->get_field_attr($field, $this->_post('mode', 0));
            $out = $this->create_file($field, $filename, $attr, true);
            $this->after_render();
            return $out;
        } else
            return self::error('File is not uploaded');
    }

    protected function _upload_image()
    {
        $field = $this->_post('field');
        $oldfile = $this->_post('oldfile', 0);
        if (isset($_FILES) && isset($_FILES['xcrud-attach']) && ! $_FILES['xcrud-attach']['error']) {
            $file = $_FILES['xcrud-attach'];
            $this->check_file_folders($field);
            $filename = $this->safe_file_name($file, $field);
            $filename = $this->get_filename_noconfict($filename, $field);

            if ($this->before_upload) {
                $path = $this->check_file($this->before_upload['path'], 'before_upload');
                include_once ($path);
                $callable = $this->before_upload['callable'];
                if (is_callable($callable)) {
                    call_user_func_array($callable, array(
                        $field,
                        $filename,
                        $this->upload_config[$field],
                        $this
                    ));
                }
                if ($this->exception) {
                    $out = $this->call_exception();
                    $this->after_render();
                    return $out;
                }
            }

            if ($oldfile != $filename) {
                $this->upload_to_remove[$oldfile] = $field;
            }
            $this->upload_to_save[$filename] = $field;
            if ($this->is_resize($field)) {
                $this->save_file_to_tmp($file, $filename, $field);
                if ($this->exception) {
                    $out = $this->call_exception();
                    $this->after_render();
                    return $out;
                }
                if ($this->is_manual_crop($field)) {
                    // $this->make_bg($filename, $field);
                    $out = $this->render_crop_window($filename, $field);
                } else {
                    $this->make_autoresize($filename, $field);
                    $this->remove_tmp_image($filename, $field);
                    if ($this->exception) {
                        $out = $this->call_exception();
                        $this->after_render();
                        return $out;
                    }
                    // $this->render_image_field($filename, $field);
                    $attr = $this->get_field_attr($field, $this->_post('mode', 0));
                    $out = $this->create_image($field, $filename, $attr, true);
                }
            } else {
                // $this->save_file($file, $filename, $field);
                // //$this->render_image_field($filename, $field);
                $this->save_file_to_tmp($file, $filename, $field);
                if ($this->exception) {
                    $out = $this->call_exception();
                    $this->after_render();
                    return $out;
                }
                $this->filter_image($filename, $field);
                $this->remove_tmp_image($filename, $field);
                if ($this->exception) {
                    $out = $this->call_exception();
                    $this->after_render();
                    return $out;
                }
                $attr = $this->get_field_attr($field, $this->_post('mode', 0));
                $out = $this->create_image($field, $filename, $attr, true);
            }
            $this->after_render();
            return $out;
        } else
            return self::error('File is not uploaded');
    }

    protected function render_crop_window($filename, $field)
    {
        $out = ''; // upload container
        $out .= $this->open_tag('div', 'xcrud-upload-container');
        $tmp_name = substr($filename, 0, strrpos($filename, '.')) . '.tmp';
        if (isset($this->labels[$field]))
            $title = $this->html_safe($this->labels[$field]);
        else {
            list ($tmp, $fieldname) = explode('.', $field);
            $title = $this->html_safe($this->_humanize($fieldname));
        }
        $path = $this->get_image_folder($field) . '/' . $tmp_name;
        list ($width, $height) = getimagesize($path);
        $ratio = isset($this->upload_config[$field]['ratio']) ? $this->upload_config[$field]['ratio'] : '';
        $attr = array(
            'src' => $this->file_link($field, $this->primary_val, false, true),
            'title' => $title,
            'data-width' => $width,
            'data-height' => $height,
            'data-ratio' => $ratio,
            'style' => 'display:none;max-width:none;',
            'alt' => ''
        );
        $out .= $this->single_tag('img', 'xcrud-crop', $attr);
        /*
         * $out .= $this->single_tag('input', 'new_key', array(
         * 'name' => 'new_key',
         * 'value' => $this->key,
         * 'type' => 'hidden'));
         */
        $out .= $this->single_tag('input', 'xrud-crop-data', array(
            'name' => 'field',
            'value' => $field,
            'type' => 'hidden'
        ));
        $out .= $this->single_tag('input', 'xrud-crop-data', array(
            'name' => 'filename',
            'value' => $filename,
            'type' => 'hidden'
        ));
        $out .= $this->single_tag('input', 'xrud-crop-data', array(
            'name' => 'x',
            'value' => 0,
            'type' => 'hidden'
        ));
        $out .= $this->single_tag('input', 'xrud-crop-data', array(
            'name' => 'y',
            'value' => 0,
            'type' => 'hidden'
        ));
        $out .= $this->single_tag('input', 'xrud-crop-data', array(
            'name' => 'x2',
            'value' => 0,
            'type' => 'hidden'
        ));
        $out .= $this->single_tag('input', 'xrud-crop-data', array(
            'name' => 'y2',
            'value' => 0,
            'type' => 'hidden'
        ));
        $out .= $this->single_tag('input', 'xrud-crop-data', array(
            'name' => 'w',
            'value' => 0,
            'type' => 'hidden'
        ));
        $out .= $this->single_tag('input', 'xrud-crop-data', array(
            'name' => 'h',
            'value' => 0,
            'type' => 'hidden'
        ));
        $out .= $this->close_tag('div');
        return $out;
    }

    protected function filter_image($filename, $field)
    {
        $tmp_name = substr($filename, 0, strrpos($filename, '.')) . '.tmp';
        $settings = $this->upload_config[$field];
        $tmp_path = $this->get_image_folder($field) . '/' . $tmp_name;
        $file_path = $this->get_image_folder($field) . '/' . $filename;
        $watermark = (isset($settings['watermark']) && $settings['watermark']) ? $this->check_file($settings['watermark'], 'try_crop_image') : false;
        $watermark_position = (isset($settings['watermark_position']) && is_array($settings['watermark_position']) && count($settings['watermark_position'] == 2)) ? array_values($settings['watermark_position']) : array(
            50,
            50
        );
        $quality = (isset($settings['quality']) && $settings['quality']) ? $settings['quality'] : 92;
        $this->_draw_watermark($tmp_path, $file_path, $quality, $watermark, $watermark_position);
        if (isset($settings['thumbs']) && is_array($settings['thumbs'])) {
            foreach ($settings['thumbs'] as $thumb) {
                $thumb_file = $this->get_thumb_path($filename, $field, $thumb);
                $this->_try_change_size($tmp_path, $thumb_file, $field, $thumb);
            }
        }
    }

    protected function make_autoresize($filename, $field)
    {
        $tmp_name = substr($filename, 0, strrpos($filename, '.')) . '.tmp';
        $settings = $this->upload_config[$field];
        $tmp_path = $this->get_image_folder($field) . '/' . $tmp_name;
        $file_path = $this->get_image_folder($field) . '/' . $filename;
        $this->_try_change_size($tmp_path, $file_path, $field, $settings);
        if (isset($settings['thumbs']) && is_array($settings['thumbs'])) {
            foreach ($settings['thumbs'] as $thumb) {
                $thumb_file = $this->get_thumb_path($filename, $field, $thumb);
                $this->_try_change_size($tmp_path, $thumb_file, $field, $thumb);
            }
        }
    }

    protected function manual_crop()
    {
        $field = $this->_post('field');
        $filename = $this->_post('filename');
        $tmp_name = substr($filename, 0, strrpos($filename, '.')) . '.tmp';
        $x = round($this->_post('x'));
        $y = round($this->_post('y'));
        $x2 = round($this->_post('x2'));
        $y2 = round($this->_post('y2'));
        $w = round($this->_post('w'));
        $h = round($this->_post('h'));
        if (! $w or ! $h) {
            $this->remove_tmp_image($filename, $field);
            $this->after_render();
            return $this->create_image($field, '');
        }
        $settings = $this->upload_config[$field];
        $ratio = (isset($settings['ratio']) && ! empty($settings['ratio'])) ? (float) $settings['ratio'] : $w / $h;
        $tmp_path = $this->get_image_folder($field) . '/' . $tmp_name;
        $file_path = $this->get_image_folder($field) . '/' . $filename;
        $this->_try_crop_image($tmp_path, $file_path, $field, $settings, $x, $y, $w, $h, $ratio);
        if (isset($settings['thumbs']) && is_array($settings['thumbs'])) {
            foreach ($settings['thumbs'] as $thumb) {
                $thumb_path = $this->get_thumb_path($filename, $field, $thumb);
                $this->_try_crop_image($tmp_path, $thumb_path, $field, $thumb, $x, $y, $w, $h, $ratio);
            }
        }
        $this->remove_tmp_image($filename, $field);
        $this->after_render();
        return $this->create_image($field, $filename);
    }

    protected function _try_crop_image($tmp_path, $file_path, $field, $settings, $x, $y, $w, $h, $ratio)
    {
        $set_w = (isset($settings['width']) && ! empty($settings['width'])) ? (int) $settings['width'] : false;
        $set_h = (isset($settings['height']) && ! empty($settings['height'])) ? (int) $settings['height'] : false;
        // $set_ratio = (isset($settings['ratio']) &&
        // !empty($settings['ratio'])) ? (float)$settings['ratio'] : false;
        $sizes = $this->_calculate_crop_sizes($w, $h, $set_w, $set_h, $ratio);
        $watermark = (isset($settings['watermark']) && $settings['watermark']) ? $this->check_file($settings['watermark'], 'try_crop_image') : false;
        $watermark_position = (isset($settings['watermark_position']) && is_array($settings['watermark_position']) && count($settings['watermark_position'] == 2)) ? array_values($settings['watermark_position']) : array(
            50,
            50
        );
        $quality = (isset($settings['quality']) && $settings['quality']) ? $settings['quality'] : 92;
        $this->_custom_image_crop($tmp_path, $file_path, $sizes['w'], $sizes['h'], $quality, $x, $y, $w, $h, $watermark, $watermark_position);
    }

    protected function _calculate_crop_sizes($w, $h, $set_w, $set_h, $set_ratio)
    {
        $sizes = array();
        if ($set_w && $set_h) {
            $tmp_ratio = $set_w / $set_h;
            if ($set_ratio > $tmp_ratio) {
                $sizes['w'] = $set_w;
                $sizes['h'] = $set_w / $set_ratio;
            } else {
                $sizes['h'] = $set_h;
                $sizes['w'] = $set_h * $set_ratio;
            }
        } elseif (! $set_w && ! $set_h) {
            $sizes['w'] = $w;
            $sizes['h'] = $h;
        } elseif (! $set_h) {
            $sizes['w'] = $set_w;
            $sizes['h'] = round($set_w / $set_ratio);
        } elseif (! $set_w) {
            $sizes['h'] = $set_h;
            $sizes['w'] = round($set_h * $set_ratio);
        }
        return $sizes;
    }

    protected function _try_change_size($tmp_path, $file_path, $field, $settings)
    {
        $crop = (isset($settings['crop']) && $settings['crop'] == true) ? true : false;
        $width = (isset($settings['width']) && $settings['width']) ? $settings['width'] : false;
        $height = (isset($settings['height']) && $settings['height']) ? $settings['height'] : false;
        $watermark = (isset($settings['watermark']) && $settings['watermark']) ? $this->check_file($settings['watermark'], 'try_change_size') : false;
        $watermark_position = (isset($settings['watermark_position']) && is_array($settings['watermark_position']) && count($settings['watermark_position'] == 2)) ? array_values($settings['watermark_position']) : array(
            50,
            50
        );
        $quality = (isset($settings['quality']) && $settings['quality']) ? $settings['quality'] : 92;
        if ($crop && $width && $height) {
            $this->_image_crop($tmp_path, $file_path, $width, $height, $quality, $watermark, $watermark_position);
        } elseif ($width or $height) {
            $this->_image_resize($tmp_path, $file_path, $width, $height, $quality, $watermark, $watermark_position);
        }
    }

    protected function _remove_upload()
    {
        $type = isset($this->field_type[$this->_post('field')]) ? $this->field_type[$this->_post('field')] : false;
        switch ($type) {
            case 'image':
                return $this->_remove_image();
                break;
            case 'file':
                return $this->_remove_file();
                break;
            default:
                return self::error('Remove Error');
                break;
        }
    }

    protected function _remove_file()
    {
        $field = $this->_post('field');
        $file = $this->_post('file');
        $this->upload_to_remove[$file] = $field;
        $this->after_render();
        return $this->create_file($field, '');
    }

    protected function _remove_image()
    {
        $field = $this->_post('field');
        $file = $this->_post('file');
        $this->upload_to_remove[$file] = $field;
        $this->after_render();
        return $this->create_image($field, '');
    }

    protected function _remove_and_save_uploads()
    {
        if (! $this->cancel_file_saving) {
            switch ($this->task) {
                case 'save':
                    if (! $this->demo_mode) {
                        if ($this->upload_to_remove) {
                            foreach ($this->upload_to_remove as $file => $field) {
                                if ($file) {
                                    $this->remove_file($file, $field);
                                }
                            }
                        }
                    }
                    $this->upload_to_save = array();
                    $this->upload_to_remove = array();
                    break;
                case 'list':
                case 'create':
                case 'edit':
                case 'view':
                case '':
                    if ($this->upload_to_save) {
                        foreach ($this->upload_to_save as $file => $field) {
                            $this->remove_file($file, $field);
                        }
                        $f_bak = array();
                        foreach ($this->upload_to_remove as $file => $field) {
                            if (! isset($f_bak[$field])) {
                                $f_bak[$field] = true;
                                continue;
                            }
                            $this->remove_file($file, $field);
                        }
                    }
                    $this->upload_to_save = array();
                    $this->upload_to_remove = array();
                    break;
            }
        } else {
            $this->cancel_file_saving = false;
        }
    }

    protected function _image_resize($src_file, $dest_file, $new_size_w = false, $new_size_h = false, $dest_qual = 92, $watermark = false, $watermark_position = array(
        50,
        50
    ))
    {
        list ($srcWidth, $srcHeight, $type) = getimagesize($src_file);
        switch ($type) {
            case 1:
                $srcHandle = imagecreatefromgif($src_file);
                break;
            case 2:
                $srcHandle = imagecreatefromjpeg($src_file);
                break;
            case 3:
                $srcHandle = imagecreatefrompng($src_file);
                break;
            default:
                self::error('NO FILE');
                return false;
        }
        if ($srcWidth >= $srcHeight) {
            $ratio = (($new_size_w ? $srcWidth : $srcHeight) / ($new_size_w ? $new_size_w : $new_size_h));
            $ratio = max($ratio, 1.0);
            $destWidth = ($srcWidth / $ratio);
            $destHeight = ($srcHeight / $ratio);
            if ($destHeight > $new_size_h) {
                $ratio = ($destHeight / ($new_size_h ? $new_size_h : $new_size_w));
                $ratio = max($ratio, 1.0);
                $destWidth = ($destWidth / $ratio);
                $destHeight = ($destHeight / $ratio);
            }
        } elseif ($srcHeight > $srcWidth) {
            $ratio = (($new_size_h ? $srcHeight : $srcWidth) / ($new_size_h ? $new_size_h : $new_size_w));
            $ratio = max($ratio, 1.0);
            $destWidth = ($srcWidth / $ratio);
            $destHeight = ($srcHeight / $ratio);
            if ($destWidth > $new_size_w) {
                $ratio = ($destWidth / ($new_size_w ? $new_size_w : $new_size_h));
                $ratio = max($ratio, 1.0);
                $destWidth = ($destWidth / $ratio);
                $destHeight = ($destHeight / $ratio);
            }
        }
        $dstHandle = imagecreatetruecolor($destWidth, $destHeight);
        switch ($type) {
            case 1:
                $transparent_source_index = imagecolortransparent($srcHandle);
                if ($transparent_source_index !== - 1) {
                    $transparent_color = imagecolorsforindex($srcHandle, $transparent_source_index);
                    $transparent_destination_index = imagecolorallocate($dstHandle, $transparent_color['red'], $transparent_color['green'], $transparent_color['blue']);
                    imagecolortransparent($dstHandle, $transparent_destination_index);
                    imagefill($dstHandle, 0, 0, $transparent_destination_index);
                }
                break;
            case 3:
                imagealphablending($dstHandle, false);
                imagesavealpha($dstHandle, true);
                break;
        }
        imagecopyresampled($dstHandle, $srcHandle, 0, 0, 0, 0, $destWidth, $destHeight, $srcWidth, $srcHeight);
        imagedestroy($srcHandle);
        if ($watermark) {
            list ($water_w, $water_h, $water_type) = getimagesize($watermark);
            $offsets = $this->calculate_watermark_offsets($destWidth, $destHeight, $water_w, $water_h, $watermark_position);
            switch ($water_type) {
                case 1:
                    $waterHandle = imagecreatefromgif($watermark);
                    $transparent_source_index = imagecolortransparent($waterHandle);
                    if ($transparent_source_index !== - 1) {
                        $transparent_color = imagecolorsforindex($waterHandle, $transparent_source_index);
                        $transparent_destination_index = imagecolorallocate($waterHandle, $transparent_color['red'], $transparent_color['green'], $transparent_color['blue']);
                        imagecolortransparent($waterHandle, $transparent_destination_index);
                        imagefill($waterHandle, 0, 0, $transparent_destination_index);
                    }
                    break;
                case 2:
                    $waterHandle = imagecreatefromjpeg($watermark);
                    break;
                case 3:
                    $waterHandle = imagecreatefrompng($watermark);
                    imagealphablending($waterHandle, false);
                    imagesavealpha($waterHandle, true);
                    imagealphablending($dstHandle, true);
                    break;
                    break;
                default:
                    self::error('NO WATERMARK FILE');
                    return false;
            }
            imagecopy($dstHandle, $waterHandle, $offsets['x'], $offsets['y'], 0, 0, $water_w, $water_h);
            imagedestroy($waterHandle);
        }
        switch ($type) {
            case 1:
                imagegif($dstHandle, $dest_file);
                break;
            case 2:
                imagejpeg($dstHandle, $dest_file, $dest_qual);
                break;
            case 3:
                imagepng($dstHandle, $dest_file);
                break;
            default:
                self::error('File Type Not Supported!');
                return false;
        }
        imagedestroy($dstHandle);
        $newimgarray = array(
            $destWidth,
            $destHeight
        );
        return $newimgarray;
    }

    protected function _image_crop($src_file, $dest_file, $new_size_w, $new_size_h, $dest_qual = 92, $watermark = false, $watermark_position = array(
        50,
        50
    ))
    {
        list ($srcWidth, $srcHeight, $type) = getimagesize($src_file);
        switch ($type) {
            case 1:
                $srcHandle = imagecreatefromgif($src_file);
                break;
            case 2:
                $srcHandle = imagecreatefromjpeg($src_file);
                break;
            case 3:
                $srcHandle = imagecreatefrompng($src_file);
                break;
            default:
                self::error('NO FILE');
                return false;
        }
        if (! $srcHandle) {
            self::error('Could not execute imagecreatefrom() function! ');
            return false;
        }
        if ($srcHeight < $srcWidth) {
            $ratio = (double) ($srcHeight / $new_size_h);
            $cpyWidth = round($new_size_w * $ratio);
            if ($cpyWidth > $srcWidth) {
                $ratio = (double) ($srcWidth / $new_size_w);
                $cpyWidth = $srcWidth;
                $cpyHeight = round($new_size_h * $ratio);
                $xOffset = 0;
                $yOffset = round(($srcHeight - $cpyHeight) / 2);
            } else {
                $cpyHeight = $srcHeight;
                $xOffset = round(($srcWidth - $cpyWidth) / 2);
                $yOffset = 0;
            }
        } else {
            $ratio = (double) ($srcWidth / $new_size_w);
            $cpyHeight = round($new_size_h * $ratio);
            if ($cpyHeight > $srcHeight) {
                $ratio = (double) ($srcHeight / $new_size_h);
                $cpyHeight = $srcHeight;
                $cpyWidth = round($new_size_w * $ratio);
                $xOffset = round(($srcWidth - $cpyWidth) / 2);
                $yOffset = 0;
            } else {
                $cpyWidth = $srcWidth;
                $xOffset = 0;
                $yOffset = round(($srcHeight - $cpyHeight) / 2);
            }
        }
        $dstHandle = ImageCreateTrueColor($new_size_w, $new_size_h);
        switch ($type) {
            case 1:
                $transparent_source_index = imagecolortransparent($srcHandle);
                if ($transparent_source_index !== - 1) {
                    $transparent_color = imagecolorsforindex($srcHandle, $transparent_source_index);
                    $transparent_destination_index = imagecolorallocate($dstHandle, $transparent_color['red'], $transparent_color['green'], $transparent_color['blue']);
                    imagecolortransparent($dstHandle, $transparent_destination_index);
                    imagefill($dstHandle, 0, 0, $transparent_destination_index);
                }
                break;
            case 3:
                imagealphablending($dstHandle, false);
                imagesavealpha($dstHandle, true);
                break;
        }
        if (! imagecopyresampled($dstHandle, $srcHandle, 0, 0, $xOffset, $yOffset, $new_size_w, $new_size_h, $cpyWidth, $cpyHeight)) {
            self::error('Could not execute imagecopyresampled() function!');
            return false;
        }
        imagedestroy($srcHandle);
        if ($watermark) {
            list ($water_w, $water_h, $water_type) = getimagesize($watermark);
            $offsets = $this->calculate_watermark_offsets($new_size_w, $new_size_h, $water_w, $water_h, $watermark_position);
            switch ($water_type) {
                case 1:
                    $waterHandle = imagecreatefromgif($watermark);
                    $transparent_source_index = imagecolortransparent($waterHandle);
                    if ($transparent_source_index !== - 1) {
                        $transparent_color = imagecolorsforindex($waterHandle, $transparent_source_index);
                        $transparent_destination_index = imagecolorallocate($waterHandle, $transparent_color['red'], $transparent_color['green'], $transparent_color['blue']);
                        imagecolortransparent($waterHandle, $transparent_destination_index);
                        imagefill($waterHandle, 0, 0, $transparent_destination_index);
                    }
                    break;
                case 2:
                    $waterHandle = imagecreatefromjpeg($watermark);
                    break;
                case 3:
                    $waterHandle = imagecreatefrompng($watermark);
                    imagealphablending($waterHandle, false);
                    imagesavealpha($waterHandle, true);
                    imagealphablending($dstHandle, true);
                    break;
                    break;
                default:
                    self::error('NO WATERMARK FILE');
                    return false;
            }
            imagecopy($dstHandle, $waterHandle, $offsets['x'], $offsets['y'], 0, 0, $water_w, $water_h);
            imagedestroy($waterHandle);
        }
        switch ($type) {
            case 1:
                imagegif($dstHandle, $dest_file);
                break;
            case 2:
                imagejpeg($dstHandle, $dest_file, $dest_qual);
                break;
            case 3:
                imagepng($dstHandle, $dest_file);
                break;
            default:
                self::error('File Type Not Supported!');
                return false;
        }
        imagedestroy($dstHandle);
        return true;
    }

    protected function _custom_image_crop($src_file, $dest_file, $new_size_w, $new_size_h, $dest_qual, $x, $y, $w, $h, $watermark = false, $watermark_position = array(
        50,
        50
    ))
    {
        list ($srcWidth, $srcHeight, $type) = getimagesize($src_file);
        switch ($type) {
            case 1:
                $srcHandle = imagecreatefromgif($src_file);
                break;
            case 2:
                $srcHandle = imagecreatefromjpeg($src_file);
                break;
            case 3:
                $srcHandle = imagecreatefrompng($src_file);
                break;
            default:
                self::error('NO FILE');
                return false;
        }
        if (! $srcHandle) {
            self::error('Could not execute imagecreatefrom() function!');
            return false;
        }
        $dstHandle = ImageCreateTrueColor($new_size_w, $new_size_h);
        switch ($type) {
            case 1:
                $transparent_source_index = imagecolortransparent($srcHandle);
                if ($transparent_source_index !== - 1) {
                    $transparent_color = imagecolorsforindex($srcHandle, $transparent_source_index);
                    $transparent_destination_index = imagecolorallocate($dstHandle, $transparent_color['red'], $transparent_color['green'], $transparent_color['blue']);
                    imagecolortransparent($dstHandle, $transparent_destination_index);
                    imagefill($dstHandle, 0, 0, $transparent_destination_index);
                }
                break;
            case 3:
                imagealphablending($dstHandle, false);
                imagesavealpha($dstHandle, true);
                break;
        }
        if (! imagecopyresampled($dstHandle, $srcHandle, 0, 0, $x, $y, $new_size_w, $new_size_h, $w, $h)) {
            self::error('Could not execute imagecopyresampled() function!');
            return false;
        }
        imagedestroy($srcHandle);
        if ($watermark) {
            list ($water_w, $water_h, $water_type) = getimagesize($watermark);
            $offsets = $this->calculate_watermark_offsets($new_size_w, $new_size_h, $water_w, $water_h, $watermark_position);
            switch ($water_type) {
                case 1:
                    $waterHandle = imagecreatefromgif($watermark);
                    $transparent_source_index = imagecolortransparent($waterHandle);
                    if ($transparent_source_index !== - 1) {
                        $transparent_color = imagecolorsforindex($waterHandle, $transparent_source_index);
                        $transparent_destination_index = imagecolorallocate($waterHandle, $transparent_color['red'], $transparent_color['green'], $transparent_color['blue']);
                        imagecolortransparent($waterHandle, $transparent_destination_index);
                        imagefill($waterHandle, 0, 0, $transparent_destination_index);
                    }
                    break;
                case 2:
                    $waterHandle = imagecreatefromjpeg($watermark);
                    break;
                case 3:
                    $waterHandle = imagecreatefrompng($watermark);
                    imagealphablending($waterHandle, false);
                    imagesavealpha($waterHandle, true);
                    imagealphablending($dstHandle, true);
                    break;
                    break;
                default:
                    self::error('NO WATERMARK FILE');
                    return false;
            }
            imagecopy($dstHandle, $waterHandle, $offsets['x'], $offsets['y'], 0, 0, $water_w, $water_h);
            imagedestroy($waterHandle);
        }
        switch ($type) {
            case 1:
                imagegif($dstHandle, $dest_file);
                break;
            case 2:
                imagejpeg($dstHandle, $dest_file, $dest_qual);
                break;
            case 3:
                imagepng($dstHandle, $dest_file);
                break;
            default:
                self::error('File Type Not Supported!');
                return false;
        }
        imagedestroy($dstHandle);
        return true;
    }

    protected function _draw_watermark($src_file, $dest_file, $dest_qual = 95, $watermark = false, $watermark_position = array(
        50,
        50
    ))
    {
        list ($srcWidth, $srcHeight, $type) = getimagesize($src_file);
        switch ($type) {
            case 1:
                $srcHandle = imagecreatefromgif($src_file);
                break;
            case 2:
                $srcHandle = imagecreatefromjpeg($src_file);
                break;
            case 3:
                $srcHandle = imagecreatefrompng($src_file);
                break;
            default:
                self::error('NO FILE');
                return false;
        }
        $dstHandle = imagecreatetruecolor($srcWidth, $srcHeight);
        switch ($type) {
            case 1:
                $transparent_source_index = imagecolortransparent($srcHandle);
                if ($transparent_source_index !== - 1) {
                    $transparent_color = imagecolorsforindex($srcHandle, $transparent_source_index);
                    $transparent_destination_index = imagecolorallocate($dstHandle, $transparent_color['red'], $transparent_color['green'], $transparent_color['blue']);
                    imagecolortransparent($dstHandle, $transparent_destination_index);
                    imagefill($dstHandle, 0, 0, $transparent_destination_index);
                }
                break;
            case 3:
                imagealphablending($dstHandle, false);
                imagesavealpha($dstHandle, true);
                $transparent_color = imagecolorallocatealpha($dstHandle, 0, 0, 0, 127);
                imagefill($dstHandle, 0, 0, $transparent_color);
                break;
        }
        imagecopy($dstHandle, $srcHandle, 0, 0, 0, 0, $srcWidth, $srcHeight);
        imagedestroy($srcHandle);
        if ($watermark) {
            list ($water_w, $water_h, $water_type) = getimagesize($watermark);
            $offsets = $this->calculate_watermark_offsets($srcWidth, $srcHeight, $water_w, $water_h, $watermark_position);
            switch ($water_type) {
                case 1:
                    $waterHandle = imagecreatefromgif($watermark);
                    $transparent_source_index = imagecolortransparent($waterHandle);
                    if ($transparent_source_index !== - 1) {
                        $transparent_color = imagecolorsforindex($waterHandle, $transparent_source_index);
                        $transparent_destination_index = imagecolorallocate($waterHandle, $transparent_color['red'], $transparent_color['green'], $transparent_color['blue']);
                        imagecolortransparent($waterHandle, $transparent_destination_index);
                        imagefill($waterHandle, 0, 0, $transparent_destination_index);
                    }
                    break;
                case 2:
                    $waterHandle = imagecreatefromjpeg($watermark);
                    break;
                case 3:
                    $waterHandle = imagecreatefrompng($watermark);
                    imagealphablending($waterHandle, false);
                    imagesavealpha($waterHandle, true);
                    break;
                    break;
                default:
                    self::error('NO WATERMARK FILE');
                    return false;
            }
            imagecopy($dstHandle, $waterHandle, $offsets['x'], $offsets['y'], 0, 0, $water_w, $water_h);
            imagedestroy($waterHandle);
        }
        switch ($type) {
            case 1:
                imagegif($dstHandle, $dest_file);
                break;
            case 2:
                imagejpeg($dstHandle, $dest_file, $dest_qual);
                break;
            case 3:
                imagepng($dstHandle, $dest_file);
                break;
            default:
                self::error('File Type Not Supported!');
                return false;
        }
        imagedestroy($dstHandle);
        return true;
    }

    protected function calculate_watermark_offsets($img_w, $img_h, $water_w, $water_h, $water_pos)
    {
        $offsets = array();
        $pos_x = ($water_pos[0] < 0 or $water_pos[0] > 100) ? 0 : $water_pos[0];
        $pos_y = ($water_pos[1] < 0 or $water_pos[1] > 100) ? 0 : $water_pos[1];
        $avail_w = $img_w - $water_w;
        $avail_h = $img_h - $water_h;
        if ($avail_w < 0)
            $avail_w = 0;
        if ($avail_h < 0)
            $avail_h = 0;
        if (! $avail_w)
            $offsets['x'] = 0;
        else {
            $offsets['x'] = round($avail_w / 100 * $pos_x);
        }
        if (! $avail_h)
            $offsets['y'] = 0;
        else {
            $offsets['y'] = round($avail_h / 100 * $pos_y);
        }
        return $offsets;
    }

    protected function _clean_file_name($txt)
    {
        $replace = array(
            'Š' => 'S',
            'Œ' => 'O',
            'Ž' => 'Z',
            'š' => 's',
            'œ' => 'oe',
            'ž' => 'z',
            'Ÿ' => 'Y',
            '¥' => 'Y',
            'µ' => 'u',
            'À' => 'A',
            'Á' => 'A',
            'Â' => 'A',
            'Ã' => 'A',
            'Ä' => 'A',
            'Å' => 'A',
            'Æ' => 'A',
            'Ç' => 'C',
            'È' => 'E',
            'É' => 'E',
            'Ê' => 'E',
            'Ë' => 'E',
            'Ì' => 'I',
            'Í' => 'I',
            'Î' => 'I',
            'Ï' => 'I',
            'І' => 'I',
            'Ð' => 'D',
            'Ñ' => 'N',
            'Ò' => 'O',
            'Ó' => 'O',
            'Ô' => 'O',
            'Õ' => 'O',
            'Ö' => 'O',
            'Ø' => 'O',
            'Ù' => 'U',
            'Ú' => 'U',
            'Û' => 'U',
            'Ü' => 'U',
            'Ý' => 'Y',
            'ß' => 'ss',
            'à' => 'a',
            'á' => 'a',
            'â' => 'a',
            'ã' => 'a',
            'ä' => 'a',
            'å' => 'a',
            'æ' => 'a',
            'ç' => 'c',
            'è' => 'e',
            'é' => 'e',
            'ê' => 'e',
            'ë' => 'e',
            'ì' => 'i',
            'í' => 'i',
            'î' => 'i',
            'ï' => 'i',
            'і' => 'i',
            'ð' => 'o',
            'ñ' => 'n',
            'ò' => 'o',
            'ó' => 'o',
            'ô' => 'o',
            'õ' => 'o',
            'ö' => 'o',
            'ø' => 'o',
            'ù' => 'u',
            'ú' => 'u',
            'û' => 'u',
            'ü' => 'u',
            'ý' => 'y',
            'ÿ' => 'y',
            'ă' => 'a',
            'ş' => 's',
            'ţ' => 't',
            'ț' => 't',
            'Ț' => 'T',
            'Ș' => 'S',
            'ș' => 's',
            'Ş' => 'S',
            'А' => 'A',
            'Б' => 'B',
            'В' => 'V',
            'Г' => 'G',
            'Д' => 'D',
            'Е' => 'E',
            'Ё' => 'E',
            'Ж' => 'J',
            'З' => 'Z',
            'И' => 'I',
            'Й' => 'I',
            'К' => 'K',
            'Л' => 'L',
            'М' => 'M',
            'Н' => 'N',
            'О' => 'O',
            'П' => 'P',
            'Р' => 'R',
            'С' => 'S',
            'Т' => 'T',
            'У' => 'U',
            'Ф' => 'F',
            'Х' => 'H',
            'Ц' => 'C',
            'Ч' => 'CH',
            'Ш' => 'SH',
            'Щ' => 'SH',
            'Ы' => 'Y',
            'Э' => 'E',
            'Ю' => 'YU',
            'Я' => 'YA',
            'а' => 'a',
            'б' => 'b',
            'в' => 'v',
            'г' => 'g',
            'д' => 'd',
            'е' => 'e',
            'ё' => 'e',
            'ж' => 'j',
            'з' => 'z',
            'и' => 'i',
            'й' => 'i',
            'к' => 'k',
            'л' => 'l',
            'м' => 'm',
            'н' => 'n',
            'о' => 'o',
            'п' => 'p',
            'р' => 'r',
            'с' => 's',
            'т' => 't',
            'у' => 'u',
            'ф' => 'f',
            'х' => 'H',
            'ц' => 'c',
            'ч' => 'ch',
            'ш' => 'sh',
            'щ' => 'sh',
            'ы' => 'y',
            'э' => 'e',
            'ю' => 'yu',
            'я' => 'ya',
            'Ā' => 'A',
            'ā' => 'a',
            'Č' => 'C',
            'č' => 'c',
            'Ē' => 'E',
            'ē' => 'e',
            'Ģ' => 'G',
            'ģ' => 'g',
            'Ī' => 'I',
            'ī' => 'i',
            'Ķ' => 'K',
            'ķ' => 'k',
            'Ļ' => 'L',
            'ļ' => 'l',
            'Ņ' => 'N',
            'ņ' => 'n',
            'Ū' => 'U',
            'ū' => 'u',
            ' ' => '_'
        );
        $txt = str_replace(array_keys($replace), array_values($replace), $txt);
        $txt = preg_replace('/[^a-zA-Z0-9_\-\.]+/', '', $txt);
        return $txt;
    }

    protected function _file_size($path)
    {
        return number_format(is_file($path) ? filesize($path) / 1024 : 0, 2, '.', ' ') . ' KB';
    }

    protected function _file_size_bin($text)
    {
        return number_format(strlen($text) / 1024, 2, '.', ' ') . ' KB';
    }

    protected function _prepare_field($field)
    {
        preg_match_all('/([^<>!=]+)/u', $field, $matches);
        preg_match_all('/([<>!=]+)/u', $field, $matches2);
        return '`' . trim($matches[0][0]) . '`' . ($matches2[0] ? implode('', $matches2[0]) : '=');
    }

    protected function _field_from_where($field)
    {
        return preg_replace('/\s*[<>!=]+\s*$/u', '', $field);
    }

    protected function _cond_from_where($field)
    {
        if (preg_match('/\s*([<>!=]+)\s*$/u', $field, $matches)) {
            return $matches[1];
        } else {
            return '=';
        }
    }

    protected function _where_field($param)
    {
        return '`' . $param['table'] . '`.`' . $this->_field_from_where($param['field']) . '`';
    }

    protected function _where_fieldkey($param)
    {
        return $param['table'] . '.' . $this->_field_from_where($param['field']);
    }

    protected function _cond_from_where_in($field)
    {
        if (preg_match('/\s*[!]+\s*$/u', $field)) {
            return ' NOT IN';
        } else {
            return ' IN';
        }
    }

    protected function _prepare_field_in($field)
    {
        preg_match_all('/([^!]+)/u', $field, $matches);
        preg_match_all('/([!]+)/u', $field, $matches2);
        return '`' . trim($matches[0][0]) . '`' . ($matches2[0] ? ' NOT IN' : ' IN');
    }

    /**
     *
     * @author Ariel Canal
     *         Inserido os operadores IN e NOT IN
     *        
     */
    protected function _compare($val1, $operator, $val2)
    {
        switch ($operator) {
            case 'IN':
                if (! is_array($val2))
                    $val2 = $this->parse_comma_separated($val2);
                return in_array($val1, $val2);
            case 'NOT IN':
                if (! is_array($val2))
                    $val2 = $this->parse_comma_separated($val2);
                return ! in_array($val1, $val2);
            case '=':
                return ($val1 == $val2) ? true : false;
            case '>':
                return ($val1 > $val2) ? true : false;
            case '<':
                return ($val1 < $val2) ? true : false;
            case '>=':
                return ($val1 >= $val2) ? true : false;
            case '<=':
                return ($val1 <= $val2) ? true : false;
            case '!=':
                return ($val1 != $val2) ? true : false;
            case '^=':
                return (mb_strpos($val1, $val2, 0, \Config\App::$charset) === 0) ? true : false;
            case '$=':
                return (mb_strpos($val1, $val2, 0, \Config\App::$charset) == (mb_strlen($val1, \Config\App::$charset) - mb_strlen($val2, \Config\App::$charset))) ? true : false;
            case '~=':
                return (mb_strpos($val1, $val2, 0, \Config\App::$charset) !== false) ? true : false;
            default:
                return false;
        }
    }

    protected function create_modal($field, $content, $image = false)
    {
        $out = '';
        $attr = array(
            'href' => 'javascript:;',
            'data-header' => $this->columns_names[$field],
            'data-content' => $content
        );
        if ($image) {
            $attr['data-content'] = $this->single_tag('img', '', array(
                'alt' => '',
                'src' => $image
            ));
        } else {
            $attr['data-content'] = $content;
        }
        $out .= $this->open_tag('a', 'xcrud_modal', $attr);
        if (XcrudConfig::$images_in_grid && $image) {
            $out .= $content;
        } else {
            $out .= $this->open_tag('i', $this->modal[$field] ? $this->modal[$field] : $this->theme_config('modal_icon')) . $this->close_tag('i');
        }
        $out .= $this->close_tag('a');
        return $out;
    }

    protected function _render_list_item($field, $value, $primary_val, $row)
    {
        $modal = '';
        $out = '';
        $image = '';
        if (isset($this->relation[$field])) {
            $value = $row['rel.' . $field];
        }
        if (isset($this->column_callback[$field])) {
            $path = $this->check_file($this->column_callback[$field]['path'], 'column_callback');
            include_once ($path);
            if (is_callable($this->column_callback[$field]['callback']) && $row) {
                $value = call_user_func_array($this->column_callback[$field]['callback'], array(
                    $value,
                    $field,
                    $primary_val,
                    $row,
                    $this
                ));
                return $value;
            }
        }

        if (isset($this->field_type[$field])) {
            switch ($this->field_type[$field]) {
                case 'select':
                case 'radio':
                    $out .= $this->create_view_select($field, $value);
                    break;
                case 'multiselect':
                case 'checkboxes':
                    $out .= $this->create_view_multiselect($field, $value);
                    break;
                case 'timestamp':
                case 'datetime':
                    if ($value) {
                        $out .= $this->mysql2datetime($value);
                    }
                    break;
                case 'date':
                    if ($value) {
                        $out .= $this->mysql2date($value);
                    }
                    break;
                case 'time':
                    if ($value) {
                        $out .= $this->mysql2time($value);
                    }
                    break;
                case 'price':
                    $out .= $this->cast_number_format($value, $field);
                    break;
                case 'bool':
                    $out .= $value ? $this->lang('bool_on') : $this->lang('bool_off');
                    break;
                case 'file':
                    if ($value) {
                        $out .= $this->open_tag('a', '', array(
                            'target' => '_blank',
                            'href' => isset($this->upload_config[$field]['url']) ? $this->real_file_link($value, $this->upload_config[$field]) : $this->file_link($field, $primary_val)
                        ));

                        if (isset($this->upload_config[$field]['text'])) {
                            $out .= $this->upload_config[$field]['text'];
                        } elseif (isset($this->upload_config[$field]['filename'])) {
                            $out .= $this->upload_config[$field]['filename'];
                        } elseif (isset($this->upload_config[$field]['blob']) && $this->upload_config[$field]['blob']) {
                            $out .= 'blob-storage';
                        } else {
                            $out .= $this->filter_file_name($value);
                        }

                        $out .= $this->close_tag('a');
                        break;
                    }
                case 'image':
                    if ($value) {
                        if (XcrudConfig::$images_in_grid) {
                            $settings = $this->upload_config[$field];
                            if (isset($settings['grid_thumb']) && isset($settings['thumbs'][$settings['grid_thumb']])) {
                                $thumb = $settings['grid_thumb'];
                            } else {
                                $thumb = false;
                            }
                            $out .= $this->single_tag('img', '', array(
                                'alt' => '',
                                'src' => isset($this->upload_config[$field]['url']) ? $this->real_file_link($value, $this->upload_config[$field]) : $this->file_link($field, $primary_val, $thumb, false, $value),
                                'style' => 'max-height: ' . XcrudConfig::$images_in_grid_height . 'px;'
                            ));
                        } else {
                            $out .= $this->open_tag('a', '', array(
                                'target' => '_blank',
                                'href' => isset($this->upload_config[$field]['url']) ? $this->real_file_link($value, $this->upload_config[$field]) : $this->file_link($field, $primary_val, false, false, $value)
                            ));
                            $out .= isset($this->upload_config[$field]['text']) ? $this->upload_config[$field]['text'] : $value;
                            $out .= $this->close_tag('a');
                        }
                    }
                    $image = isset($this->upload_config[$field]['url']) ? $this->real_file_link($value, $this->upload_config[$field]) : $this->file_link($field, $primary_val, false, false, $value);
                    break;
                case 'remote_image':
                    if ($value) {
                        if (XcrudConfig::$images_in_grid) {
                            $out .= $this->single_tag('img', '', array(
                                'alt' => '',
                                'src' => $value,
                                'style' => 'max-height: ' . XcrudConfig::$images_in_grid_height . 'px;'
                            ));
                        } else {
                            $out .= $this->open_tag('a', '', array(
                                'target' => '_blank',
                                'href' => $value
                            ));
                            $out .= isset($this->upload_config[$field]['text']) ? $this->upload_config[$field]['text'] : $value;
                            $out .= $this->close_tag('a');
                        }
                    }
                    $image = $value;
                    break;
                case 'binary':
                    $out .= $value ? '[binary data]' : '';
                    break;
                case 'text':
                    $value = $this->_cut($value, $field);
                    if (XcrudConfig::$clickable_list_links) {
                        $value = $this->make_links($value);
                        $value = $this->make_mailto($value);
                    }
                    $out .= $value;
                    break;
                case 'textarea':
                case 'texteditor':
                    if (isset($this->modal[$field])) {
                        $out .= $value;
                    } else if (! is_null($value = $this->_cut($value, $field))) {
                        $out .= nl2br($value);
                    }
                    break;
                default:
                    $out .= $this->_cut($value, $field);
                    break;
            }
        } else {
            $out .= $this->_cut($value, $field);
        }
        if (isset($this->column_pattern[$field])) {
            $out = str_ireplace('{value}', $out, $this->column_pattern[$field]);
            $out = $this->replace_text_variables($out, $row, false);
        }

        if (trim($out) == '') {
            $out = '&nbsp;';
        }

        if (isset($this->modal[$field]) && $value) {
            return $this->create_modal($field, $out, $image);
        } else {
            return $out;
        }
    }

    protected function make_mailto($txt)
    {
        if ($this->emails_label)
            return preg_replace('/([A-Za-z0-9_\-\.]+)\@([A-Za-z0-9_\-\.]+)\.([A-Za-z]{2,4})/', '<a target="_blank" href="mailto:$1@$2.$3">' . $this->emails_label['text'] . '</a>', $txt);
        else
            return preg_replace('/([A-Za-z0-9_\-\.]+)\@([A-Za-z0-9_\-\.]+)\.([A-Za-z]{2,4})/', '<a target="_blank" href="mailto:$1@$2.$3">$1@$2.$3</a>', $txt);
    }

    protected function make_links($txt)
    {
        if ($this->links_label)
            return preg_replace('/(http:\/\/|https:\/\/)([^\s]+)/u', '<a target="_blank" href="$1$2">' . $this->links_label['text'] . '</a>', $txt);
        else
            return preg_replace('/(http:\/\/|https:\/\/)([^\s]+)/u', '<a target="_blank" href="$1$2">$1$2</a>', $txt);
    }

    /**
     * renders grid cell content, srips tags and prepares values for export in
     * csv or other
     */
    protected function _render_export_item($field, $value, $primary_val, $row)
    {
        $out = '';
        if (isset($this->relation[$field])) {
            $value = strip_tags($row['rel.' . $field]);
        }
        if (isset($this->column_callback[$field])) {
            $path = $this->check_file($this->column_callback[$field]['path'], 'column_callback');
            include_once ($path);
            if (is_callable($this->column_callback[$field]['callback']) && $row) {
                $value = strip_tags(call_user_func_array($this->column_callback[$field]['callback'], array(
                    $value,
                    $field,
                    $primary_val,
                    $row,
                    $this
                )));
                return $value;
            }
        }

        if (isset($this->field_type[$field])) {
            switch ($this->field_type[$field]) {
                case 'select':
                case 'radio':
                    $out .= $this->create_view_select($field, $value);
                    break;
                case 'multiselect':
                case 'checkboxes':
                    $out .= $this->create_view_multiselect($field, $value);
                    break;
                case 'timestamp':
                case 'datetime':
                    if ($value) {
                        $out .= $this->mysql2datetime($value);
                    }
                    break;
                case 'date':
                    if ($value) {
                        $out .= $this->mysql2date($value);
                    }
                    break;
                case 'time':
                    if ($value) {
                        $out .= $this->mysql2time($value);
                    }
                    break;
                case 'price':
                    $out .= $this->cast_number_format($value, $field);
                    break;
                case 'bool':
                    $out .= $value ? $this->lang('bool_on') : $this->lang('bool_off');
                    break;
                case 'file':
                case 'image':
                    if (isset($this->upload_config[$field]['blob'])) {
                        $out .= $value ? '[binary data]' : '';
                    } else {
                        $out .= isset($this->upload_config[$field]['text']) ? $this->upload_config[$field]['text'] : $value;
                    }
                    break;
                case 'remote_image':
                    $out .= $value;
                    break;
                case 'binary':
                    $out .= $value ? '[binary data]' : '';
                    break;
                case 'text':
                case 'textarea':
                case 'texteditor':
                default:
                    $out .= $value;
                    break;
            }
        } else {
            $out .= $value;
        }
        if (isset($this->column_pattern[$field])) {
            $out = str_ireplace('{value}', $out, $this->column_pattern[$field]);
            $out = $this->replace_text_variables($out, $row, true);
            $out = strip_tags($out);
        }
        return $out;
    }

    /**
     *
     * @author Ariel Canal
     *         Inserido o atributo data-after na renderiza��o do bot�o de
     *         duplica��o
     */
    protected function _render_list_buttons(&$row)
    {
        $out = '';
        $group = array(
            'tag' => 'span',
            'class' => $this->theme_config('grid_button_group')
        );
        $out .= $this->open_tag($group);
        if ($this->buttons) {
            foreach ($this->buttons as $button) {
                if ($button['table_ro'] == false && $this->table_ro) {
                    continue;
                }
                if ($this->is_button($button['name'], $row)) {
                    // $href = '';
                    /*
                     * if ($button['params'])
                     * {
                     * $href = http_build_query($button['params']);
                     * }
                     */
                    $link = $this->replace_text_variables($button['link'], $row, true);
                    /*
                     * if ($href)
                     * {
                     * $link = $link . ((mb_strpos($button['link'], '?') ===
                     * false) ? '?' : '&amp;') . $href;
                     * }
                     */
                    if ($button['params']) {
                        foreach ($button['params'] as $pkey => $pval) {
                            $button['params'][$pkey] = $this->replace_text_variables($pval, $row, true);
                        }
                    }
                    $tag = array(
                        'tag' => 'a',
                        'class' => $this->theme_config('grid_default'),
                        'href' => $link,
                        'title' => $button['name']
                    );
                    $out .= $this->open_tag($tag, $button['class'], $button['params']);
                    if ($button['icon']) {
                        $out .= $this->open_tag('i', $button['icon']) . $this->close_tag('i');
                    } elseif ($this->theme_config('grid_default_icon')) {
                        $out .= $this->open_tag('i', $this->theme_config('grid_default_icon')) . $this->close_tag('i');
                    }
                    if (XcrudConfig::$button_labels) {
                        $out .= ' ' . $this->html_safe($button['name']);
                    }
                    $out .= $this->close_tag($tag);
                }
            }
        }
        if (! isset($this->hide_button['duplicate']) && ! $this->table_ro && $this->is_duplicate($row)) {
            $tag = array(
                'tag' => 'a',
                'class' => 'xcrud-action',
                'title' => $this->lang('duplicate'),
                'href' => 'javascript:;',
                'data-primary' => $row['primary_key'],
                'data-confirm' => $this->lang('duplicate_confirm'),
                'data-task' => 'clone',
                'data-after' => 'edit'
            );
            $out .= $this->open_tag($tag, $this->theme_config('grid_duplicate'));
            if ($this->theme_config('grid_duplicate_icon')) {
                $out .= $this->open_tag('i', $this->theme_config('grid_duplicate_icon')) . $this->close_tag('i');
            }
            if (XcrudConfig::$button_labels) {
                $out .= ' ' . $this->lang('duplicate');
            }
            $out .= $this->close_tag($tag);
        }
        if (! isset($this->hide_button['view']) && $this->is_view($row)) {
            $tag = array(
                'tag' => 'a',
                'class' => 'xcrud-action',
                'title' => $this->lang('view'),
                'href' => 'javascript:;',
                'data-primary' => $row['primary_key'],
                'data-task' => 'view'
            );
            $out .= $this->open_tag($tag, $this->theme_config('grid_view'));
            if ($this->theme_config('grid_view_icon')) {
                $out .= $this->open_tag('i', $this->theme_config('grid_view_icon')) . $this->close_tag('i');
            }
            if (XcrudConfig::$button_labels) {
                $out .= ' ' . $this->lang('view');
            }
            $out .= $this->close_tag($tag);
        }
        if (! isset($this->hide_button['edit']) && ! $this->table_ro && $this->is_edit($row)) {
            $tag = array(
                'tag' => 'a',
                'class' => 'xcrud-action',
                'title' => $this->lang('edit'),
                'href' => 'javascript:;',
                'data-primary' => $row['primary_key'],
                'data-task' => 'edit'
            );
            $out .= $this->open_tag($tag, $this->theme_config('grid_edit'));
            if ($this->theme_config('grid_edit_icon')) {
                $out .= $this->open_tag('i', $this->theme_config('grid_edit_icon')) . $this->close_tag('i');
            }
            if (XcrudConfig::$button_labels) {
                $out .= ' ' . $this->lang('edit');
            }
            $out .= $this->close_tag($tag);
        }
        if (! isset($this->hide_button['remove']) && ! $this->table_ro && $this->is_remove($row)) {
            $tag = array(
                'tag' => 'a',
                'class' => 'xcrud-action',
                'title' => $this->lang('remove'),
                'href' => 'javascript:;',
                'data-primary' => $row['primary_key'],
                'data-task' => 'remove'
            );
            if ($this->remove_confirm) {
                $tag['data-confirm'] = $this->lang('deleting_confirm');
            }
            $out .= $this->open_tag($tag, $this->theme_config('grid_remove'));
            if ($this->theme_config('grid_remove_icon')) {
                $out .= $this->open_tag('i', $this->theme_config('grid_remove_icon')) . $this->close_tag('i');
            }
            if (XcrudConfig::$button_labels) {
                $out .= ' ' . $this->lang('remove');
            }
            $out .= $this->close_tag($tag);
        }

        $out .= $this->close_tag($group);
        return $out;
    }

    protected function render_sum_item($field)
    {
        if (isset($this->sum_row[$field])) {
            if ($this->sum[$field]['custom']) {
                return str_replace('{value}', $this->_render_list_item($field, $this->sum_row[$field], 0, null), $this->sum[$field]['custom']);
            } else {
                return $this->_render_list_item($field, $this->sum_row[$field], 0, null);
            }
        } else
            return '&nbsp;';
    }

    protected function _check_unique_value()
    {
        $db = Database::get_instance($this->connection, $this->ci);
        $unique = $this->_post('unique');
        $fdata = $this->_parse_field_names($unique, '_check_unique_value');
        $out = array();
        $table_join = $this->_build_table_join();
        if ($this->primary_val) {
            $primary_where = '`' . $this->table . '`.`' . $this->primary_key . '` != ' . $db->escape($this->primary_val) . ' AND';
        } else {
            $primary_where = '';
        }
        foreach ($fdata as $fkey => $fitem) {
            $q = 'SELECT COUNT(*) AS `count` FROM `' . $this->table . '`' . $table_join . ' WHERE ' . $primary_where . ' `' . $fitem['table'] . '`.`' . $fitem['field'] . '` = ' . $db->escape($fitem['value']);
            $db->query($q);
            $this->result_row = $db->row();
            if ($this->result_row['count'] > 0) {
                $out[] = '[name="' . $this->fieldname_encode($fkey) . '"]';
            }
        }
        if ($out) {
            $data = array(
                'error' => array(
                    'selector' => implode(',', $out)
                )
            );
        } else {
            $data = array(
                'success' => 1
            );
        }
        // $data['key'] = $this->key;
        return json_encode($data);
    }

    public static function check_url($url, $scr_url = false)
    {
        if (! $url && ! $scr_url)
            return false;
        $url = rtrim($url, '/');
        $host = trim($_SERVER['HTTP_HOST'], '/');
        $scheme = (! isset($_SERVER['HTTPS']) or ! $_SERVER['HTTPS'] or strtolower($_SERVER['HTTPS']) == 'off' or strtolower($_SERVER['HTTPS']) == 'no') ? 'http://' : 'https://';
        // some troubles with sym links between private and public
        $doc_root = trim(str_replace('\\', '/', str_replace(array(
            '/public_html',
            '/private_html'
        ), '', $_SERVER['DOCUMENT_ROOT'])), '/');
        $file_dir = trim(str_replace('\\', '/', str_replace(array(
            '/public_html',
            '/private_html'
        ), '', dirname(__file__))), '/');

        $curr_host = $scheme . $host;
        $is_full_url = mb_strpos($url, '://') === false ? false : true;
        if ($is_full_url) { // www fix
            $curr_www = preg_match('/:\/\/www\./u', $curr_host) ? true : false;
            $url_www = preg_match('/:\/\/www\./u', $url) ? true : false;
            if ($curr_www != $url_www) {
                if ($curr_www) {
                    $url = preg_replace('/(:\/\/)/u', '$1www.', $url, 1);
                } else {
                    $url = preg_replace('/(:\/\/)www\./u', '$1', $url, 1);
                }
            }
        } elseif (XcrudConfig::$urls2abs) {
            if (mb_substr($url, 0, 1) == '/' or mb_substr($url, 0, 2) == './') {
                $url = $curr_host . ltrim($url, '.');
            } elseif ($scr_url && ! $url) {
                // $script_uri = ltrim(mb_substr($file_dir, mb_strpos($file_dir,
                // $doc_root) + mb_strlen($doc_root)), '/');

                $file_dir = explode('/', $file_dir);
                $max_root = array();
                $file_dir = array_reverse($file_dir);
                foreach ($file_dir as $segment) {

                    if (mb_substr($doc_root, - mb_strlen($segment) - 1, mb_strlen($segment) + 1) != '/' . $segment) {
                        array_unshift($max_root, $segment);
                    } else {
                        break;
                    }
                }
                $script_uri = implode('/', $max_root);

                // $script_uri = trim(str_replace(str_replace('\\', '/',
                // $document_root), '', str_replace('\\', '/', $file_dir)),
                // '/');
                $url = $curr_host . '/' . $script_uri;
            } else {
                // $script_uri = ltrim(mb_substr($file_dir, mb_strpos($file_dir,
                // $doc_root) + mb_strlen($doc_root)), '/');
                $file_dir = explode('/', $file_dir);
                $max_root = array();
                $file_dir = array_reverse($file_dir);
                foreach ($file_dir as $segment) {

                    if (mb_substr($doc_root, - mb_strlen($segment) - 1, mb_strlen($segment) + 1) != '/' . $segment) {
                        array_unshift($max_root, $segment);
                    } else {
                        break;
                    }
                }
                $script_uri = implode('/', $max_root);

                // $script_uri = trim(str_replace(str_replace('\\', '/',
                // $document_root), '', str_replace('\\', '/', $file_dir)),
                // '/');
                $request_uri = trim($_SERVER['REQUEST_URI'], '/');

                $script_uri_a = /*explode('/', $script_uri)*/ $max_root;
                $request_uri_a = explode('/', $request_uri);
                $count = count($request_uri_a);
                $new_url = array();
                for ($i = 0; $i < $count; ++ $i) {
                    if (isset($script_uri_a[$i]) && $script_uri_a[$i] == $request_uri_a[$i]) {
                        $new_url[] = $request_uri_a[$i];
                    } else {
                        break;
                    }
                }
                if (dirname($request_uri) != $script_uri) {
                    foreach (explode('/', ltrim($url, '/')) as $segment) {
                        if ($segment == '..') {
                            array_pop($new_url);
                        } else {
                            $new_url[] = $segment;
                        }
                    }
                }
                if ($new_url) {
                    $url = $curr_host . '/' . implode('/', $new_url);
                }
            }
        } // echo $url.'<br />';

        return $url;
    }

    protected function file_link($field, $primary_val, $thumb = false, $crop = false, $filename = false)
    {
        $params = array(
            'xcrud' => array(
                'instance' => $this->instance_name,
                'field' => $field,
                'primary' => $primary_val,
                'key' => $this->key,
                'task' => 'file',
                'rand' => base_convert(sha1($this->instance_name . ($filename ? $filename : rand())), 10, 36)
            )
        );
        if ($thumb !== false) {
            $params['xcrud']['thumb'] = $thumb;
        }
        if ($crop) {
            $params['xcrud']['crop'] = $crop;
        }
        if (XcrudConfig::$dynamic_session) {
            $params['xcrud']['sess_name'] = session_name();
        }
        return XcrudConfig::$scripts_url . '/' . XcrudConfig::$ajax_uri . '?' . http_build_query($params);
    }

    protected function real_file_link($filename, $params, $is_details = false)
    {
        $url = rtrim($params['url'], '/');
        if ($is_details && isset($params['detail_thumb']) && isset($params['thumbs'][$params['detail_thumb']])) {
            $th = $params['thumbs'][$params['detail_thumb']];
            if (isset($th['folder'])) {
                $url .= '/' . trim($th['folder'], '/');
            }
            if (isset($th['marker'])) {
                $url .= '/' . $this->_thumb_name($filename, $th['marker']);
            } else {
                $url .= '/' . $filename;
            }
        } elseif (! $is_details && isset($params['grid_thumb']) && isset($params['thumbs'][$params['grid_thumb']])) {
            $th = $params['thumbs'][$params['grid_thumb']];
            if (isset($th['folder'])) {
                $url .= '/' . trim($th['folder'], '/');
            }
            if (isset($th['marker'])) {
                $url .= '/' . $this->_thumb_name($filename, $th['marker']);
            } else {
                $url .= '/' . $filename;
            }
        } else {
            $url .= '/' . $filename;
        }
        return $url;
    }

    protected function html_safe($text)
    {
        return htmlspecialchars((string) $text, ENT_QUOTES, \Config\App::$charset);
    }

    /**
     *
     * @author Ariel Canal
     *         Fun��o passou a considerar o atributo data-after do bot�o
     */
    protected function _clone_row()
    {
        if (is_array($this->table_info) && count($this->table_info) && ! $this->table_ro) {
            $db = Xcrud_db::get_instance($this->connection);
            $fields = array();
            $row = array();
            $this->find_details_text_variables();
            if ($this->direct_select_tags) {
                foreach ($this->direct_select_tags as $key => $dsf) {
                    if ($dsf['table'] == $this->table || (isset($this->join[$dsf['table']]) && $this->join[$dsf['table']]['not_insert'] != true)) {
                        $fields[$key] = "`{$dsf['table']}`.`{$dsf['field']}` AS `{$key}`";
                    }
                }
            }
            if ($fields) {
                if (! $this->join) {
                    $db->query('SELECT ' . implode(',', $fields) . " FROM `{$this->table}` WHERE `{$this->primary_key}` = " . $db->escape($this->primary_val) . " LIMIT 1");
                    $row = $db->row();
                } else {
                    $tables = array(
                        '`' . $this->table . '`'
                    );
                    $joins = array();
                    foreach ($this->join as $alias => $param) {
                        if ($param['not_insert'] != true) {
                            $tables[] = '`' . $alias . '`';
                            $joins[] = "INNER JOIN `{$param['join_table']}` AS `{$alias}` ON `{$param['table']}`.`{$param['field']}` = `{$alias}`.`{$param['join_field']}` " . $param['additional_cond'];
                        }
                    }
                    $db->query('SELECT ' . implode(',', $fields) . " FROM `{$this->table}` AS `{$this->table}` " . implode(' ', $joins) . " WHERE `{$this->table}`.`{$this->primary_key}` = " . $db->escape($this->primary_val));
                    $row = $db->row();
                }
            }

            if (! $this->is_duplicate($row)) {
                return self::error('Forbidden');
            }

            $columns = array();
            $this->primary_ai = false;
            foreach ($this->table_info as $table => $types) {
                if ($table == $this->table || (isset($this->join[$table]) && $this->join[$table]['not_insert'] != true)) {
                    foreach ($types as $row) {
                        $field_index = "{$table}.{$row['Field']}";
                        if ($row['Key'] == 'PRI' && $row['Extra'] == 'auto_increment') {
                            if ($table == $this->table) {
                                $this->primary_ai = "`{$table}`.`{$row['Field']}`";
                            }
                        } elseif ($row['Key'] == 'UNI' or $row['Key'] == 'PRI') {
                            self::error('Duplication impossible. The table has a unique field.');
                        } else {
                            $columns[$field_index] = array(
                                'table' => $table,
                                'field' => $row['Field']
                            );
                        }
                    }
                }
            }
            if (! $this->primary_ai) {
                self::error('Duplication impossible. Table does not have a primary autoincrement field.');
            }
            $select = $this->_build_select_clone($columns);
            $where = $this->_build_where();
            $table_join = $this->_build_table_join();
            $where_ai = $where ? "AND {$this->primary_ai} = " . (int) $this->primary_val : "WHERE {$this->primary_ai} = " . (int) $this->primary_val;
            $db->query("SELECT {$select}\r\n FROM `{$this->table}`\r\n {$table_join}\r\n {$where}\r\n {$where_ai} LIMIT 1");
            $postdata = $db->row();
            if (isset($this->pass_var['create'])) {
                foreach ($this->pass_var['create'] as $field => $pv) {
                    $postdata[$field] = $pv['value'];
                }
            }
            if (! $this->demo_mode) {
                if (count($this->upload_config)) {
                    foreach ($this->upload_config as $field => $attr) {
                        $postdata[$field] = $this->_clone_file($field, $postdata[$field]);
                    }
                }
                $ins_id = $this->_insert($postdata, true, $columns);
                if ($this->after_clone && $ins_id) {
                    $path = $this->check_file($this->after_clone['path'], 'after_clone');
                    include_once ($path);
                    if (is_callable($this->after_clone['callable'])) {
                        call_user_func_array($this->after_clone['callable'], array(
                            $this->primary_val,
                            $ins_id,
                            $this
                        ));
                        if ($this->exception) {
                            return $this->call_exception($postdata);
                        }
                    }
                }
            }
        }
        $this->task = 'list';
        return $this->_run_task();
    }

    protected function _build_select_clone($columns)
    {
        $fields = array();
        foreach ($columns as $key => $val) {
            if ($val)
                $fields[] = "`{$val['table']}`.`{$val['field']}` AS `$key`";
        }
        return implode(',', $fields);
    }

    protected function send_email($to, $subject = '(No subject)', $message = '', $cc = array(), $html = true)
    {
        $header = 'MIME-Version: 1.0' . "\r\n" . 'Content-type: text/' . ($html ? 'html' : 'plain') . '; charset=UTF-8' . "\r\n" . 'From: ' . XcrudConfig::$email_from_name . ' <' . XcrudConfig::$email_from . ">\r\n";
        if ($cc)
            $header .= 'Cc: ' . implode(',', $cc) . "\r\n";
        if ($html)
            $message = '<!DOCTYPE HTML><html><head><meta http-equiv="content-type" content="text/html; charset=utf-8" /><title>' . $subject . '</title></head><body>' . $message . '</body></html>';
        mail($to, '=?UTF-8?B?' . base64_encode($subject) . '?=', $message, $header);
    }

    protected function _cell_attrib($field, $value, $order, &$row, $is_sum = false, $row_color = false, $row_class = false)
    {
        $attr = array();
        if (isset($this->column_class[$field])) {
            $column_class = $this->column_class[$field];
        } else {
            $column_class = array();
        }
        if (isset($this->labels[$field])) {
            $attr['data-label'] = $this->html_safe($this->labels[$field]);
        } else {
            $attr['data-label'] = $this->html_safe($this->_humanize($field));
        }
        if ($row_class)
            $column_class[] = $row_class;
        if ($field == $order && $this->is_sortable)
            $column_class[] = 'xcrud-current';
        if ($is_sum)
            $column_class[] = 'xcrud-sum';
        if ($row_color) {
            $attr['style'] = $row_color;
        }
        if (isset($this->highlight[$field])) {
            foreach ($this->highlight[$field] as $params) {
                $params['value'] = $this->replace_text_variables($params['value'], $row, true);
                if ($this->_compare($value, $params['operator'], $params['value'])) {
                    if ($params['color'])
                        $attr['style'] = 'background-color:' . $params['color'] . ';';
                    if ($params['class'])
                        $column_class[] = $params['class'];
                }
            }
        }
        if ($column_class) {
            $column_class = array_unique($column_class);
            $attr['class'] = implode(' ', $column_class);
            $attr['class'] = $this->replace_text_variables($attr['class'], $row, true);
        }
        return $attr;
    }

    protected function _get_table($method)
    {
        if (! $this->table && ! $this->query)
            self::error('You must define your table before using the <strong>' . $method . '</strong> method.');
        else
            return $this->table ? $this->table : '';
        return false;
    }

    /**
     *
     * @author Ariel Canal
     *         COMPATIBILIZAÇÃO COM A ARQUITETURA DO CODEIGINITER
     */
    protected function _get_language()
    {
        if (is_file(XCRUD_PATH . '/' . XcrudConfig::$lang_path . '/' . $this->language . '/xcrud.ini'))
            self::$lang_arr = parse_ini_file(XCRUD_PATH . '/' . XcrudConfig::$lang_path . '/' . $this->language . '/xcrud.ini');
        elseif (is_file(XCRUD_PATH . '/' . XcrudConfig::$lang_path . '/en/xcrud.ini'))
            self::$lang_arr = parse_ini_file(XCRUD_PATH . '/' . XcrudConfig::$lang_path . '/en/xcrud.ini');
        if ($this->set_lang) {
            self::$lang_arr = array_merge(self::$lang_arr, $this->set_lang);
        }
    }

    /**
     *
     * @author Ariel Canal
     *         COMPATIBILIZAÇÃO COM A ARQUITETURA DO CODEIGINITER
     */
    protected static function _get_language_static()
    {
        if (is_file(XCRUD_PATH . '/' . XcrudConfig::$lang_path . '/' . \Config\App::$defaultLocale . '/xcrud.ini'))
            self::$lang_arr = parse_ini_file(XCRUD_PATH . '/' . XcrudConfig::$lang_path . '/' . \Config\App::$defaultLocale . '/xcrud.ini');
        elseif (is_file(XCRUD_PATH . '/' . XcrudConfig::$lang_path . '/en.ini'))
            self::$lang_arr = parse_ini_file(XCRUD_PATH . '/' . XcrudConfig::$lang_path . '/en/xcrud.ini');
    }

    /**
     *
     * @author Ariel Canal
     *         COMPATIBILIZAÇÃO COM A ARQUITETURA DO CODEIGINITER
     */
    protected function _get_theme_config()
    { // loads theme configuration from
      // ini file
        if (is_file(XCRUD_PATH . '/' . XcrudConfig::$themes_path . '/xcrud_default/xcrud.ini'))
            $this->theme_config = parse_ini_file(XCRUD_PATH . '/' . XcrudConfig::$themes_path . '/xcrud_default/xcrud.ini');
        else
            self::error('xcrud.ini does not exist in your theme folder');
    }

    protected function lang($text = '')
    {
        $langtext = mb_convert_case($text, MB_CASE_LOWER, \Config\App::$charset);
        return htmlspecialchars((isset(self::$lang_arr[$langtext]) ? self::$lang_arr[$langtext] : $text), ENT_QUOTES, \Config\App::$charset);
    }

    protected function theme_config($text = '')
    {
        $text = mb_convert_case($text, MB_CASE_LOWER, \Config\App::$charset);
        return htmlspecialchars((isset($this->theme_config[$text]) ? $this->theme_config[$text] : ''), ENT_QUOTES, \Config\App::$charset);
    }

    protected function _thumb_name($name, $marker)
    {
        return substr_replace($name, $marker, strrpos($name, '.'), 0);
    }

    public function _parse_field_names($fields = '', $location = '', $table = false, $insert_prefix = true)
    {
        $field_names = array();
        if ($fields) {
            if (! $table) {
                $table = $this->_get_table($location);
            }

            if ($insert_prefix) {
                $prefix = $this->prefix;
            } else {
                $prefix = '';
            }

            if (is_array($fields)) {
                foreach ($fields as $key => $val) {
                    if (is_int($key)) {
                        if (! strpos($val, '.'))
                            $field_names[$this->make_field_alias($table, $val)] = array(
                                'table' => $table,
                                'field' => $val
                            );
                        else {
                            $tmp = explode('.', $val, 2);
                            $field_names[$this->make_field_alias($tmp[0], $tmp[1], $prefix)] = array(
                                'table' => $prefix . $tmp[0],
                                'field' => $tmp[1]
                            );
                            unset($tmp);
                        }
                    } else {
                        if (! strpos($key, '.'))
                            $field_names[$this->make_field_alias($table, $key)] = array(
                                'table' => $table,
                                'field' => $key,
                                'value' => $val
                            );
                        else {
                            $tmp = explode('.', $key, 2);
                            $field_names[$this->make_field_alias($tmp[0], $tmp[1], $prefix)] = array(
                                'table' => $prefix . $tmp[0],
                                'field' => $tmp[1],
                                'value' => $val
                            );
                            unset($tmp);
                        }
                    }
                }
            } else {
                $fields = explode(',', $fields);
                foreach ($fields as $key => $val) {
                    $val = trim($val);
                    if (! strpos($val, '.'))
                        $field_names[$this->make_field_alias($table, $val)] = array(
                            'table' => $table,
                            'field' => $val
                        );
                    else {
                        $tmp = explode('.', $val, 2);
                        $field_names[$this->make_field_alias($tmp[0], $tmp[1], $prefix)] = array(
                            'table' => $prefix . $tmp[0],
                            'field' => $tmp[1]
                        );
                        unset($tmp);
                    }
                }
            }
            unset($fields);
        } else
            self::error('You must set field name(s) for the <strong>' . $location . '</strong> method.');
        return $field_names;
    }

    protected function make_field_alias($table, $field, $pefix = '')
    {
        if ($table) {
            return $pefix . $table . '.' . $field;
        } else {
            return $field;
        }
    }

    protected function parse_comma_separated($param)
    {
        /*
         * if (!is_array($param))
         * {
         * $param = explode(',', (string )$param);
         * foreach ($param as $key => $p)
         * {
         * $param[$key] = trim($p);
         * }
         * }
         * return $param;
         */
        if (is_array($param)) {
            return $param;
        }
        if (! is_null($param)) {
            $param = trim($param);
        }

        if (! $param) {
            return array();
        }
        $param = preg_replace('/\s*\,\s*/u', ',', $param);
        return explode(',', $param);
    }

    /**
     *
     * @author Ariel Canal
     *         COMPATIBILIZAÇÃO COM A ARQUITETURA DO CODEIGINITER
     */
    public static function load_css()
    {
        $out = '';

        if (! self::$js_loaded && ! self::$instance) {
            XcrudConfig::$scripts_url = self::check_url(XcrudConfig::$scripts_url, true);
            XcrudConfig::$editor_url = self::check_url(XcrudConfig::$editor_url);
            XcrudConfig::$editor_init_url = self::check_url(XcrudConfig::$editor_init_url);
        }

        if (self::$css_loaded) {
            self::error('Xcrud\'s styles already rendered! Please, set <strong>$manual_load = true</strong> in your configuration file');
        }

        self::$css_loaded = true;
        if (XcrudConfig::$load_bootstrap) {
            $out .= '<link href="' . XcrudConfig::$scripts_url . '/' . XcrudConfig::$plugins_uri . '/bootstrap/css/bootstrap.min.css?' . time() . '" rel="stylesheet" type="text/css" />';
        }
        if (XcrudConfig::$load_jquery_ui)
            $out .= '<link href="' . XcrudConfig::$scripts_url . '/' . XcrudConfig::$plugins_uri . '/jquery-ui/jquery-ui.min.css?' . time() . '" rel="stylesheet" type="text/css" />';
        if (XcrudConfig::$load_jcrop)
            $out .= '<link href="' . XcrudConfig::$scripts_url . '/' . XcrudConfig::$plugins_uri . '/jcrop/jquery.Jcrop.min.css?' . time() . '" rel="stylesheet" type="text/css" />';

        return $out;
    }

    /**
     *
     * @author Ariel Canal
     *         COMPATIBILIZAÇÃO COM A ARQUITETURA DO CODEIGINITER
     */
    public static function load_js()
    {
        $out = '';
        if (self::$instance) {
            $instance = reset(self::$instance);
            $language = $instance->language;
            $instance->_get_language();
        } else {
            $language = \Config\App::$defaultLocale;
            self::_get_language_static();
        }

        if (! self::$css_loaded && ! self::$instance) {
            XcrudConfig::$scripts_url = self::check_url(XcrudConfig::$scripts_url, true);
            XcrudConfig::$editor_url = self::check_url(XcrudConfig::$editor_url);
            XcrudConfig::$editor_init_url = self::check_url(XcrudConfig::$editor_init_url);
        }

        if (self::$js_loaded) {
            self::error('Xcrud\'s scripts already rendered! Please, set <strong>$manual_load = true</strong> in your configuration file');
        }
        self::$js_loaded = true;
        if (XcrudConfig::$load_jquery)
            $out .= '<script src="' . XcrudConfig::$scripts_url . '/' . XcrudConfig::$plugins_uri . '/jquery.min.js"></script>';
        if (XcrudConfig::$jquery_no_conflict) {
            $out .= '
            <script type="text/javascript">
            <!--
            
            jQuery.noConflict();
            
            -->
            </script>';
        }
        if (XcrudConfig::$load_jquery_ui)
            $out .= '<script src="' . XcrudConfig::$scripts_url . '/' . XcrudConfig::$plugins_uri . '/jquery-ui/jquery-ui.min.js?' . time() . '"></script>';
        if (XcrudConfig::$load_jcrop) {
            $out .= '<script src="' . XcrudConfig::$scripts_url . '/' . XcrudConfig::$plugins_uri . '/jcrop/jquery.Jcrop.min.js?' . time() . '"></script>';
        }
        if (XcrudConfig::$load_bootstrap)
            $out .= '<script src="' . XcrudConfig::$scripts_url . '/' . XcrudConfig::$plugins_uri . '/bootstrap/js/bootstrap.min.js?' . time() . '"></script>';

        if (XcrudConfig::$editor_url)
            $out .= '<script src="' . XcrudConfig::$editor_url . '?' . time() . '"></script>';
        if (XcrudConfig::$load_googlemap)
            $out .= '<script src="//maps.google.com/maps/api/js?sensor=false&language=' . $language . '&' . time() . '"></script>';
        $out .= '<script src="' . XcrudConfig::$scripts_url . '/' . XcrudConfig::$plugins_uri . '/xcrud.js?' . time() . '"></script>';

        $config = array(
            'url' => XcrudConfig::$scripts_url . '/' . XcrudConfig::$ajax_uri,
            'table_name' => $instance->table_name,
            'editor_url' => XcrudConfig::$editor_url,
            'editor_init_url' => XcrudConfig::$editor_init_url,
            'force_editor' => XcrudConfig::$force_editor,
            'date_first_day' => XcrudConfig::$date_first_day,
            'date_format' => XcrudConfig::$date_format,
            'time_format' => XcrudConfig::$time_format,
            'lang' => self::$lang_arr,
            'rtl' => XcrudConfig::$is_rtl ? 1 : 0
        );
        $out .= '
            <script type="text/javascript">
            <!--
            
           	var xcrud_config = ' . json_encode($config) . ';
                            
            -->
            </script>';
        return $out;
    }

    protected function get_limit_list($limit = 20)
    {
        if ($this->result_total > $this->limit_list[0]) {
            $out = '';
            if (! in_array($this->limit, $this->limit_list)) {
                $this->limit_list = array_merge(array(
                    $this->limit
                ), $this->limit_list);
            }
            $container = [
                'tag' => 'div'
            ];
            $out .= $this->open_tag($container, 'dropdown ' . $this->theme_config('limit_list_container'));

            $button = [
                'tag' => 'button',
                'data-bs-toggle' => 'dropdown',
                'aria-expanded' => 'false'
            ];
            $out .= $this->open_tag($button, 'dropdown-toggle ' . $this->theme_config('limit_list_button'));
            $out .= $this->lang('limit_list_' . $this->limit_list[array_search($limit, $this->limit_list)]);
            $out .= $this->close_tag($button);

            $menu = [
                'tag' => 'ul'
            ];
            $out .= $this->open_tag($menu, 'dropdown-menu ' . $this->theme_config('limit_list_menu'));
            foreach ($this->limit_list as $limts) {
                if ($limts == $limit) {
                    $active = 'active';
                } else {
                    $active = '';
                }
                $out .= $this->open_tag('li') . $this->open_tag(array(
                    'tag' => 'a',
                    'class' => $active . ' dropdown-item xcrud-action ' . $this->theme_config('limit_list_item'),
                    'data-limit' => $limts
                )) . $this->lang('limit_list_' . $limts) . $this->close_tag('a') . $this->close_tag('li');
            }
            $out .= $this->close_tag($menu);
            $out .= $this->close_tag($container);
            return $out;
        }
    }

    /**
     *
     * @author Ariel Canal
     *         COMPATIBILIZAÇÃO COM A ARQUITETURA DO CODEIGINITER
     */
    protected function check_file($path, $func_name)
    {
        $path = str_replace('\\', '/', $path);
        list ($root_folder) = explode('/', trim(XCRUD_PATH, '/'), 2);
        list ($root_path) = explode('/', trim($path, '/'), 2);

        if (strpos($path, '../') !== false || $root_folder != $root_path) {
            $path = XCRUD_PATH . '/' . trim($path, '/');
        }

        if (! is_file($path))
            self::error('Wrong path or file is not exist! The <strong>' . $func_name . '</strong> method fails.<br /><small>' . $path . '</small>');
        return $path;
    }

    protected function check_folder($path, $func_name)
    {
        $path = str_replace('\\', '/', $path);
        list ($root_folder) = explode('/', trim(XCRUD_PATH, '/'), 2);
        list ($root_path) = explode('/', trim($path, '/'), 2);
        if (strpos($path, '../') !== false or $root_folder != $root_path)
            $path = XCRUD_PATH . '/' . trim($path, '/');
        if (! is_dir($path)) {
            if (! @mkdir($path))
                self::error('Wrong path or folder is not exist! The <strong>' . $func_name . '</strong> method fails.<br /><small>' . $path . '</small>');
        }
        return $path;
    }

    protected function additional_columns($fields = '')
    {
        if ($fields) {
            $fdata = $this->_parse_field_names($fields, 'additional_column');
            foreach ($fdata as $key => $fitem) {
                if ($fitem['field'] != 'value' && mb_substr_count($key, '.') < 2) {
                    // if (! isset($this->subselect[$key]) && $fitem['field'] != 'value' && mb_substr_count($key, '.') < 2) {
                    if (! isset($this->columns[$key])) {
                        $this->hidden_columns[$key] = $fitem;
                    }
                    $this->direct_select_tags[$key] = array(
                        'field' => $fitem['field'],
                        'table' => $fitem['table']
                    ); // will
                       // be
                       // get
                       // from
                       // db
                       // anyway
                }
            }
        }
    }

    protected function additional_fields($fields = '')
    {
        if ($fields) {
            $fdata = $this->_parse_field_names($fields, 'additional_field');
            foreach ($fdata as $key => $fitem) {
                if (! isset($this->subselect[$key]) && $fitem['field'] != 'value' && mb_substr_count($key, '.') < 2) {
                    if (! isset($this->fields[$key])) {
                        $this->hidden_fields[$key] = array(
                            'field' => $fitem['field'],
                            'table' => $fitem['table']
                        );
                        $this->locked_fields[$key] = true;
                    }
                    $this->direct_select_tags[$key] = array(
                        'field' => $fitem['field'],
                        'table' => $fitem['table']
                    ); // will
                       // be
                       // get
                       // from
                       // db
                       // anyway
                }
            }
        }
    }

    /**
     * Unlocks additional postdata fields (locked with security reason).
     * This can be used only with callbacks
     */
    public function unlock_field($fields = '')
    {
        if ($fields) {
            $fdata = $this->_parse_field_names($fields, 'unlock_field');
            foreach ($fdata as $key => $fitem) {
                if (! isset($this->fields[$key])) {
                    $this->fields[$key] = $fitem;
                }
                if (isset($this->locked_fields[$key])) {
                    unset($this->locked_fields[$key]);
                }
            }
        }
    }

    protected function extract_fields_from_text($text, $mode = 'columns')
    {
        $found = preg_match_all('/\{([^\}]+)\}/u', $text, $matches);
        if ($found) {
            switch ($mode) {
                case 'columns':
                    $this->additional_columns($matches[1]);
                    break;
                case 'fields':
                    $this->additional_fields($matches[1]);
                    break;
            }
        }
    }

    protected function find_grid_text_variables()
    {
        if (! XcrudConfig::$performance_mode) {
            if ($this->column_pattern) {
                foreach ($this->column_pattern as $item) {
                    $this->extract_fields_from_text($item, 'columns');
                }
            }
            if ($this->buttons) {
                foreach ($this->buttons as $button) {
                    $this->extract_fields_from_text($button['link'], 'columns');
                    if ($button['params']) {
                        foreach ($button['params'] as $param) {
                            $this->extract_fields_from_text($param, 'columns');
                        }
                    }
                }
            }
            /*
             * if ($this->condition)
             * {
             * foreach ($this->condition as $item)
             * {
             * $this->extract_fields_from_text($item['value'], 'columns');
             * }
             * }
             * if ($this->grid_condition)
             * {
             * foreach ($this->grid_condition as $item)
             * {
             * $this->extract_fields_from_text($item['value'], 'columns');
             * }
             * }
             */
            if ($this->highlight) {
                foreach ($this->highlight as $item) {
                    foreach ($item as $itm) {
                        $this->extract_fields_from_text($itm['value'], 'columns');
                    }
                }
            }
            if ($this->highlight_row) {
                foreach ($this->highlight_row as $item) {
                    $this->extract_fields_from_text($item['value'], 'columns');
                }
            }
            if ($this->column_class) {
                foreach ($this->column_class as $item) {
                    $this->extract_fields_from_text(implode(' ', $item), 'columns');
                }
            }
            if ($this->grid_restrictions) {
                foreach ($this->grid_restrictions as $item) {
                    if (is_array($item)) {
                        foreach ($item as $i) {
                            $this->extract_fields_from_text($i['value'], 'columns');
                            $this->additional_columns($i['field']);
                        }
                    } else {
                        $this->extract_fields_from_text($item['value'], 'columns');
                        $this->additional_columns($i['field']);
                    }
                }
            }
            if ($this->action) {
                foreach ($this->action as $item) {
                    if (is_array($item['conditions'])) {
                        foreach ($item['conditions'] as $con) {
                            $this->additional_columns($con[0]);
                        }
                    } else {
                        $this->additional_columns($item['conditions']);
                    }
                }
            }
        }
    }

    protected function find_details_text_variables()
    {
        if ($this->send_external_create) {
            foreach ($this->send_external_create['data'] as $item) {
                $this->extract_fields_from_text($item, 'fields');
            }
            if ($this->send_external_create['where_field'])
                $this->additional_fields($this->send_external_create['where_field']);
        }
        if ($this->send_external_edit) {
            foreach ($this->send_external_edit['data'] as $item) {
                $this->extract_fields_from_text($item, 'fields');
            }
            if ($this->send_external_edit['where_field'])
                $this->additional_fields($this->send_external_edit['where_field']);
        }
        if ($this->pass_var) {
            foreach ($this->pass_var as $mode => $actions) {
                foreach ($actions as $vars) {
                    $this->extract_fields_from_text($vars['value'], 'fields');
                }
            }
        }
        if ($this->relation) {
            foreach ($this->relation as $field => $params) {
                if ($params['rel_where']) {
                    if (is_array($params['rel_where'])) {
                        foreach ($params['rel_where'] as $vars) {
                            $this->extract_fields_from_text($vars, 'fields');
                        }
                    } else {
                        $this->extract_fields_from_text($params['rel_where'], 'fields');
                    }
                }
            }
        }
        if ($this->fk_relation) {
            foreach ($this->fk_relation as $field => $params) {
                if ($params['rel_where']) {
                    if (is_array($params['rel_where'])) {
                        foreach ($params['rel_where'] as $vars) {
                            $this->extract_fields_from_text($vars, 'fields');
                        }
                    } else {
                        $this->extract_fields_from_text($params['rel_where'], 'fields');
                    }
                }
            }
        }

        /*
         * ALTERADO DO PADR�O - Compatibiliza��o com array de
         * grid_restrictions
         */
        if ($this->grid_restrictions) {
            foreach ($this->grid_restrictions as $items) {
                foreach ($items as $item) {
                    $this->extract_fields_from_text($item['value'], 'fields');
                    $this->additional_fields($item['field']);
                }
            }
        }
        if ($this->column_pattern) {
            foreach ($this->column_pattern as $item) {
                $this->extract_fields_from_text($item, 'fields');
            }
        }
        if ($this->condition) {
            foreach ($this->condition as $item) {
                $this->extract_fields_from_text($item['value'], 'fields');
                $this->additional_fields($item['field']);
            }
        }
    }

    protected function replace_text_variables($value, array $data, $safety = false, $null_if_empty = false)
    {
        if (! is_array($value) && ! XcrudConfig::$performance_mode && $value) {
            foreach ($data as $key => $val) {
                $tmp = explode('.', $key);
                if (count($tmp) > 1) {
                    list ($tbl, $fld) = $tmp;
                } else {
                    $tbl = $this->table;
                    $fld = $val;
                }
                if (! is_array($val) && ! is_null($val)) {
                    $value = str_ireplace('{' . $key . '}', $safety ? $this->html_safe($val) : $val, $value);
                    if ($tbl == $this->table) {
                        $value = str_ireplace('{' . $fld . '}', $safety ? $this->html_safe($val) : $val, $value);
                    }
                }
            }
        }
        if ($value === '' && $null_if_empty) {
            $value = 'NULL';
        }
        return $value;
    }

    protected function get_browser_info($ch)
    {
        if ($_COOKIE) {
            $ca = http_build_query($_COOKIE);
            $ca = str_replace('&', ';', $ca);
            curl_setopt($ch, CURLOPT_COOKIE, $ca);
        }
        curl_setopt($ch, CURLOPT_REFERER, $_SERVER['HTTP_REFERER']);
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    }

    protected function send_http_request($url, $data, $method, $return_result = false)
    {
        // $path = self::check_url($url);
        $path = $url;
        $data = http_build_query($data);
        switch ($method) {
            case 'get':
                $ch = curl_init($path . ((mb_strpos($path, '?', 0, \Config\App::$charset) === false) ? '?' : '&') . $data);
                break;
            case 'post':
                $ch = curl_init($path);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                break;
            default:
                return;
                break;
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        if (! $return_result) {
            curl_setopt($ch, CURLOPT_NOBODY, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT_MS, 100);
        } else {
            curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        }
        // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        // curl_setopt($ch, CURLOPT_MAXREDIRS, 3);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        if (XcrudConfig::$use_browser_info) {
            $this->get_browser_info($ch);
        }
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }

    protected function open_tag($tag = '', $class = '', $attr = array())
    {
        if ($tag) {
            if (! is_array($tag)) {
                $tag = array(
                    'tag' => $tag
                );
            }
            if (isset($tag['tag'])) {
                $out = '<' . $tag['tag'];
                unset($tag['tag']);
                if ($attr) {
                    if (isset($attr['values'])) {
                        unset($attr['values']);
                    }
                    $tag = array_merge($tag, $attr);
                }
                if ($class && isset($tag['class'])) {
                    $tag['class'] .= ' ' . $class;
                } elseif ($class) {
                    $tag['class'] = $class;
                }
                if (XcrudConfig::$encode_field_names && isset($tag['data-depend'])) {
                    $tag['data-depend'] = $this->fieldname_encode($tag['data-depend']);
                }
                if (XcrudConfig::$encode_field_names && isset($tag['data-rangestart'])) {
                    $tag['data-rangestart'] = $this->fieldname_encode($tag['data-rangestart']);
                }
                if (XcrudConfig::$encode_field_names && isset($tag['data-rangeend'])) {
                    $tag['data-rangeend'] = $this->fieldname_encode($tag['data-rangeend']);
                }
                if ($tag) {
                    foreach ($tag as $key => $val) {
                        if ($key == 'href' or $key == 'src') {
                            $out .= ' ' . (string) $key . '="' . (string) $val . '"';
                        } else {
                            $out .= ' ' . (string) $key . '="' . $this->html_safe((string) $val) . '"';
                        }
                    }
                }
                $out .= '>';
                return $out;
            }
        } else
            return '';
    }

    protected function close_tag($tag = '')
    {
        if ($tag) {
            if (! is_array($tag)) {
                $tag = array(
                    'tag' => $tag
                );
            }
            if (isset($tag['tag'])) {
                return '</' . $tag['tag'] . '>';
            }
        } else
            return '';
    }

    protected function single_tag($tag = '', $class = '', $attr = array())
    {
        if ($tag) {
            if (! is_array($tag)) {
                $tag = array(
                    'tag' => $tag
                );
            }
            if (isset($tag['tag'])) {
                $out = '<' . $tag['tag'];
                unset($tag['tag']);
                if ($attr) {
                    if (isset($attr['values'])) {
                        unset($attr['values']);
                    }
                    $tag = array_merge($tag, $attr);
                }
                if ($class && isset($tag['class'])) {
                    $tag['class'] .= ' ' . $class;
                } elseif ($class) {
                    $tag['class'] = $class;
                }
                if (XcrudConfig::$encode_field_names && isset($tag['data-depend'])) {
                    $tag['data-depend'] = $this->fieldname_encode($tag['data-depend']);
                }
                if (XcrudConfig::$encode_field_names && isset($tag['data-rangestart'])) {
                    $tag['data-rangestart'] = $this->fieldname_encode($tag['data-rangestart']);
                }
                if (XcrudConfig::$encode_field_names && isset($tag['data-rangeend'])) {
                    $tag['data-rangeend'] = $this->fieldname_encode($tag['data-rangeend']);
                }
                if ($tag) {
                    foreach ($tag as $key => $val) {
                        if ($key == 'href' or $key == 'src') {
                            $out .= ' ' . (string) $key . '="' . (string) $val . '"';
                        } else {
                            $out .= ' ' . (string) $key . '="' . $this->html_safe((string) $val) . '"';
                        }
                    }
                }
                $out .= ' />';
                return $out;
            }
        } else
            return '';
    }

    protected function open_label_tag($field_key, $label_tag = 'td')
    {
        if (isset($this->validation_required[$this->fields_output[$field_key]['name']])) {
            $label_class = $this->theme_config('details_label_cell') . ' xcrud-label-required';
        } else {
            $label_class = $this->theme_config('details_label_cell');
        }
        $attr = [];
        if (! empty($this->field_attr[$field_key]['id'])) {
            $attr['for'] = $this->field_attr[$field_key]['id'];
        }
        return $this->open_tag($label_tag, $label_class, $attr);
    }

    protected function render_field_exception($field)
    {
        $out = '';
        if (array_key_exists('exception', $field)) {
            $out .= $this->open_tag('div', $this->theme_config('validation_error_text')) . $field['exception'] . $this->close_tag('div');
        }
        return $out;
    }

    protected function render_fields_list($mode, $container = 'table', $row = 'tr', $label = 'td', $field = 'td', $tabs_block = 'div', $tabs_head = 'ul', $tabs_row = 'li', $tabs_link = 'a', $tabs_content = 'div', $tabs_pane = 'div')
    {
        $out = '';
        $tabs_out = array();
        $raw_out = array();
        foreach ($this->fields_output as $key => $item) {
            if (in_array($key, array_keys($this->custom_fields))) {
                // continue;
            }
            $row_class = $this->theme_config('details_row');
            if ($this->primary_key == $item['name']) {
                $row_class .= ' primary';
            }

            if ($mode == 'report' && $this->parameters[$item['label']]['operator'] == 'between') {
                $item['field'] .= $this->open_tag('span') . ' até ' . $this->close_tag('span');
                $item['field'] .= $this->fields_output[$key . '_to']['field'];
                $row_class_ = $row_class . ' between_field';
            } else {
                $row_class_ = $row_class;
            }
            $field_rendered = $this->open_tag($row, $row_class_) . $this->open_label_tag($key, $label) . $item['label'] . $this->get_field_tooltip($item['name'], $mode) . $this->close_tag($label) . $this->open_tag($field, $this->theme_config('details_field_cell')) . $item['field'] . $this->close_tag($field) . $this->render_field_exception($item) . $this->close_tag($row);
            if (isset($this->fields[$item['name']]['tab']) && $this->fields[$item['name']]['tab']) {
                $tabs_out[$this->fields[$item['name']]['tab']][] = $field_rendered;
            } else {

                $raw_out[] = $field_rendered;
            }
        }
        if (isset($this->field_tabs[$mode]) or $this->default_tab !== false) {
            $tabs_header = $this->open_tag($tabs_block, $this->theme_config('tabs_container'), array(
                'class' => 'xcrud-tabs'
            )) . $this->open_tag($tabs_head, $this->theme_config('tabs_header_row'));
            $tabs_body = $this->open_tag($tabs_content, $this->theme_config('tabs_content'));
            $k = 0;

            if ($this->default_tab !== false && $raw_out) {
                $tabid = 'tabid_' . base_convert(rand(), 10, 36);
                $tabs_header .= $this->open_tag($tabs_row, $this->theme_config('tabs_header_cell') . ($k == 0 ? ' ' . $this->theme_config('tabs_first_element') : '')) . $this->open_tag($tabs_link, $this->theme_config('tabs_header_link') . ($k == 0 ? ' ' . $this->theme_config('tabs_first_element') : ''), array(
                    'href' => '#' . $tabid
                )) . $this->default_tab . $this->close_tag($tabs_link) . $this->close_tag($tabs_row);
                $tabs_body .= $this->open_tag($tabs_pane, $this->theme_config('tabs_content_pane') . ($k == 0 ? ' ' . $this->theme_config('tabs_first_element') : ''), array(
                    'id' => $tabid
                )) . $this->open_tag($container, $this->theme_config('details_container')) . implode('', $raw_out) . $this->close_tag($container) . $this->close_tag($tabs_pane);
                ++ $k;
                $raw_out = array();
            }

            $tab_count = 0;
            if ((isset($this->field_tabs[$mode]) && $tabs_out) || ($this->nested_rendered && XcrudConfig::$nested_in_tab)) {
                $tab_total = count($this->field_tabs[$mode]) + count($this->nested_rendered);
                if ($tab_total < $this->opened_tab || ! $this->opened_tab) {
                    $old_val = $this->opened_tab;
                    $this->opened_tab = 1;
                }
            }
            if (isset($this->field_tabs[$mode]) && $tabs_out) {
                foreach ($this->field_tabs[$mode] as $key => $tabname) {
                    if (isset($tabs_out[$tabname])) {
                        $tab_count ++;
                        $class = '';
                        if ($this->opened_tab && $tab_count == $this->opened_tab) {
                            $class = $this->theme_config('tabs_first_element');
                        } else if (! $this->opened_tab && $k == 0) {
                            $class = $this->theme_config('tabs_first_element');
                        } else {
                            $class = '';
                        }

                        $tabid = 'tabid_' . base_convert(rand(), 10, 36);
                        $tabs_header .= $this->open_tag($tabs_row, $this->theme_config('tabs_header_cell') . ' ' . $class) . $this->open_tag($tabs_link, $this->theme_config('tabs_header_link') . ' ' . $class, array(
                            'href' => '#' . $tabid
                        )) . $tabname . $this->close_tag($tabs_link) . $this->close_tag($tabs_row);
                        $tabs_body .= $this->open_tag($tabs_pane, $this->theme_config('tabs_content_pane') . ' ' . $class, array(
                            'id' => $tabid
                        )) . $this->open_tag($container, $this->theme_config('details_container')) . implode('', $tabs_out[$tabname]) . $this->close_tag($container) . $this->close_tag($tabs_pane);
                        ++ $k;
                    }
                }
            }

            if ($this->nested_rendered && XcrudConfig::$nested_in_tab) {
                foreach ($this->nested_rendered as $tabname => $content) {
                    $tab_count ++;
                    $class = '';
                    if ($this->opened_tab && $tab_count == $this->opened_tab) {
                        $class = $this->theme_config('tabs_first_element');
                    } else if (! $this->opened_tab && $k == 0) {
                        $class = $this->theme_config('tabs_first_element');
                    } else {
                        $class = '';
                    }

                    $tabid = 'tabid_' . base_convert(rand(), 10, 36);
                    $tabs_header .= $this->open_tag($tabs_row, $this->theme_config('tabs_header_cell') . ' ' . $class) . $this->open_tag($tabs_link, $this->theme_config('tabs_header_link') . ' ' . $class, array(
                        'href' => '#' . $tabid
                    )) . $tabname . $this->close_tag($tabs_link) . $this->close_tag($tabs_row);
                    $tabs_body .= $this->open_tag($tabs_pane, $this->theme_config('tabs_content_pane') . ' ' . $class, array(
                        'id' => $tabid
                    )) . $content . $this->close_tag($tabs_pane);
                    ++ $k;
                    unset($this->nested_rendered[$tabname]);
                }
            }
            if (isset($old_val)) {
                $this->opened_tab = $old_val;
            }

            $out .= $tabs_header . $this->close_tag($tabs_head) . $tabs_body . $this->close_tag($tabs_content) . $this->close_tag($tabs_block);
        }

        if ($raw_out) {
            $out .= $this->open_tag($container, $this->theme_config('details_container')) . implode('', $raw_out) . $this->close_tag($container);
        }
        // $out .= implode('', $this->hidden_fields_output);
        return $out;
    }

    protected function render_tab($tab, $mode, $container = 'table', $row = 'tr', $label = 'td', $field = 'td', $tabs_block = 'div', $tabs_head = 'ul', $tabs_row = 'li', $tabs_link = 'a', $tabs_content = 'div', $tabs_pane = 'div')
    {
        $out = '';
        $tabs_out = array();
        $raw_out = array();
        foreach ($this->fields_output as $key => $item) {
            $row_class = $this->theme_config('details_row');
            if ($this->primary_key == $item['name']) {
                $row_class .= ' primary';
            }

            $row_rendered = $this->open_tag($row, $row_class) . $this->open_tag($label, $this->theme_config('details_label_cell')) . $item['label'] . $this->get_field_tooltip($item['name'], $mode) . $this->close_tag($label) . $this->open_tag($field, $this->theme_config('details_field_cell')) . $item['field'] . $this->close_tag($field) . $this->render_field_exception($item) . $this->close_tag($row);
            ;
            if (isset($this->fields[$item['name']]['tab']) && $this->fields[$item['name']]['tab']) {
                $tabs_out[$this->fields[$item['name']]['tab']][] = $row_rendered;
            } else {
                $raw_out[] = $row_rendered;
            }
        }
        if ((isset($this->field_tabs[$mode]) or $this->default_tab !== false) && ! XcrudConfig::$tabs_in_widgets) {
            $tabs_header = $this->open_tag($tabs_block, $this->theme_config('tabs_container'), array(
                'class' => 'xcrud-tabs'
            )) . $this->open_tag($tabs_head, $this->theme_config('tabs_header_row'));
            $tabs_body = $this->open_tag($tabs_content, $this->theme_config('tabs_content'));
            $k = 0;

            if ($this->default_tab !== false && $raw_out) {
                $tabid = 'tabid_' . base_convert(rand(), 10, 36);
                $tabs_header .= $this->open_tag($tabs_row, $this->theme_config('tabs_header_cell') . ($k == 0 ? ' ' . $this->theme_config('tabs_first_element') : '')) . $this->open_tag($tabs_link, $this->theme_config('tabs_header_link') . ($k == 0 ? ' ' . $this->theme_config('tabs_first_element') : ''), array(
                    'href' => '#' . $tabid
                )) . $this->default_tab . $this->close_tag($tabs_link) . $this->close_tag($tabs_row);
                $tabs_body .= $this->open_tag($tabs_pane, $this->theme_config('tabs_content_pane') . ($k == 0 ? ' ' . $this->theme_config('tabs_first_element') : ''), array(
                    'id' => $tabid
                )) . $this->open_tag($container, $this->theme_config('details_container')) . implode('', $raw_out) . $this->close_tag($container) . $this->close_tag($tabs_pane);
                ++ $k;
                $raw_out = array();
            }

            if (isset($this->field_tabs[$mode]) && $tabs_out) {
                foreach ($this->field_tabs[$mode] as $key => $tabname) {
                    if ($key == $tab) {
                        if (isset($tabs_out[$tabname])) {
                            $tabid = 'tabid_' . base_convert(rand(), 10, 36);
                            $tabs_header .= $this->open_tag($tabs_row, $this->theme_config('tabs_header_cell') . ($k == 0 ? ' ' . $this->theme_config('tabs_first_element') : '')) . $this->open_tag($tabs_link, $this->theme_config('tabs_header_link') . ($k == 0 ? ' ' . $this->theme_config('tabs_first_element') : ''), array(
                                'href' => '#' . $tabid
                            )) . $tabname . $this->close_tag($tabs_link) . $this->close_tag($tabs_row);
                            $tabs_body .= $this->open_tag($tabs_pane, $this->theme_config('tabs_content_pane') . ($k == 0 ? ' ' . $this->theme_config('tabs_first_element') : ''), array(
                                'id' => $tabid
                            )) . $this->open_tag($container, $this->theme_config('details_container')) . implode('', $tabs_out[$tabname]) . $this->close_tag($container) . $this->close_tag($tabs_pane);
                            ++ $k;
                        }
                    }
                }
            }
            $out .= $tabs_header . $this->close_tag($tabs_head) . $tabs_body . $this->close_tag($tabs_content) . $this->close_tag($tabs_block);
        }
        if ((isset($this->field_tabs[$mode]) or $this->default_tab !== false) && XcrudConfig::$tabs_in_widgets) {
            $k = 0;
            if (isset($this->field_tabs[$mode]) && $tabs_out) {
                foreach ($this->field_tabs[$mode] as $key => $tabname) {
                    if ($key == $tab) {
                        $class_widget_container = 'widget';
                        if (XcrudConfig::$widgets_open != 'all' && XcrudConfig::$widgets_open != 'none' && $k >= (int) XcrudConfig::$widgets_open)
                            $class_widget_container .= ' widget-closed';
                        else if (XcrudConfig::$widgets_open == 'none')
                            $class_widget_container .= ' widget-closed';
                        $widget .= $this->open_tag('div', $class_widget_container, array(
                            'class' => 'xcrud-widgets'
                        ));
                        $widget .= $this->open_tag('div', 'widget-header');
                        $widget .= $this->open_tag('h4');
                        $widget .= $this->open_tag('i', 'fas fa-bars') . $this->close_tag('i');
                        $widget .= $tabname;
                        $widget .= $this->close_tag('h4');

                        $widget .= $this->open_tag('div', 'toolbar');
                        $widget .= $this->open_tag('div', 'btn-group');
                        $widget .= $this->open_tag('span', 'btn btn-xs widget-collapse');
                        $widget .= $this->open_tag('i', 'fas fa-angle-down') . $this->close_tag('i');
                        $widget .= $this->close_tag('span');
                        $widget .= $this->close_tag('div') . $this->close_tag('div') . $this->close_tag('div');

                        $widget .= $this->open_tag('div', 'widget-content');
                        if (isset($tabs_out[$tabname])) {

                            $widget .= implode('', $tabs_out[$tabname]);
                            ++ $k;
                        }
                        $widget .= $this->close_tag('div');
                        $widget .= $this->close_tag('div');
                    }
                }
            }

            $out .= $widget;
        }

        if ($raw_out) {
            $out .= $this->open_tag($container, $this->theme_config('details_container')) . implode('', $raw_out) . $this->close_tag($container);
        }
        // $out .= implode('', $this->hidden_fields_output);
        return $out;
    }

    /**
     * table tooltip render
     */
    protected function get_table_tooltip()
    {
        $out = '';
        if ($this->table_tooltip) {
            $out .= ' ';
            $out .= $this->open_tag(array(
                'tag' => 'a',
                'href' => 'javascript:;',
                'class' => 'xcrud-tooltip xcrud-button-link',
                'title' => $this->table_tooltip['tooltip']
            ));
            $out .= $this->open_tag(array(
                'tag' => 'i',
                'class' => ($this->table_tooltip['icon'] ? $this->table_tooltip['icon'] : $this->theme_config('tooltip_icon'))
            ));
            $out .= $this->close_tag('i');
            $out .= $this->close_tag('a');
        }
        return $out;
    }

    /**
     * field tooltip render
     */
    protected function get_field_tooltip($field, $mode)
    {
        $out = '';
        if ($this->field_tooltip && isset($this->field_tooltip[$field])) {
            $out .= ' ';
            $out .= $this->open_tag(array(
                'tag' => 'a',
                'href' => 'javascript:;',
                'class' => 'xcrud-tooltip xcrud-button-link',
                'title' => $this->field_tooltip[$field]['tooltip']
            ));
            $out .= $this->open_tag(array(
                'tag' => 'i',
                'class' => ($this->field_tooltip[$field]['icon'] ? $this->field_tooltip[$field]['icon'] : $this->theme_config('tooltip_icon'))
            ));
            $out .= $this->close_tag('i');
            $out .= $this->close_tag('a');
        }
        return $out;
    }

    /**
     * column tooltip render
     */
    protected function get_column_tooltip($field)
    {
        $out = '';
        if ($this->column_tooltip && isset($this->column_tooltip[$field])) {
            $out .= ' ';
            $out .= $this->open_tag(array(
                'tag' => 'a',
                'href' => 'javascript:;',
                'class' => 'xcrud-tooltip xcrud-button-link',
                'title' => $this->column_tooltip[$field]['tooltip']
            ));
            $out .= $this->open_tag(array(
                'tag' => 'i',
                'class' => ($this->column_tooltip[$field]['icon'] ? $this->column_tooltip[$field]['icon'] : $this->theme_config('tooltip_icon'))
            ));
            $out .= $this->close_tag('i');
            $out .= $this->close_tag('a');
        }
        return $out;
    }

    /**
     *
     * @author Ariel Canal
     *         Compatibilização com os plugins JS
     *         search constructor and renderer
     */
    protected function search_button($search_label = false)
    {
        $attr = [
            'data-bs-toggle' => 'collapse',
            'href' => '#search_' . $this->table_name
        ];
        if ($this->search || Xcrud_config::$search_opened) {
            $attr['aria-expanded'] = 'true';
        } else {
            $attr['aria-expanded'] = 'false';
        }
        $out = '';
        $out .= $this->open_tag('button', 'xcrud-search-toggle ' . $this->theme_config('search_toggle'), $attr);
        $out .= $this->open_tag('i', $this->theme_config('search_toggle_icon')) . $this->close_tag('i');
        if (! empty($$search_label)) {
            $out .= $this->open_tag('span');
            $out .= $search_label;
            $out .= $this->close_tag('span');
        }
        $out .= $this->close_tag('button');
        return $out;
    }

    /**
     *
     * @author Ariel Canal
     *         Compatibilização com os plugins JS
     *         search constructor and renderer
     */
    protected function render_search()
    {
        $out = '';
        $phrase = '';
        $optlist = array();
        $fieldlist = array();
        $is_daterange = false;
        if (! is_int($this->search_lines)) {
            $this->search_lines = 1;
        }

        if ($this->is_search) {
            $container_tag = [
                'tag' => 'div',
                'class' => 'xcrud-search-form collapse',
                'id' => 'search_' . $this->table_name
            ];
            if ($this->search || Xcrud_config::$search_opened) {
                $container_tag['class'] = ' show';
            }
            // ABRE CONTAINER
            $out .= $this->open_tag($container_tag, $this->theme_config('search_container'));

            // LINES
            for ($i = 1; $i <= $this->search_lines; $i ++) {
                $fieldlist = array();
                if (isset($this->search_submit[$i]) && isset($this->search_submit[$i]['phrase']) && is_array($this->search_submit[$i]['phrase']) && isset($this->field_type[$this->search_submit[$i]['column']])) {
                    switch ($this->field_type[$this->search_submit[$i]['column']]) {
                        case 'timestamp':
                        case 'datetime':
                            $phrase = array(
                                'from' => $this->search_submit[$i]['phrase']['from'],
                                'to' => $this->search_submit[$i]['phrase']['to']
                            );
                            $is_daterange = true;
                            break;
                        case 'date':
                            $phrase = array(
                                'from' => $this->search_submit[$i]['phrase']['from'],
                                'to' => $this->search_submit[$i]['phrase']['to']
                            );
                            $is_daterange = true;
                            break;
                        case 'time':
                            $phrase = array(
                                'from' => $this->search_submit[$i]['phrase']['from'],
                                'to' => $this->search_submit[$i]['phrase']['to']
                            );
                            break;
                        default:
                            $phrase = '';
                            break;
                    }
                } else if (isset($this->search_submit[$i]['phrase'])) {
                    $phrase = $this->search_submit[$i]['phrase'];
                }
                $optlist = array();
                if (Xcrud_config::$search_all) {
                    $optlist[] = $this->open_tag('option', '', array(
                        'value' => ''
                    )) . $this->lang('all_fields') . $this->close_tag('option');
                    $fieldlist = $this->search_fieldlist('', $phrase, $fieldlist, $i);
                }
                if ($this->search_columns) {
                    foreach ($this->search_columns as $field => $tmp) {
                        if (in_array($field, array_keys($this->report))) {
                            continue;
                        }
                        if (isset($this->columns_names[$field])) {
                            $name = $this->columns_names[$field];
                        } else {
                            if (isset($this->labels[$field])) {
                                $name = $this->html_safe($this->labels[$field]);
                            } else {
                                $name = $this->html_safe($this->_humanize($tmp['field']));
                            }
                        }
                        $option = [
                            'tag' => 'option',
                            'value' => $field,
                            'data-type' => $this->field_type[$field]
                        ];
                        if ($field == $this->search_submit[$i]['column']) {
                            $option['selected'] = '';
                        }
                        $optlist[] = $this->open_tag($option) . $name . $this->close_tag($option);
                        $fieldlist = $this->search_fieldlist($field, $phrase, $fieldlist, $i);
                    }
                } elseif ($this->search_default !== false) { // not only 'all'
                    foreach ($this->columns_names as $field => $title) {
                        if (in_array($field, array_keys($this->report))) {
                            continue;
                        }
                        $option = [
                            'tag' => 'option',
                            'value' => $field,
                            'data-type' => $this->field_type[$field]
                        ];
                        if (isset($this->search_submit[$i]) && $field == $this->search_submit[$i]['column']) {
                            $option['selected'] = '';
                        }
                        $optlist[] = $this->open_tag($option) . $title . $this->close_tag($option);
                        $fieldlist = $this->search_fieldlist($field, $phrase, $fieldlist, $i);
                    }
                }
                // LINE CONTENT
                $line_container = [
                    'tag' => 'span'
                ];
                // $out .= $this->open_tag($line_container, 'line_container '.$this->theme_config('search_line_container'));
                $out .= implode('', $fieldlist);
                $name = 'search_submit][' . $i . '][column';
                if ($this->search_default === false && ! $this->search_columns) {
                    $input = [
                        'tag' => 'input',
                        'type' => 'hidden',
                        'name' => $name
                    ];
                    $out .= $this->single_tag($input, 'xcrud-columns-select xcrud-data ' . $this->theme_config('search_fieldlist'));
                } else {
                    $select = [
                        'tag' => 'select',
                        'name' => $name
                    ];
                    $out .= $this->open_tag($select, 'xcrud-columns-select xcrud-data ' . $this->theme_config('search_fieldlist'));
                    // $out .= $this->open_tag('option', '', array('value' => '')) .
                    // $this->lang('all_fields') . $this->close_tag('option');
                    $out .= implode('', $optlist);
                    $out .= $this->close_tag($select);
                }
                // $out .= $this->close_tag($line_container);
            }

            // BOTÕES
            $button_group = array(
                'tag' => 'span',
                'class' => $this->theme_config('search_button_group')
            );
            // $out .= $this->open_tag($button_group);

            $attr = array(
                'class' => 'xcrud-action',
                'href' => 'javascript:;',
                'data-search' => 1
            );
            $out .= $this->open_tag('button', $this->theme_config('search_go'), $attr);
            $out .= $this->lang('go');
            $out .= $this->close_tag('button');
            if ($this->search) {
                $attr = array(
                    'class' => 'xcrud-action',
                    'href' => 'javascript:;',
                    'data-search' => 0
                );
                $out .= $this->open_tag('button', $this->theme_config('search_reset'), $attr);
                $out .= $this->lang('reset') . $this->close_tag('button');
            }

            // $out .= $this->close_tag($button_group);

            // FECHA CONTAINER
            $out .= $this->close_tag($container_tag);
        }
        return $out;
    }

    /**
     * this creates unique field types for search
     */
    protected function search_fieldlist($field, $phrase, $fieldlist, $line = 1)
    {
        $attr_preset = array(
            'class' => 'xcrud-searchdata',
            'name' => 'search_submit][' . $line . '][phrase'
        );
        if ($field == @$this->search_submit[$line]['column']) {
            $class = 'xcrud-search-active';
        } else {
            $class = '';
            $attr_preset['style'] = 'display:none';
        }
        $attr = $attr_preset;
        $attr['data-type'] = $field ? $this->field_type[$field] : 'text';
        switch ($attr['data-type']) {
            case 'text':
            case 'textarea':
            case 'int':
            case 'float':
            default:
                if (! isset($fieldlist['default']) or $field == @$this->search_submit[$line]['column']) {
                    if (@! $this->search_submit[$line]['column']) {
                        $class = 'xcrud-search-active';
                        $attr['style'] = '';
                    }
                    $attr['data-fieldtype'] = 'default';
                    $attr['type'] = 'text';
                    $attr['value'] = (! is_array($phrase) && $field == @$this->search_submit[$line]['column'] or ! @$this->search_submit[$line]['column']) ? $phrase : '';
                    $fieldlist['default'] = $this->single_tag('input', $class . ' ' . $this->theme_config('search_phrase'), $attr);
                }
                break;
            case 'bool':
                if (! isset($fieldlist['bool']) or $field == @$this->search_submit[$line]['column']) {
                    $attr['name'] = 'search_submit][' . $line . '][phrase';
                    $attr['data-fieldtype'] = 'bool';
                    $attr['type'] = 'select';
                    $fieldlist['bool'] = $this->open_tag('select', $class . ' ' . $this->theme_config('search_phrase_dropdown'), $attr);
                    $attr = array(
                        'value' => 1
                    );
                    if ($phrase == 1) {
                        $attr['selected'] = '';
                    }
                    $fieldlist['bool'] .= $this->open_tag('option', '', $attr) . $this->lang('bool_on') . $this->close_tag('option');
                    $attr = array(
                        'value' => 0
                    );
                    if ($phrase == 0) {
                        $attr['selected'] = '';
                    }
                    $fieldlist['bool'] .= $this->open_tag('option', '', $attr) . $this->lang('bool_off') . $this->close_tag('option');
                    $fieldlist['bool'] .= $this->close_tag('select');
                }
                break;
            case 'date':
            case 'datetime':
            case 'time':
            case 'timestamp':
                if (! isset($fieldlist['date']) or $field == @$this->search_submit[$line]['column']) {
                    $attr['data-fieldtype'] = 'date';
                    $attr_range = array(
                        'class' => 'xcrud-daterange xcrud-searchdata ' . $this->theme_config('search_range'),
                        'name' => 'search_submit][' . $line . '][range',
                        'data-fieldtype' => 'date'
                    );
                    if ($field != @$this->search_submit[$line]['column']) {
                        $attr_range['style'] = 'display:none';
                    }

                    $fieldlist['date'] = $this->open_tag('select', $class, $attr_range);
                    $fieldlist['date'] .= $this->open_tag('option', '', array(
                        'value' => ''
                    )) . $this->lang('choose_range') . $this->close_tag('option');
                    if (Xcrud_config::$available_date_ranges) {
                        foreach (Xcrud_config::$available_date_ranges as $range) {
                            $attr_rs = array(
                                'value' => $range
                            );
                            if (isset($this->search_submit[$line]['range']) && $range == $this->search_submit[$line]['range']) {
                                $attr_rs['selected'] = '';
                            }
                            $curr_range = $this->get_range($range);
                            if ($curr_range) {
                                $attr_rs['data-from'] = $curr_range['from'];
                                $attr_rs['data-to'] = $curr_range['to'];
                                $fieldlist['date'] .= $this->open_tag('option', '', $attr_rs) . $this->lang($range) . $this->close_tag('option');
                            }
                        }
                    }
                    $fieldlist['date'] .= $this->close_tag('select');
                    $attr['type'] = 'text';
                    $attr['name'] = 'search_submit][' . $line . '][phrase][from';
                    $attr['value'] = ((isset($phrase['from']) && $field == @$this->search_submit[$line]['column']) ? $phrase['from'] : '');
                    // $fieldlist['date'] .= $this->open_tag('span', 'xcrud-range');
                    $fieldlist['date'] .= $this->single_tag('input', 'xcrud-datepicker-from ' . $class . ' ' . $this->theme_config('search_from'), $attr);
                    $attr['name'] = 'search_submit][' . $line . '][phrase][to';
                    $attr['value'] = (isset($phrase['to']) && $field == @$this->search_submit[$line]['column']) ? $phrase['to'] : '';
                    $fieldlist['date'] .= $this->single_tag('input', 'xcrud-datepicker-to ' . $class . ' ' . $this->theme_config('search_to'), $attr);
                }
                break;
            case 'select':
            case 'multiselect':
            case 'radio':
            case 'checkboxes':
                $attr['data-fieldtype'] = 'dropdown';
                $attr['data-fieldname'] = $field;
                $tmp = '';
                $tmp .= $this->open_tag('select', $class . ' ' . $this->theme_config('search_phrase_dropdown'), $attr);
                if (is_array($this->field_attr[$field]['values'])) {
                    foreach ($this->field_attr[$field]['values'] as $optkey => $opt) {
                        if (is_array($opt)) {
                            $tmp .= $this->open_tag(array(
                                'tag' => 'optgroup',
                                'label' => $optkey
                            ));
                            foreach ($opt as $k_key => $k_opt) {
                                $opt_tag = array(
                                    'tag' => 'option',
                                    'value' => $k_key
                                );
                                if ($k_key == $phrase && $field == $this->search_submit[$line]['column']) {
                                    $opt_tag['selected'] = '';
                                }
                                $tmp .= $this->open_tag($opt_tag) . $this->html_safe($k_opt) . $this->close_tag($opt_tag);
                            }
                            $tmp .= $this->close_tag('optgroup');
                        } else {
                            $opt_attr = array(
                                'value' => $optkey
                            );
                            if (isset($this->search_submit[$line]['column']) && $optkey == $phrase && $field == $this->search_submit[$line]['column']) {
                                $opt_attr['selected'] = '';
                            }
                            $tmp .= $this->open_tag('option', '', $opt_attr) . $this->html_safe($opt) . $this->close_tag('option');
                        }
                    }
                } else {
                    $opts = $this->parse_comma_separated($this->field_attr[$field]['values']);
                    foreach ($opts as $opt) {
                        $opt = trim($opt, '\'');
                        $opt_attr = array(
                            'value' => $opt
                        );
                        if ($opt == $phrase && $field == $this->column) {
                            $opt_attr['selected'] = '';
                        }
                        $tmp .= $this->open_tag('option', '', $opt_attr) . $this->html_safe($opt) . $this->close_tag('option');
                    }
                }
                $tmp .= $this->close_tag('select');
                $fieldlist[] = $tmp;
                break;
        }
        return $fieldlist;
    }

    protected function render_search_hidden()
    {
        $out = '';

        $tag = array(
            'tag' => 'input',
            'type' => 'hidden',
            'class' => 'xcrud-data'
        );
        if ($this->search) {
            if ($this->column) {
                switch ($this->field_type[$this->column]) {
                    case 'timestamp':
                    case 'datetime':
                    case 'date':
                    case 'time':
                        $out .= $this->single_tag($tag, '', array(
                            'name' => 'phrase][from',
                            'value' => (isset($this->phrase['from']) ? $this->phrase['from'] : '')
                        ));
                        $out .= $this->single_tag($tag, '', array(
                            'name' => 'phrase][to',
                            'value' => (isset($this->phrase['to']) ? $this->phrase['to'] : '')
                        ));
                        break;
                    default:
                        $out .= $this->single_tag($tag, '', array(
                            'name' => 'phrase',
                            'value' => (! is_array($this->phrase) ? $this->phrase : '')
                        ));
                        break;
                }
            } else {
                $out .= $this->single_tag($tag, '', array(
                    'name' => 'phrase',
                    'value' => (! is_array($this->phrase) ? $this->phrase : '')
                ));
            }

            $out .= $this->single_tag($tag, '', array(
                'name' => 'column',
                'value' => $this->column
            ));
            $out .= $this->single_tag($tag, '', array(
                'name' => 'range',
                'value' => $this->range
            ));
        }
        return $out;
    }

    protected function render_grid_head($row = array(
        'tag' => 'tr'
    ), $item = array(
        'tag' => 'th'
    ), $arrows = array(
        'asc' => '&uarr; ',
        'desc' => '&darr; '
    ))
    {
        $out = '';
        $out .= $this->open_tag($row, 'xcrud-th');
        if (count($this->mass_actions)) {
            $out .= $this->open_tag($item, 'xcrud-mass-checkbox-container xcrud-mass-checkbox-header ' . $this->theme_config('mass_checkbox_header_container')) . $this->single_tag('input', 'xcrud-mass-checkbox xcrud-mass-checkbox-header ' . $this->theme_config('mass_checkbox_header'), array(
                'type' => 'checkbox'
            )) . $this->single_tag('label') . $this->close_tag($item);
        }
        if ($this->is_numbers) {
            $out .= $this->open_tag($item, 'xcrud-num') . '&#35;' . $this->close_tag($item);
        }
        if (($this->is_edit || $this->is_remove || $this->is_view || $this->is_duplicate || $this->buttons || $this->grid_restrictions) && $this->task != 'print' && $this->buttons_position == 'left') {
            $out .= $this->open_tag($item, 'xcrud-actions') . '&nbsp;' . $this->close_tag($item);
        }
        foreach ($this->columns as $field => $fitem) {
            if (isset($this->field_type[$field]) && ($this->field_type[$field] == 'password' or $this->field_type[$field] == 'hidden'))
                continue;
            $fieldname = $this->columns_names[$field];
            $class = 'xcrud-column';
            $attr = array();
            if ($this->is_sortable) {
                $class .= ' xcrud-action';
                if ($this->primary_key == $field) {
                    $class .= ' xcrud-primary';
                }
                if ($this->order_column == $field) {
                    $class .= ' xcrud-current xcrud-' . $this->order_direct;
                    $attr['data-order'] = $this->order_direct == 'asc' ? 'desc' : 'asc';
                } else {
                    $attr['data-order'] = $this->order_direct;
                }
                $attr['data-orderby'] = $field;
            }
            if (isset($this->column_width[$field])) {
                $attr['style'] = 'width:' . $this->column_width[$field] . ';min-width:' . $this->column_width[$field] . ';max-width:' . $this->column_width[$field] . ';';
            }

            $out .= $this->open_tag($item, $class, $attr);
            if ($this->order_column == $field && $arrows && $this->is_sortable) {
                $out .= $arrows[$this->order_direct];
            }
            $out .= $fieldname;
            $out .= $this->get_column_tooltip($field);
            $out .= $this->close_tag($item);
        }
        if (($this->is_edit || $this->is_remove || $this->is_view || $this->is_duplicate || $this->buttons || $this->grid_restrictions) && $this->task != 'print' && $this->buttons_position == 'right') {
            $out .= $this->open_tag($item, 'xcrud-actions') . '&nbsp;' . $this->close_tag($item);
        }
        $out .= $this->close_tag($row);
        return $out;
    }

    /**
     *
     * @author Ariel Canal
     *         Renderiza��o da classe xcrud-actions-fixed
     */
    protected function render_grid_body($row_tag = array(
        'tag' => 'tr'
    ), $item = array(
        'tag' => 'td'
    ))
    {
        $out = '';
        $i = 0;
        if ($this->result_list) {
            foreach ($this->result_list as $key => $row) {
                $j = 0;
                $row_color = false;
                $row_class = '';
                if (isset($this->highlight_row)) {
                    foreach ($this->highlight_row as $params) {
                        $params['value'] = $this->replace_text_variables($params['value'], $row, true);
                        if ($this->_compare($row[$params['field']], $params['operator'], $params['value'])) {
                            if ($params['color'])
                                $row_color = 'background-color:' . $params['color'] . ';';
                            if ($params['class'])
                                $row_class .= ' ' . $params['class'];
                        }
                    }
                }
                $out .= $this->open_tag($row_tag, 'xcrud-row xcrud-row-' . $i);
                if (count($this->mass_actions)) {
                    $out .= $this->open_tag($item, 'xcrud-mass ' . $this->theme_config('mass_checkbox_container'));
                    if (! $this->table_ro && ($this->is_edit($row) || $this->is_remove($row))) {
                        $out .= $this->single_tag('input', 'xcrud-mass-checkbox ' . $this->theme_config('mass_checkbox'), array(
                            'type' => 'checkbox',
                            'name' => 'mass_list][' . $row['primary_key'],
                            'value' => $row['primary_key']
                        )) . $this->single_tag('label');
                    }
                    $out .= $this->close_tag($item);
                }
                if ($this->is_numbers) {
                    $out .= $this->open_tag($item, 'xcrud-num', $this->_cell_attrib(false, false, false, $row, false, $row_color, $row_class)) . $this->open_tag('span') . ($key + $this->start + 1) . $this->close_tag('span') . $this->close_tag($item);
                }
                if (($this->is_edit || $this->is_remove || $this->is_view || $this->buttons || $this->is_duplicate || $this->grid_restrictions) && $this->task != 'print' && $this->buttons_position == 'left') {
                    $out .= $this->open_tag($item, 'xcrud-actions' . ((Xcrud_config::$fixed_action_buttons) ? ' xcrud-actions-fixed' : ''), $this->_cell_attrib(false, false, false, $row, false, $row_color, $row_class));
                    $out .= $this->_render_list_buttons($row);
                    $out .= $this->open_tag('span') . $this->close_tag($item);
                }
                foreach ($this->columns as $field => $fitem) {
                    $value = $row[$field];
                    if (isset($this->field_type[$field]) && ($this->field_type[$field] == 'password' or $this->field_type[$field] == 'hidden'))
                        continue;
                    $out .= $this->open_tag($item, '', $this->_cell_attrib($field, $value, $this->order_column, $row, false, $row_color, $row_class)) . $this->open_tag('span');
                    $out .= $this->_render_list_item($field, $value, $row['primary_key'], $row);
                    $out .= $this->open_tag('span') . $this->close_tag($item);
                }
                if (($this->is_edit || $this->is_remove || $this->is_view || $this->buttons || $this->is_duplicate || $this->grid_restrictions) && $this->task != 'print' && $this->buttons_position == 'right') {
                    $out .= $this->open_tag($item, 'xcrud-actions' . ((Xcrud_config::$fixed_action_buttons) ? ' xcrud-actions-fixed' : '') . (Xcrud_config::$fixed_action_buttons ? ' xcrud-fix' : ''), $this->_cell_attrib(false, false, false, $row, false, $row_color, $row_class)) . $this->open_tag('span');
                    $out .= $this->_render_list_buttons($row);
                    $out .= $this->open_tag('span') . $this->close_tag($item);
                }
                $out .= $this->close_tag($row_tag);
                $i = 1 - $i;
            }
        } else {
            $j = count($this->columns); // colspan
            if (($this->is_edit || $this->is_remove || $this->is_view || $this->buttons || $this->is_duplicate || $this->grid_restrictions) && $this->task != 'print' && ($this->buttons_position == 'right' || $this->buttons_position == 'left')) {
                ++ $j;
            }
            if ($this->is_numbers) {
                ++ $j;
            }
            if (count($this->mass_actions)) {
                ++ $j;
            }
            $out .= $this->open_tag($row_tag, 'xcrud-row') . $this->open_tag($item, '', array(
                'colspan' => $j
            )) . $this->lang('table_empty') . $this->close_tag($item) . $this->close_tag($row_tag);
        }
        return $out;
    }

    protected function render_grid_footer($row = array(
        'tag' => 'tr'
    ), $item = array(
        'tag' => 'td'
    ))
    {
        $out = '';
        if ($this->sum && $this->result_list) {
            $out .= $this->open_tag($row, 'xcrud-tf');
            if (count($this->mass_actions)) {
                $out .= $this->open_tag($item, 'xcrud-mass') . '&nbsp;' . $this->close_tag($item);
            }
            if ($this->is_numbers) {
                $out .= $this->open_tag($item, 'xcrud-num') . '&Sigma;' . $this->close_tag($item);
            }
            if (($this->is_edit || $this->is_remove || $this->buttons || $this->is_view || $this->is_duplicate || $this->grid_restrictions) && $this->task != 'print' && $this->buttons_position == 'left') {
                $out .= $this->open_tag($item, 'xcrud-actions') . '&nbsp;' . $this->close_tag($item);
            }
            foreach ($this->columns as $field => $fitem) {
                if (isset($this->field_type[$field]) && ($this->field_type[$field] == 'password' or $this->field_type[$field] == 'hidden'))
                    continue;
                $out .= $this->open_tag($item, isset($this->sum[$field]) ? $this->sum[$field]['class'] : '', $this->_cell_attrib($field, isset($this->sum[$field]) ? $this->sum[$field] : null, $this->order_column, $this->sum, true));
                $out .= $this->render_sum_item($field);
                $out .= $this->close_tag($item);
            }
            if (($this->is_edit || $this->is_remove || $this->buttons || $this->is_view || $this->is_duplicate || $this->grid_restrictions) && $this->task != 'print' && $this->buttons_position == 'right') {
                $out .= $this->open_tag($item, 'xcrud-actions') . '&nbsp;' . $this->close_tag($item);
            }
            $out .= $this->close_tag($row);
        }
        return $out;
    }

    protected function render_limitlist()
    {
        if ($this->is_limitlist) {
            return $this->get_limit_list($this->limit);
        }
        return '';
    }

    protected function render_pagination($numbers = 10, $offsets = 2)
    {
        if ($this->is_pagination) {
            return $this->_pagination($this->result_total, $this->start, $this->limit, $numbers, $offsets);
        }
        return '';
    }

    protected function render_benchmark($tag = array(
        'tag' => 'span'
    ))
    {
        if ($this->benchmark) {
            return $this->open_tag($tag, 'xcrud-benchmark') . $this->benchmark_end() . $this->close_tag($tag);
        }
        return '';
    }

    protected function render_control_fields()
    {
        $out = '';
        $tag = array(
            'tag' => 'input',
            'type' => 'hidden',
            'class' => 'xcrud-data'
        );
        $out .= $this->single_tag($tag, '', array(
            'name' => 'key',
            'value' => $this->key
        ));
        $out .= $this->single_tag($tag, '', array(
            'name' => 'orderby',
            'value' => $this->order_column
        ));
        $out .= $this->single_tag($tag, '', array(
            'name' => 'order',
            'value' => $this->order_direct
        ));
        $out .= $this->single_tag($tag, '', array(
            'name' => 'start',
            'value' => $this->start
        ));
        $out .= $this->single_tag($tag, '', array(
            'name' => 'limit',
            'value' => ($this->limit ? $this->limit : XcrudConfig::$limit)
        ));
        $out .= $this->single_tag($tag, '', array(
            'name' => 'instance',
            'value' => $this->instance_name
        ));
        $out .= $this->single_tag($tag, '', array(
            'name' => 'task',
            'value' => $this->task
        ));
        if (XcrudConfig::$dynamic_session) {
            $out .= $this->single_tag($tag, '', array(
                'name' => 'sess_name',
                'value' => session_name()
            ));
        }
        if ($this->primary_val) {
            $out .= $this->single_tag($tag, '', array(
                'name' => 'primary',
                'value' => $this->primary_val
            ));
        }

        $out .= $this->render_messages();
        $out .= implode('', $this->hidden_fields_output);

        return $out;
    }

    protected function render_custom_buttons()
    {
        $out = '';
        if (is_array($this->custom_buttons) && count($this->custom_buttons)) {
            foreach ($this->custom_buttons as $button) {
                $out .= $this->render_button($button);
            }
        }
        return $out;
    }

    /**
     * renders action button for details view
     *
     * @author Ariel Canal
     *         Adaptada para o funcionamento dos novos par�metros do m�todo
     *         create_action (icon, button_attr e conditions)
     */
    protected function render_button($name = '', $task = '', $after = '', $class = '', $icon = '', $mode = '', $primary = '')
    {
        $out = '';
        if (is_array($name) && isset($this->custom_buttons[$name['label']])) {
            // custom_buttons
            $button = $name;

            $tag = array(
                'tag' => 'a',
                'href' => $button['link']
            );
            if (is_array($button['tag']) && count($button['tag'])) {
                $tag = $tag + $button['tag'];
            }
            if ($button['class']) {
                $tag['class'] = $button['class'];
            }
            $out .= $this->open_tag($tag);
            if ($button['icon'] && ! $this->is_rtl) {
                $out .= $this->open_tag(array(
                    'tag' => 'i',
                    'class' => $button['icon']
                )) . $this->close_tag('i') . '&nbsp;';
            }
            $out .= $this->open_tag(array(
                'tag' => 'span'
            )) . $button['label'] . $this->close_tag('span');
            if ($button['icon'] && $this->is_rtl) {
                $out .= ' ' . $this->open_tag(array(
                    'tag' => 'i',
                    'class' => $button['icon']
                )) . $this->close_tag('i');
            }
            $out .= $this->close_tag($tag);
            return $out;
        } elseif (isset($this->{'is_' . $after}) && ! $this->{'is_' . $after}) {
            return $out;
        }
        if (isset($this->{'is_' . $task}) && ! $this->{'is_' . $task}) {
            return $out;
        }
        if (! isset($this->hide_button[$name])) {
            if ($mode) {
                $mode = $this->parse_comma_separated($mode);
                if (! in_array($this->task, $mode)) {
                    return $out;
                }
            }
            $tag = array(
                'tag' => 'button',
                'data-task' => $task
            );
            if ($after) {
                $tag['data-after'] = $after;
            }
            if ($class) {
                $tag['class'] = $class;
            }
            if ($primary) {
                $tag['data-primary'] = $primary;
            } elseif ($this->primary_val) {
                $tag['data-primary'] = $this->primary_val;
            }
            if (isset($this->action[$task])) {
                if ($this->action[$task]['mode']) {
                    $this->action[$task]['mode'] = $this->parse_comma_separated($this->action[$task]['mode']);
                    if (! in_array($this->task, $this->action[$task]['mode'])) {
                        return $out;
                    }
                }
                if ($this->action[$task]['conditions']) {
                    foreach ($this->action[$task]['conditions'] as $cond) {
                        $f = $cond[0];
                        $o = $cond[1];
                        $v = $cond[2];
                        if (! strpos($f, '.'))
                            $f = $this->table . "." . $f;
                        if (! $this->_compare($this->result_row[$f], $o, $v)) {
                            return $out;
                        }
                    }
                }
                $tag['data-task'] = 'action';
                $tag['data-action'] = $task;
                if ($this->action[$task]['icon'] != "") {
                    $icon = $this->action[$task]['icon'];
                }
                if ($this->action[$task]['button_attr']) {
                    foreach ($this->action[$task]['button_attr'] as $k => $v) {
                        if (is_array($v)) {
                            foreach ($v as $k2 => $v2) {
                                $tag[$k2] = $v2;
                            }
                        } else {
                            $tag[$k] = $v;
                        }
                    }
                }
            }
            $out .= $this->open_tag($tag, 'xcrud-action');
            if ($icon && ! $this->is_rtl) {
                $out .= $this->open_tag(array(
                    'tag' => 'i',
                    'class' => $icon
                )) . $this->close_tag('i') . ' ';
            }
            $out .= $this->open_tag(array(
                'tag' => 'span'
            )) . $this->lang($name) . $this->close_tag('span');
            if ($icon && $this->is_rtl) {
                $out .= ' ' . $this->open_tag(array(
                    'tag' => 'i',
                    'class' => $icon
                )) . $this->close_tag('i');
            }
            $out .= $this->close_tag($tag);
        }
        return $out;
    }

    protected function add_button($class = '', $icon = '')
    {
        if ($this->is_create && ! isset($this->hide_button['add']) && ! $this->table_ro) {
            return $this->render_button('add', 'create', '', $class, $icon);
        }
    }

    protected function csv_button($class = '', $icon = '')
    {
        if ($this->is_csv && ! isset($this->hide_button['csv'])) {
            return $this->render_button('export_csv', 'csv', '', $class . ' xcrud-in-new-window', $icon);
        }
    }

    protected function print_button($class = '', $icon = '')
    {
        if ($this->is_print && ! isset($this->hide_button['print'])) {
            return $this->render_button('print', 'print', '', $class . ' xcrud-in-new-window', $icon);
        }
    }

    protected function refresh_button($class = '', $icon = '')
    {
        if ($this->task == "list") {
            return $this->render_button('refresh', 'list', '', $class, $icon);
        }
    }

    protected function get_image_folder($field)
    {
        if (isset($this->upload_folder[$field]))
            return $this->upload_folder[$field];
        $settings = $this->upload_config[$field];
        if (isset($settings['path'])) {
            $path = $this->check_folder($settings['path'], 'get_image_folder');
        } else {
            $path = $this->check_folder(XcrudConfig::$upload_folder_def, 'get_image_folder');
        }
        $this->upload_folder[$field] = $path;
        return $path;
    }

    protected function check_file_folders($field)
    {
        $settings = $this->upload_config[$field];
        $path = $this->get_image_folder($field);
        if (! is_dir($path)) {
            $this->create_file_folders($path);
        }
        if (isset($settings['thumbs']) && is_array($settings['thumbs'])) {
            foreach ($settings['thumbs'] as $thumb) {
                if (isset($thumb['folder']) && ! is_dir($path . '/' . trim($thumb['folder'], '/'))) {
                    $this->create_file_folders($path . '/' . trim($thumb['folder'], '/'));
                }
            }
        }
    }

    protected function create_file_folders($path)
    {
        $path_array = explode('/', $path);
        array_pop($path_array);
        if (is_dir(implode('/', $path_array))) {
            if (! mkdir($path))
                self::error('cannot create directory ' . $path);
        } else {
            self::error('File path is incorrect!');
        }
    }

    protected function get_thumb_path($imgname, $field, $thumb_array)
    {
        $path = $this->get_image_folder($field);
        if (isset($thumb_array['folder']) && ! empty($thumb_array['folder'])) {
            $path .= '/' . trim($thumb_array['folder'], '/');
        }
        $marker = isset($thumb_array['marker']) ? $thumb_array['marker'] : '';
        return $path . '/' . $this->_thumb_name($imgname, $marker);
    }

    protected function safe_file_name($file, $field)
    {
        $ext = strtolower(strrchr($file['name'], '.'));
        if (isset($this->upload_config[$field]['not_rename']) && $this->upload_config[$field]['not_rename'] == true)
            $filename = $this->_clean_file_name($file['name']);
        else
            $filename = base_convert(str_replace(' ', '', microtime()) . rand(), 10, 36) . $ext;
        return $filename;
    }

    protected function get_ext($filename)
    {
        return strtolower(strrchr($filename, '.') + 1);
    }

    protected function save_file_to_tmp($file, $filename, $field)
    {
        $filename = substr($filename, 0, strrpos($filename, '.')) . '.tmp';
        $file_path = $this->get_image_folder($field) . '/' . $filename;
        move_uploaded_file($file['tmp_name'], $file_path);

        if ($this->after_upload) {
            $path = $this->check_file($this->after_upload['path'], 'save_file_to_tmp');
            include_once ($path);
            $callable = $this->after_upload['callable'];
            if (is_callable($callable)) {
                call_user_func_array($callable, array(
                    $field,
                    $filename,
                    $file_path,
                    $this->upload_config[$field],
                    $this
                ));
            }
        }

        return $filename;
    }

    protected function save_file($file, &$filename, $field)
    {
        $file_path = $this->get_image_folder($field) . '/' . $filename;
        $file_path = utf8_decode($file_path);
        move_uploaded_file($file['tmp_name'], $file_path);
        if ($this->after_upload) {
            $path = $this->check_file($this->after_upload['path'], 'save_file');
            include_once ($path);
            $callable = $this->after_upload['callable'];
            if (is_callable($callable)) {
                call_user_func_array($callable, array(
                    $field,
                    &$filename,
                    $file_path,
                    $this->upload_config[$field],
                    $this
                ));
            }
        }
        return $file_path;
    }

    protected function get_filename_noconfict($filename, $field)
    {
        $file_path = $this->get_image_folder($field) . '/' . $filename;
        if (is_file($file_path)) {
            $filename = substr_replace($filename, '_@XCRUD' . base_convert(time() . rand(), 10, 36), strrpos($filename, '.'), 0);
        }
        return $filename;
    }

    protected function is_resize($field)
    {
        if (isset($this->upload_config[$field]['width']) or isset($this->upload_config[$field]['height'])
            /* or isset($this->upload_config[$field]['field'])*/ or (isset($this->upload_config[$field]['manual_crop']) && $this->upload_config[$field]['manual_crop'] == true) /* or (isset($this->upload_config[$field]['thumbs']) && count($this->
            upload_config[$field]['thumbs']))*/)
            return true;
        else
            return false;
    }

    protected function is_manual_crop($field)
    {
        if (isset($this->upload_config[$field]['manual_crop']) && $this->upload_config[$field]['manual_crop'] == true)
            return true;
        else
            return false;
    }

    protected function remove_tmp_image($filename, $field)
    {
        $tmp_filename = substr($filename, 0, strrpos($filename, '.')) . '.tmp';
        if (isset($this->upload_config[$field]['save_original']) && $this->upload_config[$field]['save_original'] == true) {
            if (isset($this->upload_config[$field]['original_marker']) && ! empty($this->upload_config[$field]['original_marker'])) {
                $orig_filename = $this->_thumb_name($filename, $this->upload_config[$field]['original_marker']);
            } else {
                $orig_filename = $this->_thumb_name($filename, '_orig');
            }
            rename($this->get_image_folder($field) . '/' . $tmp_filename, $this->get_image_folder($field) . '/' . $orig_filename);
        } else {
            $path = $this->get_image_folder($field);
            if (is_file($path . '/' . $tmp_filename))
                unlink($path . '/' . $tmp_filename);
        }

        if ($this->after_resize) {
            $path = $this->check_file($this->after_resize['path'], 'after_resize');
            include_once ($path);
            $callable = $this->after_resize['callable'];
            if (is_callable($callable)) {
                call_user_func_array($callable, array(
                    $field,
                    $filename,
                    $this->get_image_folder($field) . '/' . $filename,
                    $this->upload_config[$field],
                    $this
                ));
            }
        }
    }

    protected function remove_file($filename, $field)
    {
        $settings = $this->upload_config[$field];
        $path = $this->get_image_folder($field);
        if (is_file($path . '/' . $filename))
            unlink($path . '/' . $filename);
        if (isset($settings['thumbs']) && is_array($settings['thumbs'])) {
            foreach ($settings['thumbs'] as $thumb) {
                $thumb_file = $this->get_thumb_path($filename, $field, $thumb);
                if (is_file($thumb_file))
                    unlink($thumb_file);
            }
        }
        if (isset($this->upload_config[$field]['save_original']) && $this->upload_config[$field]['save_original'] == true) {
            if (isset($this->upload_config[$field]['original_marker']) && ! empty($this->upload_config[$field]['original_marker'])) {
                $orig_filename = $this->_thumb_name($filename, $this->upload_config[$field]['original_marker']);
            } else {
                $orig_filename = $this->_thumb_name($filename, '_orig');
            }
            if (is_file($path . '/' . $orig_filename))
                unlink($path . '/' . $orig_filename);
        }
    }

    /**
     * date ranges in unix timestamp
     */
    protected function get_range($name)
    {
        $range = array();
        $time = time() /* + 3600 * XcrudConfig::$local_time_correction*/;
        $week_day = date('w', $time) /* + XcrudConfig::$date_first_day*/;
        switch ($name) {
            default:
            case 'today':
                $range['from'] = gmmktime(0, 0, 0, date('n', $time), date('j', $time), date('Y', $time));
                $range['to'] = gmmktime(23, 59, 59, date('n', $time), date('j', $time), date('Y', $time));
                break;
            case 'next_year':
                $range['from'] = gmmktime(0, 0, 0, 1, 1, date('Y', $time) + 1);
                $range['to'] = gmmktime(23, 59, 59, 12, 31, date('Y', $time) + 1);
                break;
            case 'next_month':
                $range['from'] = gmmktime(0, 0, 0, date('n', $time) + 1, 1, date('Y', $time));
                $range['to'] = gmmktime(23, 59, 59, date('n', $time) + 2, - 1, date('Y', $time));
                break;
            case 'this_week_today':
                if ($week_day >= XcrudConfig::$date_first_day) {
                    $offset1 = $week_day - XcrudConfig::$date_first_day;
                } else {
                    $offset1 = 7 - (XcrudConfig::$date_first_day - $week_day);
                }
                $range['from'] = gmmktime(0, 0, 0, date('n', $time), date('j', $time) - $offset1, date('Y', $time));
                $range['to'] = gmmktime(23, 59, 59, date('n', $time), date('j', $time), date('Y', $time));
                break;
            case 'this_week_full':
                if ($week_day >= XcrudConfig::$date_first_day) {
                    $offset1 = $week_day - XcrudConfig::$date_first_day;
                } else {
                    $offset1 = 7 - (XcrudConfig::$date_first_day - $week_day);
                }
                $offset2 = 6 - $week_day + XcrudConfig::$date_first_day;
                $range['from'] = gmmktime(0, 0, 0, date('n', $time), date('j', $time) - $offset1, date('Y', $time));
                $range['to'] = gmmktime(23, 59, 59, date('n', $time), date('j', $time) + $offset2, date('Y', $time));
                break;
            case 'last_week':
                if ($week_day >= XcrudConfig::$date_first_day) {
                    $offset1 = $week_day - XcrudConfig::$date_first_day;
                } else {
                    $offset1 = 7 - (XcrudConfig::$date_first_day - $week_day);
                }
                $offset2 = 6 - $week_day + XcrudConfig::$date_first_day;
                $range['from'] = gmmktime(0, 0, 0, date('n', $time), date('j', $time) - $offset1 - 7, date('Y', $time));
                $range['to'] = gmmktime(23, 59, 59, date('n', $time), date('j', $time) + $offset2 - 7, date('Y', $time));
                break;
            case 'last_2weeks':
                if ($week_day >= XcrudConfig::$date_first_day) {
                    $offset1 = $week_day - XcrudConfig::$date_first_day;
                } else {
                    $offset1 = 7 - (XcrudConfig::$date_first_day - $week_day);
                }
                $offset2 = 6 - $week_day + XcrudConfig::$date_first_day;
                $range['from'] = gmmktime(0, 0, 0, date('n', $time), date('j', $time) - $offset1 - 14, date('Y', $time));
                $range['to'] = gmmktime(23, 59, 59, date('n', $time), date('j', $time) + $offset2 - 14, date('Y', $time));
                break;
            case 'this_month':
                $range['from'] = gmmktime(0, 0, 0, date('n', $time), 1, date('Y', $time));
                $range['to'] = gmmktime(23, 59, 59, date('n', $time), date('j', $time), date('Y', $time));
                break;
            case 'last_month':
                $range['from'] = gmmktime(0, 0, 0, date('n', $time) - 1, 1, date('Y', $time));
                $range['to'] = gmmktime(23, 59, 59, date('n', $time), date('j', $time) - 1, date('Y', $time));
                break;
            case 'last_3months':
                $range['from'] = gmmktime(0, 0, 0, date('n', $time) - 3, 1, date('Y', $time));
                $range['to'] = gmmktime(23, 59, 59, date('n', $time), date('j', $time) - 1, date('Y', $time));
                break;
            case 'last_6months':
                $range['from'] = gmmktime(0, 0, 0, date('n', $time) - 6, 1, date('Y', $time));
                $range['to'] = gmmktime(23, 59, 59, date('n', $time), date('j', $time) - 1, date('Y', $time));
                break;
            case 'this_year':
                $range['from'] = gmmktime(0, 0, 0, 1, 1, date('Y', $time));
                $range['to'] = gmmktime(23, 59, 59, date('n', $time), date('j', $time), date('Y', $time));
                break;
            case 'last_year':
                $range['from'] = gmmktime(0, 0, 0, 1, 1, date('Y', $time) - 1);
                $range['to'] = gmmktime(23, 59, 59, 12, 31, date('Y', $time) - 1);
                break;
        }
        return $range;
    }

    protected function br2mysqldate($time)
    {
        if ($time == "")
            return "";
        $time = explode(' ', $time);
        $time_d = explode('/', $time[0]);
        return $time_d[2] . "-" . $time_d[1] . "-" . $time_d[0] . (isset($time[1]) ? " " . $time[1] : '');
    }

    protected function unix2date($time, $utc = false)
    {
        if ($time)
            return $utc ? gmdate($this->date_format['php_d'], $time) : date($this->date_format['php_d'], $time);
        else
            return '';
    }

    protected function unix2datetime($time, $utc = false)
    {
        if ($time)
            return $utc ? gmdate($this->date_format['php_d'] . ' ' . $this->date_format['php_t'], $time) : date(XcrudConfig::$php_date_format . ' ' . $this->date_format['php_t'], $time);
        else
            return '';
    }

    protected function unix2time($time, $utc = false)
    {
        if ($time)
            return $utc ? gmdate($this->date_format['php_t'], $time) : date($this->date_format['php_t'], $time);
        else
            return '';
    }

    protected function mysql2date($date)
    {
        if ($date && $date != '0000-00-00') {
            $d = explode('-', $date);
            $date = $this->unix2date(mktime((int) date('G'), (int) date('i'), (int) date('s'), (int) $d[1], (int) $d[2], (int) $d[0]));
            return $date;
        }
        return '';
    }

    protected function mysql2datetime($date)
    {
        if ($date && $date != '0000-00-00 00:00:00') {
            if (! preg_match('/^\-{0,1}[0-9]+$/u', $date)) {
                $date = strtotime($date);
            }
            $date = $this->unix2datetime((int) $date);
            return $date;
        }
        return '';
    }

    protected function mysql2time($date)
    {
        if ($date) {
            if (strpos($date, ' ') !== false) {
                list ($tmp, $date) = explode(' ', $date, 2);
            }
            $d = explode(':', $date);
            $date = $this->unix2time(mktime((int) $d[0], (int) $d[1], (int) $d[2]));
            return $date;
        }
        return '';
    }

    /* OPÇÃO PARA SUBSTITUIÇÃO DO TÍTULO */
    protected function render_table_name($mode = 'list', $tag = 'h2', $to_show = false, $replace_title = false)
    {
        $out = '';
        if ($this->is_title) {
            $attr = array();
            if ($to_show && ! $this->start_minimized)
                $attr['style'] = 'display:none;';
            if ($to_show)
                $attr['class'] = 'xcrud-main-tab';
            if ($replace_title)
                $title = $replace_title;
            else
                $title = $this->table_name;
            $out .= $this->open_tag($tag, '', $attr);
            switch ($mode) {
                case 'create':
                    $out .= $this->is_rtl ? '<small>' . $this->lang('add') . ' - </small>' . $title : $title . '<small> - ' . $this->lang('add') . '</small>';
                    break;
                case 'edit':
                    $out .= $this->is_rtl ? '<small>' . $this->lang('edit') . ' - </small>' . $title : $title . '<small> - ' . $this->lang('edit') . '</small>';
                    break;
                case 'view':
                    $out .= $this->is_rtl ? '<small>' . $this->lang('view') . ' - </small>' . $title : $title . '<small> - ' . $this->lang('view') . '</small>';
                    break;
                default:
                    $out .= $this->is_rtl ? '<small>' . $this->get_table_tooltip() . '</small>' . $title : $title . '<small> ' . $this->get_table_tooltip() . '</small>';
                    break;
            }
            if (XcrudConfig::$can_minimize) {
                if ($to_show)
                    $out .= '<span class="xcrud-toggle-show xcrud-toggle-down"><i class="' . $this->theme_config('slide_down_icon') . '"></i></span>';
                else
                    $out .= '<span class="xcrud-toggle-show xcrud-toggle-up"><i class="' . $this->theme_config('slide_up_icon') . '"></i></span>';
            }
            $out .= $this->close_tag($tag);
        }
        return $out;
    }

    protected function get_id()
    {
        return 'id="xc_' . base_convert(time() + rand(), 10, 36) . '"';
    }

    public function encrypt($obj)
    {
        if (! XcrudConfig::$alt_encription_key) {
            self::error('Please, set <strong>$alt_encription_key</strong> parameter in configuration file');
        }
        $text = json_encode($obj);

        if (! is_callable('mcrypt_module_open')) {
            self::error('<strong>mcrypt_module</strong> not found');
        }
        if (defined('MCRYPT_TWOFISH') && mcrypt_module_self_test(MCRYPT_TWOFISH)) {
            $algoritm = MCRYPT_TWOFISH;
        } elseif (defined('MCRYPT_RIJNDAEL_256') && mcrypt_module_self_test(MCRYPT_RIJNDAEL_256)) {
            $algoritm = MCRYPT_RIJNDAEL_256;
        } elseif (defined('MCRYPT_SERPENT') && mcrypt_module_self_test(MCRYPT_SERPENT)) {
            $algoritm = MCRYPT_SERPENT;
        } elseif (defined('MCRYPT_BLOWFISH') && mcrypt_module_self_test(MCRYPT_BLOWFISH)) {
            $algoritm = MCRYPT_BLOWFISH;
        } else {
            self::error('MCRYPT - Supported algorytm not found');
        }
        $td = mcrypt_module_open($algoritm, '', MCRYPT_MODE_CFB, '');
        $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
        $ks = mcrypt_enc_get_key_size($td);
        $key = substr(XcrudConfig::$alt_encription_key, 0, $ks);
        mcrypt_generic_init($td, $key, $iv);
        $encrypted = mcrypt_generic($td, $text);
        mcrypt_generic_deinit($td);
        mcrypt_module_close($td);

        return array(
            base64_encode($encrypted),
            base64_encode($iv)
        );
    }

    public function decrypt($text, $iv)
    {
        if (! XcrudConfig::$alt_encription_key) {
            self::error('Please, set <strong>$alt_encription_key</strong> parameter in configuration file');
        }
        if (! is_callable('mcrypt_module_open')) {
            self::error('<strong>mcrypt_module</strong> not found');
        }
        if (defined('MCRYPT_TWOFISH') && mcrypt_module_self_test(MCRYPT_TWOFISH)) {
            $algoritm = MCRYPT_TWOFISH;
        } elseif (defined('MCRYPT_RIJNDAEL_256') && mcrypt_module_self_test(MCRYPT_RIJNDAEL_256)) {
            $algoritm = MCRYPT_RIJNDAEL_256;
        } elseif (defined('MCRYPT_SERPENT') && mcrypt_module_self_test(MCRYPT_SERPENT)) {
            $algoritm = MCRYPT_SERPENT;
        } elseif (defined('MCRYPT_BLOWFISH') && mcrypt_module_self_test(MCRYPT_BLOWFISH)) {
            $algoritm = MCRYPT_BLOWFISH;
        } else {
            self::error('MCRYPT - Supported algorytm not found');
        }
        $td = mcrypt_module_open($algoritm, '', MCRYPT_MODE_CFB, '');
        $ks = mcrypt_enc_get_key_size($td);
        $key = substr(XcrudConfig::$alt_encription_key, 0, $ks);
        mcrypt_generic_init($td, $key, base64_decode($iv));
        $decrypted = mdecrypt_generic($td, base64_decode($text));
        mcrypt_generic_deinit($td);
        mcrypt_module_close($td);

        $obj = json_decode($decrypted, true);
        return $obj;
    }

    /*
     * ALTERADO DO PADR�O - Compatibiliza��o com array de grid_restrictions
     */
    protected function is_edit(&$row)
    {
        if (! isset($this->grid_restrictions['edit'])) {
            return $this->is_edit;
        } else {
            $cond = array();
            foreach ($this->grid_restrictions['edit'] as $item) {
                $fdata = $this->_parse_field_names($item['field']);
                $fname = key($fdata) /*$fdata[0]['table'] . '.' . $fdata[0]['field']*/;
                $cond[] = $this->_compare($row[$fname], $item['operator'], $this->replace_text_variables($item['value'], $row));
            }
            if (($item['bool'] === true && in_array(true, $cond)) || ($item['bool'] === false && ! in_array(false, $cond))) {
                $this->is_edit = false;
                return false;
            }

            $this->is_edit = true;
            return true;
        }
    }

    /*
     * ALTERADO DO PADR�O - Compatibiliza��o com array de grid_restrictions
     */
    protected function is_remove(&$row)
    {
        if (! isset($this->grid_restrictions['remove'])) {
            return $this->is_remove;
        } else {
            $cond = array();
            foreach ($this->grid_restrictions['remove'] as $item) {
                $fdata = $this->_parse_field_names($item['field']);
                $fname = key($fdata) /*$fdata[0]['table'] . '.' . $fdata[0]['field']*/;
                $cond[] = $this->_compare($row[$fname], $item['operator'], $this->replace_text_variables($item['value'], $row));
            }
            if (($item['bool'] === true && in_array(true, $cond)) || ($item['bool'] === false && ! in_array(false, $cond))) {
                $this->is_remove = false;
                return false;
            }
            $this->is_remove = true;
            return true;
        }
    }

    /*
     * ALTERADO DO PADR�O - Compatibiliza��o com array de grid_restrictions
     */
    protected function is_duplicate(&$row)
    {
        if (! isset($this->grid_restrictions['duplicate'])) {
            return $this->is_duplicate;
        } else {
            $cond = array();
            foreach ($this->grid_restrictions['duplicate'] as $item) {
                $fdata = $this->_parse_field_names($item['field']);
                $fname = key($fdata) /*$fdata[0]['table'] . '.' . $fdata[0]['field']*/;
                $cond[] = $this->_compare($row[$fname], $item['operator'], $this->replace_text_variables($item['value'], $row));
            }
            if (($item['bool'] === true && in_array(true, $cond)) || ($item['bool'] === false && ! in_array(false, $cond))) {
                $this->is_duplicate = false;
                return false;
            }
            $this->is_duplicate = true;
            return true;
        }
    }

    /*
     * ALTERADO DO PADR�O - Compatibiliza��o com array de grid_restrictions
     */
    protected function is_view(&$row)
    {
        if (! isset($this->grid_restrictions['view'])) {
            return $this->is_view;
        } else {
            $cond = array();
            foreach ($this->grid_restrictions['view'] as $item) {
                $fdata = $this->_parse_field_names($item['field']);
                $fname = key($fdata) /*$fdata[0]['table'] . '.' . $fdata[0]['field']*/;
                $cond[] = $this->_compare($row[$fname], $item['operator'], $this->replace_text_variables($item['value'], $row));
            }
            if (($item['bool'] === true && in_array(true, $cond)) || ($item['bool'] === false && ! in_array(false, $cond))) {
                $this->is_view = false;
                return false;
            }
            $this->is_view = true;
            return true;
        }
    }

    /*
     * ALTERADO DO PADR�O - Compatibiliza��o com array de grid_restrictions
     */
    protected function is_button($name, &$row)
    {
        if (isset($this->grid_restrictions[$name])) {
            foreach ($this->grid_restrictions[$name] as $item) {
                $fdata = $this->_parse_field_names($item['field']);
                $fname = key($fdata) /*$fdata[0]['table'] . '.' . $fdata[0]['field']*/;

                $cond = $this->_compare($row[$fname], $item['operator'], $this->replace_text_variables($item['value'], $row));
                if (($item['bool'] === true && $cond) || ($item['bool'] === false && ! $cond)) {
                    return false;
                }
            }
            return true;
        } else {
            return true;
        }
    }

    protected function _call_action()
    {
        $name = $this->_post('action');
        if (isset($this->action[$name])) {
            $path = $this->check_file($this->action[$name]['path'], 'call_action');
            include_once ($path);
            if (is_callable($this->action[$name]['callable'])) {
                call_user_func_array($this->action[$name]['callable'], array(
                    $this
                ));
            }
        }
        $this->task = $this->after;
        $this->after = null;
        return $this->_run_task();
    }

    public static function import_session($data)
    {
        $this->ci->session->userdata('xcrud_session', $data);
    }

    public static function export_session()
    {
        return $this->ci->session->userdata('xcrud_session');
    }

    public function fieldname_encode($name = '')
    {
        if (! XcrudConfig::$encode_field_names) {
            return $name;
        }
        return str_replace(array(
            '=',
            '/',
            '+'
        ), array(
            '-',
            '_',
            ':'
        ), base64_encode($name));
    }

    public function fieldname_decode($name = '')
    {
        if (! XcrudConfig::$encode_field_names) {
            return $name;
        }
        return str_replace('`', '', base64_decode(str_replace(array(
            '-',
            '_',
            ':'
        ), array(
            '=',
            '/',
            '+'
        ), $name)));
    }

    protected function parse_mode($mode)
    {
        $modes = $this->parse_comma_separated($mode);
        if ($modes) {
            return (array_combine($modes, array_fill(0, count($modes), 1)));
        } else {
            return array(
                'list' => 1,
                'create' => 1,
                'edit' => 1,
                'view' => 1
            );
        }
    }

    /**
     *
     * @author Ariel Canal
     *         As propriedades readonly_on_* e disabled_on_* n�o existem na
     *         classe, portando o backup delas, quando acionadas pelo m�todo
     *         condition() n�o era feito.
     */
    protected function condition_backup($method, $field = null)
    {
        if (! isset($this->condition_backup[$method])) {
            if ($method == "readonly_on_create" || $method == "readonly_on_edit")
                $method = 'readonly';
            elseif ($method == "disabled_on_create" || $method == "disabled_on_edit")
                $method = 'disabled';
            if (property_exists($this, $method)) {
                $this->condition_backup[$method] = $this->{$method};
            } else {
                $this->condition_backup[$method] = false;
            }
        }
    }

    protected function condition_restore()
    {
        if ($this->condition_backup) {
            foreach ($this->condition_backup as $bak_key => $back_val) {
                $this->{$bak_key} = $back_val;
            }
            $this->condition_backup = array();
        }
    }

    public function load_core_class($name)
    {
        $path = XCRUD_PATH . '/core/' . $name . '.php';
        if (isset(self::$classes[$name])) {
            return self::$classes[$name];
        }
        if (is_file($path)) {
            require_once ($path);
            $class = 'Xcrud_' . $name;
            if (class_exists($class)) {
                self::$classes[$name] = new $class();
                return self::$classes[$name];
            } else {
                self::error('Class "' . $class . '" not exist!');
            }
        } else {
            self::error('File "' . $name . '.php" not exist!');
        }
    }

    /**
     *
     * @author Ariel Canal
     *         Formata o número no formato para usuário (não BD).
     */
    protected function cast_number_format($number, $field, $edit = false)
    {
        $out = '';

        if (! $number)
            return $out;

        $out .= $this->html_safe($this->field_attr[$field]['prefix']);
        $out .= number_format($number ? (float) $number : 0, $this->field_attr[$field]['decimals'], $this->field_attr[$field]['point'], $this->html_safe($this->field_attr[$field]['separator']));
        $out .= $this->html_safe($this->field_attr[$field]['suffix']);

        return $out;
    }

    protected function _alphabetical()
    {
        if ($this->alphabetical_field != '') {
            $table_join = $this->_build_table_join();
            $where = $this->_build_where(false);
            $db = Database::get_instance($this->connection, $this->ci);

            $db->query("SELECT SUBSTRING(UPPER($this->alphabetical_field),1,1) as inicial \r\n FROM `{$this->table}`\r\n {$table_join}\r\n {$where}\r\n GROUP BY SUBSTRING(UPPER($this->alphabetical_field),1,1) ORDER BY inicial ASC");
            $this->alphabetical_index = array();
            foreach ($db->result() as $index) {
                if (in_array($index['inicial'], range('A', 'Z')))
                    $this->alphabetical_index[$index['inicial']] = $index['inicial'];
                else
                    $this->alphabetical_index['#'] = "#";
            }
        }
    }

    public function alphabetichal_filter($column_name)
    {
        $this->alphabetical_field = $column_name;
    }

    public function render_alphabetical_filter()
    {
        $out = '';
        if (count($this->alphabetical_index)) {
            $out .= $this->open_tag('ul', 'xcrud-alphabetical ' . $this->theme_config('alphabetical_container'));
            if (! isset($this->alphabetical_index[0]) || $this->alphabetical_index[0] != 'all')
                array_unshift($this->alphabetical_index, 'all');

            foreach ($this->alphabetical_index as $i) {
                if ($i == "all")
                    $attr['data-alphabetical'] = '';
                else
                    $attr['data-alphabetical'] = $i;

                if ($this->alphabetical_filter == $i || ($this->alphabetical_filter == "" && $i == 'all'))
                    $class = $this->theme_config('alphabetical_active');
                else
                    $class = $this->theme_config('alphabetical_item');

                $out .= $this->open_tag('li', 'xcrud-action ' . $class, $attr) . $this->lang($i) . $this->close_tag('li');
            }
            $out .= $this->close_tag('ul');
        }
        return $out;
    }

    public function custom_filter($filter_name, $filter_opts, $default = false, $hide_all_option = false)
    {
        if (! $hide_all_option && ! array_key_exists('all', $filter_opts)) {
            $arr = array_reverse($filter_opts, true);
            $arr['all'] = '1=1';
            $filter_opts = array_reverse($arr, true);
        }

        if (! @array_key_exists($default, $filter_opts))
            $default = false;

        $this->custom_filter[$filter_name] = $filter_opts;
        $this->custom_filter_active[$filter_name] = ($default) ? $default : 'all';
    }

    public function render_custom_filter($filter_name)
    {
        $out = '';
        if (isset($this->custom_filter[$filter_name])) {
            if (empty($this->custom_filter[$filter_name]['active'])) {
                $this->custom_filter[$filter_name]['active'] = 'all';
            }
            $out .= $this->open_tag('div', 'btn-group ' . $this->theme_config('custom_filter_container') . ' ' . $this->custom_filter[$filter_name]['container_class'], [
                "id" => "custom-filter-" . $filter_name,
                'role' => 'group'
            ]);
            $out .= $this->open_tag('button', 'btn ' . $this->theme_config('custom_filter_toggle') . ' ' . $this->custom_filter[$filter_name]['toggle_class'] . ' dropdown-toggle', [
                "data-bs-toggle" => "dropdown",
                "aria-expanded" => "false"
            ]);
            $out .= $this->lang($this->custom_filter[$filter_name]['active']);
            $out .= $this->close_tag('button');

            $out .= $this->open_tag('div', 'btn-group', [
                'role' => "group"
            ]);
            $out .= $this->open_tag('ul', 'dropdown-menu ' . $this->theme_config('custom_filter_menu'));
            $attr['data-filter'] = $filter_name;
            $attr['data-nomovepage'] = 'true';
            $attr['data-table'] = strtolower($this->table);
            $attr['href'] = "#";
            foreach ($this->custom_filter[$filter_name]['options'] as $label => $config) {
                $attr['data-label'] = $label;

                if ($this->custom_filter[$filter_name]['active'] == $attr['data-label']) {
                    $class = $this->theme_config('custom_filter_item_active') . ' active';
                } else {
                    $class = $this->theme_config('custom_filter_item');
                }

                $out .= $this->open_tag('a', 'xcrud-action dropdown-item ' . $class, $attr) . $this->lang($attr['data-label']) . $this->close_tag('a');

                if ($label == "all") {
                    $out .= $this->open_tag('div', 'dropdown-divider') . $this->close_tag('div');
                }
            }
            $out .= $this->close_tag('ul');
            $out .= $this->close_tag('div');
            $out .= $this->close_tag('div');
        }
        return $out;
    }

    public function totalizer($name, $where, $select = null, $icon = false, $icon_container = false, $replace_icon = false)
    {
        $this->totalizers[$name]['where'] = $where;
        $this->totalizers[$name]['select'] = $select;
        $this->totalizers[$name]['icon'] = $icon;
        $this->totalizers[$name]['icon_container'] = $icon_container;
        $this->totalizers[$name]['replace_icon'] = $replace_icon;
        foreach ($this->totalizers as $filter_name => $filter_opts)
            $filter[$filter_name] = $filter_opts['where'];

        $this->custom_filter('totalizer', $filter);
    }

    public function render_totalizers($render_view_all = true, $display = 'block')
    {
        if ($total_items = count($this->totalizers)) {
            if (! $display)
                $display = 'block';
            $out = '<div class="' . $this->theme_config('totalizer_container') . '" style="display:' . $display . ';">';

            if ($render_view_all) {
                $total_items ++;
                $width = round((12 / $total_items));

                $db = Database::get_instance($this->connection, $this->ci);
                $table_join = $this->_build_table_join();
                $where_tot = $this->_build_where(false, 'all');
                $db->query("SELECT COUNT(*) AS `count` \r\n FROM `{$this->table}`\r\n {$table_join}\r\n {$where_tot}");
                $total = $db->row();
                $total = $total['count'];

                $icon = ($this->theme_config('totalizer_icon_all') != "") ? $this->theme_config('totalizer_icon_all') : $this->theme_config('totalizer_icon_default');
                $icon_container = ($this->theme_config('totalizer_icon_all_container') != "") ? $this->theme_config('totalizer_icon_all_container') : $this->theme_config('totalizer_icon_container');
                $out .= '<div class="col-md-' . $width . '"><div class="statbox widget box box-shadow"><div class="widget-content">';
                $out .= '<div class="' . $icon_container . '"><i class="' . $icon . '"></i></div>';
                $out .= '<div class="title">' . $this->lang('total') . '</div>';
                $out .= '<div class="value">' . $total . '</div>';
                $out .= '<a class="xcrud-action more" data-filter="totalizer" data-label="all">Visualizar <i class="pull-right fas fa-angle-right"></i></a>';
                $out .= "</div></div></div>";
            }
            foreach ($this->totalizers as $name => $params) {
                $out .= '<div class="col-xs-4"><div class="counter">';
                $out .= '<span class="counter-number font-weight-medium">' . $params['total'] . '</span>';
                $out .= '<div class="counter-label">' . $name . '</div>';
                $out .= '</div></div>';
            }
            $out .= "</div>";
            return $out;
        }
        return false;
    }

    public function nested_readonly_on_view($bool = true)
    {
        $this->nested_readonly_on_view = $bool;
    }

    public function table_always_edit_mode($bool = true)
    {
        $this->table_always_edit_mode = $bool;
    }

    public function get_table()
    {
        return $this->table;
    }

    public function record_changes($fields = '', $reverse = false)
    {
        if ($fields != '' && $reverse) {
            $fdata = $this->_parse_field_names($fields, 'fields');
            foreach ($this->fields_edit as $k => $data) {
                if (! in_array($k, array_keys($fdata)))
                    $record_changes[$k] = $data;
            }
        } else if ($fields !== '' && ! $reverse) {
            $record_changes = $fdata;
        } else if ($fields == '') {
            $record_changes = $this->fields_edit;
        }
        $this->record_changes = $record_changes;
    }

    private function apply_record_changes($set)
    {
        if (is_array($this->record_changes) && sizeof($this->record_changes)) {
            $old_task = $this->task;
            $this->task = 'view';
            $this->where_pri($this->primary_key, $this->primary_val);
            $select = $this->_build_select_details($this->task);
            $where = $this->_build_where();
            $table_join = $this->_build_table_join();
            $this->task = $old_task;

            $db = Database::get_instance($this->connection, $this->ci);
            $db->query("SELECT {$select}\r\n FROM `{$this->table}`\r\n {$table_join}\r\n {$where}\r\n LIMIT 1");
            $result_row = (array) $db->row();

            foreach ($set as $k => $f) {
                $f = explode(' = ', str_replace(array(
                    '`',
                    "'"
                ), array(
                    '',
                    ''
                ), $f));
                if ($f[1] == "NULL")
                    $f[1] = null;
                $s[$f[0]] = $f[1];
            }
            $set = $s;

            foreach ($this->record_changes as $key => $fdata) {
                if ($this->field_type[$key] == "image")
                    continue;
                $val = $result_row[$key];
                if ($this->field_type[$key] == "datetime") {
                    if ((! is_null($val) && $val != ''))
                        $val = date('d/m/Y H:i', strtotime($val));
                    if ((! is_null($set[$key]) && $set[$key] != ''))
                        $set[$key] = date('d/m/Y H:i', strtotime($set[$key]));
                }
                if ($this->field_type[$key] == "date") {
                    if ((! is_null($val) && $val != ''))
                        $val = date('d/m/Y', strtotime($val));
                    if ((! is_null($set[$key]) && $set[$key] != ''))
                        $set[$key] = date('d/m/Y', strtotime($set[$key]));
                }
                if (array_key_exists($key, $set) && $set[$key] != $val) {
                    if (array_key_exists($key, $this->relation)) {
                        $val = $this->create_view_relation($key, $val);
                        $set[$key] = $this->create_view_relation($key, $set[$key]);
                    }
                    if ($this->labels[$key] == "")
                        $this->labels[$key] = $key;
                    $changes[$this->labels[$key]] = "<span class='change-label'>" . $this->labels[$key] . "</span> <br/><span class='change-label'>De:</span> <span class='change-data'>" . $val . "</span><br/><span class='change-label'>Para:</span> <span class='change-data'>" . $set[$key] . "</span>";
                }
            }
            // var_dump($this->result_row);
            // var_dump($changes);
            if (sizeof($changes)) {
                $this->ci->usuarios_model->registraAlteracao($this->table, $this->primary_val, implode(PHP_EOL . PHP_EOL, $changes));
            }
        }
    }

    public function strip_tags($bool = true)
    {
        $this->strip_tags = $bool;
    }

    protected function relation_search($name, $dependval)
    {
        if (! isset($this->relation[$name])) {
            return 'Restricted.';
        }
        $db = Database::get_instance($this->connection, $this->ci);
        $where_arr = array();
        $where_arr[] = $this->relation[$name]['rel_name'] . ' LIKE "%' . $_POST['q'] . '%"';
        if ($this->relation[$name]['rel_where']) {
            if (is_array($this->relation[$name]['rel_where'])) {
                foreach ($this->relation[$name]['rel_where'] as $field => $val) {
                    $val = $this->replace_text_variables($val, $this->result_row);
                    $fdata = $this->_parse_field_names($field, 'create_relation', $this->relation[$name]['rel_tbl']);
                    $fitem = reset($fdata);
                    $where_arr[] = $this->_where_field($fitem) . $this->_cond_from_where($field) . $db->escape($val);
                }
            } else {
                $where_arr[] = $this->replace_text_variables($this->relation[$name]['rel_where'], $this->result_row);
            }
        }
        if ($dependval !== false) {
            if (is_array($dependval)) {
                foreach ($dependval as $k => $v) {
                    $dependval[$k] = $db->escape($v);
                }
                $where_arr[] = $this->_field_from_where($this->relation[$name]['depend_field']) . ' IN (' . implode(',', $dependval) . ')';
            } else {
                $where_arr[] = $this->_field_from_where($this->relation[$name]['depend_field']) . $this->_cond_from_where($this->relation[$name]['depend_field']) . $db->escape($dependval);
            }
        }

        if ($where_arr)
            $where = 'WHERE ' . implode(' AND ', $where_arr);
        else
            $where = '';
        if (is_array($this->relation[$name]['rel_name'])) {
            $name_select = 'CONCAT_WS(' . $db->escape($this->relation[$name]['rel_separator']) . ',`' . implode('`,`', $this->relation[$name]['rel_name']) . '`) AS `name`';
        } else {
            $name_select = '`' . $this->relation[$name]['rel_name'] . '` AS `name`';
        }
        $db->query('SELECT `' . $this->relation[$name]['rel_field'] . '` AS `field`,' . $name_select . $this->get_relation_tree_fields($this->relation[$name]) . ' FROM `' . $this->relation[$name]['rel_tbl'] . '` ' . $where . ' GROUP BY `field` ORDER BY ' . $this->get_relation_ordering($this->relation[$name]) . ' LIMIT ' . XcrudConfig::$relation_ajax);
        $options = $this->resort_relation_opts($db->result(), $this->relation[$name]);

        $results['items'] = array();
        if ($options) {
            foreach ($options as $opt) {
                $results['items'][] = array(
                    'id' => $opt['field'],
                    'text' => $opt['name']
                );
            }
        }
        echo json_encode($results);
        unset($options);
    }

    public function custom_lists($static = false, $default = false)
    {
        $this->custom_lists = true;
        $this->custom_lists_static = $static;
        $this->custom_filter_active['title'] = $default;
        return $this;
    }

    public function unset_custom_columns($fields)
    {
        if ($fields !== false) {
            $fdata = $this->_parse_field_names($fields, 'custom_lists');
            foreach ($fdata as $fitem) {
                $f[] = $fitem['table'] . '.' . $fitem['field'];
            }
        }
        $this->unset_custom_columns = $f;
    }

    private function set_custom_lists()
    {
        return true;
        $db = Database::get_instance($this->connection, $this->ci);
        $db->query('SELECT * FROM core_listagensPersonalizadas WHERE lpe_entidade = "' . (($this->table != "contatos" ? $this->table : $this->table_name)) . '" AND (' . (($_SESSION['usr_id']) ? 'lpe_usuario = ' . $_SESSION['usr_id'] . ' OR ' : '') . 'lpe_usuario IS NULL)');

        if (in_array($this->custom_filter_active['title'], array_keys($this->custom_lists_static))) {
            $this->columns($this->columns_default);
        }
        foreach ($db->result() as $list) {
            if ($this->custom_filter_active['title'] == $list['lpe_nome']) {
                $this->custom_lists_active = $list;
                unset($colunas);
                if ($list['lpe_colunas'] != "") {
                    $colunas = json_decode($list['lpe_colunas'], true);
                    if (count($colunas))
                        $this->columns(implode(',', $colunas), false, false);
                    else
                        $this->columns($this->columns_default);
                } else
                    $this->columns($this->columns_default);
            }
            $where = array();
            foreach (json_decode($list['lpe_filtros'], true) as $field => $c) {
                $w = '';
                if ($c[0] == "=")
                    $w .= ' ' . $c[0] . ' "' . $c[1] . '"';
                else if ($c[0] == "maior")
                    $w .= ' > "' . $c[1] . '"';
                else if ($c[0] == "menor")
                    $w .= ' < "' . $c[1] . '"';
                else if ($c[0] == "maior_i")
                    $w .= ' >= "' . $c[1] . '"';
                else if ($c[0] == "menor_i")
                    $w .= ' <= "' . $c[1] . '"';
                else if (in_array($c[0], array(
                    'IS NULL'
                )))
                    $w .= ' (' . $c[0] . ' OR ' . $c[0] . ' = "")';
                else if (in_array($c[0], array(
                    'IS NOT NULL'
                )))
                    $w .= ' (' . $c[0] . ' OR ' . $c[0] . ' <> "")';
                else if (in_array($c[0], array(
                    'LIKE',
                    'NOT LIKE'
                )))
                    $w .= ' ' . $c[0] . ' "%' . $c[1] . '%"';
                else if (in_array($c[0], array(
                    'IN',
                    'NOT IN'
                )))
                    $w .= ' ' . $c[0] . ' ("' . implode('","', explode(',', $c[1])) . '")';
                if ($w != "")
                    $where[] = $field . $w;
            }
            foreach (json_decode($list['lpe_filtrosAdicionais'], true) as $filtro => $value) {
                $w = '';
                if ($filtro == 'propostaProduto')
                    $w .= '"' . $value . '" IN (SELECT fk_pro_id FROM propostas_itens WHERE fk_prp_id = prp_id)';
                if ($w != "")
                    $where[] = $w;
            }
            $where = implode(' AND ', $where);
            if ($where == "")
                $where = "1 = 1";
            $filtro_titulo[$list['lpe_nome']] = $where;
            $line = true;
        }
        $this->custom_lists_temp = $filtro_titulo;
        foreach ($this->custom_lists_static as $label => $where)
            $filtro_titulo[$label] = $where;
        // var_dump($filtro_titulo);
        $this->custom_filter('title', $filtro_titulo, $this->custom_filter_active['title']);
    }

    public function render_title($mode = 'list', $tag = 'h2', $to_show = false, $icon = false, $replace_title = false)
    {
        $out = '';
        if ($this->is_title) {
            if ($replace_title)
                $title = $replace_title;
            else
                $title = $this->table_name;

            if ($this->custom_lists) {
                unset($all_fields);
                foreach ($this->field_type as $field => $type) {
                    if (! in_array($field, $this->unset_custom_columns)) {
                        $lbl = ($this->labels[$field] != "") ? str_replace("*", "", $this->labels[$field]) : $field;
                        $tbl = explode('.', $field);
                        if (in_array($tbl[0], array_keys($this->join)) && strpos($tbl[0], '_ext') === false) {
                            $lbl = " - " . $lbl;
                            $lbl = (($this->labels[$this->join[$tbl[0]]['table'] . '.' . $this->join[$tbl[0]]['field']] != "") ? str_replace("*", "", $this->labels[$this->join[$tbl[0]]['table'] . '.' . $this->join[$tbl[0]]['field']]) : $field) . $lbl;
                        } else {
                            $lbl = $this->table_name . " - " . $lbl;
                        }
                        $all_fields[$field] = $lbl;
                    }
                }
                asort($all_fields);
                $fdata = $this->_parse_field_names($this->columns_default, 'columns');
                foreach ($fdata as $fitem) {
                    $fields_default[] = $fitem['table'] . '.' . $fitem['field'];
                }
                $modals['customLists']['name'] = 'Nova Listagem Personalizada';
                $modals['customLists']['id'] = '';
                $modals['customLists']['cols'] = $fields_default;
                $modals['customLists']['filtros'];

                if (count($this->custom_lists_active)) {
                    $modals['customListsEdit']['name'] = $this->custom_lists_active['lpe_nome'];
                    $modals['customListsEdit']['id'] = $this->custom_lists_active['lpe_id'];
                    $modals['customListsEdit']['cols'] = json_decode($this->custom_lists_active['lpe_colunas'], true);
                    $modals['customListsEdit']['filtros'] = json_decode($this->custom_lists_active['lpe_filtros'], true);
                    $modals['customListsEdit']['filtrosAdicionais'] = json_decode($this->custom_lists_active['lpe_filtrosAdicionais'], true);
                }

                $options['0'] = 'N�o Filtrar';
                $options['='] = 'Igual a';
                $options['maior'] = 'Maior que';
                $options['menor'] = 'Menor que';
                $options['maior_i'] = 'Maior ou igual a';
                $options['menor_i'] = 'Menor ou igual a';
                $options['LIKE'] = 'Cont�m';
                $options['NOT LIKE'] = 'N�o cont�m';
                $options['IN'] = 'Est� entre';
                $options['NOT IN'] = 'N�o est� entre';
                $options['IS NULL'] = '� vazio ou nulo';
                $options['IS NOT NULL'] = 'N�o � vazio ou nulo';

                $db = Database::get_instance($this->connection, $this->ci);
                if ($this->table == "propostas") {
                    $db->query('SELECT * FROM core_produtos WHERE pro_ativo = 1 ORDER BY pro_nome ASC');
                    foreach ($db->result() as $pro) {
                        $produtos[$pro['pro_id']] = $pro['pro_nome'];
                    }
                }

                foreach ($modals as $tag_id => $cfg) {
                    $out .= $this->open_tag('div', 'modal fade', array(
                        'tabindex' => '-1',
                        'role' => 'dialog',
                        'aria-hidden' => 'true',
                        'id' => $tag_id
                    ));
                    $out .= $this->open_tag('div', 'modal-dialog modal-lg');
                    $out .= $this->open_tag('div', 'modal-content');
                    $out .= $this->open_tag('div', 'modal-header');
                    $out .= $this->open_tag('h4', 'modal-title');
                    $out .= $this->open_tag('i', $icon);
                    $out .= $this->close_tag('i');
                    $out .= "&nbsp;" . $this->table_name . "&nbsp;";
                    $out .= $this->open_tag('small') . $cfg['name'] . $this->close_tag('small') . "&nbsp;";
                    $out .= $this->close_tag('h4');
                    $out .= $this->close_tag('div');
                    $out .= $this->open_tag('div', 'modal-body');

                    $out .= $this->open_tag('div', '', array(
                        'id' => 'head-name'
                    ));
                    $out .= $this->open_tag('label') . 'Nome da Listagem' . $this->close_tag('label');
                    $out .= $this->open_tag('input', '', array(
                        'type' => 'hidden',
                        'id' => 'lpe_id',
                        'value' => $cfg['id']
                    ));
                    $out .= $this->open_tag('input', '', array(
                        'type' => 'hidden',
                        'id' => 'lpe_nome_original',
                        'value' => $cfg['name']
                    ));
                    $out .= $this->open_tag('input', '', array(
                        'type' => 'hidden',
                        'id' => 'lpe_entidade',
                        'value' => ($this->table != "contatos" ? $this->table : $this->table_name)
                    ));
                    $out .= $this->open_tag('input', 'form-control', array(
                        'type' => 'text',
                        'id' => 'name',
                        'value' => ($cfg['id'] != "") ? $cfg['name'] : ''
                    ));
                    $out .= $this->close_tag('div');
                    $out .= $this->open_tag('div', 'tabbable tabbable-custom');
                    $out .= $this->open_tag('ul', 'nav nav-tabs');
                    $out .= $this->open_tag('li', 'active') . $this->open_tag('a', '', array(
                        'data-toggle' => 'tab',
                        'href' => '#filtros_' . $tag_id
                    )) . 'Filtros' . $this->close_tag('a') . $this->close_tag('li');
                    if ($this->table == "propostas")
                        $out .= $this->open_tag('li', '') . $this->open_tag('a', '', array(
                            'data-toggle' => 'tab',
                            'href' => '#filtrosAdicionais_' . $tag_id
                        )) . 'Filtros Adicionais' . $this->close_tag('a') . $this->close_tag('li');
                    $out .= $this->open_tag('li', '') . $this->open_tag('a', '', array(
                        'data-toggle' => 'tab',
                        'href' => '#colunas_' . $tag_id
                    )) . 'Colunas' . $this->close_tag('a') . $this->close_tag('li');
                    $out .= $this->close_tag('ul');

                    $out .= $this->open_tag('div', 'tab-content');
                    $out .= $this->open_tag('div', 'tab-pane active', array(
                        'id' => 'filtros_' . $tag_id
                    ));
                    foreach ($all_fields as $field => $lbl) {
                        if (! in_array($field, array_keys($this->subselect))) {
                            $type = $this->field_type[$field];
                            if ($type == "textarea" || $type == "texteditor")
                                $type = "text";

                            $out .= $this->open_tag('div', 'row next-row form-horizontal col-md-6 pull-left filtrosFields', array(
                                'id' => $field,
                                'style' => 'margin-right: 15px; position: relative; margin-top: 25px;'
                            ));
                            $out .= $this->open_tag('label', 'col-md-12 pull-left') . $lbl . $this->close_tag('label');
                            $out .= $this->open_tag('div', 'col-md-12');
                            $out .= $this->open_tag('div', 'col-md-5 pull-left', array(
                                'style' => 'padding: 0px'
                            ));
                            $out .= $this->open_tag('select', 'form-control f');
                            foreach ($options as $value => $lbl) {
                                unset($atr);
                                $atr['value'] = $value;
                                if ($cfg['id'] != "" && isset($cfg['filtros'][$field]) && $cfg['filtros'][$field][0] == $value)
                                    $atr['selected'] = $value;
                                $out .= $this->open_tag('option', '', $atr) . $lbl . $this->close_tag('option');
                            }
                            $out .= $this->close_tag('select');
                            $out .= $this->close_tag('div');
                            $out .= $this->open_tag('div', 'col-md-7 pull-right inp', array(
                                'style' => 'padding: 0px'
                            ));
                            $func = 'create_' . $type;
                            unset($attr);
                            $attr['class'] = "col-md-8 pull-left xcrud-input";
                            $attr['multiple'] = "multiple";

                            $null_opt = $this->lists_null_opt;
                            $this->lists_null_opt = false;
                            if ($type == 'relation')
                                $val = explode(',', $cfg['filtros'][$field][1]);
                            else
                                $val = $cfg['filtros'][$field][1];
                            if (method_exists($this, $func))
                                $field = call_user_func_array(array(
                                    $this,
                                    $func
                                ), array(
                                    $field,
                                    $val,
                                    $attr
                                ));
                            else
                                $field = "";
                            $this->lists_null_opt = $null_opt;
                            $out .= $field;
                            $out .= $this->close_tag('div');
                            $out .= $this->open_tag('div', 'clearfix') . $this->close_tag('div');
                            $out .= $this->close_tag('div');
                            $out .= $this->close_tag('div');
                        }
                    }
                    $out .= $this->open_tag('div', 'clearfix') . $this->close_tag('div');
                    $out .= $this->close_tag('div');

                    if ($this->table == "propostas") {
                        $out .= $this->open_tag('div', 'tab-pane ', array(
                            'id' => 'filtrosAdicionais_' . $tag_id
                        ));
                        $out .= $this->open_tag('div', 'row next-row form-horizontal col-md-12');
                        $out .= $this->open_tag('label') . 'Propostas que possuam o produto abaixo entre os itens' . $this->close_tag('label');
                        $out .= $this->open_tag('select', 'form-control filtroAd', array(
                            'id' => 'propostaProduto'
                        ));
                        $out .= $this->open_tag('option', '', array(
                            'value' => 0
                        )) . 'Selecione' . $this->close_tag('option');
                        foreach ($produtos as $value => $lbl) {
                            unset($atr);
                            $atr['value'] = $value;
                            if ($cfg['id'] != "" && isset($cfg['filtrosAdicionais']['propostaProduto']) && $value == $cfg['filtrosAdicionais']['propostaProduto'])
                                $atr['selected'] = $value;
                            $out .= $this->open_tag('option', '', $atr) . $lbl . $this->close_tag('option');
                        }
                        $out .= $this->close_tag('select');
                        $out .= $this->close_tag('div');
                        $out .= $this->close_tag('div');
                    }

                    $out .= $this->open_tag('div', 'tab-pane', array(
                        'id' => 'colunas_' . $tag_id
                    ));

                    $out .= $this->open_tag('div', 'col-md-6 dd', array(
                        'id' => 'nestable_list_1'
                    ));
                    $out .= $this->open_tag('h3') . 'Colunas Dispon�veis' . $this->close_tag('h3');
                    $out .= $this->open_tag('ol', 'dd-list');
                    foreach ($all_fields as $field => $lbl) {
                        if (! in_array($field, $cfg['cols'])) {
                            $out .= $this->open_tag('li', 'dd-item', array(
                                'data-id' => $field
                            ));
                            $out .= $this->open_tag('div', 'dd-handle');
                            $out .= $lbl;
                            $out .= $this->close_tag('div');
                        }
                    }
                    $out .= $this->close_tag('ol');
                    $out .= $this->close_tag('div');
                    $out .= $this->open_tag('div', 'col-md-6 dd', array(
                        'id' => 'nestable_list_2'
                    ));
                    $out .= $this->open_tag('h3') . 'Colunas Selecionadas' . $this->close_tag('h3');
                    $out .= $this->open_tag('input', '', array(
                        'type' => 'hidden',
                        'id' => 'cols'
                    ));
                    $out .= $this->open_tag('ol', 'dd-list');
                    foreach ($cfg['cols'] as $field) {
                        if (! in_array($field, $this->unset_custom_columns)) {
                            $out .= $this->open_tag('li', 'dd-item', array(
                                'data-id' => $field
                            ));
                            $out .= $this->open_tag('div', 'dd-handle');
                            $out .= $all_fields[$field];
                            $out .= $this->close_tag('div');
                            $out .= $this->close_tag('li');
                        }
                    }
                    $out .= $this->close_tag('ol');
                    $out .= $this->close_tag('div');

                    $out .= $this->close_tag('div');

                    $out .= $this->close_tag('div');
                    $out .= $this->close_tag('div');
                    $out .= $this->close_tag('div');

                    $out .= $this->open_tag('div', 'modal-footer');
                    $out .= $this->open_tag('button', 'btn btn-default', array(
                        'type' => 'button',
                        'data-dismiss' => 'modal',
                        'aria-hidden' => 'true'
                    )) . $this->lang('Cancelar') . $this->close_tag('button');
                    if ($cfg['id'] != "")
                        $out .= $this->open_tag('button', 'btn btn-danger remove', array(
                            'type' => 'button'
                        )) . $this->lang('remove') . $this->close_tag('button');
                    $out .= $this->open_tag('button', 'btn btn-primary save', array(
                        'type' => 'button'
                    )) . $this->lang('save') . $this->close_tag('button');
                    $out .= $this->close_tag('div');
                    $out .= $this->close_tag('div');
                    $out .= $this->close_tag('div');
                    $out .= $this->close_tag('div');
                }

                $out .= $this->open_tag('a', 'dropdown-toggle', array(
                    'data-toggle' => 'dropdown'
                ));
                $out .= $this->open_tag($tag);
                $out .= $this->open_tag('span');
                $out .= $this->open_tag('i', $icon);
                $out .= $this->close_tag('i');
                $out .= "&nbsp;" . $this->table_name . "&nbsp;";
                if ($this->custom_filter_active['title'] != "") {
                    $out .= $this->open_tag('small');
                    $out .= $this->custom_filter_active['title'] != 'all' ? $this->custom_filter_active['title'] : "";
                    $out .= $this->close_tag('small') . "&nbsp;";
                }
                $out .= $this->open_tag('i', 'fas fa-chevron-down');
                $out .= $this->close_tag('i');
                $out .= $this->close_tag('span');
                $out .= $this->close_tag($tag);
                $out .= $this->close_tag('a');
                $out .= $this->open_tag('ul', 'dropdown-menu');

                if ($this->custom_lists_static) {
                    foreach ($this->custom_lists_static as $label => $where) {
                        $filtro_titulo[$label] = $where;
                        $out .= $this->open_tag('li');
                        $out .= $this->open_tag('a', 'xcrud-action custom_list', array(
                            'data-filter' => 'title',
                            'data-label' => $label,
                            'data-preferencia' => 'custom_list_' . (($this->table != "contatos" ? $this->table : $this->table_name)),
                            'href' => '#'
                        ));
                        $out .= $this->open_tag('i', 'fas fa-list-alt fa-fw');
                        $out .= $this->close_tag('i');
                        $out .= $label . $this->close_tag('a');
                        $out .= $this->close_tag('li');
                    }
                } else {
                    $filtro_titulo[$this->lang('default_list')] = '1=1';
                    $out .= $this->open_tag('li');
                    $out .= $this->open_tag('a');
                    $out .= $this->open_tag('i', 'fas fa-list-alt fa-fw');
                    $out .= $this->close_tag('i');
                    $out .= $this->lang('default_list') . $this->close_tag('a');
                    $out .= $this->close_tag('li');
                }

                $out .= $this->open_tag('li', 'divider') . $this->close_tag('li');
                foreach ($this->custom_lists_temp as $label => $where) {
                    $line = true;
                    $filtro_titulo[$label] = $where;
                    $out .= $this->open_tag('li');
                    $out .= $this->open_tag('a', 'xcrud-action custom_list', array(
                        'data-filter' => 'title',
                        'data-label' => $label,
                        'data-preferencia' => 'custom_list_' . (($this->table != "contatos" ? $this->table : $this->table_name)),
                        'href' => '#'
                    ));
                    $out .= $this->open_tag('i', 'fas fa-filter fa-fw');
                    $out .= $this->close_tag('i');
                    $out .= $label . $this->close_tag('a');

                    if ($label == $this->custom_filter_active['title']) {
                        $out .= $this->open_tag('i', 'btn btn-xs btn-default fas fa-pencil-alt edit', array(
                            'data-toggle' => 'modal',
                            'data-target' => '#customListsEdit'
                        ));
                        $out .= $this->close_tag('i');
                    }

                    $out .= $this->close_tag('li');
                }
                $this->custom_filter('title', $filtro_titulo, ($this->custom_filter_active['title'] != "") ? $this->custom_filter_active['title'] : $default_list, true);

                if ($line)
                    $out .= $this->open_tag('li', 'divider') . $this->close_tag('li');
                $out .= $this->open_tag('li');
                $out .= $this->open_tag('a', '', array(
                    'data-toggle' => 'modal',
                    'href' => '#customLists'
                ));
                $out .= $this->open_tag('i', 'fas fa-plus fa-fw');
                $out .= $this->close_tag('i');
                $out .= $this->lang('add_custom_list') . $this->close_tag('a');
                $out .= $this->close_tag('li');
                $out .= $this->close_tag('ul');
            } else {
                $out = $this->render_table_name($mode, $tag, $to_show, $icon, $replace_title);
            }
            return $out;

            $attr = array();
            if ($to_show && ! $this->start_minimized)
                $attr['style'] = 'display:none;';
            if ($to_show)
                $attr['class'] = 'xcrud-main-tab';
            $attr['data-toggle'] = 'modal';
            $attr['data-target'] = '#customLists';
            $out .= $this->open_tag($tag, '', $attr);
            switch ($mode) {
                case 'create':
                    $out .= $this->is_rtl ? '<small>' . $this->lang('add') . ' - </small>' . $title . (($icon) ? '&nbsp;<i class="' . $icon . '"></i>' : '') : (($icon) ? '<i class="' . $icon . '"></i>&nbsp;' : '') . $title . '<small> - ' . $this->lang('add') . '</small>';
                    break;
                case 'edit':
                    $out .= $this->is_rtl ? '<small>' . $this->lang('edit') . ' - </small>' . $title . (($icon) ? '&nbsp;<i class="' . $icon . '"></i>' : '') : (($icon) ? '<i class="' . $icon . '"></i>&nbsp;' : '') . $title . '<small> - ' . $this->lang('edit') . '</small>';
                    break;
                case 'view':
                    $out .= $this->is_rtl ? '<small>' . $this->lang('view') . ' - </small>' . $title . (($icon) ? '&nbsp;<i class="' . $icon . '"></i>' : '') : (($icon) ? '<i class="' . $icon . '"></i>&nbsp;' : '') . $title . '<small> - ' . $this->lang('view') . '</small>';
                    break;
                default:
                    $out .= $this->is_rtl ? '<small>' . $this->get_table_tooltip() . '</small>' . $title . (($icon) ? '&nbsp;<i class="' . $icon . '"></i>' : '') : (($icon) ? '<i class="' . $icon . '"></i>&nbsp;' : '') . $title . '<small>' . $this->get_table_tooltip() . '</small>';
                    break;
            }
            if (XcrudConfig::$can_minimize) {
                if ($to_show)
                    $out .= '<span class="xcrud-toggle-show xcrud-toggle-down"><i class="' . $this->theme_config('slide_down_icon') . '"></i></span>';

                else
                    $out .= '<span class="xcrud-toggle-show xcrud-toggle-up"><i class="' . $this->theme_config('slide_up_icon') . '"></i></span>';
            }
            $out .= $this->close_tag($tag);
        }
        return $out;
    }
    
    public function mass_remove(bool $bool = true)
    {
        if ($bool) {
            $this->mass_actions['delete'] = $bool;
        } else {
            unset($this->mass_actions['delete']);
        }
        return $this;
    }
    
    public function mass_merge(string|bool $callable, string $path)
    {
        if ($callable) {
            $this->mass_actions['merge'] = [
                'callable' => $callable,
                'path' => "/../../helpers/" . $path
            ];
        } else {
            unset($this->mass_actions['merge']);
        }
        return $this;
    }
    
    public function mass_edit(array|string|bool $fields)
    {
        if (! is_bool($fields)) {
            $fdata = $this->_parse_field_names($fields, 'mass_edit');
            foreach ($fdata as $fitem) {
                $this->mass_actions['edit'][$fitem['table'] . '.' . $fitem['field']] = $fitem;
            }
        } else if (! $fields) {
            unset($this->mass_actions['edit']);
        }
        return $this;
    }
    
    
    public function render_mass_actions()
    {
        if (count($this->mass_actions)) {
            $out = $this->open_tag('div', $this->theme_config('mass_container_class'));
            $out .= $this->open_tag('select', 'xcrud-mass-select not_select2 not_select2 xcrud-data ' . $this->theme_config('mass_select'), array(
                'name' => 'mass_task'
            ));
            $out .= $this->open_tag('option', '', array(
                'value' => 0
            )) . $this->lang('mass_action') . $this->close_tag('option');
            if (array_key_exists('edit',$this->mass_actions)) {
                $out .= $this->open_tag('option', '', array(
                    'value' => 'edit'
                )) . $this->lang('mass_edit') . $this->close_tag('option');
            }
            if (array_key_exists('merge',$this->mass_actions)) {
                $out .= $this->open_tag('option', '', array(
                    'value' => 'merge'
                )) . $this->lang('mass_merge') . $this->close_tag('option');
            }
            if (array_key_exists('remove',$this->mass_actions)) {
                $out .= $this->open_tag('option', '', array(
                    'value' => 'remove'
                )) . $this->lang('mass_remove') . $this->close_tag('option');
            }
            $out .= $this->close_tag('select');
            $out .= $this->open_tag('a', 'xcrud-action ' . $this->theme_config('mass_button'), array(
                'data-task' => 'mass',
                'href' => 'javascript:;',
                'data-after' => 'list',
                'data-confirm' => $this->lang('mass_apply_confirm')
            )) . $this->lang('mass_apply') . $this->close_tag('a');
            $out .= $this->close_tag('div');
            return $out;
        }
    }

    public function render_mass_edit_form($container = 'table', $row = 'tr', $label = 'td', $field = 'td', $tabs_block = 'div', $tabs_head = 'ul', $tabs_row = 'li', $tabs_link = 'a', $tabs_content = 'div', $tabs_pane = 'div')
    {
        $out = "";
        if (count($this->mass_actions)) {
            $out .= $this->open_tag('div', 'xcrud-mass-form ' . $this->theme_config('mass_form_container'));
            foreach ($this->mass_edit as $field => $fitem) {
                $type = $this->field_type[$field];
                $lbl = $this->labels[$field];
                if ($type == "textarea" || $type == "texteditor") {
                    $type = "text";
                }
                $out .= $this->open_tag('div', 'xcrud-mass-form-group ' . $this->theme_config('mass_form_field_group'), array(
                    'id' => $field
                ));
                $out .= $this->open_tag('label', $this->theme_config('mass_form_label'), array(
                    'for' => $field
                )) . $lbl . $this->close_tag('label');
                $func = 'create_' . $type;
                if (method_exists($this, $func))
                    $field = call_user_func_array(array(
                        $this,
                        $func
                    ), array(
                        $field,
                        null,
                        [
                            'class' => 'xcrud-input ' . $this->theme_config('mass_form_field')
                        ]
                    ));

                $out .= $field;
                $out .= $this->close_tag('div');
            }
            $out .= $this->close_tag('div');
            return $out;
        }
    }

    public function _mass_action()
    {
        if ($this->table_ro)
            return self::error('Forbidden');
            
            $this->set_custom_lists();
            $this->_set_field_types('list');
            $this->_list(false);
            if ($this->_post('mass_task') == 'edit') {
                $postdata = $this->_post('postdata');
                $postdata = $this->check_postdata($postdata, true);
                $pd = new Xcrud_postdata($postdata, $this);
                $postdata = $pd->to_array();
                $this->validate_postdata($postdata);
                if ($this->exception) {
                    return $this->call_exception($postdata);
                }
                
                $this->_set_field_types('edit', true);
                if ($this->before_update) {
                    $path = $this->check_file($this->before_update['path'], 'before_update');
                    include_once ($path);
                    if (is_callable($this->before_update['callable'])) {
                        call_user_func_array($this->before_update['callable'], array(
                            $pd,
                            $this->_post('mass_list', array()),
                            $this
                        ));
                        $postdata = $pd->to_array();
                        
                        if ($this->exception) {
                            return $this->call_exception($postdata);
                        }
                    }
                }
                foreach ($this->result_list as $key => $row) {
                    if (in_array($row['primary_key'], $this->_post('mass_list', array())) && $this->is_edit($row)) {
                        $this->_update($postdata, $row['primary_key']);
                    }
                }
                unset($postdata);
            } else if ($this->_post('mass_task') == 'merge' && isset($this->mass_actions['merge'])) {
                $this->_set_field_types('edit', true);
                $path = $this->check_file($this->mass_actions['merge']['path'], 'merge');
                include_once ($path);
                if (is_callable($this->mass_actions['merge']['callable'])) {
                    call_user_func_array($this->mass_actions['merge']['callable'], array(
                        $this->_post('mass_list', array()),
                        $this
                    ));
                    if ($this->exception) {
                        return $this->call_exception($postdata);
                    }
                }
            } else if ($this->_post('mass_task') == 'delete') {
                foreach ($this->result_list as $key => $row) {
                    if (in_array($row['primary_key'], $this->_post('mass_list', array())) && $this->is_remove($row)) {
                        if ($this->replace_remove) {
                            $path = $this->check_file($this->replace_remove['path'], 'replace_remove');
                            include_once ($path);
                            if (is_callable($this->replace_remove['callable'])) {
                                call_user_func_array($this->replace_remove['callable'], array(
                                    $this->_post('mass_list', array()),
                                    $this
                                ));
                            }
                        }
                    }
                }
            }
            $this->_set_field_types('list');
            $this->_list();
            return $this->_render_list();
    }

    function opened_tab($id = false)
    {
        $this->opened_tab = $id;
    }

    function nested_default_render($mode = 'list', $primary = false)
    {
        $this->nested_default_render = $mode;
        $this->nested_default_render_primary = $primary;
    }

    function join_relation($fields = '', $rel_tbl = '', $rel_field = '', $rel_name = '', $rel_where = array(), $order_by = false, $rel_concat_separator = ' ', $depend_field = '', $depend_on = '', $rel_additional_fields = false, $default_data_create = null, $default_data_edit = null, $tag_support = false)
    {
        $this->relation($fields, $rel_tbl, $rel_field, $rel_name, $rel_where, $order_by, false, $rel_concat_separator, false, $depend_field, $depend_on);
        $fdata = $this->_parse_field_names($fields, 'join_relation');

        $rel_additional_fields = $this->_parse_field_names($rel_additional_fields, 'join_relation', $rel_tbl);
        foreach ($this->_parse_field_names($rel_name, 'join_relation', $rel_tbl) as $f => $fd) {
            unset($rel_additional_fields[$f]);
        }
        foreach ($fdata as $fitem) {
            $this->join_relation[$fitem['table'] . '.' . $fitem['field']] = array(
                'rel_table' => $rel_tbl,
                'rel_additional_fields' => $rel_additional_fields,
                'default_data_create' => $default_data_create,
                'default_data_edit' => $default_data_edit,
                'tag_support' => $tag_support
            );
        }
        return $this;
    }

    function join_relation_data($field, $value)
    {
        if (! $field) {
            return;
        }
        if (array_key_exists($field, $this->relation) && array_key_exists($field, $this->join_relation)) {
            foreach ($this->join_relation[$field]['rel_additional_fields'] as $k => $v) {
                $select[] = $k . ' as "' . $k . '"';
            }
            $select = implode(',', $select);
            $db = Database::get_instance($this->connection, $this->ci);
            // echo 'SELECT ' . $select . ' FROM `' . $this->relation[$field]['rel_tbl'] . '` WHERE `' . $this->relation[$field]['rel_field'] . '` = "' . $value . '"';exit;
            $db->query('SELECT ' . $select . ' FROM `' . $this->relation[$field]['rel_tbl'] . '` WHERE `' . $this->relation[$field]['rel_field'] . '` = "' . $value . '"');
            $data = $db->row();
            $mode = 'create';
            foreach ($this->join_relation[$field]['rel_additional_fields'] as $fld => $fdata) {
                $func = 'create_' . $this->field_type[$fld];
                if (isset($this->field_callback[$fld]) && $mode != 'view') {
                    $path = $this->check_file($this->field_callback[$fld]['path'], 'field_callback');
                    include_once ($path);
                    if (is_callable($this->field_callback[$fld]['callback'])) {
                        $field_rendered = call_user_func_array($this->field_callback[$fld]['callback'], array(
                            $this->result_row[$fld],
                            $fld,
                            $mode,
                            $this->result_row,
                            $this
                        ));
                        if (! $field_rendered)
                            $field_rendered = call_user_func_array(array(
                                $this,
                                $func
                            ), array(
                                $fld,
                                $data[$fld],
                                $attr
                            ));
                        $return[$this->fieldname_encode($fld)] = $field_rendered;
                    }
                } else {
                    $attr = $this->get_field_attr($fld, $mode);
                    $attr['class'] .= ' jr_additional';
                    $attr['jr-parent'] = $this->fieldname_encode($field);
                    if (! method_exists($this, $func)) {
                        continue;
                    }
                    if ($this->field_type[$fld] == "relation" && $this->relation[$fld]['depend_on'] && isset($data[$this->relation[$fld]['depend_on']])) {
                        $return[$this->fieldname_encode($fld)] = call_user_func_array(array(
                            $this,
                            $func
                        ), array(
                            $fld,
                            $data[$fld],
                            $attr,
                            $data[$this->relation[$fld]['depend_on']]
                        ));
                    } else {
                        $return[$this->fieldname_encode($fld)] = call_user_func_array(array(
                            $this,
                            $func
                        ), array(
                            $fld,
                            $data[$fld],
                            $attr
                        ));
                    }
                }
            }
            print json_encode($return);
            exit();
        }
    }

    function join_relation_tag($postdata)
    {
        foreach ($this->join_relation as $key => $params) {
            if ($params['tag_support'] === true) {
                $val = $postdata[$key];
                $db = Database::get_instance($this->connection, $this->ci);
                $db->query('SELECT * FROM `' . $this->relation[$key]['rel_tbl'] . '` WHERE `' . $this->relation[$key]['rel_field'] . '` = "' . $val . '"');
                $row = $db->row();
                unset($set);
                if (is_array($this->join_relation[$key]['rel_additional_fields'])) {
                    foreach ($this->join_relation[$key]['rel_additional_fields'] as $k => $fdata) {
                        $set['`' . str_replace($this->relation[$key]['rel_tbl'] . '.', '', $k) . '`'] = $db->escape($postdata[$k]);
                    }
                }

                if (! count($row)) {
                    if (is_array($this->join_relation[$key]['default_data_create'])) {
                        foreach ($this->join_relation[$key]['default_data_create'] as $k => $v) {
                            $set['`' . $k . '`'] = $db->escape($v);
                        }
                    }
                    $set['`' . $this->relation[$key]['rel_name'] . '`'] = $db->escape($val);

                    // inserir o campo do depend_on
                    if ($this->relation[$key]['depend_on'] != "" && $this->relation[$key]['depend_field'] != "") {
                        $set['`' . $this->relation[$key]['depend_field'] . '`'] = $db->escape($postdata[$this->relation[$key]['depend_on']]);
                    }

                    $db->query('INSERT INTO `' . $this->relation[$key]['rel_tbl'] . '` (' . implode(',', array_keys($set)) . ') VALUES (' . implode(',', $set) . ')');
                    $postdata[$key] = $db->insert_id();
                } else {
                    if (is_array($this->join_relation[$key]['default_data_edit'])) {
                        foreach ($this->join_relation[$key]['default_data_edit'] as $k => $v) {
                            $set['`' . $k . '`'] = $db->escape($v);
                        }
                    }
                    unset($update);
                    foreach ($set as $k => $v) {
                        $update[] = $k . ' = ' . $v;
                    }
                    $db->query('UPDATE `' . $this->relation[$key]['rel_tbl'] . '` SET ' . implode(',', $update) . ' WHERE `' . $this->relation[$key]['rel_field'] . '` = ' . $row[$this->relation[$key]['rel_field']]);
                }
            }
            unset($set);
        }
        return $postdata;
    }

    public function parameter($name, $field, $operator = '=')
    {
        if (! in_array($operator, array(
            '=',
            'between',
            'IN',
            'FIND_IN_SET'
        ))) {
            return false;
        }
        $field = $this->_parse_field_names($field, 'parameter');
        foreach ($field as $fname => $fdata) {
            $this->parameters[$name] = array(
                'field' => $fname,
                'operator' => $operator
            );
            $this->fields_report[$fname] = $fdata;
            $this->fields_names[$fname] = $this->html_safe($name);
        }
        return $this;
    }

    protected function _report($postdata = array())
    {
        foreach ($this->parameters as $name => $attr) {
            if ($attr['operator'] == 'between') {
                $this->create_field($attr['field'] . '_to', $this->field_type[$attr['field']], null, array(
                    'data-rangestart' => $this->fieldname_encode($attr['field'])
                ));
                $this->field_attr[$attr['field']] = array(
                    'data-rangeend' => $this->fieldname_encode($attr['field'] . '_to')
                );
                $this->parameters[$attr['field'] . '_to'] = array(
                    'field' => $attr['field'] . '_to',
                    'operator' => '_to'
                );
                $this->fields_names[$attr['field'] . '_to'] = $attr['field'] . '_to';
            } elseif ($attr['operator'] == 'IN' && $this->field_type[$attr['field']] == 'relation') {
                $this->relation[$attr['field']]['multi'] = true;
            }
        }
        $this->lists_null_opt = false;
        return $this->_render_report();
    }

    protected function _render_report()
    {
        $mode = 'report';
        foreach ($this->parameters as $name => $attr) {
            $field = $attr['field'];
            $operator = $attr['operator'];

            if ($operator == 'between' && ! in_array($this->field_type[$field], array(
                'date',
                'datetime',
                'int'
            ))) {
                continue;
            }

            $func = 'create_' . $this->field_type[$field];

            if (isset($this->field_callback[$field])) {
                $path = $this->check_file($this->field_callback[$field]['path'], 'field_callback');
                include_once ($path);
                if (is_callable($this->field_callback[$field]['callback'])) {
                    $attr = $this->get_field_attr($field, 'create');
                    $field_default = call_user_func_array(array(
                        $this,
                        $func
                    ), array(
                        $field,
                        null,
                        $attr
                    ));
                    $field_rendered = call_user_func_array($this->field_callback[$field]['callback'], array(
                        null,
                        $field,
                        'create',
                        null,
                        $this,
                        $field_default
                    ));
                    if (! $field_rendered)
                        $field_rendered = call_user_func_array(array(
                            $this,
                            $func
                        ), array(
                            $field,
                            $this->result_row[$field],
                            $attr
                        ));
                    $this->fields_output[$field] = array(
                        'label' => $this->fields_names[$field],
                        'field' => $field_rendered,
                        'name' => $field
                    );
                }
            } else {
                $attr = $this->get_field_attr($field, 'create');
                if (! method_exists($this, $func))
                    continue;
                $this->fields_output[$field] = array(
                    'label' => $this->fields_names[$field],
                    'field' => call_user_func_array(array(
                        $this,
                        $func
                    ), array(
                        $field,
                        null,
                        $attr
                    )),
                    'name' => $field
                );
            }
        }

        $view_file = XcrudConfig::$themes_path . '/' . $this->theme . '/' . $this->load_view[$mode];
        $view_file = $this->check_file($view_file, 'render');
        ob_start();
        include ($view_file);
        $this->data = $this->render_search_hidden() . ob_get_contents();
        ob_end_clean();

        return $this->render_output();
    }

    private function _save_report_values()
    {
        $postdata = $this->_post('postdata');
        if (! $postdata)
            return;
        foreach ($postdata as $k => $v) {
            if (trim($postdata[$k]) == "") {
                unset($postdata[$k]);
            }
        }
        $postdata = $this->check_postdata($postdata, 0);
        foreach ($postdata as $field => $val) {
            $this->report_values[$field] = $val;
        }
    }

    public function search_lines($lines = 1)
    {
        $this->search_lines = (int) $lines;
    }
}

class Xcrud_postdata
{

    private $xcrud = null;

    private $postdata = array();

    public function __construct($postdata, $xcrud)
    {
        $this->xcrud = $xcrud;
        $this->postdata = $postdata;
        unset($postdata);
    }

    public function set($name, $value)
    {
        $fdata = $this->xcrud->_parse_field_names($name, 'Xcrud_postdata');
        foreach ($fdata as $key => $fitem) {
            $this->postdata[$key] = $value;
        }
        $this->xcrud->unlock_field($name);
        return $this;
    }

    public function del($name)
    {
        $fdata = $this->xcrud->_parse_field_names($name, 'Xcrud_postdata');
        foreach ($fdata as $key => $fitem) {
            unset($this->postdata[$key]);
        }
        return $this;
    }

    public function get($name)
    {
        $fdata = $this->xcrud->_parse_field_names($name, 'Xcrud_postdata');
        $fname = key($fdata) /*$fdata[0]['table'] . '.' . $fdata[0]['field']*/;
        $value = (isset($this->postdata[$fname]) ? $this->postdata[$fname] : false);
        return /* new Xcrud_postdata_item */
        ($value);
    }

    public function to_array()
    {
        return $this->postdata;
    }
}