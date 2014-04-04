<?php

class Menu_generator {

	public $items = null;
	public $nodes = array();
	public $current_page = '/';

	public function __construct() {} 

	public function load($items)
	{
		$this->nodes = array();
		$this->items = $items;
	}

	public function set_current_page( $path )
	{
		$this->current_page = $path;	
	}

	public function generate($menu_id)
	{
		$this->build_nodes( $this->current_page );		
		return $this->render_menu($menu_id, $this->current_page );
	}

	public function render_menu ($menu_id, $path, $selected_class = 'current') 
	{
		$menu = "<ul class=\"nav-menu\" id=\"{$menu_id}\">\n";
		foreach ($this->nodes AS $url => $item)
		{
			$menu .= "\t<li class=\"nav-item\">";
			if ( isset($item['children']) )
			{
				$css_class = ($path === $url) ? $selected_class : '';
				$access_key = (isset($item['access_key'])) ? $item['access_key'] : '';
				$rel = (isset($item['rel'])) ? $item['rel'] : '';

				$menu .= $this->render_link($url, $item['label'], $css_class, $access_key, $rel );
				$menu .= "\n\t<ul class=\"sub-nav-group\">";
				foreach ($item['children'] AS $data)
				{
					$css_class = ($path === $url) ? $selected_class : '';
					$access_key = (isset($data['access_key'])) ? $data['access_key'] : '';
					$rel = (isset($data['rel'])) ? $data['rel'] : '';
					$menu .= "\n\t\t<li>"
					. $this->render_link($data['url'], $data['label'], $css_class, $access_key, $rel)
					. "</li>";
				}
				$menu .= "\n\t</ul>\n";

			}
			else
			{
				$css_class = ($path === $url) ? $selected_class : '';
				$access_key = (isset($item['access_key'])) ? $item['access_key'] : '';
				$rel = (isset($item['rel'])) ? $item['rel'] : '';
				
				$menu .= $this->render_link($url, $item['label'], $css_class, $access_key, $rel );
			}
			$menu .= "\t</li>\n";
		}
		$menu .= "</ul>\n";

		return $menu;
	}

	public function build_nodes( $path )
	{
		foreach( $this->items AS $key => $item )
		{
			$parent = $item['parent'];
			if ( $parent != '' ) {
				if ( ! isset( $this->nodes[ $parent ] ) )
				{
					$this->nodes[ $parent ]['children'] = array(); 
				}
				$item['url'] = $key; 
				$this->nodes[ $parent ]['children'][] = $item; 
			}
			else
			{
				unset( $item['parent']); 
				$this->nodes[$key] = $item; 
			}
		}
	}
	

	public function render_link($path, $label, $selected_class = '', $access_key = '', $rel = '')
	{
		$link = '<a href="' . $path . '" ';
		if ($selected_class){
			$link .= ' class="' . $selected_class . '" ';
		} 
		if ($access_key !== ''){
			$link .= ' accesskey="' . $access_key . '" ';
		} 
		if ($rel !== ''){
			$link .= ' rel="' . $rel . '" ';
		} 

		$link .= '>' . $label . '</a>'; 

		return $link;
	}

}




