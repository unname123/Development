<?php
namespace ZN\ImageProcessing;

interface ImageInterface
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Thumb
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $fpath
	// @param array  $set
	//
	//----------------------------------------------------------------------------------------------------
	public function thumb(String $fpath, Array $set);
	
	//----------------------------------------------------------------------------------------------------
	// Get Prosize
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $path
	// @param int    $width
	// @param int    $height
	//
	//----------------------------------------------------------------------------------------------------
	public function getProsize(String $path, $width, $height);
}