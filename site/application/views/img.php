<!doctype html>
<html lang="en">
<head>
     <meta charset="utf-8" />
     <title>View Image: <?php echo $title; ?></title>
     
     <meta name="description" content="Image view including long description; provided by Easy Chirp." />
     <meta name="author" content="Easy Chirp | http://www.EasyChirp.com | @EasyChirp" />
     <meta name="viewport" content="width=device-width, initial-scale=1" />
     <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

     <link rel="shortcut icon" href="/images/brand/favicon.ico"/>
     <link rel="stylesheet" href="/include/css/general.css" />
     <style type="text/css">
     h1 {
          margin-bottom: .5em;
     }
     img[longdesc] {
          margin-left: .75em;
          max-width: 1000px;
          height: auto;
     }
     footer p {
          margin-bottom: .25em;
          border-top: 3px solid #ccc;
     }
     </style>
</head>

<body class="theme-default">

<div id="wrapper">

     <header role="banner">
          <h1 class="rounded">View Image: <?php echo $title; ?></h1>
     </header>

     <main role="main">
          <div><img src="<?php echo $url; ?>" alt="<?php echo $title; ?>" longdesc="<?php echo $longdescUri; ?>" /></div>
          <!-- <div>
               <p><?php echo $title; ?></p>
               <p><?php echo $longdesc; ?></p>
               <a href="<?php echo $longdescUri; ?>">KDLKF</a>
          </div> -->
     </main>

     <footer role="contentinfo">
          <p>Brought to you by <a href="http://www.easychirp.com">Easy Chirp</a> | <a href="http://twitter.com/easychirp">@EasyChirp</a></p>
          <div><img src="/images/brand/easy_chirp_icon1.png" width="48" height="48" alt="logo" /></div>
     </footer>

</div>

</body>
</html>