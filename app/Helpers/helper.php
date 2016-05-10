<?php 

function CURRENCY($value, $id = null)
{
	switch ($id) {
		case 'id':
			$format = "Rp. ".number_format($value, 0, ',', '.');
			break;
		case 'us':
			$format = "US$. ".number_format($value, 2, '.', ',');
			break;		
		default:
			$format = "Rp. ".number_format($value, 0, ',', '.');
			break;
	}

	return $format;
}

function STOCK($value)
{
	$format = number_format($value);

	return $format;
}