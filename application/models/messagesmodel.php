<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MessagesModel extends CI_Model {
 
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
   
 
	function getMessages(){
 
		/* $op_res = $this->db->get('operator_user_info')->result();
		
		$operator = array();
		foreach($op_res as $row ){
			$operator[$row->Username]= $row->fullname;
		} */

		
		$aColumns = array( 'op_user', 'date_updated', 'unreadno', 'comments', 'msg_subject', 'site', 'status_id', 'isAdminDeleted' );
		
		/* Indexed column (used for fast and accurate table cardinality) */
		$sIndexColumn = "message.mid";
		
		/* DB table to use */
		$sTable = "message";
		$sJoin = "";
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
		$sWhere = "";
		
		$sWhere .= " WHERE isAdminDeleted = 0 ";
		
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
				mid, op_id, op_user,msg_subject,msg_text,site,date_created,date_updated,status_id, admin_id, owner_isadmin, admin_user,
				(SELECT COUNT(*) FROM message_reply WHERE admin_unread = 0 AND message_reply.mid = message.mid) AS 'unreadno',
				(SELECT COUNT(*) FROM message_reply WHERE  message_reply.mid = message.mid) AS 'comments',
				isAdminDeleted
			
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
			
			$rows['DT_RowId'] = $row->mid; 
			
			if( $row->owner_isadmin ){			
				$rows[] = '<a href="admin/viewmessage/'.$row->mid.'"><strong style="color:red">Ricktag Team('.$row->admin_user.')</strong></a>'; 
			}else{
				$rows[] = '<a href="admin/viewmessage/'.$row->mid.'">'.@$row->op_user.'</a>'; 
			}
			$rows[] = $row->date_updated; 
			$rows[] = $row->unreadno;  
			$rows[] = $row->comments; 
			$rows[] = '<a href="admin/viewmessage/'.$row->mid.'">'.$row->msg_subject.'</a>';    
			$rows[] = $row->site;    
			$rows[] = (!$row->status_id)?"Open":"Closed";
			$rows[] = '<a href="javascript:Messages.deleteMsg('.$row->mid.')">Delete</a>';
			
			$output['aaData'][] = $rows;
			$i--;
		}
		
		echo json_encode( $output );	
	}		
	
}

/* End of file welcome.php */
/* Location: ./application/model/midasmodel.php */