<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$this->call('ModulesTableSeeder');
		$this->call('ChaptersTableSeeder');
		$this->call('TopicsTableSeeder');
	}

}

class ModulesTableSeeder extends Seeder {
	
	public function run()
	{
		$time = @time();
		
		$modules = array(
				'name' => 'MINDSET Program',
				'month' => '1',
				'date_created' => $time,
				'last_updated' => $time
			);
		
		DB::table('modules')->insert(
			$modules
		);
	}
		
}

class ChaptersTableSeeder extends Seeder {
	
	public function run()
	{
		$time = @time();
		
		$contents = array(
			array(
				'module_id' => 1,
				'name' => 'Introduction',
				'date_created' => $time,
				'last_updated' => $time
			),
			array(
				'module_id' => 1,
				'name' => 'Mind-Body-Stress',
				'date_created' => $time,
				'last_updated' => $time
			),
			array(
				'module_id' => 1,
				'name' => 'Hormones',
				'date_created' => $time,
				'last_updated' => $time
			),
			array(
				'module_id' => 1,
				'name' => 'Inflammation',
				'date_created' => $time,
				'last_updated' => $time
			),
			array(
				'module_id' => 1,
				'name' => 'Nutrition-Fat',
				'date_created' => $time,
				'last_updated' => $time
			)				
		);
		
		DB::table('chapters')->insert(
			$contents
		);
	}
		
}

class TopicsTableSeeder extends Seeder {
	
	public function run()
	{
		$time = @time();
		
		$contents = array(
			array(
				'chapter_id' => 1,
				'topic' => 'Stop treating symptoms <strong>CURE</strong> the cause.',
				'date_created' => $time,
				'last_updated' => $time
			),
			array(
				'chapter_id' => 1,
				'topic' => 'Mindset Matters:</strong> Fixed Mindset and Growth Mindset',
				'date_created' => $time,
				'last_updated' => $time
			)
		);
		
		DB::table('topics')->insert(
			$contents
		);
		
		
		//Mind-Body-Stress
		$file = public_path().'/months/one/mind-body-stress.html';
		$this->build_data($file, 2);
		
		//Hormones
		$file = public_path().'/months/one/hormones.html';
		$this->build_data($file, 3);
		
		//Inflammation
		$file = public_path().'/months/one/inflammation.html';
		$this->build_data($file, 4);
		
		//Nutrition-Fat
		$file = public_path().'/months/one/nutritionfat.html';
		$this->build_data($file, 5);
	}
	
	protected function build_data($file, $chapter)
	{
		$processed = $this->process($file);
		$time = @time();
		$data = array();
		
		foreach($processed as $key => $val) {
			extract($val);
			
			$data[] = array(
				'chapter_id' => $chapter,
				'topic' => $name,
				'contents' => @$contents,
				'date_created' => $time,
				'last_updated' => $time
			);	
		}
		
		DB::table('topics')->insert(
			$data
		);
			
	}
	
	protected function read_file($file_name)
	{
		$file = new SplFileObject($file_name);
		$dictionary = array();
		
		while (!$file->eof()) {
			$dictionary[] = trim($file->fgets());
		}
		
		return $dictionary;
	}
	
	protected function process($file)
	{
		$contents = $this->read_file($file);
		$data = array();
		$start = false;
		$counter = -1;
		$sub = "";
		
		foreach($contents as $key => $val) {
			
			$val = trim($val);
			
			if ( strpos($val, '-0') ) {
				
				if ($sub != "") {
					$data[$counter]['contents'] = $sub . "</ul>";
					$sub = "";
				}
				
				$start = true;
				$counter++;
			}
			
			if ($val == '</ul>' && $start) {
				$start = false;
			}
			
			if ($start && strpos($val, 'class="c5"')) {
				$data[$counter]['name']= strip_tags($val, '<span><b><strong><em><i><u><a>');
			} else if (!$start && $val != '</ul>') {
				$sub .= $val;	
			}
			
		}
		
		$data[$counter]['contents'] = $sub . "</ul>";
		
		foreach($data as $key => $val) {
			if ($val == '') {
				unset($data[$key]);
			}
		}
		
		return $data;
			
	}
		
}