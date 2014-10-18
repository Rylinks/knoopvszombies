<?php

  $page_title = 'Change Picture';
  $require_login = true;
  
  require '../knoopvszombies.ini.php';
  
  require 'module/includes.php';
  
  require 'module/general.php';
  
  $user = $GLOBALS['User']->GetUserFromGame($_SESSION['uid']);

  if (isset($_POST['action']) && $_POST['action'] == 'toggle' && 
                 (!$GLOBALS['state'] || !$GLOBALS['state']['active'] || $user['share_optout']) &&
                  !$GLOBALS['state']['archive']){

    $GLOBALS['Game']->ToggleFeedOpt($GLOBALS['state']['gid'], $_SESSION['uid']); 
    header("Location: //".DOMAIN."/account");
  } 
?>

<!DOCTYPE html>


<html>

<head>
  <?php
    require 'module/html_head.php';
  ?>
  
  <link href="//<?php echo DOMAIN; ?>/css/page/squad.css" rel="stylesheet" type="text/css"/>
  
</head>

<body>

  <div id="body_container">
  
    <?php
      require 'module/header.php';
    ?>
    
    <div class="content_column">
      <div id="content">
      
        <div id="content_top_border">

            <?php
              require 'module/body_header.php';
            ?>
    
        </div>

        <div id="body_content">

          <div id="squad_container">
          
            <div class="squad_title">
              Change your <span class="accent_color">Feedsharing Options</span>
            </div>

            <div class="squad_header">
              <p>Change whether other people are able to share feeds with you. After the game starts, you can only switch from not accepting feeds to accepting feeds. You are always able to share your own kills with others.
            </div>
            
            <div class="squad_content">
            <?php if((!$GLOBALS['state'] || !$GLOBALS['state']['active'] || $user['share_optout']) && 
                  !$GLOBALS['state']['archive']): ?> 

             <form id="squad" name="changepicture" action="//<?php echo DOMAIN; ?>/togglefeed" method="POST" enctype="multipart/form-data">

              <div class="squad_row">
                          
                <div class="squad_form">
                    <input type="hidden" name= "action" id="hiddenField" value="toggle"/>
                    <input type="submit" value="Toggle feedsharing" class="squad_form_submit" />
                </div>
                <div class="clearfix"></div>
              </div>
               
            </form>
            <?php else: ?>
              You cannot opt out of feedshares once the game has begun
            <?php endif; ?>

            </div></div>
            </div>
          
          </div> <!-- body_container -->
          
          <div class="clearfix"></div>
          
        </div> <!-- body_content -->     
        

      </div> <!-- content -->
    </div>  <!-- content_column -->
    
    
    <div id="footer_push"></div>
  </div> <!-- body_container -->

  <?php
    require 'module/footer.php';
  ?>


</body>


</html>
