<h1 class="rounded"><?php echo $xliff_reader->get('tips-h1'); ?></h1>

<div class="box1 rounded">
	<h2 class="alert"><?php echo $xliff_reader->get('tips-h2-spam'); ?></h2>
	<p><?php echo $xliff_reader->get('tips-spam-p'); ?></p>
	<ul>
		<li><?php echo $xliff_reader->get('tips-spam-li-1'); ?></li>
		<li><?php echo $xliff_reader->get('tips-spam-li-2'); ?></li>
		<li><?php echo $xliff_reader->get('tips-spam-li-3'); ?></li>
	</ul>
</div>

<div class="box1 rounded">
	<h2><?php echo $xliff_reader->get('tips-h2-search'); ?></h2>
	<p><?php echo $xliff_reader->get('tips-search-p'); ?></p>
</div>

<div class="box1 rounded">
	<h2><?php echo $xliff_reader->get('tips-h2-table'); ?></h2>
	<p id="tblSyntaxSummary"><?php echo $xliff_reader->get('tips-table-p'); ?></p>
	<table aria-describedby="tblSyntaxSummary">
	<thead>
		<tr>
			<th scope="col" style="width:30%;">Syntax</th>
			<th scope="col">Explanation</th>
			<th scope="col">Example</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<th scope="row">@username + message</th>
			<td>Directs a tweet at named person, and causes your twitter to save in their &quot;replies&quot; timeline. Only you, named person, and users following both, will see this tweet in their timeline.</td>
			<td>@caratina I love that song too, The Cure rules!</td>
		</tr>
		<tr>
			<th scope="row">.@username + message</th>
			<td>Same as above but allows all accounts to view the tweet. (Period at beginning.)</td>
			<td>.@jennison I love that song too, Joy Division rules!</td>
		</tr>
		<tr>
			<th scope="row">RT @username + their message</th>
			<td>Retweet. When you copy and pass along someone else's message. This is the old method which is different that Twitter's "native" retweet.</td>
			<td>RT @easychirp Working on some performance enhancements with the API.</td>
		</tr>
		<tr>
			<th scope="row">MT @username + their message</th>
			<td>Modified tweet. Similar to a Retweet, but when you modify someone else's message.</td>
			<td>Cool! MT @EasyChirp is working on some performance enhancements with the Twitter API. #twitter #a11y</td>
		</tr>
		<tr>
			<th scope="row">^ + user initials</th>
			<td>For accounts with more than one author, the author adds a carat (^) and his initials to the end of the tweet to clarify who he is.</td>
			<td>@somebody Yes, sent to email address associated with the account. ^DW</td>
		</tr>
		<tr>
			<th scope="row">D username + message</th>
			<td>Sends a person a direct (private) message.</td>
			<td>d dennisl Want to meet at Starbucks at 4pm today?</td>
		</tr>
	</tbody>
	</table>
</div>

<div class="box1 rounded">
	<h2>Access Keys</h2>
	<ul>
		<li>0 Home</li>
		<li>1 Timeline</li>
		<li>2 My Tweets</li>
		<li>3 Mentions</li>
		<li>4 Favorites</li>
		<li>5 Direct Message (DM)</li>
		<li>6 Search</li>
		<li>7 Lists</li>
		<li>8 Trends</li>
	</ul>
</div>

<div class="box1 rounded">
	<h2>Web Applications</h2>
	<ul>
		<li><a href="http://twuffer.com/" rel="external">Twuffer</a>: a Twitter buffer (schedule tweets)</li>
		<li><a href="http://topsy.com/" rel="external">Topsy</a>: Twitter search.</li>
		<li><a href="http://backtweets.com/" rel="external">BackTweet</a>: Search links on Twitter.</li>
		<li><a href="http://monitter.com/" rel="external">Monitter</a>: monitor tweets with keywords.</li>
		<li><a href="http://tweetstats.com" rel="external">TweetStats</a>: Graphin' your stats!</li>
		<li><a href="http://twtvite.com/" rel="external">Twtvite</a>: Organize a tweetup!</li>
		<li><a href="http://twtpoll.com/" rel="external">TwtPoll</a>: create and distribute polls on Twitter.</li>
		<li><a href="http://tweetbeep.com/" rel="external">tweetbeep</a>: Free Twitter alerts by email.</li>
	</ul>
</div>




