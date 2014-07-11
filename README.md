*******************************************************************
** THIS SOFTWARE IS FREE SOFTWARE; SEE LICENSE IN THIS DIRECTORY **
** LICENSED AS GPL3 OR NEWER                                     **
*******************************************************************

multimatrix-0.5~git

PHP Library for creating dynamical field matrices, and textareas objects too.

It can save output in mysql easily.

To use
~~~~~~~~~~~~~~~~~~~~~~~~~~~~

There are just 2 functions:

<?php
Include 'multiform.php';
MultiMatrix_save(); //saves matrix data in mysql
MultiMatrix(....); //spawns a matrix of fields
?> 


A TYPICAL USE:
~~~~~~~~~~~~~~~~~~~

<?php
include 'multiform.php';
MultiMatrix_save(); //saves matrix data in mysql

// spawn a multi matrix with many fields + delete checkbox (typical use)!
$coltitles3=array(
    "ID" => $UPDATE_YES,
    "Title" => $UPDATE_NO,
    "Text" => $UPDATE_NO,
    "Delete" => $UPDATE_NO
);
$field_data=array(
    0=>"welcome",
    1=>"to",
    2=>"the",
    3=>"matrix"
);
$checkbox_data1=array(
    ""
);

MultiMatrix(
    $maxfieldsx=8,$maxfieldsy=3,
    $colwidth_arr=NULL,
    $coltitles3,
    $field_data,
    $maxcheckboxes=1,
    $checkbox_data1
);
?> 
