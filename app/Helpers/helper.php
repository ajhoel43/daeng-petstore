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

function error_delimiter($type, $message)
{
	$close_sign = '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
	switch($type) {
		case 'warning':
			$result = '<div class="alert alert-warning">'.$close_sign.$message.'</div>';
			break;
		case 'danger':
			$result = '<div class="alert alert-danger">'.$close_sign.$message.'</div>';
			break;
		case 'info':
			$result = '<div class="alert alert-info">'.$close_sign.$message.'</div>';
			break;
		case 'success':
			$result = '<div class="alert alert-success">'.$close_sign.$message.'</div>';
			break;
	}

	return $result;
}

function dropdown_jbar()
{
	$list = array(
        'Hewan' => 'Hewan',
        'Makanan' => 'Makanan',
        'Perlengkapan' => 'Perlengkapan'
	    );

	return $list;
}

function dropdown_satuan()
{
	$list = array(
	    'Gram' => 'Gram', 
	    'Kg' => 'Kg', 
	    'Pcs' => 'Pcs', 
	    'Lsn' => 'Lsn', 
	    'Ekor' => 'Ekor'
		);

	return $list;
}

function FormatDateDB($date = null)
{
	if(!$date)
		$date = 'now';

	$newDate = date('Y-m-d H:i:s', strtotime($date));

	return $newDate;
}

function HumanDate($date = null)
{
	if(!$date)
		$date = 'now';

	$newDate = date('D, d M Y', strtotime($date));

	return $newDate;
}