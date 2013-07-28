<?php
class MyYoutube
{
	public $boolVideo;
	public $strVideoId;
	
	
	public function __construct()
	{
		$this->boolVideo = FALSE;
		$this->strVideoId = NULL;
	}

	public function video($id)
	{
		$gdata = "https://gdata.youtube.com/feeds/api/videos/".$id."?alt=json";

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $gdata);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$data = curl_exec($ch);
		$retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		if($retcode != 200)
		{
			$this->boolVideo= FALSE;
			$this->strVideoId = NULL;
		}else{
			$this->boolVideo= json_decode($data);
			$this->strVideoId = $id;
		}
	}

	public function getTitle()
	{
		if(!$this->boolVideo)
		{
			return 0;
		}else{
			return $this->boolVideo->entry->title->{'$t'};
		}
	}

	public function getDescription()
	{
		if(!$this->boolVideo)
		{
			return 0;
		}else{
			return $this->boolVideo->entry->content->{'$t'};
		}
	}

	public function getAuthor()
	{
		if(!$this->boolVideo)
		{
			return 0;
		}else{
			return $this->boolVideo->entry->author[0]->name->{'$t'};
		}
	}

	public function getDuration()
	{
		if(!$this->boolVideo)
		{
			return 0;
		}else{
			return $this->boolVideo->entry->{'media$group'}->{'yt$duration'}->seconds;
		}
	}

	public function getThumbnail()
	{
		if(!$this->boolVideo)
		{
			return 0;
		}else{
			return $this->boolVideo->entry->{'media$group'}->{'media$thumbnail'}[2]->url;
		}
	}

	public function getRating()
	{
		if(!$this->boolVideo)
		{
			return 0;
		}else{
			return $this->boolVideo->entry->{'gd$rating'}->average;
		}
	}

	public function getNumRaters()
	{
		if(!$this->boolVideo)
		{
			return 0;
		}else{
			return $this->boolVideo->entry->{'gd$rating'}->numRaters;
		}
	}

	public function getViews()
	{
		if(!$this->boolVideo)
		{
			return 0;
		}else{
			return $this->boolVideo->entry->{'yt$statistics'}->viewCount;
		}
	}

	public function getLink()
	{
		if(!$this->boolVideo)
		{
			return 0;
		}else{
			return $this->boolVideo->entry->link[0]->href;
		}
	}

	public function getCategory()
	{
		if(!$this->boolVideo)
		{
			return 0;
		}else{
			return $this->boolVideo->entry->category[1]->label;
		}
	}

	public function getPublishDate()
	{
		if(!$this->boolVideo)
		{
			return 0;
		}else{
			return $this->boolVideo->entry->published->{'$t'};
		}
	}

	public function getEmbedCode($width,$height)
	{
		if(!$this->boolVideo)
		{
			return 0;
		}else{
			return '<iframe width="'.$width.'" height="'.$height.'" src="http://www.youtube.com/embed/'.$this->strVideoId.'" frameborder="0" allowfullscreen></iframe>';
		}
	}
}
?>
