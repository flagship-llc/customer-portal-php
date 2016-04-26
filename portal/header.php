<?php
include_once('init.php');
$subscription = $servicePortal->getSubscription();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Customer Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <link rel="shortcut icon" href="https://d3hmlbpz653lq.cloudfront.net/wp-content/themes/tokyotreat-wp/images/favicon.ico">
    
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/portal.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
</head>
<body>
  <div id="page" class="hfeed site">
    <header id="masthead" class="site-header scroll" role="banner">
      <nav role="navigation">
        <div class="sp-logo visible-xs">
          <a href="https://tokyotreat.com/"></a>
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <div data-cb-jshook="attach-account-dropdown" class="navbar-collapse collapse" style="height: auto;">
            <ul class="nav navbar-nav navbar-right">
              <li class="visible-xs">
                <a href="/portal/switch_account.php">Switch Account</a>
              </li>
              <li class="visible-xs">
                <a href="/portal/change_password">Change Password</a>
              </li>
              <li class="visible-xs">
                <a href="/portal/logout">Logout</a>
              </li>

              <li class="dropdown hidden-xs">
                <a href="" class="dropdown-toggle" data-toggle="dropdown">
                  <span class="glyphicon glyphicon-user"></span>
                  Your Account
                  <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                  <li class="">
                    <a href="/portal/switch_account.php">Switch Account</a>
                  </li>
                  <li class="">
                    <a href="/portal/change_password">Change Password</a>
                  </li>
                  <li class="">
                    <a href=<?php echo getLogoutUrl($configData); ?>>Logout</a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </div>

        <div class="container text-center nav-area sp-no-padding">
          <div class="menu-wrap"> 
            <ul id="g-menu" class="add_menu">
              <li><a href="https://tokyotreat.com/about/" target="_blank" rel="nofollow">ABOUT</a></li>
              <li><a href="https://tokyotreat.com/treats/" target="_blank" rel="nofollow">TREATS</a></li>
              <li><a href="https://tokyotreat.com/subscribe/" target="_blank" rel="nofollow">PRICING</a></li>
              <li class="hidden-xs center-logo"><a href="https://tokyotreat.com/" target="_blank" rel="nofollow"></a></li>
              <li><a href="http://help.tokyotreat.com/hc/en-us" target="_blank" rel="nofollow">FAQ</a></li>
              <li class="hidden-xs"><a href="https://tokyotreat.com/community/" target="_blank" rel="nofollow">COMMUNITY</a></li>
              <li>
                <div data-cb-jshook="attach-account-dropdown" class="navbar-collapse collapse">
                  <ul class="nav navbar-nav navbar-right">
                    <?php if($account_count > 1 ):?>
                    <li class="visible-xs">
                      <a href="switch_account.php">Switch Account</a>
                    </li>
                    <?php endif; ?>
                    <li class="visible-xs">
                      <a href=<?php echo getChangePasswordUrl($configData); ?>>Change Password</a>
                    </li>
                    <li class="visible-xs">
                      <a href=<?php echo getLogoutUrl($configData); ?>>Logout</a>
                    </li>
                    <li class="dropdown hidden-xs">
                      <a href="" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-user"></span>
                        Your Account
                        <b class="caret"></b>
                      </a>
                      <ul class="dropdown-menu">
                        <?php if($account_count > 1 ):?>
                        <li class="">
                          <a href="switch_account.php">Switch Account</a>
                        </li>
                        <?php endif;?>
                        <li class="">
                          <a href=<?php echo getChangePasswordUrl($configData); ?>>Change Password</a>
                        </li>
                        <li class="">
                          <a href=<?php echo getLogoutUrl($configData); ?>>Logout</a>
                        </li>
                      </ul>
                    </li>
                  </ul>
                </div> 
              </li>
            </ul>
          </div>
        </div>
      </nav><!-- #site-navigation -->
    </header><!-- #masthead -->
  </div>




