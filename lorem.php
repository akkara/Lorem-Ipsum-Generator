<?php

/**
 * Lorem Ipsum, Dummy Text Generator.
 *
 * {@link http://github.com/akkara/LoremIpsum}
 *
 * @author Kadir 'Akkara' Yardımcı {@link http://kadiryardimci.com}
 */
class lorem {

	function words () {
		return explode(' ',str_repeat('lorem ipsum dolor sit amet consectetur adipiscing '.
			'elit nam vel augue nibh dictum faucibus fusce varius odio '.
			'quis sollicitudin rhoncus libero turpis vestibulum metus congue '.
			'ligula tortor eu sem integer iaculis nisl eget sapien placerat '.
			'volutpat phasellus tincidunt purus vitae ultrices felis mi '.
			'sodales ac dui ut pellentesque neque vehicula nulla bibendum '.
			'dapibus consequat urna interdum orci duis mattis velit pharetra '.
			'molestie euismod donec justo hendrerit id sagittis nec posuere '.
			'mauris sed vulputate nunc ullamcorper non fermentum enim '.
			'lobortis habitant morbi tristique senectus et netus malesuada '.
			'fames egestas cras blandit a ultricies risus proin arcu quam '.
			'maecenas rutrum fringilla porta etiam suspendisse magna '.
			'scelerisque erat tellus condimentum at feugiat lacus '.
			'lectus mollis aliquam in praesent luctus lacinia '.
			'dignissim viverra elementum porttitor ante tempor '.
			'curabitur leo nullam accumsan commodo laoreet est '.
			'massa aenean eros hac habitasse platea dictumst '.
			'semper gravida cum sociis natoque penatibus '.
			'magnis dis parturient montes nascetur '.
			'ridiculus mus',10)) ; }

	function get ($lenght=100,$start='',$end='.') {
		$words = self::words() ;
		$total = count($words) ;
		global $ipsum_offset ;
		if (!isset($ipsum_offset)) {
			$ipsum_offset = 0 ; }
		$ipsum_offset_keep = $ipsum_offset ;
		$ipsum_offset += $lenght ;
		if ($ipsum_offset > $total) {
			$words = array_merge($words,$words) ;
			if ($ipsum_offset > count($words)) {
				$ipsum_offset = count($words) ;
				$end = ' expected lorem is too big'.$end ; }
			$ipsum_offset -= $total ; }
		return ucfirst(strtolower(implode(' ',array_slice($words,$ipsum_offset_keep,$lenght)))).$end ; }

	function text ($total=5,$lenght=10,$sep="\n\n") {
		$text = array() ;
		for ( $i=0 ; $i < $total ; $i++ ) {
			$text[] = self::get($lenght) ; }
		self::reset() ;
		return implode($sep,$text) ; }

	function html ($lenght=100,$tags='strong/em/a') {
		$tags = explode('/',$tags) ;
		$text = self::get($lenght,'','') ;
		return self::html_rec($text,$tags) ; }

	function html_rec ($text,$tags) {
		if ($tags) {
			$text = explode(' ',$text) ;
			$count = count($text) ;
			$index = 0 ;
			$parts = array() ;
			while ($index < $count) {
				$range = rand(1,floor($count/2)) ;
				$parts[] = implode(' ',array_slice($text,$index,$range)) ;
				$index += $range ; }
			foreach ($parts as $key => $part) {
				if (!self::rand(0,2,0,3,0,1)) {
					shuffle($tags) ;
					$tag = array_pop($tags) ;
					if ($tags) {
						$part = self::html_rec($part,$tags) ; }
					$part = self::html_tag($part,$tag) ;
					$parts[$key] = $part ;
					array_push($tags,$tag) ; } }
			return implode(' ',$parts) ; }
		return $text ; }

	function html_tag ($text,$tag) {
		switch ($tag) {
			case 'a' : return '<a href="#">'.$text.'</a>' ;
			default : return '<'.$tag.'>'.$text.'</'.$tag.'>' ; } }

	function p ($lenght=100,$tags='strong/em/a') {
		return '<p>'.self::html($lenght,$tags).'</p>' ; }

	function h ($size=3,$lenght=10,$tags='strong/em/a') {
		return '<h'.$size.'>'.self::html($lenght,$tags).'</h'.$size.'>' ; }

	function lists ($type='ol',$total=5,$lenght=10,$tags='strong/em/a') {
		$items = array() ;
		for ( $i=0 ; $i < $total ; $i++ ) {
			$items[] = '<li>'.self::html($lenght,$tags).'</li>' ; }
		return '<'.$type.'>'.implode("\n",$items).'</'.$type.'>' ; }

	function ol ($total=5,$lenght=10,$tags='strong/em/a') {
		return self::lists('ol',$total,$lenght,$tags) ; }

	function ul ($total=5,$lenght=10,$tags='strong/em/a') {
		return self::lists('ul',$total,$lenght,$tags) ; }

	function rand ($c1,$c2,$t1,$t2,$f1,$f2) {
		return (rand($c1,$c2) ? rand($t1,$t2) : rand($f1,$f2)) ; }

	function reset () {
		global $ipsum_offset ;
		$ipsum_offset = 0 ; }

}


?>