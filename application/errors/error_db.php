<html>
    
    <head>
        <title>CAE OAA Applications</title>
        <link href="<?php echo css_path(); ?>/style.css" type="text/css" rel="stylesheet" />
    </head>
    
<body>
    
    <div id="header">
        <div id="header_login">

        </div> 
    </div>
    
    
    
    <div id="menu"><?php
        echo anchor('home', 'Home').' | ';
        echo anchor('test', 'Test').' | ';
        echo anchor('user/register', 'Register').' | ';
        echo anchor('easyjet_page_1', 'Easyjet').' | ';
    ?></div>
    
    <div id="content">

        <h1><?php echo $heading; ?></h1>
	<?php echo $message; ?>
        
    </div> <!-- #content -->

<div id="footer"><div id="copyright">&amp;copy CAE Oxford Aviation Academy 2014</div></div>

</body>
</html>