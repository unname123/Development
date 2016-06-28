<?php
//----------------------------------------------------------------------------------------------------
// ZERONEED PHP WEB FRAMEWORK 
//----------------------------------------------------------------------------------------------------
//
// Author     : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
// Site       : www.znframework.com
// License    : The MIT License
// Copyright  : Copyright (c) 2012-2016, ZN Framework
//
//----------------------------------------------------------------------------------------------------

//----------------------------------------------------------------------------------------------------
// SYSTEM_DIR
//----------------------------------------------------------------------------------------------------
//
// @return System/
//
//----------------------------------------------------------------------------------------------------
define('SYSTEM_DIR', 'System/'); 

//----------------------------------------------------------------------------------------------------
// CORE_DIR
//----------------------------------------------------------------------------------------------------
//
// @return System/Core/
//
//----------------------------------------------------------------------------------------------------
define('CORE_DIR', SYSTEM_DIR.'Core/'); 

//----------------------------------------------------------------------------------------------------
// COMMON_DIR
//----------------------------------------------------------------------------------------------------
//
// @return Common/
//
//----------------------------------------------------------------------------------------------------
define('COMMON_DIR', 'Common/'); 

//----------------------------------------------------------------------------------------------------
// CONFIG_DIR
//----------------------------------------------------------------------------------------------------
//
// @return Common/Config/
//
//----------------------------------------------------------------------------------------------------
define('COMMON_CONFIG_DIR', COMMON_DIR.'Config/'); 

//----------------------------------------------------------------------------------------------------
//  Uygulama Ayarları
//----------------------------------------------------------------------------------------------------
require_once COMMON_CONFIG_DIR.'Application.php';
//----------------------------------------------------------------------------------------------------

//----------------------------------------------------------------------------------------------------
//  Global Application Variable
//----------------------------------------------------------------------------------------------------
global $config;

$application = $config['Application'];
//----------------------------------------------------------------------------------------------------

//----------------------------------------------------------------------------------------------------
//  Directory Index
//----------------------------------------------------------------------------------------------------
define('DIRECTORY_INDEX', $application['directoryIndex']);
//----------------------------------------------------------------------------------------------------

//----------------------------------------------------------------------------------------------------
// REAL_BASE_DIR
//----------------------------------------------------------------------------------------------------
define('REAL_BASE_DIR', realpath(__DIR__).DIRECTORY_SEPARATOR);

//----------------------------------------------------------------------------------------------------
//  Uygulama Türü
//----------------------------------------------------------------------------------------------------
define('APPMODE', strtolower($application['mode']));
//----------------------------------------------------------------------------------------------------

//----------------------------------------------------------------------------------------------------
// Kullanılabilir Uygulama Seçenekleri
//----------------------------------------------------------------------------------------------------
switch( APPMODE )
{ 
	//------------------------------------------------------------------------------------------------
	// Publication Yayın Modu
	// Tüm hatalar kapalıdır.
	// Projenin tamamlanmasından sonra bu modun kullanılması önerilir.
	//------------------------------------------------------------------------------------------------
	case 'publication' :
		error_reporting(0); 
	break;
	//------------------------------------------------------------------------------------------------
	
	//------------------------------------------------------------------------------------------------
	// Restoration Onarım Modu
	// Hataların görünümü görecelidir.
	//------------------------------------------------------------------------------------------------
	case 'restoration' :
	//------------------------------------------------------------------------------------------------
	// Development Geliştirme Modu
	// Tüm hatalar açıktır.
	//------------------------------------------------------------------------------------------------
	case 'development' : 
		error_reporting(-1);
	break; 
	//------------------------------------------------------------------------------------------------
	
	//------------------------------------------------------------------------------------------------
	// Farklı bir kullanım hatası
	//------------------------------------------------------------------------------------------------
	default: exit('Invalid Application Mode! Available Options: development, restoration or publication');
	//------------------------------------------------------------------------------------------------
}	
//----------------------------------------------------------------------------------------------------

