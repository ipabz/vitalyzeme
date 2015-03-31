<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class TimelineController extends Controller {

	public function index()
	{
		$page_title = "Timeline";
		$month = 1;
		$current_month = 1;
		$month_word = 'one';
		$timeline_data = NULL;
		
		return view('pages.timeline.module', compact('page_title', 'month', 'current_month', 'month_word', 'timeline_data'));
	}

}
