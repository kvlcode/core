<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <style type="text/css">
      .menu{
        display: table;
        text-align: center;
        width: 100%;
        overflow: hidden;
        background-color: gray;
      }
      .nav{
        color: #f2f2f2;
        display: inline-block;
        font-size: 25px;
        padding: 10px 30px;
        text-decoration: none;
        font-weight: bold;
      }


    </style>
</head>
<body style="margin: 0; padding: 0;">
  <div class="menu">
    <?php 
      $file =glob("View/*_grid.php");
      foreach ($file as $value):
          $fileName = substr($value, 5,-9);?>
          <a class="nav" href="index.php?a=grid&c=<?php echo $fileName?>"><?php echo $fileName;?></a>
      <?php endforeach; ?> 
  </div>

    <br>
</body>
</html>
