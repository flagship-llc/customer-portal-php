        <footer id="footer">

        <?php if($yume){
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