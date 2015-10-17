<?php
class __USE_STATIC_ACCESS__Blade
{
	/***********************************************************************************/
	/* BLADE LIBRARY	     	     		                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: Blade
	/* Versiyon: 1.2
	/* Tanımlanma: Dinamik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: $this->Blade, zn::$use->Blade, uselib('Blade')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	/******************************************************************************************
	* CALL                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Geçersiz fonksiyon girildiğinde çağrılması için.						  |
	|          																				  |
	******************************************************************************************/
	public function __call($method = '', $param = '')
	{	
		die(getErrorMessage('Error', 'undefinedFunction', "Blade::$method()"));	
	}
	
	/******************************************************************************************
	* PAGE                                                                             		  *
	*******************************************************************************************
	| Genel Kullanım: Görünüm sayfasında ayrıştırma işlemi yapmak için kullanılır.			  |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                                     |
	| 1. string var @page => Views/Pages/ dizininde yer alan sayfa ismi.					  |
	| 2. array var @data => Değiştirilecek veriler.					  					      |
	| 3. boolean var @output => Direk çıktı üretilsin mi, değer mi döndürülsün?.			  |
	|          																				  |
	| Örnek Kullanım: ->page('test', array('test' => 'deneme'))         					  |
	|          																				  |
	******************************************************************************************/
	public function page($page = '', $data = '', $obGetContents = false)
	{
		$pageContent = Import::page($page, $data, true);
		
		$pageContent = $this->data($pageContent, $data);
		
		if( $obGetContents === true )
		{
			return $pageContent;
		}
		
		echo $pageContent;
	}
	
	/******************************************************************************************
	* PAGE / VIEW                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Görünüm sayfasında ayrıştırma işlemi yapmak için kullanılır.			  |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                                     |
	| 1. string var @page => Views/Pages/ dizininde yer alan sayfa ismi.					  |
	| 2. array var @data => Değiştirilecek veriler.					  					      |
	| 3. boolean var @output => Direk çıktı üretilsin mi, değer mi döndürülsün?.			  |
	|          																				  |
	| Örnek Kullanım: ->view('test', array('test' => 'deneme'))         					  |
	|          																				  |
	******************************************************************************************/
	public function view($page = '', $data = array(), $output = false)
	{
		return $this->page($page, $data, $output);
	}
	
	/******************************************************************************************
	* DATA                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Metinsel ifadelerde ayrıştırma işlemi yapmak için kullanılır.			  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @string => Metinsel veri.					 							  |
	| 2. array var @data => Değiştirilecek veriler.					  					      |
	|          																				  |
	| Örnek Kullanım: ->data('test', array('test' => 'deneme'))         					  |
	|          																				  |
	******************************************************************************************/
	public function data($str = '', $data = array())
	{
		if( ! is_string($str) )
		{
			return Error::set(lang('Error', 'stringParameter', 'str'));
		}
		
		$bladeChars = array
		(	
			'{{{'	=> '<?php echo "',
			'}}}'	=> '" ?>',
			'{{--' 	=> '<!-- ',
			'--}}'  => ' -->',
			'{{' 	=> '<?php echo ',
			'}}' 	=> ' ?>',	
			'{['    => '<?php',
			']}'  	=> '?>'
  		);
		
		$endKeywords = array
		(
			'foreach',
			'for',
			'while',
			'if',
			'switch'
		);
	
		$newData = str_replace(array_keys($bladeChars), array_values($bladeChars), $str);
		
		$newDatas = array();

		preg_match_all('/\B@.+\B/', $newData, $matchData);

		if( ! empty($matchData[0]) ) foreach( $matchData[0] as $val )
		{
			$new = str_replace('@', '??', $val);
			
			preg_match('/\w+/', $new, $matchKeyword);
			
			$matchKeyword = isset( $matchKeyword[0] )
			              ? $matchKeyword[0]
						  : NULL;
		
			if( in_array(strtolower(trim($matchKeyword)), $endKeywords) && ! strstr($new, ':') )
			{
				  $new .= ':';
			}
	
			$newDatas[$val] = $new.' ?>';
		}
	
		$newData = str_replace(array_keys($newDatas), array_values($newDatas), $newData);
		
		$newData = preg_replace('/\?\?/', '<?php ', $newData);
		
		if( is_array($data) )
		{
			extract($data, EXTR_OVERWRITE, 'extract');
		}
		
		ob_start(); 
		eval("?>$newData");
		$content = ob_get_contents(); 
		ob_end_clean(); 
		
		return $content;
	}	
}