<?php 

/*
        1.belum login
        2.
*/

	function cache_delete($cache_name)
	{
    	$CI =& get_instance();
		$CI->load->driver('cache',array('adapter' => 'apc', 'backup' =>'file' ));
        $status = $CI->cache->delete('gdrive/'.$cache_name);
	}

    function cur($value='')
    {
        //http://192.168.0.102/IDEB/index.php/Antrian/create
        
        if (site_url('Antrian/create') == current_url()) {
                echo (current_url());
        }
    }
    function LINKgd()
    {
        $CI =& get_instance();
        $CI->load->driver('cache',array('adapter' => 'apc', 'backup' =>'file' ));
        $cache_data = $CI->cache->get('gdrive/LINK');
        if (!($cache_data)) {
          return site_url('Antrian/create');
        }
        else {
          return $CI->cache->get('gdrive/LINK');
        }
    }
	function cache_save($data)
	{
    	$CI =& get_instance();
		$cache_name = 'LINK';
		$CI->load->driver('cache',array('adapter' => 'apc', 'backup' =>'file' ));
		//if ($CI->cache->apc->is_supported()) {echo "ya";}else{echo "no";}
	    $cache_data = $CI->cache->get('gdrive/'.$cache_name);

	    if ( !$cache_data )
	     {
	          //here goes your codes...
	     	//$data = array('menu_id' => $menu_id);
	        
	        $CI->cache->save('gdrive/'.$cache_name, $data, 30000);
	        $cache_data = $data;
	     }
	    else
	     {
	     	cache_delete($cache_name);
	     	cache_save($data);
	     }
	    //return $cache_data;
	    //var_dump($cache_data);
	}

	function active_main()
	{
    	$CI =& get_instance();
        $cache_name = $CI->session->userdata("user_id");
        $CI->load->driver('cache',array('adapter' => 'apc', 'backup' =>'file' ));
        $cache_data = $CI->cache->get($cache_name);

        if ( !$cache_data )
         {
            $cache_data = $CI->cache->get('gdrive/'.$cache_name);
            //return $cache_data['menu_id'];
            $menu_id = $cache_data['menu_id'];
            $where = array('id' => $menu_id);
            $menu = $CI->db->select('id, is_active, is_parent')->where($where)->get('menu',1)->row();
            if (empty($menu)) {
            	cache_save();
            	return 74;
            } else {
	            if ($menu->is_parent <= 0) { return $menu->id; } 
	            else { return $menu->is_parent; }
            }
         }
        else
         {
         	return 74;
         }
	}

	function active_sub()
	{
    	$CI =& get_instance();
        $cache_name = $CI->session->userdata("user_id");
        $CI->load->driver('cache',array('adapter' => 'apc', 'backup' =>'file' ));
        $cache_data = $CI->cache->get('cache_key');

        if ( !$cache_data )
         {
            $cache_data = $CI->cache->get('gdrive/'.$cache_name);
            return $cache_data['menu_id'];
         }
        else
         {
         	return 74;
         }
	}

    function fixed_sidebar()
    {
        $CI =& get_instance();
        $cache_name = $CI->session->userdata("user_id");
        $CI->load->driver('cache',array('adapter' => 'apc', 'backup' =>'file' ));
        $cache_data = $CI->cache->get($cache_name);

        if ( !$cache_data )
         {
            $cache_data = $CI->cache->get('fixed/'.$cache_name);
            return $cache_data['sidebar'];
         }
        else
         {
            return 74;
         }
    }
      function fixed_breadcrumbs()
    {
        $CI =& get_instance();
        $cache_name = $CI->session->userdata("user_id");
        $CI->load->driver('cache',array('adapter' => 'apc', 'backup' =>'file' ));
        $cache_data = $CI->cache->get($cache_name);

        if ( !$cache_data )
         {
            $cache_data = $CI->cache->get('fixed/'.$cache_name);
            return $cache_data['breadcrumbs'];
         }
        else
         {
            return 74;
         }
    }
     function fixed_navbar()
    {
        $CI =& get_instance();
        $cache_name = $CI->session->userdata("user_id");
        $CI->load->driver('cache',array('adapter' => 'apc', 'backup' =>'file' ));
        $cache_data = $CI->cache->get($cache_name);

        if ( !$cache_data )
         {
            $cache_data = $CI->cache->get('fixed/'.$cache_name);
            return $cache_data['navbar'];
         }
        else
         {
            return 74;
         }
    }
     function id_navbar()
    {
        $CI =& get_instance();
        $cache_name = $CI->session->userdata("user_id");
        $CI->load->driver('cache',array('adapter' => 'apc', 'backup' =>'file' ));
        $cache_data = $CI->cache->get($cache_name);

        if ( !$cache_data )
         {
            $cache_data = $CI->cache->get('fixed/'.$cache_name);
            return $cache_data['id_navbar'];
         }
        else
         {
            return 74;
         }
    }
      function id_sidebar()
    {
        $CI =& get_instance();
        $cache_name = $CI->session->userdata("user_id");
        $CI->load->driver('cache',array('adapter' => 'apc', 'backup' =>'file' ));
        $cache_data = $CI->cache->get($cache_name);

        if ( !$cache_data )
         {
            $cache_data = $CI->cache->get('fixed/'.$cache_name);
            return $cache_data['id_sidebar'];
         }
        else
         {
            return 74;
         }
    }
       function margintop()
    {
        $CI =& get_instance();
        $cache_name = $CI->session->userdata("user_id");
        $CI->load->driver('cache',array('adapter' => 'apc', 'backup' =>'file' ));
        $cache_data = $CI->cache->get($cache_name);

        if ( !$cache_data )
         {
            $cache_data = $CI->cache->get('fixed/'.$cache_name);
            return $cache_data['margintop'];
         }
        else
         {
            return 74;
         }
    }

 ?>