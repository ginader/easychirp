<?php
/**
* HTML for the Articles page
*
* @package EasyChirp
* @subpackage Views
*/

?>
<h1 class="rounded"><?php echo $xliff_reader->get('articles-h1'); ?></h1>

<div class="p-row-r">
	<div class="p-col-1-2">

<div class="box1 rounded">
	<h2><?php echo $xliff_reader->get('articles-h2-books'); ?></h2>

	<h3>A Web For Everyone</h3>
	<p><img src="/images/a-web-for-everyone.png" alt="<?php echo $xliff_reader->get('articles-book-cover'); ?>" width="80" height="120" class="fl" style="margin-right:.35em;" /> 
		<?php echo $xliff_reader->get('articles-books-webforeveryone'); ?></p>
	
	<h3 class="clear">The Twitter Book</h3>
	<p><img src="/images/the_twitter_book.jpg" alt="<?php echo $xliff_reader->get('articles-book-cover'); ?>" width="100" height="75" class="fl" style="margin-right:.35em;" /> 
		<?php echo $xliff_reader->get('articles-books-thetwitter'); ?></p>
	
	<h3 class="clear">N&auml;in k&auml;yt&auml;t Twitteri&auml; (How to Use Twitter)</h3>
	<p class="clearfix"><img src="/images/twitter-kirja.jpg" width="69" height="94" alt="<?php echo $xliff_reader->get('articles-book-cover'); ?>" class="fl" style="margin-right:.35em;" /> 
		<?php echo $xliff_reader->get('articles-books-finnish'); ?></p>
</div>

<div class="box1 rounded">
	<h2><?php echo $xliff_reader->get('articles-h2-wikis'); ?></h2>

	<h3>Wikipedia</h3>
	<p><a href="http://en.wikipedia.org/wiki/Easy_Chirp">Easy Chirp on Wikipedia</a></p>
	<p><a href="http://en.wikipedia.org/wiki/List_of_Twitter_services_and_applications">List of Twitter Services and Applications</a></p>

	<h3>Twitter Fan Wiki</h3>
	<p><a href="http://twitter.pbworks.com/w/page/1779855/MultiPlatformApps">Apps/MultiPlatformApps</a></p>

	<h3>MozillaWiki</h3>
	<p><a href="https://wiki.mozilla.org/Accessibility/Social#Alternative_Options_and_Info_for_Users">Accessibility/Social</a></p>

	<h3>W3C Wiki: Social Web</h3>
	<p><a href="http://www.w3.org/WAI/PF/wiki/Social_Web#Twitter_API_Clients_Used_by_Persons_With_Disabilities">Twitter API Clients Used by Persons With Disabilities</a></p>

	<h3>Emergency 2.0 Wiki</h3>
	<p><a href="http://emergency20wiki.org/wiki/index.php/Accessibility_Toolkit">Accessibility Toolkit</a></p>
</div>

<div class="box1 rounded">
	<h2><?php echo $xliff_reader->get('articles-h2-user'); ?></h2>

	<?php 
	if ($favorites) {
		echo $favorites;
	}
	?>

	<p>Tweets about Easy Chirp are archived via <a href="https://twitter.com/EasyChirp/favorites" rel="noopener noreferrer" target="_blank">Easy Chirp's Twitter favorites</a>.</p>
</div>

	</div>
	<div class="p-col-1-2">

