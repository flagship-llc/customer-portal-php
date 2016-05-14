            <footer id="footer">

        <?php if($now_url){?>

        <div class="container text-center orange footer-copyright-area">
            <div class="footer-menu">
                <ul class="text-bold">
                    <li><a href="https://tokyotreat.com/privacy-policy/" target="_blank">Privacy Policy</a></li>
                    <li><a href="https://tokyotreat.com/terms-of-service/" target="_blank">Terms of Service</a></li>
                </ul>
            </div>

            <div class="copyright col-xs-12">Copyright © 2016 TOKYOTREAT. All Rights Reserved.</div>
        </div>
        <?php }elseif($yume){
          include('yume-footer.php');
        }else{
          include('footer-menu.php');
        } ?>

        </footer>
        
        <!-- jQuery 2.1.4 -->
	    <script type="text/javascript" src="http://malsup.github.io/jquery.form.js"></script>
	    <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js"></script>
        <!-- Bootstrap 3.3.5 -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.1.0/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.cookie.js"></script>
        <script src="assets/js/application.js"></script>
    </body>
</html>