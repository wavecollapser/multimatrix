<?php
include 'multiform.php';
MultiMatrix_save();

// library constants
$UPDATE_YES=35135;
$UPDATE_NO=35134;

// the field you want to update on should have $UPDATE_YES set
// all other fields UPDATE_NO
// Update foo set ID=xx,Title=yy,Text=zz where ID=xx; will result
// (update on UPDATE_YES cols)
$coltitles1=array(
    "ID"        => $UPDATE_YES,
    "Title"     => $UPDATE_NO,
);
$coltitles=array(
    "ID"        => $UPDATE_YES,
    "Title"     => $UPDATE_NO,
    "Text"      => $UPDATE_NO
);
// the size of the fields in the matrix for each Col
$colwidth=array(
    0 => 3,
    1 => 20,
    2 => 35,
    3 => 15
);

$z=0;
//remember to initialize array fully, or 
//undefined behavior may happen!
//always zero first 200 array elements, to be sure!!
//in case we forget to initialize one
//keep this line always!
for ($z=0;$z<200;$z++)
    $field_data[$z]="";
$field_data=array();
//this way works too, to initialize from mysql data:
//$field_data[0]="hey";
//$field_data[1]="there";
//$field_data[2]="mio";

$field_data1=array(
    0=>"welcome",
    1=>"to",
    2=>"the",
    3=>"matrix.."

    );
$field_data=array(
    0=>"hey",
    1=>"hey",
    2=>"hey",
    3=>"hey"

    );

// spawn a multi matrix with many fields
MultiMatrix($maxfieldsx=3,$maxfieldsy=2,$colwidth=NULL,$coltitles1,$field_data1);

// spawn a multi matrix with many fields
MultiMatrix($maxfieldsx=8,$maxfieldsy=3,$colwidth,$coltitles,$field_data);
//
// spawn a multi matrix with one text area
MultiMatrix_textarea($field_data,$rows=5,$cols=35);

?>
