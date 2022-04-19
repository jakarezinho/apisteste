<?php 
class composeJson
{
	
	public $feed;
	
	public $file;
	
	
	function __construct($feed, $file)
	{
		
		$this->feed = $feed;
		
		$this->file = $file;
		
	}
	
	
	private function makefile()
	{
		
		
		
		
		$curl = curl_init();
		
		
		$headers = array(
		'Accept: application/json',
		'Content-Type: application/json',
		'api_key: 40d728c2b16f2917601b9a3d4fc9d2d5',);
		
		
		
		curl_setopt($curl, CURLOPT_URL, $this->feed);
		
		
		curl_setopt($curl, CURLOPT_HTTPHEADER,$headers);
		
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true );
		
		
		$data = curl_exec($curl);
		
		
		curl_close($curl);
		
		if($this->file == 'nofile')
		{
			return $data;
    
		}
		else{
			
			$fp = fopen($this->file, 'w');
			
			fwrite($fp, $data);
			
			fclose($fp);
			
		}
		
		
		
	}
	
	
	
	public function init()
	{
		
		if($this->file == 'nofile')
    {
      return $this->makefile();
    }
		clearstatcache();
		
		if (file_exists($this->file)&& filesize($this->file)) {
			
			
			$file_time = filemtime($this->file);
			
			
			$expire = 60*60;
			// 			Time in seconds to cache the file for
			// 			var_dump($file_time < (time() - $expire));
			
			if ($file_time < (time() - $expire)) {
				
				// 				if expired, overwrite file
				// 				var_dump('expired');
				
				$this->makefile();
				
			}
			
		}
		else {
			
			// 			if file does not exist, write to file
			$this->makefile();
			
			return $file_data = file_get_contents($this->file);
			
		}
		
		//v		ar_dump('NOexpired');
		
		return $file_data = file_get_contents($this->file);
		
	}
	
}

