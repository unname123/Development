<?php
/******************************************************************\
|                          ZN FRAMEWORK                            |
\******************************************************************/

/* Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
/* Site: www.zntr.net
/* Lisans: The MIT License
/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net

*/

//------------------------------------------------------------------
// Temel Sistem Ayarları
//
// 1 - Application Directory: Uygulamanın yer alacağı dizini ayarlamak içindir.
//
// 2 - Application Type: Uygulama türünü ayarlamak içindir.
//     local: Yerel sunucuda çalışırken tercih edilebilir.
//     development: Proje'nin geliştirilmesi aşamasında tercih edilebilir.
//     publication: Proje'nin yayınlanması ile bu seçenek tercih edilebilir.
//
// 3 - Benchmark Performance Test: Sistemin açılış hızını test etmek içindir.
//     true: Sayfanın yüklenmek hızı ve kullandığı bellek miktarını gösteren bir tablo çıktılar.
//     false: Herhangi bir tablo çıktılamaz.
//------------------------------------------------------------------
$settings = array
(
	'applicationDirectory' => 'Application', // Sonunda bölü(/) işareti kullanmayınız.
	'applicationType'      => 'local',       // local, development veya publication
	'benchmarkingTest'     => false          // true veya false
);

//------------------------------------------------------------------
//  Sistem Çalıştırılıyor...
//------------------------------------------------------------------
System::run($settings);
//------------------------------------------------------------------

class System
{
	public static function run($settings)
	{	
		//------------------------------------------------------------------
		//  Uygulama Dizini
		//------------------------------------------------------------------
		define('APP_DIR', $settings['applicationDirectory'].'/');
		//------------------------------------------------------------------
		
		//------------------------------------------------------------------
		//  Uygulama Türü
		//------------------------------------------------------------------
		define('APP_TYPE', $settings['applicationType']);
		//------------------------------------------------------------------
		
		//------------------------------------------------------------------
		// Kullanılabilir Uygulama Seçenekleri
		//------------------------------------------------------------------
		switch( APP_TYPE )
		{ 
			//------------------------------------------------------------------
			// Publication Yayın Modu
			// Tüm hatalar kapalıdır.
			// Projenin tamamlanmasından sonra bu modun kullanılması önerilir.
			//------------------------------------------------------------------
			case 'publication' :
				error_reporting(0); 
			break;
			//------------------------------------------------------------------
			
			//------------------------------------------------------------------
			// Local Yerel Mod
			// Standart PHP hata çıktısı kapatılır. Bunun yerine
			// hatalar özel bir çıktı ile gösterilir.
			//------------------------------------------------------------------
			case 'local' :
			//------------------------------------------------------------------
			// Development Geliştirme Modu
			// Tüm hatalar açıktır.
			//------------------------------------------------------------------
			case 'development' : 
				error_reporting(-1);
			break; 
			//------------------------------------------------------------------
			
			//------------------------------------------------------------------
			// Farklı bir kullanım hatası
			//------------------------------------------------------------------
			default: echo 'Invalid Application Environment! Available Options: local, development or publication'; exit;
			//------------------------------------------------------------------
		}	
		//------------------------------------------------------------------
		
		/******************************************************************\
		|                                                                  | 
		|                SİSTEM BENCHMARK PERFORMANS TESTİ                 |
		|                                                                  |
		*******************************************************************/
		
		//------------------------------------------------------------------
		//------------------------------------------------------------------
		//------------------------------------------------------------------
		//------------------------------------------------------------------
		//  Sistem Performans Testini Başlat: true or false
		//------------------------------------------------------------------	
		$benchmarkingTest = $settings['benchmarkingTest'];	
		//------------------------------------------------------------------
		//------------------------------------------------------------------
		//------------------------------------------------------------------
		//------------------------------------------------------------------
		
		if( $benchmarkingTest === true ) 
		{
			//------------------------------------------------------------------
			//  Sisteminin Açılış Zamanını Hesaplamayı Başlat
			//------------------------------------------------------------------
			$start = microtime();
			//------------------------------------------------------------------
		}
		
		//******************************************************************
		//  Sistem yükleniyor ... >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
		//
		require_once 'System/Core/Hierarchy.php'; // <<<<<<<<<<<<<<<<<<<<<<<
		//
		//  Sistem çalıştırılıyor ... >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
		//******************************************************************
		
		if( $benchmarkingTest === true )
		{	
			//------------------------------------------------------------------
			//  Sistemin Açılış Zamanını Hesaplamayı Bitir
			//------------------------------------------------------------------
			$finish         = microtime();
			//------------------------------------------------------------------
			
			//------------------------------------------------------------------
			//  System Elapsed Time Calculating
			//------------------------------------------------------------------
			$elapsedTime    = $finish - $start;
			//------------------------------------------------------------------
			
			//------------------------------------------------------------------
			//  Sistemin Bellek Kullanımını Hesapla
			//------------------------------------------------------------------
			$memoryUsage    = memory_get_usage();
			//------------------------------------------------------------------
			
			//------------------------------------------------------------------
			//  Sistemin Maksimum Bellek Kullanımını Hesapla
			//------------------------------------------------------------------
			$maxMemoryUsage = memory_get_peak_usage();
			//------------------------------------------------------------------
			
			//------------------------------------------------------------------
			//  Benchmark Performans Sonuç Tablosu
			//------------------------------------------------------------------
			$benchmarkData  = array
			(
				'elapsedTime'	 => $elapsedTime,
				'memoryUsage'	 => $memoryUsage,
				'maxMemoryUsage' => $maxMemoryUsage
			);	
			
			$benchResult    = Import::template('BenchmarkTable', $benchmarkData, true);
			//------------------------------------------------------------------
			
			//------------------------------------------------------------------
			//  Benchmark Performans Sonuç Tablosu Yazdırılıyor
			//------------------------------------------------------------------
			echo $benchResult;
			//------------------------------------------------------------------
					
			//------------------------------------------------------------------
			//  Sistem benchmark performans test sonuçlarını raporla.
			//------------------------------------------------------------------
			report('BenchmarkTestResults', $benchResult, 'BenchmarkTestResults');
			//------------------------------------------------------------------
		}
	}
}