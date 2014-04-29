<!doctype html>
<html lang="en">
<head>
     <meta charset="utf-8" />
     <title>Help | Add Image | Easy Chirp</title>
     
     <meta name="description" content="Image view including long description; provided by Easy Chirp." />
     <meta name="author" content="Easy Chirp | http://www.EasyChirp.com | @EasyChirp" />
     <meta name="viewport" content="width=device-width, initial-scale=1" />
     <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

     <link rel="shortcut icon" href="/images/brand/favicon.ico"/>
     <link rel="stylesheet" href="/include/css/general.css" />
     <style type="text/css">
     #wrapper {
          width: 85%;
          max-width: 900px;
     }
     main {
          padding: 1em;
     }
     footer {
          padding-top: 1.5em;
     }
     footer p {
          margin-bottom: .25em;
          border-top: 2px solid #ccc;
     }
     @media only screen and (max-width: 640px) {
          #wrapper {
               width: 93%;
          }
     }
     </style>
</head>

<body class="theme-default">

<div id="wrapper">

     <header role="banner">
          <h1 class="rounded">Help | Add Image</h1>
     </header>

     <main role="main">
          <h2>Short Description</h2>
          <p>Enter a brief text description for the image. This will be used as a title and an alt attribute on the image. A general suggestion is 5 to 12 words.</p>

          <h2>Long Description</h2>
          <p>Enter a longer, detailed text description for the image.
               This will be used to provide to a longdesc attribute on the resulting page which is valuable to people with visual impairments. 
               For help on writing a long description, check out <a href="http://www.d.umn.edu/itss/training/online/images/long_how/">How to Write Long Text Alternatives</a>.
          </p>
          <p>Do not enter a URL in this input field; the longdesc value is provided by Easy Chirp via a dataURI. 
               For technical details, view the W3C's <a href="http://www.w3.org/TR/html-longdesc/">HTML5 Image Description Extension</a>.
          </p>

          <h2>Limitations</h2>
          <ul>
               <li>For the long description, you can only enter text; structured markup (HTML) is not supported by this tool.</li>
               <li>After submitting an image the content is not editable. 
                    To get around this, use the Imgur service directly; you can edit the descriptions if you're logged in. 
                    Steps: 
                    <ol>
                         <li>Log into <a href="http://imgur.com/" target="_blank">Imgur.com</a>.</li>
                         <li>Upload an image with proper descriptions.</li>
                         <li>Append the image's unique ID to &quot;http://easychirp.com/img/&quot;. For example: http://easychirp.com/img/AkoGysu</li>
                         <li>Copy into a tweet. Magic!</li>
                         <li>To edit, view the image while logged in Imgur and click the options dropdown.</li>
                    </ol>
               </li>
          </ul>

          <?php /* <h2>More</h2>
          <ul>
               <li><a href="http://www.w3.org/TR/html-longdesc/">HTML5 Image Description Extension (longdesc)</a></li>
               <li><a href="http://www.d.umn.edu/itss/training/online/images/long_how/">How to Write Long Text Alternatives</a></li>
               <li><a href="http://www.d.umn.edu/~lcarlson/research/ld.html">Longdesc examples in the wild</a></li>
          </ul> -->

         <!--  <h2>The Result</h2>
          <p>Once you've uploaded an image, a URL will be displayed on the page and also entered in the tweet.
               The URL points to a page hosted by Easy Chirp which displays a page with the image and the descriptions.</p> */ ?>
     </main>

     <footer role="contentinfo">
          <p>Brought to you by <a href="http://www.easychirp.com">Easy Chirp</a> | <a href="http://twitter.com/easychirp">@EasyChirp</a></p>
          <div><img src="/images/brand/easy_chirp_icon1.png" width="48" height="48" alt="logo" /></div>
     </footer>

</div>

</body>
</html>