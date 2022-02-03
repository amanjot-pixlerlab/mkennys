 <?php


if(isset($_REQUEST['action'])){
	if($_REQUEST['action'] == 'delete'){
		global $wpdb;
        $table_name = $wpdb->prefix . 'notify';
			if(is_array($_REQUEST['movie']))
			{
				$ids = implode( ',', array_map( 'absint', $_REQUEST['movie'] ) );
			}
			else
			{
				$ids = $_REQUEST['movie'];
			}
		$wpdb->query( "DELETE FROM $table_name WHERE ID IN($ids)" );
		
	}
}


class TT_Exa_List_Table extends WP_List_Table {
 function __construct(){
        global $status, $page;
        parent::__construct( array(
            'singular'  => 'movie',     
            'plural'    => 'movies',    
            'ajax'      => false     
        ) );
        
    }
    function column_default($item, $column_name){
        switch($column_name){
            
            case 'name':
            case 'email':
            case 'phone':
                return $item[$column_name];
            default:
                return print_r($item,true); 
        }
    }

     function column_name($item){
        
        //Build row actions
        $actions = array(
            //'edit'      => sprintf('<a href="?page=%s&action=%s&movie=%s">Edit</a>','gift-admin-edit.php','edit',$item['ID']),
            'delete'    => sprintf('<a href="?page=%s&location='.$_GET['location'].'&action=%s&movie=%s">Delete</a>',$_REQUEST['page'],'delete',$item['ID']),
        );
        
        //Return the title contents
        return sprintf('%1$s <span style="color:silver"></span>%3$s',
            /*$1%s*/ $item['name'],
            /*$2%s*/ $item['ID'],
            /*$3%s*/ $this->row_actions($actions)
        );
    }

    function column_cb($item){
        return sprintf(
            '<input type="checkbox" name="%1$s[]" value="%2$s" />',
            $this->_args['singular'],  
            $item['ID']                
        );
    }

    function get_columns(){
        $columns = array(
            'cb'        => '<input type="checkbox" />', 
            'name'     => 'Name',
            'email'    => 'Email',
            'phone'    => 'Phone'
            
        );
        return $columns;
    }

     function get_sortable_columns() {
        $sortable_columns = array(
            'name'     => array('name',false),     
            'email'    => array('email',false),
            'phone'    => array('phone',false)
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
        
        $table_name = $wpdb->prefix . 'notify';
		
        if(!empty($search)){
            $data = $wpdb->get_results("SELECT *,id As ID FROM $table_name Where location = '".$_GET['location']."' And name LIKE '%$search%' ",ARRAY_A);
        }
        else{
            $data = $wpdb->get_results("SELECT *,id As ID FROM $table_name where location = '".$_GET['location']."' ",ARRAY_A);
        }


        function usort_reorder($a,$b){
            $orderby = (!empty($_REQUEST['orderby'])) ? $_REQUEST['orderby'] : 'location'; 
            $order = (!empty($_REQUEST['order'])) ? $_REQUEST['order'] : 'asc';
            $result = strcmp($a[$orderby], $b[$orderby]); 
            return ($order==='asc') ? $result : -$result; 
        }
        usort($data, 'usort_reorder');
        
        
       
        $current_page = $this->get_pagenum();
        $total_items = count($data);
        $data = array_slice($data,(($current_page-1)*$per_page),$per_page);
        $this->items = $data;
        $this->set_pagination_args( array(
            'total_items' => $total_items,                  //WE have to calculate the total number of items
            'per_page'    => $per_page,                     //WE have to determine how many items to show on a page
            'total_pages' => ceil($total_items/$per_page)   //WE have to calculate the total number of pages
        ) );
    }
}
    $testListTable = new TT_Exa_List_Table();

     if( isset($_GET['s']) ){
        $testListTable->prepare_items($_GET['s']);
     } else {
        $testListTable->prepare_items();
     }

  

  //  echo "<pre>";print_r($testListTable);die;
?>
    <div class="wrap">
        <div id="icon-users" class="icon32"><br/></div>
        <h2>Subscriber List</h2>
        <form id="movies-filter" method="get">
            <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
            <input type="hidden" name="location" value="<?php echo $_GET['location'] ?>" />
            <?php   $testListTable->search_box('search', 'search_id'); ?>
            <?php $testListTable->display() ?>
        </form>
    </div>
 
 