<?php

if(isset($_REQUEST['action'])){
    if($_REQUEST['action'] == 'delete'){
        global $wpdb;
        $table_name = $wpdb->prefix . 'refer';
            if(is_array($_REQUEST['id']))
            {
                $ids = implode( ',', array_map( 'absint', $_REQUEST['id'] ) );
            }
            else
            {
                $ids = $_REQUEST['id'];
            }
        $wpdb->query( "DELETE FROM $table_name WHERE ID IN($ids)" );
        
    }
}


if(!class_exists('WP_List_Table')){
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class TT_Example_List_Table extends WP_List_Table {
    
 function __construct(){
        global $status, $page;
                
       
        parent::__construct( array(
            'singular'  => 'id',     
            'plural'    => 'ids',    
            'ajax'      => false     
        ) );
        
    }

    function column_default($item, $column_name){
        switch($column_name){
            case 'to_email':
            case 'to_name':
            case 'to_state':
            case 'from_name':
            case 'from_email':
            case 'from_state':
            case 'created_at':
                return $item[$column_name];
            default:
                return print_r($item,true); //Show the whole array for troubleshooting purposes
        }
    }

    function column_to_name($item){
        
        //Build row actions
        $actions = array(
            'edit'      => sprintf('<a href="?page=%s&action=%s&id=%s">Edit</a>','mkenny-admin-refer-list.php','edit',$item['ID']),
            'delete'    => sprintf('<a href="?page=%s&action=%s&id=%s">Delete</a>',$_REQUEST['page'],'delete',$item['id']),
        );
        
        //Return the title contents
        return sprintf('%1$s %3$s',
            /*$1%s*/ $item['to_name'],
            /*$2%s*/ $item['id'],
            /*$3%s*/ $this->row_actions($actions)
        );
    }
    
    function column_cb($item){
        return sprintf(
            '<input type="checkbox" name="%1$s[]" value="%2$s" />',
            /*$1%s*/ $this->_args['singular'],  //Let's simply repurpose the table's singular label ("movie")
            /*$2%s*/ $item['id']                //The value of the checkbox should be the record's id
        );
    }
  
    function get_columns(){
        $columns = array(
            'cb'        => '<input type="checkbox" />', //Render a checkbox instead of text
            'to_name'     => 'Name',
            'to_email'    => 'Email Address',
            'to_state'    => 'State',
            'from_name'    => 'Referral Name',
            'from_email'    => 'Email Address',
            'from_state'   => 'State',
            'created_at'  => 'Date'            
        );
        return $columns;
    }
   
    function get_sortable_columns() {
        $sortable_columns = array(
            'to_name'     => array('to_name',false),     
            'to_email'    => array('to_email',false),
            'to_state'    => array('to_state',false),
            'from_name'     => array('from_name',false),
            'from_email'     => array('from_email',false),
            'from_state'  => array('from_state',false),
            'created_at' => array('created_at',false)
        );
        return $sortable_columns;
    }
  
    function get_bulk_actions() {
        $actions = array(
            'delete'    => 'Delete'
        );
        return $actions;
    }
    
    function process_bulk_action() {
        
        //Detect when a bulk action is being triggered...
       
         if( 'delete'===$this->current_action() ) {
           ?><script>alert('Selected Items deleted');</script>
       <?php }
    }

    
    function prepare_items($search ='') {
        global $wpdb;        
        $per_page = 10;

        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->get_sortable_columns();
        
        $this->_column_headers = array($columns, $hidden, $sortable);
        $this->process_bulk_action();
        $table_name = $wpdb->prefix . 'refer';
	  
        if(!empty($search)){
            $data = $wpdb->get_results("SELECT *,id As ID FROM $table_name Where (from_name LIKE '%{$search}%' OR to_name LIKE '%{$search}%')",ARRAY_A);
        }
        else{
            $data = $wpdb->get_results("SELECT *,id As ID FROM $table_name",ARRAY_A);
        }      


        function usort_reorder($a,$b){
            $orderby = (!empty($_REQUEST['orderby'])) ? $_REQUEST['orderby'] : 'created_at'; //If no sort, default to title
            $order = (!empty($_REQUEST['order'])) ? $_REQUEST['order'] : 'desc'; //If no order, default to asc
            $result = strcmp($a[$orderby], $b[$orderby]); //Determine sort order
            return ($order==='asc') ? $result : -$result; //Send final sort direction to usort
        }
        usort($data, 'usort_reorder');
        
        
      
        $current_page = $this->get_pagenum();
        $total_items = count($data);
        $data = array_slice($data,(($current_page-1)*$per_page),$per_page);
        $this->items = $data;
        $this->set_pagination_args( array(
            'total_items' => $total_items,                  
            'per_page'    => $per_page,                    
            'total_pages' => ceil($total_items/$per_page)   
        ) );
    }
}
    $testListTable = new TT_Example_List_Table();
   
    if( isset($_GET['s']) ){
        $testListTable->prepare_items($_GET['s']);
    } else {
        $testListTable->prepare_items();
    }

  //  echo "<pre>";print_r($testListTable);die;  
?>
    <div class="wrap">        
        <div id="icon-users" class="icon32"><br/></div>
        <h2>Referal List</h2>
       <form id="movies-filter" method="get">
            <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
             <?php   $testListTable->search_box('search', 'search_id'); ?>
            <?php $testListTable->display() ?>
        </form>
        
    </div>