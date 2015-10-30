 <form id="reportakill" name="reportakill" action="http://<?php echo DOMAIN; ?>/report/submit" method="POST" data-parsley-validate>
  
  <?php
  $playerArray = $GLOBALS['Game']->GetPlayers($GLOBALS['state']['gid'], 'all', null, 'starve_time');

  ?>
  
  <div class="step1 show">
  <div class="reportakill_row">
    <div class="reportakill_label">
      Enter a Secret Game ID:
    </div>

    <div class="reportakill_form">
        <input type="text" name="secret" id="secret" class="reportakill_form_input" data-parsley-remote data-parsley-remote-validator='checksecret' data-parsley-group="step1"/>
    </div>
    </div>
      <div class="clearfix"></div>
    <div class="reportakill_row">
      <span class="next btn btn-info pull-right" data-current-block="1" data-next-block="2">Next &gt;</span>
    </div>
    <div class="clearfix"></div>
  </div>
  <script>
  jQuery('#secret').parsley().addAsyncValidator(
  'checksecret', function (xhr) {
       var UserLogin = $('#secret').parsley();
       window.ParsleyUI.removeError(UserLogin,'errorUsername');
       response = $.parseJSON(xhr.responseText);
       if(xhr.status == '200') {
           killtime = parseInt(response.time);
           return 200;
       }
       if(xhr.status != '200') {
           window.ParsleyUI.addError(UserLogin,'errorUsername',response.error);
           return false;
       }
  }, '/checksecret'
  );
  </script>
 <script type="text/javascript">
$(document).ready(function () {
  $('.next').on('click', function () {
    var current = $(this).data('currentBlock'),
      next = $(this).data('nextBlock');
    console.log('click');
    // only validate going forward. If current group is invalid, do not go further
    // .parsley().validate() returns validation result AND show errors
    if (next > current) {
      console.log('check');
      $('#reportakill').parsley().unsubscribe('parsley:form:success');
      $('#reportakill').parsley().subscribe('parsley:form:success', function () {
        // individual validation
        if (current === 1) {
          currenttime = <?php echo($user_game['zombie_feed_timer'] + ZOMBIE_MAX_FEED_TIMER - time()) ?>;
          maxtime = <?php echo(ZOMBIE_MAX_FEED_TIMER); ?>;
          $('#self_time').val( Math.ceil(Math.min(maxtime - currenttime, killtime) / 3600));
          $('#self_time').attr('data-parsley-max', Math.ceil(Math.min(maxtime - currenttime, killtime) / 3600));
          $('#time1').text(killtime/3600);
        }
          
        if (current === 2) {
         var remtime = killtime - $('#self_time').val() * 3600;
         $('#time2').text(remtime/3600);
         $('#feed1_time').val(remtime/3600);
         $('#feed1_time').attr('data-parsley-max', remtime / 3600);
        }
        
        if (current === 3) {
         var remtime = killtime - $('#self_time').val() * 3600 - $('#feed1_time').val() * 3600;
         $('#time3').text(remtime/3600);
        }
        console.log('event css');
        $('.step' + current)
          .removeClass('show')
          .addClass('hidden');
        $('.step' + next)
          .removeClass('hidden')
          .addClass('show');
      });
      //include loading dialogue here
      console.log('asyncvalidate');
      $('#reportakill').parsley().asyncValidate('step'+current);
      return;
    }

    // validation was ok. We can go on next step.
    console.log('css');
    $('.step' + current)
      .removeClass('show')
      .addClass('hidden');
    $('.step' + next)
      .removeClass('hidden')
      .addClass('show');

  });
});
</script> 
  <div class="step2 hidden">
  <div class="reportakill_row">
    <div class="reportakill_label">Total feed time: <a id="time1">??</a> hours</div>
  </div>
  <div class="clearfix"></div>
  <div class="reportakill_row">
    <div class="reportakill_label">Hours for you:</div>
    <div class="reportakill_form">
        <input type="text" name="self_time" id="self_time" value = "48" class="reportakill_form_input" data-parsley-type="digits" data-parsley-group="step2" required>
    </div>
