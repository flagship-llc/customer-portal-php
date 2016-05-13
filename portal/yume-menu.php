
        <div class="container text-center nav-area sp-no-padding">
          <div class="menu-wrap"> 
            <ul id="g-menu" class="add_menu">

              <li class="hidden-xs center-logo"><a href="https://tokyotreat.com/" target="_blank" rel="nofollow"></a></li>
              
              <li class="link-p">
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