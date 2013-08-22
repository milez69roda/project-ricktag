<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AdminModel extends CI_Model {
 
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
   
	function card_save(){
			
		$id 		= @$this->input->post("id");
		$form_type 	= $this->input->post("form_type");
		
		$set["card_type"] 	= $this->input->post("card_type");
		$set["card_start"] 	= $this->input->post("card_start");
		$set["card_end"] 	= $this->input->post("card_end");
		$set["card_url"] 	= $this->input->post("card_url");			
		$set["card_value"] 	= $this->input->post("card_value");			
		$set["card_max_value"] 	= $this->input->post("card_max_value");			
		
		if( $form_type == "new"  )	{
			$set["dist_id"] = $this->input->post("dist_id");

			$this->db->insert("card_info", $set);			
			$id = $this->db->insert_id();
		}
		
		$this->load->library('upload');
		 
		$config['upload_path'] 		= './files/distributor/cards/';		 
		$config['allowed_types'] 	= 'gif|jpg|png';
		$config['max_size']			= '1000';
		$config['max_width']  		= '1024';
		$config['max_height']  		= '768';
		$config['overwrite']  		= TRUE; 
		
		if (!empty($_FILES['userfile_1']['name']))  {
 
			$ext 	= pathinfo($_FILES['userfile_1']['name'], PATHINFO_EXTENSION);
			$type 	= $this->input->post("type");
			 
			$config['file_name']  		= $id."_1.".$ext;
			$filename = "files/distributor/cards/".$config['file_name'];
			
			$this->upload->initialize($config); 
			if ($this->upload->do_upload('userfile_1')) {
				 
				$set["slider_image1"] = $filename;
						
			}
			else {
				echo $this->upload->display_errors();
			}
 
		}
		
		if (!empty($_FILES['userfile_2']['name']))  {
 
			$ext 	= pathinfo($_FILES['userfile_2']['name'], PATHINFO_EXTENSION);
			$type 	= $this->input->post("type");
			 
			$config['file_name']  		= $id."_2.".$ext;
			$filename = "files/distributor/cards/".$config['file_name'];
			
			$this->upload->initialize($config); 
			if ($this->upload->do_upload('userfile_2')) {
				 
				$set["slider_image2"] = $filename;
						
			}
			else {
				echo $this->upload->display_errors();
			}
 
		}

		if (!empty($_FILES['userfile_3']['name']))  {
 
			$ext 	= pathinfo($_FILES['userfile_3']['name'], PATHINFO_EXTENSION);
			$type 	= $this->input->post("type");
			 
			$config['file_name']  		= $id."_3.".$ext;
			$filename = "files/distributor/cards/".$config['file_name'];
			
			$this->upload->initialize($config); 
			if ($this->upload->do_upload('userfile_3')) {
				 
				$set["slider_image3"] = $filename;
							
			}
			else {
				echo $this->upload->display_errors();
			}
 
		}

		if (!empty($_FILES['userfile_4']['name']))  {
 
			$ext 	= pathinfo($_FILES['userfile_4']['name'], PATHINFO_EXTENSION);
			$type 	= $this->input->post("type");
			 
			$config['file_name']  		= $id."_4.".$ext;
			$filename = "files/distributor/cards/".$config['file_name'];
			
			$this->upload->initialize($config); 
			if ($this->upload->do_upload('userfile_4')) {
				 
				$set["slider_image4"] = $filename;
					
			}
			else {
				echo $this->upload->display_errors();
			}
 
		}

		if (!empty($_FILES['userfile_5']['name']))  {
			
			$config['upload_path'] 		= './files/distributor/banners/';				
			$ext 	= pathinfo($_FILES['userfile_5']['name'], PATHINFO_EXTENSION);
			$type 	= $this->input->post("type");
			
			$config['file_name']  		= $id."_banner.".$ext;
			$filename = "files/distributor/banners/".$config['file_name'];
			
			$this->upload->initialize($config); 
			if ($this->upload->do_upload('userfile_5')) {
				
				$set["card_image"] = $filename;
				
								
			}
			else {
				echo $this->upload->display_errors();
			}
 
		}
		$set['notification'] = isset($_POST['notification'])? 1:0; 
		$this->db->where("card_id", $id );	 
		$this->db->update("card_info", $set);

		if( $form_type == "new" ){
			redirect(base_url()."admin/cardmanager_edit/".$id);
		}		
	}
 
	function getCardActivityRC(){

		//echo $this->userId.' asdfa sdf asdf';
		
		
		$aColumns = array( 'Date_Card_ID', 'store_info.company_name', 'storecity', 'Transaction_ID', 'card_holder_activity_info.Card_ID', 'card_holders.FIRSTNAME', 'card_holders.EMAIL', 'cities.name', 'card_holders.GENDER', 'confirmed', 'purchased_amount', 'Amount_Used', 'Points' );
		
		/* Indexed column (used for fast and accurate table cardinality) */
		$sIndexColumn = "card_holder_activity_info.ID";
		
		/* DB table to use */
		$sTable = "card_holder_activity_info";
		$sJoin = "LEFT OUTER JOIN store_info ON store_info.id = card_holder_activity_info.Store_ID
				LEFT OUTER JOIN card_holders ON card_holders.CARD_ID = card_holder_activity_info.Card_ID and card_holders.CARD_TYPE='RC'
				LEFT OUTER JOIN cities ON cities.id = card_holders.CITY_ID ";
		/* 
		 * Paging
		 */
		$sLimit = "";
		if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' ) {
			$sLimit = "LIMIT ".mysql_real_escape_string( $_GET['iDisplayStart'] ).", ".mysql_real_escape_string( $_GET['iDisplayLength'] );
				
			
			//$this->db->limit( $_GET['iDisplayLength'] ),  $_GET['iDisplayStart']  );
		}
		
		
		/*
		 * Ordering
		 */
		if ( isset( $_GET['iSortCol_0'] ) )
		{
			$sOrder = "ORDER BY  ";
			for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ ) {
			
				if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" ) {
					
					
					$sOrder .= $aColumns[ intval( $_GET['iSortCol_'.$i] ) ]." ".mysql_real_escape_string( $_GET['sSortDir_'.$i] ) .", ";
						
					//$this->db->order_by($aColumns[ intval( $_GET['iSortCol_'.$i] ) ], $_GET['sSortDir_'.$i] );	
				}
			}
			
			$sOrder = substr_replace( $sOrder, "", -2 );
			if ( $sOrder == "ORDER BY" ){
				$sOrder = "";
			}
		}
		
		
		/* 
		 * Filtering
		 * NOTE this does not match the built-in DataTables filtering which does it
		 * word by word on any field. It's possible to do here, but concerned about efficiency
		 * on very large tables, and MySQL's regex functionality is very limited
		 */
		$sWhere = "WHERE CardType='R' ";
		
		//$sWhere .= "users.role_id = 4";
		
		if ( $_GET['sSearch'] != "" ){
			$sWhere .= " AND (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ ){
				
				if( $aColumns[$i] == "Points" ){
				
				}else{
			
					$sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
				}
				/*if( $i == 0 )
					$this->db->like($_GET['sSearch'], 'match');
				else
					$this->db->or_like($_GET['sSearch'], 'match');*/
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		}
		
		/* Individual column filtering */
		for ( $i=0 ; $i<count($aColumns) ; $i++ ){
			if ( $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' ){
				if ( $sWhere == "" ) {
					$sWhere = "WHERE ";
				}
				else { 
					$sWhere .= " AND";
				}
				$sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
			}
		}
		
		 
		
		/*
		 * SQL queries
		 * Get data to display
		 */
		$sQuery = "
			SELECT SQL_CALC_FOUND_ROWS  
						card_holder_activity_info.ID,
						Date_Card_ID, 
						store_info.company_name as 'storename',
						(SELECT cities.name  FROM cities WHERE cities.id = store_info.city_id) AS 'storecity',
						Transaction_ID, 
						card_holder_activity_info.Card_ID,  
						card_holders.FIRSTNAME,
						card_holders.EMAIL,
						cities.name AS 'city', 
						card_holders.GENDER,
						if(card_holders.CONFIRMED=1, 'Yes', 'No') as 'confirmed',  
						Purchased_Amount as 'purchase_amount',
						Amount_Used as amount_used,
						ROUND((Purchased_Amount/p_value)*p_points, 0) AS 'points'			
			
			FROM   $sTable
			$sJoin
			$sWhere
			$sOrder
			$sLimit
		";
		 
		$rResult = $this->db->query($sQuery); 
		
		//echo $this->db->last_query();
		$iFilteredTotal = $rResult->num_rows();
		
		/* Total data set length */
		$sQuery = "
			SELECT COUNT(".$sIndexColumn.") as numrow
			FROM   $sTable
			$sJoin
			$sWhere
		";
		//$rResultTotal = mysql_query( $sQuery, $gaSql['link'] ) or die(mysql_error());
		//$aResultTotal = mysql_fetch_array($rResultTotal);
		$aResultTotal = $this->db->query($sQuery)->row();
		$iTotal = $aResultTotal->numrow;
		
		
		/*
		 * Output
		 */
		$output = array(
			"sEcho" => intval($_GET['sEcho']),
			//"sEcho" => 1,
			"iTotalRecords" => $iTotal,
			//"iTotalDisplayRecords" => $iFilteredTotal,
			"iTotalDisplayRecords" => $iTotal,
			"aaData" => array()
		);
		
		//while ( $aRow = mysql_fetch_array( $rResult ) ){
		
		$rResult = $rResult->result();
		
		//print_r($rResult);
		foreach( $rResult as $row ){
		
			$rows = array();
			
			$rows['DT_RowId'] = $row->ID; 
			
			$rows[] = $row->Date_Card_ID; 
			$rows[] = $row->storename; 
			$rows[] = $row->storecity; 
			$rows[] = $row->Transaction_ID; 
			$rows[] = $row->Card_ID; 
			$rows[] = $row->FIRSTNAME; 
			$rows[] = $row->EMAIL; 
			$rows[] = $row->city; 
			$rows[] = $row->GENDER; 
			$rows[] = $row->confirmed; 
			$rows[] = $row->purchase_amount; 
			$rows[] = $row->amount_used; 
			$rows[] = $row->points; 
			
			$output['aaData'][] = $rows;
		}
		
		echo json_encode( $output );	
	}	
	
	
	
	function getCardActivityGC(){

		//echo $this->userId.' asdfa sdf asdf';
		
		
		$aColumns = array( 'Date_Card_ID', 'store_info.address', 'Transaction_ID', 'card_holder_activity_info.Card_ID', 'card_holders.POSTAL_CODE', 'card_holders.GENDER', 'Purchased_Amount' );
		
		/* Indexed column (used for fast and accurate table cardinality) */
		$sIndexColumn = "card_holder_activity_info.ID";
		
		/* DB table to use */
		$sTable = "card_holder_activity_info";
		$sJoin = "LEFT OUTER JOIN store_info ON store_info.id = card_holder_activity_info.Store_ID
				LEFT OUTER JOIN card_holders ON card_holders.CARD_ID = card_holder_activity_info.Card_ID and card_holders.CARD_TYPE='GC'
				LEFT OUTER JOIN cities ON cities.id = card_holders.CITY_ID";
		/* 
		 * Paging
		 */
		$sLimit = "";
		if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' ) {
			$sLimit = "LIMIT ".mysql_real_escape_string( $_GET['iDisplayStart'] ).", ".mysql_real_escape_string( $_GET['iDisplayLength'] );
				
			
			//$this->db->limit( $_GET['iDisplayLength'] ),  $_GET['iDisplayStart']  );
		}
		
		
		/*
		 * Ordering
		 */
		if ( isset( $_GET['iSortCol_0'] ) )
		{
			$sOrder = "ORDER BY  ";
			for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ ) {
			
				if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" ) {
					
					
					$sOrder .= $aColumns[ intval( $_GET['iSortCol_'.$i] ) ]." ".mysql_real_escape_string( $_GET['sSortDir_'.$i] ) .", ";
						
					//$this->db->order_by($aColumns[ intval( $_GET['iSortCol_'.$i] ) ], $_GET['sSortDir_'.$i] );	
				}
			}
			
			$sOrder = substr_replace( $sOrder, "", -2 );
			if ( $sOrder == "ORDER BY" ){
				$sOrder = "";
			}
		}
		
		
		/* 
		 * Filtering
		 * NOTE this does not match the built-in DataTables filtering which does it
		 * word by word on any field. It's possible to do here, but concerned about efficiency
		 * on very large tables, and MySQL's regex functionality is very limited
		 */
		$sWhere = "WHERE CardType='G' ";
		
		//$sWhere .= "users.role_id = 4";
		
		if ( $_GET['sSearch'] != "" ){
			$sWhere .= " AND (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ ){
				$sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
				
				/*if( $i == 0 )
					$this->db->like($_GET['sSearch'], 'match');
				else
					$this->db->or_like($_GET['sSearch'], 'match');*/
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		}
		
		/* Individual column filtering */
		for ( $i=0 ; $i<count($aColumns) ; $i++ ){
			if ( $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' ){
				if ( $sWhere == "" ) {
					$sWhere = "WHERE ";
				}
				else { 
					$sWhere .= " AND";
				}
				$sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
			}
		}
		
		 
		
		/*
		 * SQL queries
		 * Get data to display
		 */
		$sQuery = "
			SELECT SQL_CALC_FOUND_ROWS  
						card_holder_activity_info.ID,
						Date_Card_ID, 
						store_info.address,
						Transaction_ID, 
						card_holder_activity_info.Card_ID,  
						card_holders.POSTAL_CODE,
						card_holders.GENDER, 			
						Purchased_Amount AS 'purchased_amount'	
			
			FROM   $sTable
			$sJoin
			$sWhere
			$sOrder
			$sLimit
		";
		 
		$rResult = $this->db->query($sQuery); 
		
		//echo $this->db->last_query();
		$iFilteredTotal = $rResult->num_rows();
		
		/* Total data set length */
		$sQuery = "
			SELECT COUNT(".$sIndexColumn.") as numrow
			FROM   $sTable
			$sJoin
			$sWhere
		";
		//$rResultTotal = mysql_query( $sQuery, $gaSql['link'] ) or die(mysql_error());
		//$aResultTotal = mysql_fetch_array($rResultTotal);
		$aResultTotal = $this->db->query($sQuery)->row();
		$iTotal = $aResultTotal->numrow;
		
		
		/*
		 * Output
		 */
		$output = array(
			"sEcho" => intval($_GET['sEcho']),
			"iTotalRecords" => $iTotal,
			//"iTotalDisplayRecords" => $iFilteredTotal,
			"iTotalDisplayRecords" => $iTotal,
			"aaData" => array()
		);
		
		//while ( $aRow = mysql_fetch_array( $rResult ) ){
		
		$rResult = $rResult->result();
		
		//print_r($rResult);
		foreach( $rResult as $row ){
		
			$rows = array();
			
			$rows['DT_RowId'] = $row->ID; 
			
			$rows[] = $row->Date_Card_ID; 
			$rows[] = $row->address; 
			$rows[] = $row->Transaction_ID; 
			$rows[] = $row->Card_ID; 
			$rows[] = $row->POSTAL_CODE; 
			$rows[] = $row->GENDER; 
			$rows[] = $row->purchased_amount;  
			
			$output['aaData'][] = $rows;
		}
		
		echo json_encode( $output );	
	}		


	function getRegisteredCardMembers(){

		//echo $this->userId.' asdfa sdf asdf';
		
		
		$aColumns = array( 'card_holders.ID', 'CREATE_DATE', 'CARD_ID', 'card_balance', 'cities.name', 'FIRSTNAME', 'card_holders.EMAIL', 'card_holders.PHONE', 'GENDER', 'ACTIVE', 'company_name', 'register_operator'  );
		
		/* Indexed column (used for fast and accurate table cardinality) */
		$sIndexColumn = "card_holders.ID";
		
		/* DB table to use */
		$sTable = "card_holders";
		$sJoin = "LEFT OUTER JOIN distributor_info ON distributor_info.dist_id = card_holders.Distributer_Id				
				LEFT OUTER JOIN cities ON cities.id=card_holders.city_id";
		/* 
		 * Paging
		 */
		$sLimit = "";
		if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' ) {
			$sLimit = "LIMIT ".mysql_real_escape_string( $_GET['iDisplayStart'] ).", ".mysql_real_escape_string( $_GET['iDisplayLength'] );
				
			
			//$this->db->limit( $_GET['iDisplayLength'] ),  $_GET['iDisplayStart']  );
		}
		
		
		/*
		 * Ordering
		 */
		if ( isset( $_GET['iSortCol_0'] ) )
		{
			$sOrder = "ORDER BY  ";
			for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ ) {
			
				if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" ) {
					
					
					$sOrder .= $aColumns[ intval( $_GET['iSortCol_'.$i] ) ]." ".mysql_real_escape_string( $_GET['sSortDir_'.$i] ) .", ";
						
					//$this->db->order_by($aColumns[ intval( $_GET['iSortCol_'.$i] ) ], $_GET['sSortDir_'.$i] );	
				}
			}
			
			$sOrder = substr_replace( $sOrder, "", -2 );
			if ( $sOrder == "ORDER BY" ){
				$sOrder = "";
			}
		}
		
		
		/* 
		 * Filtering
		 * NOTE this does not match the built-in DataTables filtering which does it
		 * word by word on any field. It's possible to do here, but concerned about efficiency
		 * on very large tables, and MySQL's regex functionality is very limited
		 */
		$sWhere = "WHERE CARD_TYPE='RC' ";
		
		//$sWhere .= "users.role_id = 4";
		
		if ( $_GET['sSearch'] != "" ){
			$sWhere .= " AND (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ ){
				$sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
				
				/*if( $i == 0 )
					$this->db->like($_GET['sSearch'], 'match');
				else
					$this->db->or_like($_GET['sSearch'], 'match');*/
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		}
		
		/* Individual column filtering */
		for ( $i=0 ; $i<count($aColumns) ; $i++ ){
			if ( $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' ){
				if ( $sWhere == "" ) {
					$sWhere = "WHERE ";
				}
				else { 
					$sWhere .= " AND";
				}
				$sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
			}
		}
		
		 
		
		/*
		 * SQL queries
		 * Get data to display
		 */
		$sQuery = "
			SELECT SQL_CALC_FOUND_ROWS 						
						card_holders.ID,
						card_holders.CREATE_DATE,
						CARD_ID, 
						card_balance, 
						card_holders.CARD_TYPE, 
						FIRSTNAME, 
						LASTNAME, 
						card_holders.EMAIL, 
						card_holders.PHONE, 
						GENDER, 
						CONFIRMED, 
						ACTIVE, 
						cities.name as city_name, 
						company_name, 
						distributor_info.first_name, 
						distributor_info.last_name, 
						CREATE_DATE, 
						register_operator	
			
			FROM   $sTable
			$sJoin
			$sWhere
			$sOrder
			$sLimit
		";
		 
		$rResult = $this->db->query($sQuery); 
		
		//echo $this->db->last_query();
		$iFilteredTotal = $rResult->num_rows();
		
		/* Total data set length */
		$sQuery = "
			SELECT COUNT(".$sIndexColumn.") as numrow
			FROM   $sTable
			$sJoin
			$sWhere
		";
		//$rResultTotal = mysql_query( $sQuery, $gaSql['link'] ) or die(mysql_error());
		//$aResultTotal = mysql_fetch_array($rResultTotal);
		$aResultTotal = $this->db->query($sQuery)->row();
		$iTotal = $aResultTotal->numrow;
		
		
		/*
		 * Output
		 */
		$output = array(
			"sEcho" => intval($_GET['sEcho']),
			"iTotalRecords" => $iTotal,
			//"iTotalDisplayRecords" => $iFilteredTotal,
			"iTotalDisplayRecords" => $iTotal,
			"aaData" => array()
		);
		
		//while ( $aRow = mysql_fetch_array( $rResult ) ){
		
		$rResult = $rResult->result();
		
		//print_r($rResult);
		$i = ($iTotal)-($_GET['iDisplayStart']);
		foreach( $rResult as $row ){
		
			$rows = array();
			
			$rows['DT_RowId'] = $row->ID; 
			
			$rows[] = $i; 
			$rows[] = $row->CREATE_DATE; 
			$rows[] = $row->CARD_ID; 
			$rows[] = $row->card_balance;  
			$rows[] = $row->city_name; 
			$rows[] = $row->FIRSTNAME;   
			$rows[] = $row->EMAIL;  
			$rows[] = $row->PHONE;  
			$rows[] = $row->GENDER;  
			$rows[] = ($row->CONFIRMED)?"Yes":"No";;  
			$rows[] = ($row->ACTIVE)?"Yes":"No";  
			$rows[] = $row->company_name." - ".$row->first_name;  
			$rows[] = $row->register_operator;  
			$rows[] = '<a href="javascript:Admin.resendVCode('.$row->CARD_ID.')" >Resend</a>';  
			
			$output['aaData'][] = $rows;
			$i--;
		}
		
		echo json_encode( $output );	
	}		
	
}

/* End of file welcome.php */
/* Location: ./application/model/midasmodel.php */