<div class="box1 rounded article_mentions">
	<h2><?php echo $xliff_reader->get('articles-h2-blogs'); ?></h2>
	<h3><?php echo $xliff_reader->get('articles-h3-highlights'); ?></h3>
	<dl>
	<dt><a href="https://www.marcozehe.de/2015/02/21/social-networks-and-accessibility-a-rather-sad-picture/">Social networks and accessibility: A not so sad picture</a></dt>
		<dd>Marco Zehe</dd>
		<dd>2015 Feb 21</dd>
	<dt><a href="http://accessibleinsights.info/blog/2013/10/29/easy-chirp-returns-with-new-sporty-features-and-more-power-under-the-hood/">Easy Chirp returns with new sporty features and more power under the hood</a></dt>
		<dd>Accessible Insights Blog</dd>
		<dd>2013 Oct 29</dd>
	<dt><a href="http://www.nomensa.com/blog/2010/accessible-twitter-advancement-through-technology/">Accessible Twitter: Advancement through technology</a></dt>
		<dd>Nomensa, L&eacute;onie Watson</dd>
		<dd>2010 Feb 10</dd>
	<dt><a href="http://rivendellbrewery.wordpress.com/2009/07/31/accessible-twitter/">Accessible Twitter: how it should have been done to start with</a></dt>
		<dd>Andy Bryant</dd>
		<dd>2009 Jul 31</dd>
	</dl>
	<h3><?php echo $xliff_reader->get('articles-h3-more'); ?></h3>
	<dl>
	<dt><a href="https://werwoelfchenstestecke.blogspot.com/2017/12/vom-sinn-eines-accessible-twitter.html">Vom Sinn eines accessible Twitter clients</a></dt>
		<dd><a href="http://translate.google.com/translate?hl=en&amp;sl=auto&amp;tl=en&amp;u=https%3A%2F%2Fwerwoelfchenstestecke.blogspot.com%2F2017%2F12%2Fvom-sinn-eines-accessible-twitter.html&amp;sandbox=1">German to English translation</a> by Google</dd>
		<dd>Werwoelfchens Blog</dd>
		<dd>2017 Dec 09</dd>
	<dt><a href="https://blog.twitter.com/2016/alt-text-support-for-twitter-cards-and-the-rest-api">Alt text support for Twitter Cards and the REST API</a></dt>
		<dd>Twitter Blog</dd>
		<dd>2016 Mar 29</dd>
	<dt><a href="https://abilitynet.org.uk/blog/brief-history-accessibility-twitter-ten-tweets-mark-twitters-10th-birthday">A brief history of accessibility on Twitter in ten tweets to mark Twitter's 10th birthday</a></dt>
		<dd>AbilityNet</dd>
		<dd>2016 Mar 21</dd>
	<dt><a href="http://yinwahkreher.com/2015/11/08/screenreaders-twitter-and-ocr/">Screenreaders, Twitter and OCR</a></dt>
		<dd>Yin Wah Kreher</dd>
		<dd>2015 Nov 08</dd>
	<dt><a href="http://www.equipmentlink.org/blog/?p=3228">Easy Chirp, an accessible Twitter alternative</a></dt>
		<dd>Where It's AT – Assistive Technology Blog (Maryland Department of Disabilities)</dd>
		<dd>2015 Oct 21</dd>
	<dt><a href="http://www.chooseworkttw.net/blog/easy-chirp-technology-how-people-with-visual-impairments-can-now-access-twitter">Easy Chirp Technology: How People with Visual Impairments Can Now Access Twitter</a></dt>
		<dd>Ticket to Work (US gov)</dd>
		<dd>2015 Aug 12</dd>
	<dt><a href="http://www.paciellogroup.com/blog/2015/01/notes-on-providing-alt-text-for-twitter-images/">Notes on providing alt text for twitter images</a></dt>
		<dd>The Paciello Group blog</dd>
		<dd>2015 Jan 02</dd>
	<dt><a href="http://blog.adrianroselli.com/2014/12/dont-tweet-pictures-of-text.html">Don't Tweet Pictures of Text</a></dt>
		<dd>Adrian Roselli</dd>
		<dd>2014 Dec 21</dd>
	<dt><a href="http://fedscoop.com/social-media-accessibility/">Anti-social: Feds wonder why social media companies drag feet on accessibility issues</a></dt>
		<dd>FedScoop</dd>
		<dd>2014 July 17</dd>
	<dt><a href="http://networkedblogs.com/X61we">Highlight an App – Easy Chirp</a></dt>
		<dd>Student Affairs Women Talk Tech</dd>
		<dd>2014 May 22</dd>
	<dt><a href="http://poslepu.blogspot.cz/2013/10/easy-chirp-pristupna-alternativa.html">Easy Chirp: web-accessible alternative interface for Twitter [in Czech]</a></dt>
		<dd>Blindly, The blind users - web accessibility, assistive technology for disabled users</dd>
		<dd>2013 Oct 31</dd>
	</dt>
	<dt><a href="http://www.webable.tv/Events/m_enabling_summit_130606.aspx?VID=/webable/130604_SMD_EasyChirp.flv&amp;Cap=/WebAble/130604_SMD_EasyChirp.xml#anchor">Social Media and Disability Pilot Program Featuring Easy Chirp</a> (video)</dt>
		<dd>WebAble.tv</dd>
		<dd>2013 Jun 05</dd>
	<dt><a href="http://www.mediaaccess.org.au/latest_news/general/easy-chirp-seeks-funding-for-update">Easy Chirp seeks funding for update</a></dt>
		<dd>Media Access Australia</dd>
		<dd>2013 Apr 05</dd>
	<dt><a href="http://www.readbelowthefold.com/web-accessibility/got-accessibility-tips-for-social-media.html">Got Accessibility? Tips for Social Media</a></dt>
		<dd>Below The Fold</dd>
		<dd>2012 Oct 4</dd>
	<dt><a href="http://totalacesso.mundocegal.com.br/easy-chirp-twitter-acessivel-via-web/">Easy Chirp: Twitter Acess&iacute;vel Via Web!</a></dt>
		<dd>Total Acesso</dd>
		<dd>2012 Sep 10</dd>
	<dt><a href="http://preparednessforall.wordpress.com/2012/06/04/report-sociability-social-media-for-people-with-a-disability/">Report: Sociability, Social Media for People with a Disability</a></dt>
		<dd>Preparedness For All</dd>
		<dd>2012 Jun 04</dd>
	<dt><a href="https://www-304.ibm.com/connections/blogs/socialbusiness/entry/march_7_2012_3_03_pm3">Making Social Media More Accessible</a></dt>
		<dd>IBM Social Business Insights Blog</dd>
		<dd>2012 Mar 7</dd>
	<dt><a href="http://lowvisionbureau.com/blog/lvbpodcast/twitter-accessible-for-visually-impaired-people/">Twitter accessible for visually impaired people [podcast]</a></dt>
		<dd>LowVisionBureau</dd>
		<dd>2012 Jan 29</dd>
	<dt><a href="http://rscscotlandnewsfeed.blogspot.com/2011/10/easy-chirp-makes-tweeting-more.html">Easy Chirp makes tweeting more accessible</a></dt>
		<dd>Regional Support Centre Scotland</dd>
		<dd>2011 Oct 00</dd>
	<dt><a href="http://askjan.org/enews/2011/Enews-V9-I3.htm#7">Twitter: Tweet Me Accessible</a></dt>
		<dd>Job Accommodation Network</dd>
		<dd>2011, third quarter</dd>
	<dt><a href="http://techaccessweekly.com/dailytips/2011/07/06/ta-daily-tip-238-easychirp/">TA Daily Tip 238: @EasyChirp [podcast]</a></dt>
		<dd>Tech Access Weekly</dd>
		<dd>2011 Jul 06</dd>
	<dt><a href="http://atupdate.libsyn.com/at-update-7-1-11-google-app-accessibility-easy-chirp-yahoo-accessibility-channel-at-update-in-depth">Google App Accessibility, Easy Chirp, Yahoo Accessibility Channel, AT Update In-depth [podcast]</a></dt>
		<dd>Assistive Technology Update</dd>
		<dd>2011 Jul 01</dd>
	<dt><a href="http://mediaaccess.org.au/latest_news/general/accessible-twitter-changes-name-to-easy-chirp">Accessible Twitter Changes Name To Easy Chirp</a></dt>
		<dd>Media Access Australia</dd>
		<dd>2011 Jun 02</dd>
	<dt><a href="http://davebanesaccess.jigsy.com/entries/general/happy-birthday-twitter">Happy Birthday Twitter</a></dt>
		<dd>Dave Banes Access</dd>
		<dd>2011 Apr 08</dd>
	<dt><a href="http://www.uta.edu/huma/agger/fastcapitalism/7_1/elliskent7_1.html">Tweeters Take Responsibility for an Accessible Web 2.0</a></dt>
		<dd>Fast Capitalism</dd>
		<dd>2010 Jul 01</dd>
	<dt><a href="http://accessibleinsights.info/blog/2010/02/26/a-word-with-the-accessible-dennis-lembree-on-accessible-twitter/">A word with the accessible Dennis Lembree on Accessible Twitter</a></dt>
		<dd>Accessible Insights, Laura Legendary</dd>
		<dd>2010 Feb 26</dd>
	<dt><a href="http://sarahebourne.posterous.com/accessible-twitter-on-the-kindle">Accessible Twitter on the Kindle</a></dt>
		<dd>Sarah E. Bourne</dd>
		<dd>2010 Feb 25</dd>
	<dt><a href="http://www.blacktelephone.com/2010/02/contribute-to-twitter-presentation-at-csun10/">Contribute to Twitter Presentation at CSUN10</a></dt>
		<dd>Joseph Karr O'Connor</dd>
		<dd>2010 Feb 24</dd>
	<dt><a href="http://www.practicalecommerce.com/articles/1581-Accessibility-and-Social-Media">Accessibility and Social Media</a></dt>
		<dd>practical ecommerce, Joe Dolson</dd>
		<dd>2010 Jan 21</dd>
	<dt><a href="http://www.elearningcouncil.com/content/accessible-twitter">Accessible Twitter (from E-Learning Council)</a></dt>
		<dd>E-Learning Council</dd>
		<dd>2010 Jan 18</dd>
	<dt><a href="http://www.acljohn.com/inclusion/accessible-twitter">Accessible Twitter (from aclJohn's Inclusion Finds)</a></dt>
		<dd>aclJohn's Inclusion Finds</dd>
		<dd>2009 Dec 23</dd>
	<dt><a href="http://webkrauts.de/2009/12/05/zugaenglich-und-bequem-twittern/">Zugänglich – und bequem – twittern</a></dt>
		<dd><a href="http://translate.google.com/translate?js=y&amp;prev=_t&amp;hl=en&amp;ie=UTF-8&amp;layout=1&amp;eotf=1&amp;u=http%3A%2F%2Fwebkrauts.de%2F2009%2F12%2F05%2Fzugaenglich-und-bequem-twittern%2F&amp;sl=auto&amp;tl=en">German to English translation</a> by Google</dd>
		<dd>webkrauts.de</dd>
		<dd>2009 Dec 05</dd>
	<dt><a href="https://newmatilda.com/2009/12/01/wake-call-twitter">A Wake-Up Call For Twitter</a></dt>
		<dd>New Matilda</dd>
		<dd>2009 Dec 01</dd>
	<dt><a href="http://www.ideose.com/accessibilite-20-bien-plus-quun-slogan/">Accessibilit&eacute; 2.0, bien plus qu'un slogan</a></dt>
		<dd>translated title: "Accessibility 2.0, more than a slogan"</dd>
		<dd>presentation by Pierre Guillou of IDEOSE</dd>
		<dd>2009 Nov 25</dd>
	<dt><a href="http://www.eastersealstech.com/2009/10/29/review-twitters-alter-ego-accessible-twitter/">Review: Twitter's Alter Ego, "Accessible Twitter"</a></dt>
		<dd>2009 Oct 29</dd>
		<dd><abbr title="Indiana Assistive Technology Act">INDATA</abbr></dd>
	<dt><a href="http://murraynewlands.com/2009/07/twitter-apps-accessible-twitter-optimized-for-disabled-twitter-users/">Accessible Twitter optimized for disabled Twitter users</a></dt>
		<dd>Murray Newlands</dd>
		<dd>2009 Sep 00</dd>
	<dt><a href="http://www.evengrounds.com/blog/accessible-experts-dennis-lembree">Accessible Experts: Dennis Lembree Talks About Accessible Twitter</a></dt>
		<dd>working title: "Inaccessibility: The Awful Truth About Most Web Sites"</dd>
		<dd>Even Grounds, Tom Babinszki (guest article by Dennis Lembree</dd>
		<dd>2009 Sep 04</dd>
	<dt><a href="http://www.headstar.com/eablive/?p=321">Application Opens Up Twitter To Disabled Users</a></dt>
		<dd>E-Access Bulletin Live</dd>
		<dd>2009 Aug 14</dd>
	<dt><a href="http://www.web2access.org.uk/product/160/">[Test] Results for Accessible Twitter</a></dt>
		<dd>Web2Access</dd>
		<dd>2009 August 10</dd>
	<dt><a href="http://www.blacktelephone.com/2009/08/for-fun-and-for-free/">For Fun And For Free</a></dt>
		<dd>Black Telephone; Joseph Karr O'Connor</dd>
		<dd>2009 Aug 02</dd>
	<dt><a href="http://webaccessibilityrambles.blogspot.com/2009/07/accessible-twitter.html">Accessible Twitter (from Web Accessibility Rambles)</a></dt>
		<dd>Web Accessibility Rambles</dd>
		<dd>2009 Jul 29</dd>
	<dt><a href="http://udmlti.edublogs.org/2009/07/07/accessible-twitter/">Accessible Twitter (from UD in ME)</a></dt>
		<dd><abbr title="Universal Design in the MLTI">UD in ME</abbr>, Cynthia Curry</dd>
		<dd>2009 Jul 09</dd>
	<dt><a href="http://www.twitip.com/twitter-remaking-the-persona-of-the-physically-challenged/">Twitter: Remaking the Persona of the Physically Challenged</a></dt>
		<dd>TwitTip, Carmen R. Gonzalez</dd>
		<dd>2009 Jul 03</dd>
	<dt><a href="http://www.evengrounds.com/blog/mainstream-sites-or-accessible-solutions">Mainstream Sites Or Accessible Solutions</a></dt>
		<dd>Even Grounds, Tom Babinszki</dd>
		<dd>2009 Jun 11</dd>
	<dt><a href="http://tink.uk/accessible-twitter-applications/">Accessible Twitter Applications</a></dt>
		<dd>Tink, L&eacute;onie Watson</dd>
		<dd>2009 May 21</dd>
	<dt><a href="http://everythingtwitter.com/2009/05/08/accessible-twitter-web-accessibility-for-the-twitter-website/">Accessible Twitter – web accessibility for the Twitter website</a></dt>
		<dd>EverythingTwitter</dd>
		<dd>2009 May 08</dd>
	<dt><a href="http://www.freedomscientific.com/FSCast/episodes/fscast030-may2009.asp">FSCast Episode 30, May 2009</a> (using Twitter with JAWS screen reader)</dt>
		<dd>Freedom Scientific</dd>
		<dd>2009 May 00</dd>
	<dt><a href="http://accessify.com/news/2009/04/interview-with-accessible-twitter-creator-dennis-lembree/">Interview with Accessible Twitter creator Dennis Lembree</a></dt>
		<dd>Accessify</dd>
		<dd>2009 Apr 23</dd>
	<dt><a href="http://naricspotlight.wordpress.com/2009/04/23/tweet-two-twitter-items/">Tweet: Two Twitter Items</a></dt>
		<dd><abbr title="National Rehabilitation Information Center">NARIC</abbr></dd>
		<dd>2009 Apr 23</dd>
	<dt><a href="http://bub.blicio.us/tag/accessible-twitter/">Accessible Social Media</a></dt>
		<dd>bub.blicio.us</dd>
		<dd>2009 Apr 07</dd>
	<dt><a href="http://www.smiffysplace.com/accessible-twitter-accessible-tweets/">Accessible Twitter, Accessible Tweets</a></dt>
		<dd>Smiffy's Place, Matthew Smith</dd>
		<dd>2009 Apr 03</dd>
	<dt><a href="http://www.slideshare.net/jared_w_smith/twitter-accessibility">Twitter Accessibility (CSUN Tweetup 2009)</a> (see slide 14)</dt>
		<dd>WebAIM, Jared Smith</dd>
		<dd>2009 Mar 19</dd>
	<dt><a href="http://www.timobrienphotos.com/2009/03/accessing-twitter-from-the-iphone/">Accessing Twitter from the iPhone</a></dt>
		<dd>tim o'brien photos</dd>
		<dd>2009 Mar 04</dd>
	<dt><a href="http://www.evengrounds.com/blog/accessible-twitter">Accessible Twitter (from Even Grounds)</a></dt>
		<dd>Even Grounds, Tom Babinszki</dd>
		<dd>2009 Feb 28</dd>
	<dt><a href="http://doteduguru.com/id2215-accessible-twitter.html">Accessible Twitter (from EduGuru)</a></dt>
		<dd>.EduGuru, Nick DeNardis</dd>
		<dd>2009 Feb 16</dd>
	<dt><a href="http://www.prettysimple.co.uk/blog/index.php/2009/02/accessible-twitter/">Accessible Twitter (from Pretty Simple)</a></dt>
		<dd>Pretty Simple, James Coltham</dd>
		<dd>2009 Feb 10</dd>
	<dt><a href="http://www.webdirections.org/blog/accessible-twitter/">Accessible Twitter (Web Directions South)</a></dt>
		<dd>Web Directions South</dd>
		<dd>2009 Feb 09</dd>
	<dt><a href="http://anikto.com/wordpress/2009/02/08/accessible-twitter/">Accessible Twitter (from AniktoBlog)</a></dt>
		<dd>Anikto Blog</dd>
		<dd>2009 Feb 08</dd>
	<dt><a href="http://www.saifscotland.org.uk/information-and-advice/what-about-social-networks-and-accessibility/">What about Social Networks and Accessibility?</a></dt>
		<dd>Scottish Accessible Information Forum</dd>
		<dd>date not available</dd>
	<dt><a href="http://www.mediaaccess.org.au/online-media/social-media/twitter">Twitter Social Media Guide</a></dt>
		<dd>Media Access Australia</dd>
		<dd>date not available</dd>
	<dt><a href="http://accesstechnology.org.uk/">Suite of accessible web applications</a></dt>
		<dd>ACCESS: Technology</dd>
		<dd>date not available</dd>
	</dl>
</div>

	</div>
</div>	


