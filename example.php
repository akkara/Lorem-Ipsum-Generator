<?php

	include 'lorem.php' ;

	echo '<p>'.lorem::get(rand(100,200)).'</p>' ;

	echo '<pre>'.lorem::text().'</pre>' ;

	echo lorem::h(1) ;
	echo lorem::h(3) ;
	echo lorem::p() ;
	echo lorem::ul() ;
	echo lorem::p(rand(100,200)) ;

?>