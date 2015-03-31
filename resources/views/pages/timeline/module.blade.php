@extends('pages.timeline.timeline')

@section('modules')
<?php
if ($timeline_data != NULL) {
	$the_count = 1;
	foreach($timeline_data['modules'] as $module_id => $module_name) {
		$main_counter = 0;
		$counter = 1;
		
		foreach($timeline_data['chapters'][$module_id] as $chapter_id => $chapter_name) {
			
			
?>

<section class="the_contents">
    <div class="tc_left">
    	<?php if ($main_counter == 0) { ?>
        <div class="the_title"><?php print $module_name; ?></div>
        <?php
		}
		
		if (($main_counter % 2) != 0) {
		?>
        <div id="chapter<?php print $chapter_id; ?>" class="article <?php print (($month <= 6 && $counter == 1) ? 'now' : (($counter == 1) ? 'now2' : '')); ?> <?php print (($current_step == $chapter_id OR ($counter == 1 && $current_step == 0)) ? 'current_step' : ''); ?>">
            <div class="a_title"><?php print $chapter_name; ?> <span class="box"></span></div>
            <div class="topics">
            	<?php
				foreach($timeline_data['topics'][$chapter_id] as $topic) {
				?>
                <div class="topic"><a data-toggle="modal" data-target="#myModal" data-href="<?php print URL::to('timeline/view_topic/'.$topic['topic_id']); ?>" class="thelink" ><?php print $topic['topic']; ?></a> <a data-chapter-id="<?php print $chapter_id; ?>" href="<?php print URL::to('pages/track/'.$topic['topic_id'].'/'.$chapter_id); ?>" class="star glyphicon glyphicon-star<?php print $timeline_model->topic_done($topic['topic_id']); ?>"></a></div>
                <?php	
				}
				?>
            </div>
        </div>
        <?php
		}
		?>
    </div>
    <div class="tc_right">
		<?php
		
		if ($the_count == count($timeline_data['chapters'][$module_id])) {
		?>
        <div class="whitebar"></div>
        <?php
		}
		
		if (($main_counter % 2) == 0 OR ($main_counter % 2) != 0) {
		?>
        <div <?php print ((($main_counter % 2) != 0) ? 'style="visibility: hidden;"' : ''); ?> id="chapter<?php print $chapter_id; ?>" class="article <?php print (($month <= 6 && $counter == 1) ? 'now' : (($counter == 1) ? 'now2' : '')); ?> <?php print (($current_step == $chapter_id OR ($counter == 1 && $current_step == 0)) ? 'current_step' : ''); ?>">
            <div class="a_title"><span class="box"></span><?php print $chapter_name; ?></div>
            <div class="topics">
            	<?php
				foreach($timeline_data['topics'][$chapter_id] as $topic) {
				?>
                <div class="topic"><a data-toggle="modal" data-target="#myModal" data-href="<?php print URL::to('timeline/view_topic/'.$topic['topic_id']); ?>" class="thelink"><?php print $topic['topic']; ?></a> <a data-chapter-id="<?php print $chapter_id; ?>" href="<?php print URL::to('pages/track/'.$topic['topic_id'].'/'.$chapter_id); ?>" class="star glyphicon glyphicon-star<?php print $timeline_model->topic_done($topic['topic_id']); ?>"></a></div>
                <?php	
				}
				?>
            </div>
        </div>
        <?php
		}
		?>
    </div>
    <div class="clearall"></div>
</section>



<?php
			$counter++;
			$main_counter++; $the_count++;
		}
	}
}
?>
@stop