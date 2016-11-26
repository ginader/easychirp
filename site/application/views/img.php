<!doctype html>
<html lang="en">
<head>
     <meta charset="utf-8" />
     <title><?php echo $title; ?> | View Image | Easy Chirp</title>
     
     <meta name="description" content="Image view including long description; provided by Easy Chirp." />
     <meta name="author" content="Easy Chirp | http://www.EasyChirp.com | @EasyChirp" />
     <meta name="viewport" content="width=device-width, initial-scale=1" />
     <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

     <link rel="shortcut icon" href="/images/brand/favicon.ico"/>
     <link rel="stylesheet" href="/include/css/general.css" />
     <style type="text/css">
     h1 {
          margin-bottom: .5em;
          font-weight: normal;
     }
     #main img,
     #main p {
          margin-left: .25em;
     }
     img[longdesc] {
          max-width: 1000px;
          height: auto;
          margin-bottom: 1em;
     }
     #footer {
          margin-top: 1.5em;
          padding-top: 1em;
          border-top: 2px solid #ccc;
     }
     footer p {
          font-size: .9rem;
          line-height: 1.1rem;
     }
     @media only screen and (max-width: 640px) {
          img[longdesc] {
               width: 90%;
          }
     }
     </style>
</head>

<body class="theme-default">

<div id="wrapper">

     <header role="banner">
          <?php /* <h1 class="rounded"><span class="hide">View Image</span> <span aria-hidden="true"><?php echo $title; ?></span></h1> */ ?>
          <h1 class="rounded"><?php echo $title; ?></h1>
     </header>

     <main id="main" role="main">

          <div>
          <?php
           echo '<img src="' . $url . '" ';
           echo 'alt="' . $title . '" ';
           if ($isLongDesc) {
               echo 'longdesc="' . $longdescUri . '" ';
           }
           echo '/>';
          ?>
          </div>

          <?php /* <p><a href="<?php echo $urlImgur; ?>" rel="noopener" target="_blank">View image on Imgur</a></p> */ ?>

          <?php
           if ($isLongDesc) {
               //echo '<p><a href="' . $longdescUri . '">image description</a></p>';
               echo '<p>Image description: ' . $imgDesc . '</p>';
           }
          ?>

     </main>

     <footer id="footer" role="contentinfo">
          <p>This page is designed to provide an <a href="http://webaim.org/techniques/alttext/" rel="noopener" target="_blank">accessible image</a>.</p>
          <p>Note that the longdesc image attribute on this page (if content is provided) targets a data URI which IE does not yet support.</p>
          <p>Brought to you by <a href="http://www.easychirp.com">Easy Chirp</a> (<a href="http://twitter.com/easychirp">@EasyChirp</a>) 
            and the <a href="http://www.Imgur.com" rel="noopener" target="_blank">Imgur</a> photo service.</p>
          <div><img src="/images/brand/easy_chirp_icon1.png" width="48" height="48" alt="Easy Chirp icon" /></div>
     </footer>

</div>

</body>
</html>