<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Libraries\TimelineHelper;

class TimelineController extends Controller {

	private $months = NULL;
	
	public function __construct()
	{
		$this->months = array(
			1 => 'one',
			2 => 'two',
			3 => 'three',
			4 => 'four',
			5 => 'five',
			6 => 'six',
			7 => 'seven',
			8 => 'eight',
			9 => 'nine',
			10 => 'ten',
			11 => 'eleven',
			12 => 'twelve'
		);	
	}

	public function index($month=1)
	{
		$timeline_model = new TimelineHelper;
		
		$page_title = "Timeline";
		$current_month = $timeline_model->current_month();
		$month_word = $this->months[$month];
		$timeline_data = $timeline_model->get_topics($month);
		$current_step = $timeline_model->current_step();
		
		return view('pages.timeline.module', compact('page_title', 'month', 'current_month', 'month_word', 'timeline_data', 'current_step', 'timeline_model'));
	}
	
	public function track($topic_id, $chapter_id)
	{
		$timeline_model = new TimelineHelper;
		$timeline_model->track($topic_id, $chapter_id);	
	}
	
	public function timeline_topic_details($topic_id)
	{
		$timeline_model = new TimelineHelper;
		
		$data['page_title'] = 'Timeline';
		$data['topic'] = $timeline_model->get_topic($topic_id);
		
		//$this->load->view('common/header', $data);
		//$this->load->view('pages/timeline/topic_view', $data);
		//$this->load->view('common/footer');
		return view('pages.timeline.topic', $data);
	}

}
