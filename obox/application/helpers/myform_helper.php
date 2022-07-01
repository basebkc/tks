<?php
		function no_antrian()
		{
			$CI =& get_instance();
			$kantor = kantor_pegawai()->kd_kan.'.';
			$sekarang = date('Y-m-d');
			$awal = date('Y-m-01', strtotime($sekarang));
			$akhir = date('Y-m-t', strtotime($sekarang));
			$where = array('tgl_upload >=' => $awal, 'tgl_upload <=' => $akhir);
			$antrian_terakhir = $CI->db->order_by('id_antrian', 'desc')->select('no_antrian')->where($where)->get('antrian', 1)->row();
			if (empty($antrian_terakhir->no_antrian)) 
				{ $antrian_terakhir = date('Y').date('m').'.600420.'.$kantor.'00000'; }
			else 
				{ $antrian_terakhir = $antrian_terakhir->no_antrian; }

			$panjang_kode_kode 	= 14;
			$panjang_kode 	= 18;
			$panjang_angka 	= 5;
			$kode 		= substr($antrian_terakhir, 0, $panjang_kode_kode);
			$angka 		= substr($antrian_terakhir, $panjang_kode, $panjang_angka);
			$angka_baru = str_repeat('0', $panjang_angka-strlen($angka+1)).($angka+1);
			$antrian 	= $kode.$kantor.$angka_baru;//.'/'.date('m').'/'.date('Y');
			return $antrian;
			// return $antrian_terakhir;
		}

		function nama_batch()
		{
			$CI =& get_instance();
			$kantor = kantor_pegawai()->kd_kan;
			//$where = array('id_kan' => kantor_pegawai()->id_kan);
			//$where_not = array('id_group' => null);

			$batch_terakhir = $CI->db->order_by('id_antrian', 'desc')->select('id_group')->where_not_in('id_group','')->get('antrian', 1)->row()->id_group;
			// mengambil angka dari kode barang terbesar, menggunakan fungsi substr
			// dan diubah ke integer dengan (int)
			$urutan = (int) substr($batch_terakhir, 9, 3);
			
			// bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
			$urutan++;
			
			// membentuk kode barang baru
			// perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
			// misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
			// angka yang diambil tadi digabungkan dengan kode huruf yang kita inginkan, misalnya BRG 
			$huruf = $kantor."_batch";
			$id_group = $huruf . sprintf("%03s", $urutan);
			return $id_group;
		}

		function get_nama($id)
		{
			$CI =& get_instance();
			return $CI->db->select('nama')->where('id', $id)->get('pegawai',1)->row()->nama;

		}
		function peran_pengguna($id)
		{
			$CI =& get_instance();
			$data = $CI->db->select('nama')->where('id', $id)->get('peran_pengguna');
			if (empty($data->num_rows())) {
				return "<i>---</i>";
			}else{
				return $data->row()->nama;
			}
		}
		function jum_non_file($id){
			$CI =& get_instance();
			return $CI->db->where(array('id_user' => $id,'file'=>'https://drive.google.com/file/d//view' ))->get('antrian')->num_rows();
		}
		function get_non_file(){
			$CI =& get_instance();
			return $CI->db->where(array('id_user' => $CI->session->userdata('user_id'),'file'=>'https://drive.google.com/file/d//view' ))->get('antrian',5)->result();
		}
		function rand_color()
		{
			$bg = array('primary', 'warning','danger','info','success');
			$i = rand(0,count($bg)-1);
			$selectBg = "$bg[$i]";
			return $selectBg;
		}
		function bg_color()
		{
			$bg = array('#57ff0014', 
						'#ff000014',
						'#00ffe714',
						'#ffeb0014',
						'#0400ff1f',
						'#ff00f71f');
			$i = rand(0,count($bg)-1);
			$selectBg = "$bg[$i]";
			return $selectBg;
		}
		function nama_jenis_ljk($id)
		{
			$CI =& get_instance();
			$data = $CI->db->select('nama_ljk')->where('kode', $id)->get('jenis_ljk');
			if (empty($data->num_rows())) {
				return "<i>---</i>";
			}else{
				return $data->row()->nama_ljk;
			}
		}
		function kode_ljk($id)
		{
			$CI =& get_instance();
			$data = $CI->db->select('kode')->where('id', $id)->get('jenis_ljk');
			if (empty($data->num_rows())) {
				return "<i>---</i>";
			}else{
				return $data->row()->kode;
			}
		}
		function cabang($id)
		{
			$CI =& get_instance();
			return $CI->db->select('n_kan')->where('id_kan', $id)->get('tbl_kantor',1)->row()->n_kan;

		}
		

		function lokasi($posisi='')
		{
			$CI =& get_instance();
			if ($posisi!='') {
				$CI->db->where('id_kota', $posisi);
				$res = $CI->db->get('kota')->row()->nama_kota;
				return $res;
			} else {
				return '';
			}
		}

		function username($id_user='')
		{
			
			$CI =& get_instance();
			$id = $CI->session->userdata("user_id");
			if (empty($id_user)) {
				$CI->db->where('id', $id);
			}else{
				$CI->db->where('id', $id_user);
			}
				$dat = $CI->db->get('users')->row();
				if (!isset($dat)) {
					return "--";
				}else{
				$res = $dat->first_name."&nbsp;".$dat->last_name;
				return $res;
				}
		
		}
		function peran_pengguna_user($id_user)
		{
			
			$CI =& get_instance();
			if (empty($id_user)) {
				return "--";
			}else{
				$CI->db->where('id', $id_user);
				$dat = $CI->db->get('users')->row();
				if (!isset($dat)) {
					return "--";
				}else{
				$id_p = $dat->id_peran_pengguna;
				$CI->db->where('id', $id_p);
				$dat = $CI->db->get('peran_pengguna')->row();
				return $dat->nama;
				}
			}
				
		
		}
		function username2($id_user='')
		{
			
			$CI =& get_instance();
			$id = $CI->session->userdata("user_id");
			if (empty($id_user)) {
				$CI->db->where('id', $id);
			}else{
				$CI->db->where('id', $id_user);
			}
				$dat = $CI->db->get('users')->row();
				if (!isset($dat)) {
					return "--";
				}else{
				$res = $dat->first_name."&nbsp;".$dat->last_name;
				return $res;
				}
				
		
		}
		function foto()
		{
			
			$CI =& get_instance();
			$id = $CI->session->userdata("user_id");
				$CI->db->where('id', $id);
				$res = $CI->db->get('users')->row()->photo;
				return $res;
		
		}
		function user_level()
		{
			
			$CI =& get_instance();
			$id = $CI->session->userdata("user_id");
				$CI->db->where('user_id', $id);
				$res = $CI->db->get('users_groups')->row()->group_id;
				return $res;
		 
		}
		// function id_pegawai()
		// {
			
		// 	$CI =& get_instance();
		// 	$id = $CI->session->userdata("user_id");
		// 		$CI->db->where('id', $id);
		// 		$res = $CI->db->get('users')->row()->id_pegawai;
		// 		return $res;
		
		// }
		function get_nip()
		{
			
			$CI =& get_instance();
			$id = $CI->session->userdata("user_id");
				$CI->db->where('id', $id);
				$res = $CI->db->get('users')->row()->nip;
				return $res;
		
		}

		function get_id_kan($id)
		{
			
			$CI =& get_instance();
				$CI->db->where('id', $id);
				$res = $CI->db->get('users')->row()->company;
				return $res;
		
		}

		function tab_display($process)
		{
			if ($process=='Create') {
				return 'style="display : none"';
			}
		}

		function kantor_pegawai()
		{
			$CI =& get_instance();
			$id = $CI->session->userdata('user_id');
			$users = $CI->db->select('company')->where('id', $id)->get('users', 1)->row();
			//$pegawai = $CI->db->select('id_kan')->where('id', $users->id_pegawai)->get('pegawai', 1)->row();
			$kantor  = $CI->db->select('id_kan,n_kan,kd_kan')->where('id_kan', $users->company)->get('tbl_kantor', 1)->row();
			if (empty($kantor)) {return '';} 
			else {return $kantor;}
		}

		function pegawai_by_kan($up='')
		{
			$id_kan=kantor_pegawai()->id_kan;
			$CI =& get_instance();
			$result['0'] = 'Please Select';
			$CI->db->order_by('nama', 'asc');
			if (!empty($id_kan)) {
				$CI->db->where('id_kan', $id_kan);
				if ($up!='') {
					$CI->db->where(array('status_fingerprint' => 'NOT_YET', 'status_fingerprint' => 'READY'));
				} else {
					$CI->db->where('status_fingerprint', 'NOT_YET');
				}
			}
			foreach ($CI->db->get('pegawai')->result() as $key => $value) {
				//$result; 
				$result[$value->id] = $value->nama; 
			}
			return $result;
		}

		function data_finger($req='')
		{
			$min = 1;
			$max = 99; 


			for ($i=$min; $i <= $max; $i++) {
				$result[$i]=$i;
			}
			return $result;
		}

		function fp_terpakai()
		{
			$id_kan=kantor_pegawai()->id_kan;
			$CI =& get_instance();
			$CI->db->select('id_fingerprint,nama');
			$CI->db->where('status_fingerprint', 'DONE');
			$CI->db->or_where('status_fingerprint', 'READY');
			return $CI->db->get('pegawai')->result();
		}

		function fp_tersedia()
		{
			$data_finger=data_finger();
			$result['0'] = 'Please Select';
			foreach (fp_terpakai() as $key => $value) {
				if ($k=array_search($value->id_fingerprint, $data_finger)) 
				{
					unset($data_finger[$k]);
				}
			}	
			foreach ($data_finger as $key => $value) {
					$result[$value] = $value;
			}
			return $result;
		}

		function nama_kantor($id='')
		{

			$CI =& get_instance();
			if ($id=='') {
				$id_user = $CI->session->userdata('user_id');
				$CI->db->select('company');
				$CI->db->where('id', $id_user);
				$id = $CI->db->get('users')->row()->company;
			}
			$res = $CI->db->select('n_kan')->where('id_kan', $id)->get('tbl_kantor', 1)->row();
			if (empty($res)) {return '';} 
			else {return $res->n_kan;}
		}
		function company($id='')
		{

			$CI =& get_instance();
			if ($id=='') {
				
			}
			$res = $CI->db->select('n_kan')->where('id_kan', $id)->get('tbl_kantor', 1)->row();
			if (empty($res)) {return '';} 
			else {return $res->n_kan;}
		}

		function menu_cek($id_menu,$id_group)
		{
			$CI =& get_instance();
			$group = $CI->db->where('id', $id_group)->get('groups', 1)->row();
			$menu_allowed = explode(' | ', $group->menu_allowed);
			if (in_array($id_menu, $menu_allowed)) {return 'checked';}
			else {return '';}
		}


		function cek_singel_main_menu($id_menu,$user_id)
		{
			$where_user = array(
				'user_id' => $user_id,
			);

			$CI =& get_instance();
			$CI->db->limit(1);
			$CI->db->select('groups.id, users_groups.group_id, menu_allowed');
			$CI->db->from('users_groups');
			$CI->db->join('groups', 'groups.id = users_groups.group_id', 'left');
			$group = $CI->db->where($where_user)->get()->row();
			$menu_allowed = explode(' | ', $group->menu_allowed);
			if (in_array($id_menu, $menu_allowed)) {return true;}
			else {return false;}
		}

		function get_main_menu($user_id)
		{

			$where_user = array(
				'user_id' => $user_id,
			);

			$where_menu = array(
				'is_parent' => 0,
				'is_active'=>1,
				'type'=>0
			);

			$CI =& get_instance();
			$CI->db->limit(1);
			$CI->db->from('users_groups');
			$CI->db->join('groups', 'groups.id = users_groups.group_id', 'left');
			$group = $CI->db->where($where_user)->get()->row();
			$menu_allowed = explode(' | ', $group->menu_allowed);

			$CI->db->order_by('sort','ASC');
				
			$CI->db->where($where_menu);			

			return $CI->db->get('menu');
			//return $CI->db->get('menu');
		}

		function get_sub_menu($user_id, $menu_id)
		{
			$where = array(
				'user_id' => $user_id,
			);
			
			$where2 = array('is_parent'=>$menu_id,'is_active'=>1);

			$CI =& get_instance();
			$CI->db->limit(1);
			$CI->db->from('users_groups');
			$CI->db->join('groups', 'groups.id = users_groups.group_id', 'left');
			$group = $CI->db->where($where)->get()->row();
			$menu_allowed = explode(' | ', $group->menu_allowed);
			
			$CI->db->order_by('sort','ASC');
			
			foreach ($menu_allowed as $key) {
				$CI->db->or_where('id', $key);
				$CI->db->where($where2);
			}
			return $CI->db->get('menu');
		}

		function get_group($id)
		{
			$CI =& get_instance();
			$CI->db->where('user_id',$id);
			 $id_group=$CI->db->get('users_groups')->row()->group_id;
			 $CI->db->where(array('id' => $id_group ));
			 return $CI->db->get('groups')->row()->name;

		}
	    
	    function array_cari($array, $user_id, $user_ip)
	    {
	        foreach ($array as $key => $val) {
	            if ($val['user_id'] == $user_id && $val['user_ip'] == $user_ip) {
	                return $key;
	            }
	        }
	        return -1;
	    }
		function main_active2()
		{
			$CI =& get_instance();
			$user_id = $CI->session->userdata('user_id');
        	$user_ip = $CI->input->ip_address();

	        $path_read = base_url('assets/json_files/try.JSON');
	        $json = file_get_contents($path_read);
	    	$data = json_decode($json, true);
		   	$index = array_cari($data['data'],$user_id,$user_ip);
	        
	        if ($index >= 0) { $sub_id = $data['data'][$index]['menu_id']; }
	        else { $sub_id = 74; }
			
			$is_parent = $CI->db->where('id',$sub_id)->get('menu')->row()->is_parent;
			
			if (empty($is_parent)) { return $sub_id; }
			else { return $is_parent; }
		}
        function pingAddress() 
        { 
			$CI =& get_instance();
        	$ip=$CI->input->ip_address();
            $pingresult = exec("ping -n 3 $ip", $outcome, $status); 
            if (0 == $status) 
                { $status = "alive"; } 
            else 
                { $status = "dead"; } 
            echo "The IP address, $ip, is ".$status; 
            //print_r($outcome);
        } 

		function sub_active2()
		{
			$CI =& get_instance();
			$user_id = $CI->session->userdata('user_id');
        	$user_ip = $CI->input->ip_address();

	        $path_read = base_url('assets/json_files/try.JSON');
	        $json = file_get_contents($path_read);
	    	$data = json_decode($json, true);
		   	$index = array_cari($data['data'],$user_id,$user_ip);
	        
	        if ($index >= 0) { return $sub_id = $data['data'][$index]['menu_id']; }
	        else { return $sub_id = 74; }

	        //return $data[0]['menu_id'];
		}

		function main_active()
		{
			$CI =& get_instance();
			$user_id = $CI->session->userdata('user_id');
        	$user_ip = $CI->input->ip_address();

	        $path_read = base_url('assets/json_files/menu.JSON');
	        $json = file_get_contents($path_read);
	    	$data = json_decode($json, true);
	        $sub_id = $data[0]['menu_id'];
		   //$index = $CI->array_cari($data['data'],$user_id,$user_ip);

			$is_parent = $CI->db->where('id',$sub_id)->get('menu')->row()->is_parent;
			if (empty($is_parent)) { return $sub_id; }
			else { return $is_parent; }
		}

		function sub_active()
		{
	        $path_read = base_url('assets/json_files/menu.JSON');
	        $json = file_get_contents($path_read);
	    	$data = json_decode($json, true);
	        return $data[0]['menu_id'];
		}

		function data_cuti()
		{
		 $CI =& get_instance();
		 $CI->db->select("ajuancuti.kdcuti,
						ajuancuti.tgl_pengajuan,
						ajuancuti.tgl_mulai,
						ajuancuti.tgl_akhir,
						ajuancuti.lama_cuti,
						ajuancuti.alasan,
						ajuancuti.kd_approve,
						ajuancuti.tgl_approve,
						ajuancuti.pesan_approve,
						ajuancuti.id,
						ajuancuti.nip,
						ajuancuti.kdnotif,
						ajuancuti.jab_atasan,

						pegawai.nama,
						status_app.approve,
						tbl_cuti.n_cuti");
						$CI->db->from('ajuancuti');
						$CI->db->join('pegawai','pegawai.nip=ajuancuti.nip');
						$CI->db->join('status_app','status_app.kd_approve=ajuancuti.kd_approve');
						$CI->db->join('tbl_cuti','tbl_cuti.id_cuti=ajuancuti.id_cuti');
						$data=$CI->db->get();
						foreach ($data->result_array() as $e) {							
							if ($e['kd_approve']=="3" || $e['kd_approve']=="4" || $e['kd_approve']=="2") {
								if(user_level()=="3"){
									manager_admin($e['kd_approve'],
											  $e['kdcuti'],
											  $e['approve'],
											  $e['nip'],
											  $e['nama'],
											  $e['tgl_pengajuan'],
											  $e['n_cuti'],
											  $e['tgl_mulai'],
											  $e['tgl_akhir'],
											  $e['lama_cuti'],
											  $e['alasan']);
								}
							}

							if ($e['kd_approve']=="4" || $e['kd_approve']=="5" || $e['kd_approve']=="2") {
								if(user_level()=="2"){
									manager_admin($e['kd_approve'],
											  $e['kdcuti'],
											  $e['approve'],
											  $e['nip'],
											  $e['nama'],
											  $e['tgl_pengajuan'],
											  $e['n_cuti'],
											  $e['tgl_mulai'],
											  $e['tgl_akhir'],
											  $e['lama_cuti'],
											  $e['alasan']);
								}
							}
							if (user_level()=="1"){
									manager_admin($e['kd_approve'],
											  $e['kdcuti'],
											  $e['approve'],
											  $e['nip'],
											  $e['nama'],
											  $e['tgl_pengajuan'],
											  $e['n_cuti'],
											  $e['tgl_mulai'],
											  $e['tgl_akhir'],
											  $e['lama_cuti'],
											  $e['alasan']);
							}  
						}  

		}
		function manager_admin($kd_approve,$kdcuti,$approve,$nip,$nama,$tgl_pengajuan,$n_cuti,$tgl_mulai,$tgl_akhir,$lama_cuti,$alasan)
		{
	       ?> <tr>
				<td><?php echo $nip ?></td>
				<td><?php echo $nama ?></td>
				<td><?php echo $tgl_pengajuan ?></td>
				<td><?php echo $n_cuti ?></td>
				<td><?php echo $tgl_mulai ?></td>
				<td><?php echo $tgl_akhir ?></td>
				<td><?php echo $lama_cuti ?></td>
				<td><?php echo $alasan ?></td>
				<td>
				<a href="<?php echo site_url('cuti_dan_absen/cuti/approve_cuti/'.$kdcuti) ?>" id="<?php echo $kdcuti ?>" <?php if ($approve=="Bloked"){echo"class='btn btn-sm btn-danger'";}else{echo"class='btn btn-sm btn-primary'";} ?> data-toggle="modal"><?php echo $approve ?>
	            </a>&nbsp |
	            <a href="<?php echo site_url('cuti_dan_absen/cuti/hapus_data_cuti/'.$kdcuti) ?>" id="<?php echo $kdcuti ?>" class="hapus">
	                <i class="ace-icon glyphicon glyphicon-trash"></i>
	            </a>
				</td>
			</tr>
			<?php }

?>