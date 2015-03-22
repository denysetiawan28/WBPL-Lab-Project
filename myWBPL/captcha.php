<?php 

class captcha  {
	
	function genCaptcha()
	{
		$characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	 $randomString = '';
							
	 $temp;
	 $tampCap = "";
	 for ($i=1; $i <= 6 ; $i++) 
	 { 
		if ($i%2 == 1) $temp = floor(rand(0,10));
		else $temp = $characters[rand(0, strlen($characters) - 1)];
		$tampCap = $tampCap . $temp;
	 }
	echo $tampCap;
	}
}

     $a=new captcha();
	 $b=$a->genCaptcha();
?>