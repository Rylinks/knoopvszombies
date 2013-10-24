<div id="signup_title">
  Sign up <span class="accent_color">agree to our code of conduct</span>
  </div>

  <?php if (isset($_GET['state'])): ?>
  <div id="signup_status">
    <?php
      switch ($_GET['state'])
      {    
        
        // this should be short circuited... but if not show an error
        case 'agree':
          echo 'There was an error saving your agreement. Please try again.';
        break;
                
        case 'slowdown':
          echo 'Please wait a few minutes before requesting another confirmation email. Check your email and try again in about 5 minutes.';
        break;
          
        default:
          echo 'An unknown error occured. Please try again.';
        break;
      }
    ?>
  </div>
  <?php endif ?>
    
  <div class="signup_body_text">
  OSUndead Code of Coduct
  </div>

  <div class="signup_body_text">
  1 . By signing up for the Humans vs. Zombies game, I agree to act in accordance with all laws (local, state
  and federal), and to act within the Oregon State code of conduct.
  </div>

  <div class="signup_body_text">
  2. By signing up for the Humans vs. Zombies game, I agree to take no action which would cause myself
  or others bodily harm, or result in the loss, damage, or destruction of property.
  </div>

  <div class="signup_body_text">
  3. By signing up for the Humans vs. Zombies game, I acknowledge that ignorance of these policies is not
  an excuse for noncompliance, and take responsibility for knowing the code of conduct.
  </div>

  <div class="signup_body_text">
  4. By signing up for the Humans vs. Zombies game, I understand that if I violate any laws (local, state or
  federal) or the OSU code of conduct as part of my participation in the Humans vs. Zombies game, I will
  likely be removed from the game and may be reported to Public Safety.
  </div>

  <div class="signup_body_text">
  5. By signing up for the Humans vs. Zombies game, I agree to forgo the use of an automobile for
  purposes related to Humans vs. Zombies game. Use of a car will result in removal
  from the game.
  </div>

  <div class="signup_body_text">
  6. By signing up for the Humans vs. Zombies game, I agree to demonstrate respect for all players and
  non-players alike. I understand that discharging a Nerf-style toy at a non-player is grounds for removal
  from the game.
  </div>

  <div class="signup_body_text">
  7. By signing up for the Humans vs. Zombies game, I agree not to display Nerf-style toys in academic
  buildings or use Nerf-style toys which resemble real weapons. I understand that displaying a Nerf-style
  toy in an academic building, or using a Nerf-style toy which resembles a real weapon is grounds for
  removal from the game. Interpretation of �resembling real weapons� is left to the discretion of the
  moderators. Complaints about realistic-looking Nerf-style toys made by a non-player arc grounds for the
  toy in question to be banned. Nerf-style toys must have a visible blaze-orange tip.
  </div>

  <div class="signup_body_text">
  8. By signing up for the Humans vs. Zombies game, I agree to leave my building in an evacuation
  situation such as a fire alarm. I understand that the area I evacuate to is temporarily a safe zone for the
  duration of the evacuation, and that I cannot be tagged (or tag another player) while going to or returning
  from the evacuation area.
  </div>

  <div class="signup_body_text">
  9. By signing up for the Humans vs. Zombies game, I agree to wear the provided appropriate identifying markers as a player of Humans vs. Zombies (provided armband for humans, headband for zombies). I understand that I must wear these identifying markers at all times while participating in the game, except in circumstances where a uniform, etc. is required of me, and that I may not participate in the game at these times. I understand that I may not participate in the game except when clearly identified as a player using the provided markers. I understand that participating in the game while not clearly identified, especially (but not limited to) when tagging or using/carrying a Nerf-style toy is strictly prohibited, and that violation of this rule will result in immediate removal of the game. I understand that any violation of this rule is mine and not the responsibility of others affiliated with the Humans vs. Zombies game, and agree to accept full responsibility for my actions.
  </div>

  <div id="signup_conduct_agree_container">

  <div id="signup_conduct_agree_text">
      To continue you must agree to our Code of Conduct.
  </div>

  <div id="signup_conduct_agree_button_container">
    <span class="signup_box_button">
      <a class="signup_box_button_link" href="http://<?php echo DOMAIN; ?>/signup/3/agree">I Agree</a>
    </span>
  </div>
  
  <div class="clearfix"></div>
</div>
