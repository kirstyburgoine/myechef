<?php // functions/query_loop.php

class query_loop implements Iterator, Countable {
	
	public $has_posts = FALSE;

	public function __construct( $args = array() ) {

		// store the previous post so we can reset it later
		// we have to use this method (instesd of wp_reset_postdata) because
		// there's a good chance we may be using more than two nested loops

		global $post;
		$this->previous_post = $post;
		
		$this->query = new WP_Query( $args );

		$this->has_posts = $this->count() >= 1;

	}

	function has_posts() {
		return $this->count >= 1;
	}

	function count() {
		return count($this->query->posts);
	}
 
	function rewind() {
		$this->query->rewind_posts();
	}
 
	function current() {
		$this->query->the_post();
		return $this->query->post;
	}
 
	function key() {
		return $this->query->post->ID;
	}
 
	function next() {
		//$this->query->the_post();
	}
 
	function valid() {

		if ( $this->query->have_posts() ) {
			return true;
		} else {

			// restore global post to the previously stored version
			global $post;
			$post = $this->previous_post;

			return false;

		}

	}

}