//----------------------------------------------------------------------------------------------------
//  Ön Yüklenenler
//----------------------------------------------------------------------------------------------------
require_once CORE_DIR.'Preloading.php';
//----------------------------------------------------------------------------------------------------

//----------------------------------------------------------------------------------------------------
//  Uygulama Dizini
//----------------------------------------------------------------------------------------------------
$appdir = $application['directory'];

if( is_array($appdir) && ! empty($appdir[host()]) )
{
	$appdir = $appdir[host()];
}
elseif( defined('INTERNAL_DIR') )
{
	$appdir = INTERNAL_DIR;
}
elseif( is_array($appdir) )
{
	$appdir = 'Local';	
}

//----------------------------------------------------------------------------------------------------
//  Applications & Restorasyons Directories
//----------------------------------------------------------------------------------------------------
define('APPDIR', suffix(APPLICATIONS_DIR.$appdir));
define('RESDIR', suffix(RESTORATIONS_DIR.$appdir));
//----------------------------------------------------------------------------------------------------

if( ! is_dir(APPDIR) )
{
	exit('"'.$appdir.'" Application Directory Not Found!');
}

//----------------------------------------------------------------------------------------------------
// Benchmarking Test
//----------------------------------------------------------------------------------------------------
$benchmark = $application['benchmark'];	
//----------------------------------------------------------------------------------------------------

if( $benchmark === true ) 
{
	//------------------------------------------------------------------------------------------------
	//  Sisteminin Açılış Zamanını Hesaplamayı Başlat
	//------------------------------------------------------------------------------------------------
	$start = microtime();
	//------------------------------------------------------------------------------------------------
}

//----------------------------------------------------------------------------------------------------
//  Sistem Hiyerarşisi -- System/Core/Hierarchy.php
//----------------------------------------------------------------------------------------------------
require_once HIERARCHY_DIR; 
//----------------------------------------------------------------------------------------------------

if( $benchmark === true )
{	
	//------------------------------------------------------------------------------------------------
	//  Sistemin Açılış Zamanını Hesaplamayı Bitir
	//------------------------------------------------------------------------------------------------
	$finish         = microtime();
	//------------------------------------------------------------------------------------------------
	
	//------------------------------------------------------------------------------------------------
	//  System Elapsed Time Calculating
	//------------------------------------------------------------------------------------------------
	$elapsedTime    = $finish - $start;
	//------------------------------------------------------------------------------------------------
	
	//------------------------------------------------------------------------------------------------
	//  Sistemin Bellek Kullanımını Hesapla
	//------------------------------------------------------------------------------------------------
	$memoryUsage    = memory_get_usage();
	//------------------------------------------------------------------------------------------------
	
	//------------------------------------------------------------------------------------------------
	//  Sistemin Maksimum Bellek Kullanımını Hesapla
	//------------------------------------------------------------------------------------------------
	$maxMemoryUsage = memory_get_peak_usage();
	//------------------------------------------------------------------------------------------------
	
	//------------------------------------------------------------------------------------------------
	//  Benchmark Performans Sonuç Tablosu
	//------------------------------------------------------------------------------------------------
	$benchmarkData  = array
	(
		'elapsedTime'	 => $elapsedTime,
		'memoryUsage'	 => $memoryUsage,
		'maxMemoryUsage' => $maxMemoryUsage
	);	
	
	$benchResult    = Import::template('BenchmarkTable', $benchmarkData, true);
	//------------------------------------------------------------------------------------------------
	
	//------------------------------------------------------------------------------------------------
	//  Benchmark Performans Sonuç Tablosu Yazdırılıyor
	//------------------------------------------------------------------------------------------------
	echo $benchResult;
	//------------------------------------------------------------------------------------------------
			
	//------------------------------------------------------------------------------------------------
	//  Sistem benchmark performans test sonuçlarını raporla.
	//------------------------------------------------------------------------------------------------
	report('Benchmarking Test Result', $benchResult, 'BenchmarkTestResults');
	//------------------------------------------------------------------------------------------------
}