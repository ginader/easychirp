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
		$menu = "<ul id=\"{$menu_id}\">\n";
		foreach ($this->nodes AS $url => $item)
		{
			$menu .= "\t<li>";
			if ( isset($item['children']) )
			{
				$menu .= $this->render_link($url, $item['label'], $css_class );
				$menu .= "\n\t<ul class=\"submenu\">";
				foreach ($item['children'] AS $data)
				{
					error_log('IF path=' . $path . '. data url=' . $data['url']);
					$css_class = ($path === $url) ? $selected_class : '';
					$menu .= "\n\t\t<li>"
					. $this->render_link($data['url'], $data['label'], $css_class)
					. "</li>";
				}
				$menu .= "\n\t</ul>\n";

			}
			else
			{
				error_log('ELSE path=' . $path . ' url=' . $url);
				$css_class = ($path === $url) ? $selected_class : '';
				
				$menu .= $this->render_link($url, $item['label'], $css_class );
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
	

	public function render_link($path, $label, $selected_class = '')
	{
		if ($selected_class){
			return "<a class=\"{$selected_class}\" href=\"{$path}\">{$label}</a>"; 
		} else {
			return "<a href=\"{$path}\">{$label}</a>"; 
		}
	}

}




