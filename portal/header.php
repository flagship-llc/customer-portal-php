<?php
include_once('init.php');
$subscription = $servicePortal->getSubscription();
include_once('brand-switch.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Customer Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <link rel="shortcut icon" href="https://d3hmlbpz653lq.cloudfront.net/wp-content/themes/tokyotreat-wp/images/favicon.ico">
    
    <link rel="stylesheet" type="text/css" href="assets/css/portal.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="stylesheets/mystyles.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <?php if($now_url){ ?>
      <link rel="stylesheet" type="text/css" href="stylesheets/common-theme.css">
    <?php }elseif($yume){ ?>
      <link rel="stylesheet" type="text/css" href="stylesheets/yume-theme.css">
    <?php }?>
</head>

<?php if($yume){ ?>
<body id="yume">
<?php }else{ ?>
<body>
<?php }?>
  <div id="page" class="hfeed site">
    <header id="masthead" class="site-header scroll" role="banner">
      <nav role="navigation">
        <?php if($now_url){?>
          <div class="sp-logo visible-xs">
            <ul class="row clearfix">
              <li class="col-xs-6 col-xs-push-1 text-center"><a href="https://tokyotreat.com"><img src="assets/images/logo.png" alt="TokyoTreat"></a></li>
              <li class="col-xs-4 col-xs-push-1 text-center"><a href="https://yumetwins.com"><img src="assets/images/yume/yume-logo.png" alt="YumeTwins"></a></li>
            </ul>
          </div>
        <?php }else{?>
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
        <?php } ?>
        <?php if($now_url){
          include('common-menu.php');
        }elseif($yume){
          include('yume-menu.php');
        }else{
          include('menu.php');
        } ?>
      </nav><!-- #site-navigation -->
    </header><!-- #masthead -->
  </div>

