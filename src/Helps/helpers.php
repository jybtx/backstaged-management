<?php
if ( ! function_exists('prefixPath') ) {
	/**
	 * [prefixPath description]
	 * @author jybtx
	 * @date   2019-12-30
	 * @return [type]     [description]
	 */
	function prefixPath()
	{
		return config('backstaged.route.prefix');
	}
}