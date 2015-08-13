<!DOCTYPE html>
<html>
<head>
    <title>Phalcon Skeleton</title>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    {{ stylesheet_link('css/bootstrap/bootstrap.min.css') }}
    {{ javascript_include('js/jquery/jquery.min.js') }}
    {{ javascript_include('js/bootstrap/bootstrap.min.js') }}
</head>
<body>
{{ flash.output() }}<br>
<?php echo $this->getContent(); ?>
</body>
</html>