<?php
class PDOOdbcDriver
{
	/***********************************************************************************/
	/* PDO ODBC DRIVER LIBRARY					                   	                   */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: PDOOdbcDriver
	/* Versiyon: 1.2
	/* Tanımlanma: Dinamik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: PDO sürücüsü tarafından kullanılmaktadır.
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	/* Config Değişkeni
	 *  
	 * Veritabanı ayarlar bilgisini
	 * tutmak için oluşturulmuştur.
	 *
	 */
	protected $config;
	
	/******************************************************************************************
	* CONSTRUCT     	                                                                      *
	******************************************************************************************/
	public function __construct()
	{
		$this->config = Config::get('Database');	
	}
	
	/******************************************************************************************
	* DNS       		                                                                      *
	*******************************************************************************************
	| Bu sürücü için dsn bilgisi oluşturuluyor.  							                  |
	******************************************************************************************/
	public function dsn()
	{
		$dsn  = '';
		
		$dsn  = 'odbc:DRIVER={IBM DB2 ODBC DRIVER}'.
			
		$dsn .= ( ! empty($this->config['database']) ) 
				? ';DATABASE='.$this->config['database'] 
				: '';
				
		$dsn .= ( ! empty($this->config['host']) ) 
				? ';HOSTNAME='.$this->config['host'] 
				: '';
				
		$dsn .= ( ! empty($this->config['port']) ) 
				? ';PORT='.$this->config['port'] 
				: '';
				
		$dsn .= ( ! empty($this->config['protocol']) ) 
				? ';PROTOCOL='.$this->config['protocol'] 
				: ';PROTOCOL=TCPIP';
				
		$dsn .= ( ! empty($this->config['user']) ) 
				? ';UID='.$this->config['user'] 
				: '';
		
		$dsn .= ( ! empty($this->config['password']) ) 
				? ';PWD='.$this->config['password'] 
				: '';
	
		return $dsn;
	}	
}