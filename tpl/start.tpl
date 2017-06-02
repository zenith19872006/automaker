<!doctype html>
<html>
<head>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0,user-scalable=no, minimal-ui"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="format-detection" content="telephone=no">
    <meta content="no" name="apple-mobile-web-app-capable">
    <meta content="black" name="apple-mobile-web-app-status-bar-style">
    <meta content="must-revalidate,no-cache" http-equiv="Cache-Control">

    <link rel="stylesheet" href="../common/css/common.css?20170330" />

    <style type="text/css">
    <?php if($type=='books' && $info['direction']){?>

            #book{
                position: absolute;
                transform:rotate(90deg);
                -ms-transform:rotate(90deg); 	/* IE 9 */
                -moz-transform:rotate(90deg); 	/* Firefox */
                -webkit-transform:rotate(90deg); /* Safari 和 Chrome */
                -o-transform:rotate(90deg); 	/* Opera */
            }
    <?php } ?>


    <?php if($type=='photos'){?>
        img{
        z-index:2;
        position: absolute;}
    <?php }?>
    </style>
    
</head>

<body>

