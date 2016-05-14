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


<script type="text/javascript">
setTimeout(function(){var a=document.createElement("script");
var b=document.getElementsByTagName("script")[0];
a.src=document.location.protocol+"//script.crazyegg.com/pages/scripts/0042/6966.js?"+Math.floor(new Date().getTime()/3600000);
a.async=true;a.type="text/javascript";b.parentNode.insertBefore(a,b)}, 1);
</script>
<script type="text/javascript">
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','__gaTracker');
  __gaTracker('create', 'UA-60081243-3', 'auto');
  __gaTracker('set', 'forceSSL', true);
  __gaTracker('require', 'displayfeatures');
  __gaTracker('send','pageview');
</script>

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
            <?php if($yume){?>
            <a href="https://yumetwins.com/"></a>
            <?php } else{ ?>
            <a href="https://tokyotreat.com/"></a>
            <?php }?>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <div data-cb-jshook="attach-account-dropdown" class="navbar-collapse collapse" style="height: auto;">
              <ul class="nav navbar-nav navbar-right">
                <li class="visible-xs">
                  <a href="switch_account.php">Switch Account</a>
                </li>
                <li class="visible-xs">
                  <a href="<?php echo getChangePasswordUrl($configData); ?>">Change Password</a>
                </li>
                <li class="visible-xs">
                  <a href="<?php echo getLogoutUrl($configData); ?>">Logout</a>
                </li>

                <li class="dropdown hidden-xs">
                  <a href="" class="dropdown-toggle" data-toggle="dropdown">
                    <span class="glyphicon glyphicon-user"></span>
                    Your Account
                    <b class="caret"></b>
                  </a>
                  <ul class="dropdown-menu">
                    <li class="">
                      <a href="/switch_account.php">Switch Account</a>
                    </li>
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

