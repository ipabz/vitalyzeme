<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

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
		$page_title = "Timeline";
		$current_month = 1;
		$month_word = $this->months[$month];
		$timeline_data = NULL;
		
		return view('pages.timeline.module', compact('page_title', 'month', 'current_month', 'month_word', 'timeline_data'));
	}

}
