<?php namespace App\Libraries;

use DB;

class TimelineHelper {
	
	public function get_topics($month, $limit=0, $offset=0)
	{
		$sql = "SELECT `topics`.`topic_id`, `topics`.`topic`, `modules`.`name` AS module_name, `modules`.`month`, `modules`.`module_id`, `chapters`.`name` AS chapter_name, `chapters`.`chapter_id` FROM (`modules`) INNER JOIN `chapters` ON `modules`.`module_id` = `chapters`.`module_id` INNER JOIN `topics` ON `chapters`.`chapter_id` = `topics`.`chapter_id` WHERE `modules`.`month` = :month ORDER BY `chapters`.`chapter_id` ASC";
		
		$vars['month'] = $month;
		
		if ($limit > 0) {
			$sql .= " LIMIT :offset, :limit";
			$vars['offset'] = $offset;
			$vars['limit'] = $limit;
		}
		
		$results = DB::select($sql, $vars);
		$results = (array)$results;
		
		$data = NULL;
		
		foreach($results as $row) {
			$row = (array)$row;
			
			$data['modules'][ $row['module_id'] ] = $row['module_name'];
			$data['chapters'][ $row['module_id'] ][ $row['chapter_id'] ] = $row['chapter_name'];
			$data['topics'][ $row['chapter_id'] ][] = $row;
		}
		
		return $data;
		
	}
	
	protected function count_topics($topics_data)
	{
		$topics = $topics_data['topics'];
		$counter = 0;
		
		if ($topics) {
			foreach($topics as $key => $val) {
				$counter += count($val);
			}
		}
		
		return $counter;
		
	}
	
	public function get_topic($topic_id)
	{
		$vars['topic_id'] = $topic_id;
		$sql = "SELECT * FROM topics where topic_id = :topic_id";
		
		$results = DB::select($sql, $vars);
		
		if ($results) {
			$results = (array)$results[0];
			return $results;
		}
		
		return NULL;
	}
	
	function get_client_ip() {
		$ipaddress = '';
		if (@$_SERVER['HTTP_CLIENT_IP'])
			$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
		else if(@$_SERVER['HTTP_X_FORWARDED_FOR'])
			$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		else if(@$_SERVER['HTTP_X_FORWARDED'])
			$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
		else if(@$_SERVER['HTTP_FORWARDED_FOR'])
			$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
		else if(@$_SERVER['HTTP_FORWARDED'])
			$ipaddress = $_SERVER['HTTP_FORWARDED'];
		else if(@$_SERVER['REMOTE_ADDR'])
			$ipaddress = $_SERVER['REMOTE_ADDR'];
		else
			$ipaddress = 'UNKNOWN';
		return $ipaddress;
	}
	
	public function topic_done($topic_id)
	{
		$ip_address = $this->get_client_ip();	
		
		$vars['ip_address'] = $ip_address;
		$sql = "SELECT * FROM tracking WHERE ip_address = :ip_address";
		
		$results = DB::select($sql, $vars);
		$data = '-empty';
		
		if ($results) {
			$results = (array)$results[0];
			$topics = $results['topic_done'];
			
			$exp = explode(',', $topics);
			
			if ( in_array($topic_id, $exp) ) {
				$data = '';
			}
		}
		
		return $data;
	}
	
	public function current_step()
	{
		$ip_address = $this->get_client_ip();	
		
		$vars['ip_address'] = $ip_address;
		$sql = "SELECT * FROM tracking WHERE ip_address = :ip_address";
		
		$results = DB::select($sql, $vars);
		$data = 0;
		
		if ($results) {
			$results = (array)$results[0];
			$data = $results['current_topic'];
		}
		
		return $data;
		
	}
	
	public function track($topic_id, $chapter_id)
	{
		$ip_address = $this->get_client_ip();	
		
		$vars['ip_address'] = $ip_address;
		$sql = "SELECT * FROM tracking WHERE ip_address = :ip_address";
		
		$results = DB::select($sql, $vars);
		
		if ($results) {
			$row = $results[0];
			$data['topic_done'] = trim( $row->topic_done );
			
			if ($data['topic_done'] == '') {
				$data['topic_done'] = $topic_id;
			} else {
				
				$exp = explode(',', $data['topic_done']);
				
				if ( ! in_array($topic_id, $exp) ) {
					$data['topic_done'] .= ',' . $topic_id;	
				}
				
				
			}
			
			$data['last_updated'] = @time();
			$data['current_topic'] = "$chapter_id";
			
			DB::table('tracking')->where('track_id', $row->track_id)->update($data);
			
			
		} else {
			
			$data['topic_done'] = $topic_id;
			$data['ip_address'] = $ip_address;
			$data['date_created'] = @time();
			$data['last_updated'] = @time();
			$data['current_topic'] = "$chapter_id"; 
			
			DB::table('tracking')->insert(
				$data
			);
			
		}
	}
	
	public function current_month()
	{
		$ip_address = $this->get_client_ip();	
		
		$vars['ip_address'] = $ip_address;
		$sql = "SELECT * FROM tracking WHERE ip_address = :ip_address";
		
		$results = DB::select($sql, $vars);
		
		$month = 1;
		
		if ($results) {
			$data = $results[0]->topic_done;
			$exp = explode(',', $data);
			
			$tcount = $this->count_topics($this->get_topics($month));
			
			while(count($exp) >= $tcount && $tcount > 0 ) {
				$month++;
				$tcount = $this->count_topics($this->get_topics($month));
			}
		}
		
		return $month;
	}
	
		
}