<div class="clearfix"></div>
  </div>
  <div class="reportakill_row">
    <span class="next btn btn-info pull-left" data-current-block="2" data-next-block="1">&lt; Previous</span>
    <span class="next btn btn-info pull-right" data-current-block="2" data-next-block="3">Next &gt;</span>
  </div>
  <div class="clearfix"></div>
  </div>
  <div class="step3 hidden">
  <div class="reportakill_row">
    <div class="reportakill_label">Time Remaining: <a id="time2">??</a> hours</div>
  </div>
  <div class="clearfix"></div>
  <div class="reportakill_row">
    <div class="reportakill_label">
      Zombie to Feed (#1):
    </div>
              
    <div class="reportakill_form">
      <select name="feed1" class="reportakill_form_select">
        <?php
          if (is_array($playerArray))
          {
            foreach ($playerArray as $player)
            {
              if ($player['status'] == 'zombie' && $player['uid'] != $_SESSION['uid'] && !$player['share_optout'])
              {
                if (($GLOBALS['state']['oz_hidden'] && !$player['oz']) || !$GLOBALS['state']['oz_hidden'])
                {
                  $now = date("U");
                  $starve_time = $player['zombie_feed_timer'] + ZOMBIE_MAX_FEED_TIMER;
                  $hours_left = ceil(($starve_time - $now) / (60*60));
                  $kills = $player['zombie_kills'];
                  
                  echo "<option value='{$player['uid']}'>{$player['name']} ($hours_left hours left, $kills tags)</option>";
                }
              }
            }
          }       
        ?>
      </select>
    </div>
    </div>
<div class="clearfix"></div>
    <div class="reportakill_row">
      <div class="reportakill_label">
        Hours to give:
      </div>
    <div class="reportakill_form">
      <input type="text" name="feed1_time" id="feed1_time" value = "48" class="reportakill_form_input" data-parsley-type="digits" data-parsley-group="step3" required>  
    </div>
  </div>
<div class="clearfix"></div>
  <div class="reportakill_row">
    <span class="next btn btn-info pull-left" data-current-block="3" data-next-block="2">&lt; Previous</span>
    <span class="next btn btn-info pull-right" data-current-block="3" data-next-block="4">Next &gt;</span>
  </div>
<div class="clearfix"></div>
 </div>
    <div class ="step4 hidden">
  <div class="reportakill_row">
    <div class="reportakill_label">Time Remaining: <a id="time3">??</a> hours</div>
  </div>
  <div class="clearfix"></div>
    <div class ="reportakill_row">
      <div class="reportakill_label">
      Zombie to Feed (#2):
      </div>

      <div class="reportakill_form">
      <select name="feed2" class="reportakill_form_select">
        <?php
          if (is_array($playerArray))
          {
            foreach ($playerArray as $player)
            {
              if ($player['status'] == 'zombie' && $player['uid'] != $_SESSION['uid'] && !$player['share_optout'])
              {
                if (($GLOBALS['state']['oz_hidden'] && !$player['oz']) || !$GLOBALS['state']['oz_hidden'])
                {
                  $now = date("U");
                  $starve_time = $player['zombie_feed_timer'] + ZOMBIE_MAX_FEED_TIMER;
                  $hours_left = ceil(($starve_time - $now) / (60*60));
                  $kills = $player['zombie_kills'];

                  echo "<option value='{$player['uid']}'>{$player['name']} ($hours_left hours left, $kills tags)</option>";
                }
              }
            }
          }
        ?>
      </select>

 
    </div>
    <div class="clearfix"></div>
    <div class="reportakill_row">
      <div class="reportakill_label">(They will recieve all remaining time)</div>
    </div>
    <div class="clearfix"></div>
  </div>
  
  <div class="reportakill_row">
    <span class="next btn btn-info pull-left" data-current-block="4" data-next-block="3">&lt; Previous</span>
    <input type="submit" value="Report Tag" class="btn btn-default pull-right" />
    <div class="clearfix"></div>
  </div>
  </div> 
</form>
<script type="text/javascript">
$(document).ready(function () {
  $('.next').on('click', function () {
    var current = $(this).data('currentBlock'),
      next = $(this).data('nextBlock');

    // only validate going forward. If current group is invalid, do not go further
    // .parsley().validate() returns validation result AND show errors
    if (next > current)
      if (false === $('#reportakill').parsley().validate('block' + current))
        return;

    // validation was ok. We can go on next step.
    $('.block' + current)
      .removeClass('show')
      .addClass('hidden');

    $('.block' + next)
      .removeClass('hidden')
      .addClass('show');

  });`
});
</script>
