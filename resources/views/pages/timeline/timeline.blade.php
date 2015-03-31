@extends('common.default')

@section('content')
	
    <section class="container-fluid" id="main-container">        
    <div id="timeline-body">
        
<section class="page-title">My Wellness Journey</section>
        
        <section class="months">                	
            <div class="month_left">Month</div>
            <div class="month_right">                
                <?php
                if ($month < 12) {
                ?>
                <img class="fourth_locked" src="/images/locked_icon.png" width="9" />
                <?php
                }
                ?>
                <div class="wrapper">
                    <div class="row">
                        <div class="col-md-9"></div>
                        <div <?php print (($current_month == 10 OR $current_month > 10) ? 'data-href="'.URL::to('timeline/10').'"' : ''); ?> class="col-md-1 the_month text-center <?php print (($current_month == 10) ? 'month_current' : (($current_month > 10) ? 'month_passed' : '')); ?>">Ten</div>
                        <div <?php print (($current_month == 11 OR $current_month > 11) ? 'data-href="'.URL::to('timeline/11').'"' : ''); ?> class="col-md-1 the_month text-center <?php print (($current_month == 11) ? 'month_current' : (($current_month > 11) ? 'month_passed' : '')); ?>">Eleven</div>
                        <div <?php print (($current_month == 12 OR $current_month > 12) ? 'data-href="'.URL::to('timeline/12').'"' : ''); ?> class="col-md-1 the_month text-center last <?php print (($current_month == 12) ? 'month_current' : (($current_month > 12) ? 'month_passed' : '')); ?>">Twelve</div>
                    </div>
                    <div class="row">
                        <div class="col-md-6"></div>
                        <div <?php print (($current_month == 7 OR $current_month > 7) ? 'data-href="'.URL::to('timeline/7').'"' : ''); ?> class="col-md-1 the_month text-center <?php print (($current_month == 7) ? 'month_current' : (($current_month > 7) ? 'month_passed' : '')); ?>">Seven</div>
                        <div <?php print (($current_month == 8 OR $current_month > 8) ? 'data-href="'.URL::to('timeline/8').'"' : ''); ?> class="col-md-1 the_month text-center <?php print (($current_month == 8) ? 'month_current' : (($current_month > 8) ? 'month_passed' : '')); ?>">Eight</div>
                        <div <?php print (($current_month == 9 OR $current_month > 9) ? 'data-href="'.URL::to('timeline/9').'"' : ''); ?> class="col-md-1 the_month text-center last <?php print (($current_month == 9) ? 'month_current' : (($current_month > 9) ? 'month_passed' : '')); ?>">Nine</div>
                        <div class="col-md-1 locked_icon">
                            <?php
                            if ($month <= 9) {
                            ?>
                            <img src="/images/locked_icon.png" width="9" />
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div <?php print (($current_month == 4 OR $current_month > 4) ? 'data-href="'.URL::to('timeline/4').'"' : ''); ?> class="col-md-1 the_month text-center <?php print (($current_month == 4) ? 'month_current' : (($current_month > 4) ? 'month_passed' : '')); ?>">Four</div>
                        <div <?php print (($current_month == 5 OR $current_month > 5) ? 'data-href="'.URL::to('timeline/5').'"' : ''); ?> class="col-md-1 the_month text-center <?php print (($current_month == 5) ? 'month_current' : (($current_month > 5) ? 'month_passed' : '')); ?>">Five</div>
                        <div <?php print (($current_month == 6 OR $current_month > 6) ? 'data-href="'.URL::to('timeline/6').'"' : ''); ?> class="col-md-1 the_month text-center last <?php print (($current_month == 6) ? 'month_current' : (($current_month > 6) ? 'month_passed' : '')); ?>">Six</div>
                        <div class="col-md-1 locked_icon">
                            <?php
                            if ($month <= 6) {
                            ?>
                            <img src="/images/locked_icon.png" width="9" />
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div <?php print (($current_month == 1 OR $current_month > 1) ? 'data-href="'.URL::to('timeline/1').'"' : ''); ?> class="col-md-1 the_month text-center <?php print (($current_month == 1) ? 'month_current' : (($current_month > 1) ? 'month_passed' : '')); ?>">One</div>
                        <div <?php print (($current_month == 2 OR $current_month > 2) ? 'data-href="'.URL::to('timeline/2').'"' : ''); ?> class="col-md-1 the_month text-center <?php print (($current_month == 2) ? 'month_current' : (($current_month > 2) ? 'month_passed' : '')); ?>">Two</div>
                        <div <?php print (($current_month == 3 OR $current_month > 3) ? 'data-href="'.URL::to('timeline/3').'"' : ''); ?> class="col-md-1 the_month text-center last <?php print (($current_month == 3) ? 'month_current' : (($current_month > 3) ? 'month_passed' : '')); ?>">Three</div>
                        <div class="col-md-1 locked_icon">
                            <?php
                            if ($month <= 3) {
                            ?>
                            <img src="/images/locked_icon.png" width="9" />
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="clearall"></div>
            </div>
            <div class="clearall"></div>
        </section>
        
        <section class="steps_lines">                	
            <div class="sl_left">
                <?php
                if ($month <= 6) {
                ?>
                <div class="<?php print $month_word; ?>_arrow"></div>
                <?php
                }
                ?>                 
            </div>
            <div class="sl_right">
                <?php
                if ($month > 6) {
                ?>
                <div class="<?php print $month_word; ?>_arrow"></div>
                <?php
                }
                ?>                     	                   
            </div>
            <div class="clearall"></div>
            
        </section>
        
        @yield('modules')
        
    </div>
</section>
    
    
@stop