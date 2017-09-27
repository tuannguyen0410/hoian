<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	private $user = "user";
	private $category = 'category';
	private $article = "article";
	private $info = "info";
	private $book = "book";
	private $images = "images";
	private $faqs = "faqs";
	private $setting = "setting";
	private $comment = "comment";
	private $ourtour = "ourtour";
	private $promotion = "promotion";
	private $support = "support";
	private $insurance = "insurance";
	private $rss = "rss";
	private $tags = "tags";
	public function __construct(){
		parent::__construct();
		$this->load->library('pagination');
		if(strtolower($this->uri->segment(1)) == 'acp') {
			if($this->uri->segment(2) != 'login.html'){
				if($this->session->userdata('user_admin') == ""){
					header('Location: '.PATH_URL.'acp/logout');
				} else if(session_id() != $this->model->getContent($this->user, array('username' => $this->session->userdata('user_admin')), "user_active_key")->user_active_key) {
					header('Location: '.PATH_URL.'acp/logout');
				}
			}
			if($this->session->userdata('lange') == 'en') {
				$this->lang->load('en',"english");
			} else {
				$this->lang->load("vi","vietnam");
			}
			$this->template->set_template('admincp');
			$this->template->write_view('header','BACKEND/header');
			$this->template->write_view('left','BACKEND/left');
		} else {
			$this->template->set_template("home");
			if($this->uri->segment(1) == 'en') {
				$this->session->set_userdata('home_lang','_en');
				$this->session->set_userdata('diff_lang','');
				$this->lang->load('en',"english");
			} else {
				$this->session->set_userdata('home_lang','');
				$this->session->set_userdata('diff_lang','_en');
				$this->lang->load("vi","vietnam");
			}
			$home_lang = $this->session->userdata('home_lang');
			$this->session->set_userdata('article_record', 9);
			$header = array(
				'menu' => $this->model->getListContent($this->category, array('status' => 1, 'type' => 'menu', 'parent_id' => 0), 'order_by asc', null, null, "id, links$home_lang as links"),
				'setting' => $this->model->getContent($this->setting, null, "phone, email, owner_address, facebook_url, google_plus, twitter_plus, youtube_url, fax, owner_company, address, latitude, longitude, images, price_plus, usd_to_vnd"),
				'home_lang' => $home_lang
			);
			$this->template->write_view('header','FRONTEND/header',$header);
			$banner_footer = $this->model->getContent($this->category, array('links' => 'footer','type' => 'page', 'parent_id' => 0),"id");
			$news_id = $this->model->getContent($this->category, array('links' => 'news', 'type' => 'page', 'parent_id' => 0), 'id');
			$footer = array(
				'block_footer' => $this->model->getListContent($this->article, array('status' => 1, 'category_id' => $banner_footer?$banner_footer->id:0), 'order_by asc', null, null, "name$home_lang as name, content$home_lang as content"),
				'news' => $this->model->getListContent($this->article, array('status' => 1, 'category_id <> ' => 0, 'type' => 'article'), 'order_by asc, updated desc', 5, 0, "name$home_lang as name, links$home_lang as links")
			);
			$this->template->write_view('footer','FRONTEND/footer',$footer);
		}
	}

	public function index() { // Xong Ori 15.3.2016
		$home_lang = $this->session->userdata('home_lang');
		$menu_id = 6;

		// $popup_st = $this->session->userdata('popup_st');
		// if(!isset($popup_st)){
		// 	$this->session->set_userdata('popup_st',1);
		// 	$popup_status = 1;
		// }else{
		// 	$popup_status = 0;
		// }

		// if($popup_status == 1)
		$popup = $this->model->getContent('article', "FIND_IN_SET(category_id, 35) > 0 AND status = 1 AND type = 'banner'", "id, name$home_lang as name, links$home_lang as links, images");
		// else
		// 	$popup = '';

		$data = array(
			'banner' => $this->model->getListContent('article', "FIND_IN_SET(category_id, 9) > 0 AND status = 1 AND type = 'banner'",'order_by asc, updated desc', 3, null, "id, name$home_lang as name, content$home_lang as content, links$home_lang as links, images"),
			'tour' => $this->model->getListContent($this->article, array('type' => 'tour', 'status' => 1, 'category_id <>' => 0), 'order_by asc, updated desc', null, null, "name$home_lang as name, images, shortcontent$home_lang as shortcontent, links$home_lang as links, updated, id, category_id, title, keywords, description"),
			'category' => $this->model->getListContent($this->category, array('type' => 'tour', 'status' => 1), 'order_by asc', null, null, "name$home_lang as name, images, id"),
			'newest_video' => $this->model->getListContent('article', "FIND_IN_SET(category_id, 23) > 0 AND status = 1 AND type = 'banner' AND homepage = 1",'order_by asc, updated desc', 3, null, "id, name$home_lang as name, content$home_lang as content, links$home_lang as links, images"),
			'news' => $this->model->getListContent($this->article, array('type' => 'article', 'status' => 1, 'homepage' => 1, 'category_id <>' => 0), 'order_by asc, updated desc', 3, 0, "name$home_lang as name, images, shortcontent$home_lang as shortcontent, links$home_lang as links, updated, id, category_id"),
			'travel_gallery' => $this->model->getListContent('article', "FIND_IN_SET(category_id, 22) > 0 AND status = 1 AND type = 'banner' AND homepage = 1",'order_by asc, updated desc', null, null, "id, name$home_lang as name, content$home_lang as content, links$home_lang as links, images"),
			'reviews' => $this->model->getListContent('article', "FIND_IN_SET(category_id, 25) > 0 AND status = 1 AND type = 'banner'",'order_by asc', null, null, "name$home_lang as name, content$home_lang as content, links$home_lang as links, images"),
			'popup' => $popup,
			// 'popup_status' =>  $popup_status
		);
		$setting = $this->model->getContent($this->setting,null, "title, description, keywords");
		if($home_lang != ''){
			$this->template->write('links','');
		}else{
			$this->template->write('links','en');
		}
		$this->template->write('menu_id',$menu_id);
		$this->template->write('title',$setting->title);
		$this->template->write('description',$setting->description);
		$this->template->write('keywords',$setting->keywords);
		$this->template->write_view('content','FRONTEND/content/home',$data);
		$this->template->render();
	}

	public function sendNewsLetter() {
		if($_POST) {
			$data = array(
				'name' => $this->input->post('name'),
				'email' => $this->input->post('email'),
				'content' => $this->input->post('content'),
				'status' => 0,
				'created' => time()
			);
			if($this->db->insert('newsletter', $data)) {
				$this->session->set_flashdata('success',1);
				header('location:'.$_SERVER['HTTP_REFERER']);
			}

		}
	}

	public function about() { // Xong Ori 16.3.2016
		$home_lang = $this->session->userdata('home_lang');
		$diff_lang = $this->session->userdata('diff_lang');
		$menu_id = 7;
		$links = $this->model->getContent('category', array('id' => $menu_id), "links$diff_lang as links");
		$data = array(
			'banner' => $this->model->getListContent('article', "FIND_IN_SET(category_id, 27) > 0 AND status = 1 AND type = 'banner'",'order_by asc', null, null, "name$home_lang as name, content$home_lang as content, links$home_lang as links, images"),
			'founder' => $this->model->getListContent('article', "FIND_IN_SET(category_id, 26) > 0 AND status = 1 AND type = 'banner'",'order_by asc', null, null, "name$home_lang as name, content$home_lang as content, links$home_lang as links, images"),
			'featured' => $this->model->getListContent('article', "FIND_IN_SET(category_id, 28) > 0 AND status = 1 AND type = 'banner'",'order_by asc', null, null, "name$home_lang as name, content$home_lang as content, links$home_lang as links, images"),
			'team1' => $this->model->getListContent('article', "FIND_IN_SET(category_id, 30) > 0 AND status = 1 AND type = 'banner'",'order_by asc', null, null, "name$home_lang as name, content$home_lang as content, links$home_lang as links, images"),
			'team2' => $this->model->getListContent('article', "FIND_IN_SET(category_id, 31) > 0 AND status = 1 AND type = 'banner'",'order_by asc', null, null, "name$home_lang as name, content$home_lang as content, links$home_lang as links, images"),
			'vehicle' => $this->model->getListContent('article', "FIND_IN_SET(category_id, 29) > 0 AND status = 1 AND type = 'banner'",'order_by asc', null, null, "name$home_lang as name, content$home_lang as content, links$home_lang as links, images"),
			'title'  =>$this->model->getContent($this->category, array('id' => $menu_id), "name$home_lang as name, description, keywords,links"),
		);
		$setting = $this->model->getContent($this->category, array('id' => $menu_id), "name$home_lang as name, description, keywords");
		$this->template->write('menu_id',$menu_id);
		$this->template->write('links',$links->links);
		$this->template->write('title',$setting->name);
		$this->template->write('description',$setting->description);
		$this->template->write('keywords',$setting->keywords);
		$this->template->write_view('content','FRONTEND/content/about',$data);
		$this->template->render();
	}

	public function news($page = 0) {
		$home_lang = $this->session->userdata('home_lang');
		$diff_lang = $this->session->userdata('diff_lang');
		$menu_id = 12;
		//print_r((string)$page); exit();
		$links = $this->model->getContent('category', array('id' => $menu_id), "links$diff_lang as links");
		if($page != 0){
			$links->links .= '/'.$page;
		}
		// Phân trang
		$this->load->library('pagination');
		$newsalla = $this->model->getContent('category', array('id' => $menu_id), "links$home_lang as links");
		$config['total_rows'] = $this->db->get_where($this->article, array('type' => 'article', 'status' => 1))->num_rows();
		$config['base_url'] = PATH_URL.$newsalla->links;
		$config['uri_segment'] = 3; if($home_lang == ''){ $config['uri_segment'] = 2;}
		$config['per_page'] = 10;// $this->session->userdata('article_record');
		$config['num_links'] = 3;
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a>';
		$config['cur_tag_close'] = '</a></li>';
		$config['prev_link'] =  'Prev';
		$config['next_link'] = 'Next';
		$config['first_link'] =  '<<';
		$config['last_link'] = '>>';
		$this->pagination->initialize($config);
		//
		$data = array(
			'category' => $this->model->getListContent($this->category, array('type' => 'article', 'status' => 1), 'order_by asc, id desc', null, null, "links$home_lang as links, name$home_lang as name, id"),
			'news' => $this->model->getListContent($this->article, array('type' => 'article', 'status' => 1, 'category_id <>' => 0), 'order_by asc, updated desc', $config['per_page'], $page, "name$home_lang as name, images, shortcontent$home_lang as shortcontent, links$home_lang as links, updated, id, category_id"),
			'newsleft' => $this->model->getListContent($this->article, array('type' => 'article', 'status' => 1, 'category_id <>' => 0), 'updated desc', 3, 0, "name$home_lang as name, images, shortcontent$home_lang as shortcontent, links$home_lang as links, updated, id, category_id"),
			'featuredleft' => $this->model->getListContent($this->article, array('type' => 'article', 'status' => 1, 'featured' => 1, 'category_id <>' => 0), 'updated desc', 3, 0, "name$home_lang as name, images, shortcontent$home_lang as shortcontent, links$home_lang as links, updated, id, category_id"),
			'newsall' => $this->model->getContent('category', array('id' => $menu_id), "links$home_lang as links"),
			'pages' => $this->pagination->create_links(),
			'title'  =>$this->model->getContent($this->category, array('id' => $menu_id), "name$home_lang as name, description, keywords,links"),
		);
		$setting = $this->model->getContent($this->category, array('id' => $menu_id), "name$home_lang as name, description, keywords");
		//var_dump($data);
		//exit();
		$this->template->write('menu_id',$menu_id);
		$this->template->write('links',$links->links);
		$this->template->write('title',$setting->name);
		$this->template->write('description',$setting->description);
		$this->template->write('keywords',$setting->keywords);
		$this->template->write_view('content','FRONTEND/content/news',$data);
		$this->template->render();
	}

	public function category($url , $page = 0) {
		$home_lang = $this->session->userdata('home_lang');
		$diff_lang = $this->session->userdata('diff_lang');
		$menu_id = 12;
		if($home_lang != ''){
			$category = $this->model->getContent($this->category, array('links'.$home_lang => str_replace("_","",$home_lang).'/'.$url, 'type' => 'article'),"id, links$diff_lang as links, links$home_lang as links1");
		}else{
			$category = $this->model->getContent($this->category, array('links' => $url, 'type' => 'article'),"id, links$diff_lang as links, links$home_lang as links1");
		}
		if($home_lang == ''){
			$links = str_replace('en/','en/c/', $category->links);
		}else{
			$links = 'c/'.$category->links;
		}
		if($diff_lang == ''){
			$links2 = str_replace('en/','en/c/', $category->links1);
		}else{
			$links2 = 'c/'.$category->links1;
		}
		if($page != 0){
			$links .= '/'.$page;
		}
		// Phân trang
		$this->load->library('pagination');
		$config['total_rows'] = $this->db->get_where($this->article, array('type' => 'article', 'category_id' => $category->id, 'status' => 1))->num_rows();
		$config['base_url'] = PATH_URL.$links2;
		$config['uri_segment'] = 4; if($home_lang == ''){ $config['uri_segment'] = 3;}
		$config['per_page'] = $this->session->userdata('article_record');
		$config['num_links'] = 3;
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a>';
		$config['cur_tag_close'] = '</a></li>';
		$config['prev_link'] =  @_trang_truoc;
		$config['next_link'] = @_trang_sau;
		$config['first_link'] =  '<<';
		$config['last_link'] = '>>';
		$this->pagination->initialize($config);
		//
		$data = array(
			'category' => $this->model->getListContent($this->category, array('type' => 'article', 'status' => 1), 'order_by asc, id desc', null, null, "links$home_lang as links, name$home_lang as name, id"),
			'news' => $this->model->getListContent($this->article, array('type' => 'article', 'status' => 1, 'category_id' => $category->id), 'order_by asc, updated desc', $config['per_page'], $page, "name$home_lang as name, images, shortcontent$home_lang as shortcontent, links$home_lang as links, updated, id, category_id"),
			'newsleft' => $this->model->getListContent($this->article, array('type' => 'article', 'status' => 1, 'category_id <>' => 0), 'updated desc', 3, 0, "name$home_lang as name, images, shortcontent$home_lang as shortcontent, links$home_lang as links, updated, id, category_id"),
			'featuredleft' => $this->model->getListContent($this->article, array('type' => 'article', 'status' => 1, 'featured' => 1, 'category_id <>' => 0), 'updated desc', 3, 0, "name$home_lang as name, images, shortcontent$home_lang as shortcontent, links$home_lang as links, updated, id, category_id"),
			'newsall' => $this->model->getContent('category', array('id' => $menu_id), "links$home_lang as links"),
			'pages' => $this->pagination->create_links(),
			'title'  =>$this->model->getContent($this->category, array('id' => $menu_id), "name$home_lang as name, description, keywords,links"),
			'cate' => $category,
		);

		$setting = $this->model->getContent($this->category, array('id' => $category->id), "name$home_lang as name, description, keywords");
		$this->template->write('menu_id',$menu_id);
		$this->template->write('links',$links);
		$this->template->write('title',$setting->name);
		$this->template->write('description',$setting->description);
		$this->template->write('keywords',$setting->keywords);
		$this->template->write_view('content','FRONTEND/content/news',$data);
		$this->template->render();
	}

	public function search($page = 0) { // Xong Ori 16h 16.03.2016
		$home_lang = $this->session->userdata('home_lang');
		$diff_lang = $this->session->userdata('diff_lang');
		$keyword = $_GET['s'];
		$page_id = 2;
		$menu_id = 3;
		if($home_lang != ''){
			$links = 'search';
			$searchlinks = 'en/search';
		}else{
			$links = 'en/search';
			$searchlinks = 'search';
		}
		if($page != 0){
			$links .= '/'.$page;
		}
		$links .= '?s='.$keyword;
		// Phân trang
		$this->load->library('pagination');
		$config['total_rows'] = $this->db->get_where($this->article, array('type' => 'article', 'status' => 1, 'category_id <>' => 0, 'name'.$home_lang.' like' => '%'.$keyword.'%'))->num_rows();
		$config['base_url'] = PATH_URL.$searchlinks;
		$config['uri_segment'] = 3; if($home_lang == ''){ $config['uri_segment'] = 2;}
		$config['per_page'] = $this->session->userdata('article_record');
		$config['num_links'] = 3;
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a>';
		$config['cur_tag_close'] = '</a></li>';
		$config['prev_link'] =  @_trang_truoc;
		$config['next_link'] = @_trang_sau;
		$config['first_link'] =  '<<';
		$config['last_link'] = '>>';
		$config['reuse_query_string'] = FALSE;
		$config['suffix'] = '?s='.$keyword;
		$this->pagination->initialize($config);
		//
		$data = array(
			'banner' => $this->model->getListContent('article', "FIND_IN_SET(category_id, 30) > 0 AND status = 1 AND type = 'banner'",'order_by asc', null, null, "name$home_lang as name, content$home_lang as content, links$home_lang as links, images"),
			'result' => $this->model->search($this->article, $keyword, null, null, array('type' => 'article')),
		);
		$data = array(
			'banner' => $this->model->getListContent('article', "FIND_IN_SET(category_id, 30) > 0 AND status = 1 AND type = 'banner'",'order_by asc', null, null, "name$home_lang as name, content$home_lang as content, links$home_lang as links, images"),
			'result' => $this->model->getListContent($this->article, "FIND_IN_SET('".$page_id."', category_id) > 0 AND status = 1 AND type = 'article'", 'featured desc, order_by asc', null, 0, "id, name$home_lang as name, shortcontent$home_lang as shortcontent, links$home_lang as links, images, updated, category_id"),
			'category' => $this->model->getListContent($this->category, array('type' => 'article', 'status' => 1, 'category_id' => 2), 'order_by asc, id desc', null, null, "links$home_lang as links, name$home_lang as name, id"),
			'news' => $this->model->getListContent($this->article, array('type' => 'article', 'status' => 1, 'category_id <>' => 0, 'name'.$home_lang.' like' => '%'.$keyword.'%'), 'order_by asc, updated desc', $config['per_page'], $page, "name$home_lang as name, images, shortcontent$home_lang as shortcontent, links$home_lang as links, updated, id, category_id"),
			'newsleft' => $this->model->getListContent($this->article, array('type' => 'article', 'status' => 1, 'category_id <>' => 0), 'updated desc', 7, 0, "name$home_lang as name, images, shortcontent$home_lang as shortcontent, links$home_lang as links, updated, id, category_id"),
			'newsall' => $this->model->getContent('category', array('id' => 3), "links$home_lang as links"),
			'pages' => $this->pagination->create_links(),
		);
		$this->template->write('menu_id',$menu_id);
		$this->template->write('links',$links);
		$this->template->write('title',"Search: ".$keyword);
		$this->template->write('description',"Search");
		$this->template->write('keywords',"Search, ".$keyword);
		$this->template->write_view('content','FRONTEND/content/news',$data);
		$this->template->render();
	}

	public function faqs() {
		$home_lang = $this->session->userdata('home_lang');
		$diff_lang = $this->session->userdata('diff_lang');
		$menu_id = 17;
		$setting = $this->model->getContent($this->category, array('id' => $menu_id), "name$home_lang as name, description, keywords");
		$data = array(
			'result' => $this->model->getListContent('article', "FIND_IN_SET(category_id, 18) > 0 AND status = 1 AND type = 'banner'",'order_by asc', null, null, "id,name$home_lang as name, content$home_lang as content, links$home_lang as links, images"),
			'setting' => $setting,
			'title'  =>$this->model->getContent($this->category, array('id' => $menu_id), "name$home_lang as name, description, keywords,links"),
		);
		$this->template->write('menu_id',$menu_id);
		$this->template->write('title',$setting->name);
		$this->template->write('description',$setting->description);
		$this->template->write('keywords',$setting->keywords);
		$this->template->write_view('content','FRONTEND/content/faqs',$data);
		$this->template->render();
	}

	public function ourtour() {
		$home_lang = $this->session->userdata('home_lang');
		$diff_lang = $this->session->userdata('diff_lang');
		$menu_id = 24;

		$data = array(
			'banner' => $this->model->getListContent('article', "FIND_IN_SET(category_id, 9) > 0 AND status = 1 AND type = 'banner'",'order_by asc, updated desc', 3, null, "id, name$home_lang as name, content$home_lang as content, links$home_lang as links, images"),
			'article' => $this->model->getListContent($this->article, array('type' => 'tour', 'status' => 1, 'category_id <>' => 0), 'category_id, updated desc', null, null, "name$home_lang as name , images, shortcontent$home_lang as shortcontent, links$home_lang as links, updated, id, category_id , title, keywords, description"),
			'category' => $this->model->getListContent($this->category, array('type' => 'tour', 'status' => 1), 'name','group_by asc', null, null, "name$home_lang as name, images, id"),
			'reviews' => $this->model->getListContent('article', "FIND_IN_SET(category_id, 25) > 0 AND status = 1 AND type = 'banner'",'order_by asc', null, null, "name$home_lang as name, content$home_lang as content, links$home_lang as links, images"),
			'title'  =>$this->model->getContent($this->category, array('id' => $menu_id), "name$home_lang as name, description, keywords,links"),

		);
		$setting = $this->model->getContent($this->setting,null, "title, description, keywords");
		if($home_lang != ''){
			$this->template->write('links','');
		}else{
			$this->template->write('links','en');
		}
		$this->template->write('menu_id',$menu_id);
		$this->template->write('title',' Our Tours');
		$this->template->write('description',$setting->description);
		$this->template->write('keywords',$setting->keywords);
		$this->template->write_view('content','FRONTEND/content/ourtour',$data);
		$this->template->render();
	}
	public function promotion() {
		$home_lang = $this->session->userdata('home_lang');
		$diff_lang = $this->session->userdata('diff_lang');
		$menu_id = 39;

		$setting = $this->model->getContent($this->category, array('id' => $menu_id), "name$home_lang as name, description, keywords");
		$data = array(
			'result' => $this->model->getListContent('article', "FIND_IN_SET(category_id, 39) > 0 AND status = 1 AND type = 'banner'",'order_by asc', null, null, "id,name$home_lang as name, content$home_lang as content, links$home_lang as links, images"),
			'setting' => $setting,
			'title'  =>$this->model->getContent($this->category, array('id' => $menu_id), "name$home_lang as name, description, keywords,links"),
		);
		$this->template->write('menu_id',$menu_id);
		$this->template->write('title',$setting->name);
		$this->template->write('description',$setting->description);
		$this->template->write('keywords',$setting->keywords);
		$this->template->write_view('content','FRONTEND/content/support',$data);
		$this->template->render();
	}
	public function support() {
		$home_lang = $this->session->userdata('home_lang');
		$diff_lang = $this->session->userdata('diff_lang');
		$menu_id = 41;

		$setting = $this->model->getContent($this->category, array('id' => $menu_id), "name$home_lang as name, description, keywords");
		$data = array(
			'result' => $this->model->getListContent('article', "FIND_IN_SET(category_id, 41) > 0 AND status = 1 AND type = 'banner'",'order_by asc', null, null, "id,name$home_lang as name, content$home_lang as content, links$home_lang as links, images"),
			'setting' => $setting,
			'title'  =>$this->model->getContent($this->category, array('id' => $menu_id), "name$home_lang as name, description, keywords,links"),
		);
		$this->template->write('menu_id',$menu_id);
		$this->template->write('title',$setting->name);
		$this->template->write('description',$setting->description);
		$this->template->write('keywords',$setting->keywords);
		$this->template->write_view('content','FRONTEND/content/pro-sup',$data);
		$this->template->render();
	}

	public function insurance() {
		$home_lang = $this->session->userdata('home_lang');
		$diff_lang = $this->session->userdata('diff_lang');
		$menu_id = 43;

		$setting = $this->model->getContent($this->category, array('id' => $menu_id), "name$home_lang as name, description, keywords");
		$data = array(
			'result' => $this->model->getListContent('article', "FIND_IN_SET(category_id, 43) > 0 AND status = 1 AND type = 'banner'",'order_by asc', null, null, "id,name$home_lang as name, content$home_lang as content, links$home_lang as links, images"),
			'setting' => $setting,
			'title'  =>$this->model->getContent($this->category, array('id' => $menu_id), "name$home_lang as name, description, keywords,links"),
		);
		$this->template->write('menu_id',$menu_id);
		$this->template->write('title',$setting->name);
		$this->template->write('description',$setting->description);
		$this->template->write('keywords',$setting->keywords);
		$this->template->write_view('content','FRONTEND/content/insurance',$data);
		$this->template->render();
	}
	public function rss() {
		$home_lang = $this->session->userdata('home_lang');
		$diff_lang = $this->session->userdata('diff_lang');
		$data = array(
			'article' => $this->model->getListContent($this->article,array('type'=>'article','status'=> 1), 'order_by asc, id desc', null, null, "links$home_lang as links, name$home_lang as name, id"),
			'tour' => $this->model->getListContent($this->article,array('type'=>'tour','status'=> 1), 'order_by asc, id desc', null, null, "links$home_lang as links, name$home_lang as name, id"),
			'page' => $this->model->getListContent($this->category,array('type'=>'menu','status'=> 1), 'order_by asc, id desc', null, null, "links$home_lang as links, name$home_lang as name, id"),
		);
		$this->template->write('title','Rss');
		$this->template->write('description','Rss');
		$this->template->write('keywords','Rss');
		$this->template->write_view('content','FRONTEND/content/rss',$data);
		$this->template->render();
	}

	public function rss_detail($id) {  
		$home_lang = $this->session->userdata('home_lang');
		$diff_lang = $this->session->userdata('diff_lang');

		$result = $this->model->getContent($this->article, array("id" => $id), "name$home_lang as name, links$diff_lang as links1, shortcontent$home_lang as shortcontent, content$home_lang as content, images, updated, title, description, keywords,id,category_id, tags,links");
		
		if(empty($result)){
			header('location:'.PATH_URL.str_replace("_","",$home_lang));
			exit();
		}
		$data = array(
			'result' => $result,
		);

		$data['feed_name'] = 'saigonadventure.com';
		$data['encoding'] = 'utf-8';
		$data['feed_url'] = 'http://www.saigonadventure.com'.'/'.$result->links;
		$data['page_description'] = $result->content;
		$this->template->write('links',$result->links1);
		$this->template->write('title',$result->name);
		$this->template->write('description',$result->name);
		$this->template->write('meta_image', PATH_URL.'media/'.$result->images);
		$this->template->write('keywords',$result->keywords);
		$this->load->view('FRONTEND/content/rss_detail',$data);
		$this->output->set_header("Content-Type: application/rss+xml");
		
		
	}

	public function testimonials($page = 0) {
		$home_lang = $this->session->userdata('home_lang');
		$diff_lang = $this->session->userdata('diff_lang');
		$menu_id = 19;
		$links = $this->model->getContent('category', array('id' => $menu_id), "links$diff_lang as links");
		if($page != 0){
			$links->links .= '/'.$page;
		}
		// Phân trang
		$this->load->library('pagination');
		$testall = $this->model->getContent('category', array('id' => $menu_id), "links$home_lang as links");
		$config['total_rows'] = $this->db->get_where($this->article, array('type' => 'banner', 'status' => 1,'category_id' => 20))->num_rows();
		$config['base_url'] = PATH_URL.$testall->links;
		$config['uri_segment'] = 3; if($home_lang == ''){ $config['uri_segment'] = 2;}
		$config['per_page'] = 5;
		$config['num_links'] = 1;
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a>';
		$config['cur_tag_close'] = '</a></li>';
		$config['prev_link'] =  'Prev';
		$config['next_link'] = 'Next';
		$config['first_link'] =  '<<';
		$config['last_link'] = '>>';

		$this->pagination->initialize($config);

		$setting = $this->model->getContent($this->category, array('id' => $menu_id), "name$home_lang as name, description, keywords");
		$data = array(
			'result' => $this->model->getListContent('article', "FIND_IN_SET(category_id, 20) > 0 AND status = 1 AND type = 'banner'",'order_by asc', $config['per_page'], $page, null, null, "id,name$home_lang as name, content$home_lang as content, links$home_lang as links, images"),
			'setting' => $setting,
			'testall' => $this->model->getContent('category', array('id' => $menu_id), "links$home_lang as links"),
			'pages' => $this->pagination->create_links(),
			'title'  =>$this->model->getContent($this->category, array('id' => $menu_id), "name$home_lang as name, description, keywords,links"),
		);

		$this->template->write('menu_id',$menu_id);
		$this->template->write('title',$setting->name);
		$this->template->write('description',$setting->description);
		$this->template->write('keywords',$setting->keywords);
		$this->template->write_view('content','FRONTEND/content/testimonials',$data);
		$this->template->render();
	}

	public function gallery() {
		$home_lang = $this->session->userdata('home_lang');
		$diff_lang = $this->session->userdata('diff_lang');
		$menu_id = 21;
		$setting = $this->model->getContent($this->category, array('id' => $menu_id), "name$home_lang as name, description, keywords");
		$data = array(
			'result' => $this->model->getListContent('article', "FIND_IN_SET(category_id, 22) > 0 AND status = 1 AND type = 'banner'",'order_by asc', null, null, "id,name$home_lang as name, content$home_lang as content, links$home_lang as links, images"),
			'resultvideo' => $this->model->getListContent('article', "FIND_IN_SET(category_id, 23) > 0 AND status = 1 AND type = 'banner'",'order_by asc', null, null, "id,name$home_lang as name, content$home_lang as content, links$home_lang as links, images"),
			'setting' => $setting,
			'title'  =>$this->model->getContent($this->category, array('id' => $menu_id), "name$home_lang as name, description, keywords,links"),
		);
		$this->template->write('menu_id',$menu_id);
		$this->template->write('title',$setting->name);
		$this->template->write('description',$setting->description);
		$this->template->write('keywords',$setting->keywords);
		$this->template->write_view('content','FRONTEND/content/gallery',$data);
		$this->template->render();
	}

	public function detail($links) {  // Xong Ori 17h 16.03.2016
		$home_lang = $this->session->userdata('home_lang');
		$diff_lang = $this->session->userdata('diff_lang');
		$menu_id = 3;
		if(!empty($home_lang)){
			$lang = "en/".$links;
		}else{
			$lang = $links;
		}
		$result = $this->model->getContent($this->article, array("links$home_lang" => $lang), "name$home_lang as name, links$home_lang as links, links$diff_lang as links1, shortcontent$home_lang as shortcontent, content$home_lang as content, images, updated, title, description, keywords,id,category_id, tags");
		if(empty($result)){
			header('location:'.PATH_URL.str_replace("_","",$home_lang));
			exit();
		}
		$data = array(
			'banner' => $this->model->getListContent('article', "FIND_IN_SET(category_id, 30) > 0 AND status = 1 AND type = 'banner'",'order_by asc', null, null, "name$home_lang as name, content$home_lang as content, links$home_lang as links, images"),
			'result' => $result,
			'other' => $this->model->getListContent($this->article, array('category_id' => $result->category_id, 'id <> ' => $result->id, 'status' => 1), 'order_by asc, updated desc', null, null, "name$home_lang as name, images, links$home_lang as links, shortcontent$home_lang as shortcontent,id,category_id,updated "),
			'category' => $this->model->getListContent($this->category, array('type' => 'article', 'status' => 1, 'category_id' => 2), 'order_by asc, id desc', null, null, "links$home_lang as links, name$home_lang as name, id"),
			'title'  =>$this->model->getContent($this->category, array('id' => 12), "name$home_lang as name, description, keywords,links"),
		);
		$this->template->write('menu_id',$menu_id);
		$this->template->write('links',$result->links1);
		$this->template->write('title',$result->title);
		$this->template->write('description',$result->description);
		$this->template->write('meta_image', PATH_URL.'media/'.$result->images);
		$this->template->write('keywords',$result->keywords);
		$this->template->write_view('content','FRONTEND/content/detail',$data);
		$this->template->render();
	}

	public function tour_detail($id) {  // Xong Ori 17h 16.03.2016
		$home_lang = $this->session->userdata('home_lang');
		$diff_lang = $this->session->userdata('diff_lang');
		$result = $this->model->getContent($this->article, array("links$home_lang" => $id), "name$home_lang as name, links$home_lang as links, links$diff_lang as links1, shortcontent$home_lang as shortcontent, content$home_lang as content, images, updated, title, description, keywords,id,category_id, tags");
		if(empty($result)){
			header('location:'.PATH_URL.str_replace("_","",$home_lang));
			exit();
		}
		$data = array(
			'banner' => $this->model->getListContent('article', "FIND_IN_SET(category_id, 30) > 0 AND status = 1 AND type = 'banner'",'order_by asc', null, null, "name$home_lang as name, content$home_lang as content, links$home_lang as links, images"),
			'result' => $result,
			'other' => $this->model->getListContent($this->article, array('category_id' => $result->category_id, 'id <> ' => $result->id, 'status' => 1), 'order_by asc, updated desc', null, null, "name$home_lang as name, images, links$home_lang as links, shortcontent$home_lang as shortcontent,id,category_id,updated "),
			'category' => $this->model->getListContent($this->category, array('type' => 'article', 'status' => 1, 'category_id' => 2), 'order_by asc, id desc', null, null, "links$home_lang as links, name$home_lang as name, id"),
			'title'  =>$this->model->getContent($this->category, array('id' => 24), "name$home_lang as name, description, keywords,links"),
		);
		$this->template->write('links',$result->links1);
		$this->template->write('title',$result->name);
		$this->template->write('description',$result->description);
		$this->template->write('meta_image', PATH_URL.'media/'.$result->images);
		$this->template->write('keywords',$result->keywords);
		$this->template->write_view('content','FRONTEND/content/tour_detail',$data);
		$this->template->render();
	}
	public function add_tour() {  // Xong Ori 17h 16.03.2016
		$tour = $this->session->userdata('book_tour[tour]');
		if($_POST) {
			$id = $this->input->post('id');
			$this_tour['name'] = $this->model->getContent($this->article, array('id' => $id), "name")->name;
			$this_tour['date'] = '';
			$this_tour['time'] = '';
			$this_tour['service'] = '';
			$this_tour['guest'] = 1;
			$this_tour['transportation'] = '';
			if(empty($tour)){
				$tour[$id] = $this_tour;
				$this->session->set_userdata('book_tour[tour]', $tour);
			}else{
				foreach($tour as $key=>$to){
					if($id != $key){
						$tour[$id] = $this_tour;
					}
				}
				$this->session->set_userdata('book_tour[tour]', $tour);
			}

		}
		header('location:'.PATH_URL.str_replace("_","",$home_lang).'booking');
	}
	public function update_tour() {  // Xong Ori 17h 16.03.2016
		$tour = $this->session->userdata('book_tour[tour]');
		$data = array();

		$this_tour['name'] = $this->model->getContent($this->article, array('id' => $_POST['val']), "name")->name;
		$this_tour['date'] = '';
		$this_tour['time'] = '';
		$this_tour['service'] = '';
		$this_tour['guest'] = 1;
		$this_tour['transportation'] = '';
		$check = 0;
		foreach($tour as $key=>$to){
			if($_POST['val'] == $key){
				$check = 1;
			}
		}
		if($check == 0){
			$tour[$_POST['val']] = $this_tour;
			$timeopt = '';
			$timeopt2 = '';
			$tmp = $this->model->getContent($this->article, array('id' => $_POST['val']), "keywords")->keywords;
			$tmp = explode(',', $tmp);
			if(!empty($tmp)){
				$i=0;
				foreach($tmp as $tp){
					if($tp != ''){
						$i++;
						$timeopt .= '<option value="'.$tp.'">'.$tp.'</option>';
						if($i == 1){
							$timeopt2 .= '<span class="current">'.$tp.'</span>';
							$timeopt2 .= '<ul class="list">';
							$timeopt2 .= '<li class="option selected focus" data-value="'.$tp.'">'.$tp.'</li>';
						}else{
							$timeopt2 .= '<li class="option" data-value="'.$tp.'">'.$tp.'</li>';
						}
					}
				}
				$timeopt2 .= '</ul>';
			}

			$transportationopt = '';
			$transportationopt2 = '';
			$category_id = explode(',', $this->model->getContent($this->article, array('id' => $_POST['val']), "category_id")->category_id);
			if(!empty($category_id)){
				$category_name = array();
				foreach ($category_id as $key => $value) {
					$category_name[] = $this->model->getContent($this->category, array('id' => $value), "name , id");
				}
			}

			if(!empty($category_name)){
				$i=0;
				foreach($category_name as $tp){
					if($tp != ''){
						$i++;
						$transportationopt .= '<option value="'.$tp->id.'">'.$tp->name.'</option>';
						if($i == 1){
							$transportationopt2 .= '<span class="current">'.$tp->name.'</span>';
							$transportationopt2 .= '<ul class="list">';
							$transportationopt2 .= '<li class="option selected focus" data-value="'.$tp->id.'">'.$tp->name.'</li>';
						}else{
							$transportationopt2 .= '<li class="option" data-value="'.$tp->id.'">'.$tp->name.'</li>';
						}
					}
				}
				$transportationopt2 .= '</ul>';
			}

			unset($tour[$_POST['id']]);
			$data = array(
				'type' => 0,
				'timeopt' 			=> $timeopt,
				'timeopt2' 			=> $timeopt2,
				'transportationopt' => $transportationopt,
				'transportationopt2'=> $transportationopt2
			);
		}else{
			$data = array('type' => 1);
		}
		$this->session->set_userdata('book_tour[tour]', $tour);

		echo json_encode($data);
	}
	public function del_tour($id) {  // Xong Ori 17h 16.03.2016
		$tour = $this->session->userdata('book_tour[tour]');
		unset($tour[$id]);
		$this->session->set_userdata('book_tour[tour]', $tour);
		header('location:'.PATH_URL.str_replace("_","",$home_lang).'booking');
	}

	public function booking () {  // Xong Ori 17h 16.03.2016
		$home_lang = $this->session->userdata('home_lang');
		$diff_lang = $this->session->userdata('diff_lang');
		if($_POST){
			$tour = $this->session->userdata('book_tour[tour]');
			foreach($tour as $key=>$to){
				$tour[$key]['name']	= $this_tour['name'] = $this->model->getContent($this->article, array('id' => $_POST['name_'.$key]), "name")->name;
				$tour[$key]['date']	= $_POST['date_'.$key];
				$tour[$key]['time']	= $_POST['time_'.$key];
				$tour[$key]['service']= $_POST['service_'.$key];
				$tour[$key]['transportation'] = $_POST['transportation_'.$key];
				$tour[$key]['guest'] = $_POST['guest_'.$key];
				if(empty($tour[$key]['date'])||empty($tour[$key]['guest'])||empty($tour[$key]['time'])||empty($tour[$key]['transportation']) )
				{
					header('location:'.PATH_URL.str_replace("_","",$home_lang).'booking');
					exit();
					
				}
			}
			$this->session->set_userdata('book_tour[tour]', $tour);
			header('location:'.PATH_URL.str_replace("_","",$home_lang).'information');
		}
		$data = array(
			'tour' => $this->session->userdata('book_tour[tour]'),
			'tour_name' =>  $this->model->getListContent($this->article, array('type' => 'tour', 'status' => 1, 'category_id <>' => 0), 'order_by asc', null, null, "name, id"),

		);
		$this->template->write('title','Booking');
		$this->template->write_view('content','FRONTEND/content/booking',$data);
		$this->template->render();
	}

	public function information() {  // Xong Ori 17h 16.03.2016
		$home_lang = $this->session->userdata('home_lang');
		$diff_lang = $this->session->userdata('diff_lang');
		$ori_tmp = $this->session->userdata('book_tour[tour]');
		if(empty($ori_tmp)){
			header('location:'.PATH_URL.str_replace("_","",$home_lang).'booking');
		}
		if($_POST){
			$this->session->set_userdata('book_tour[info]', $_POST);
			header('location:'.PATH_URL.str_replace("_","",$home_lang).'payment');
		}
		$data = array(
			'info' => $this->session->userdata('book_tour[info]'),
		);
		$this->template->write('title','Infomation');
		$this->template->write_view('content','FRONTEND/content/information',$data);
		$this->template->render();
	}

	public function payment() {  // Xong Ori 17h 16.03.2016
		$home_lang = $this->session->userdata('home_lang');
		$diff_lang = $this->session->userdata('diff_lang');
		$ori_tmp = $this->session->userdata('book_tour[tour]');
		$ori_tmp2 = $this->session->userdata('book_tour[info]');
		if(empty($ori_tmp) || empty($ori_tmp2)){
			header('location:'.PATH_URL.str_replace("_","",$home_lang).'booking');
		}
		if($_POST){
			$setting = $this->model->getContent($this->setting, null, "phone, email, owner_address, facebook_url, google_plus, twitter_plus, youtube_url, fax, owner_company, address, latitude, longitude, images, price_plus, usd_to_vnd");

			$info = $this->session->userdata('book_tour[info]');
			if($_POST['currency'] == 2){
				$info['price'] = ($this->session->userdata('book_tour[payment][price]'))*($setting->usd_to_vnd);
			}else{
				$info['price'] = $this->session->userdata('book_tour[payment][price]');
			}
			$info['payment'] = $_POST['payment'];
			$info['currency'] = $_POST['currency'];
			$info['created'] = time();
			$info['status'] = 1;
			unset($info['reemail']);

			if($this->model->saveContent($this->info,$info)){
				$id = $this->db->insert_id();
				$tmp_tour = $this->session->userdata('book_tour[tour]');
				$tour = array();
				$html_tmp = '';
				foreach($tmp_tour as $key=>$to){
					$tour = array();
					$tour['tour_id'] = $key;
					$tour['info_id'] = $id;
					$tour['name'] = $to['name'];
					$tour['date'] = $to['date'];
					$tour['time'] = $to['time'];
					$tour['service'] = $to['service'];
					$tour['transportation']	= $to['transportation'];
					$tour['guest'] = $to['guest'];

					$html_tmp .= '<tr>
					<td style="padding:10px">'.$tour['name'].'</td>
					<td style="padding:10px">'.$tour['date'].'</td>
					<td style="padding:10px">'.$tour['time'].'</td>
					<td style="padding:10px">'.(($tour['service']==1)? 'Private Tour':'None Service').'</td>
					<td style="padding:10px">'.$this->model->getContent($this->category, array('id' => $tour['transportation']), "name")->name.'</td>
					<td style="padding:10px">'.$tour['guest'].'</td>
					</tr>';
					$this->model->saveContent($this->book,$tour);
				}

				//Mail here
				?>

				<?php
				$info_s = $this->model->getContent($this->setting, null, "email,website_title");
				$html = '<div style="width:100%">
				<h3>BASIC INFORMATION</h3>
				<div style="padding-left: 10px;">
				<p>Fullname: '.$info['firstname'].' '.$info['lastname'].'</p>
				
				<p>Email: '.$info['email'].'</p>
				<p>Phone number: '.$info['phone'].'</p>
				
				</div>
				<h3>HOTEL INFORMATION</h3>
				<div style="padding-left: 10px;">
				<p>Hotel name: '.$info['hname'].'</p>
				<p>Room number: '.$info['hroom'].'</p>
				<p>Hotel address: '.$info['haddress'].'</p>
				<p>Notes: '.$info['hnote'].'</p>
				</div>
				<h3>TOUR DETAILS</h3>
				<div>
				<table>
				<thead style="background:#cecece">
				<tr>
				<th style="padding:10px">TOUR NAME</th>
				<th style="padding:10px">TOUR DATE</th>
				<th style="padding:10px">TOUR TIME</th>
				<th style="padding:10px">OPTIONAL SERVICES</th>
				<th style="padding:10px">TRANSPORTATION</th>
				<th style="padding:10px">GUESTS</th>
				</tr>
				</thead>
				<tbody>'.$html_tmp.'</tbody>
				<tfoot>
				<tr>
				<td style="padding:20px 10px 10px; text-align:right;" colspan="5"><b>Total Price: '.(($info['currency']==1)? '$'.(number_format($info['price'])):(number_format($info['price'])).'VND').'</b></td>
				</tr>
				</tfoot>
				</table>
				</div>
				</div>';
				$this->load->library('My_email');
				$mail = new PHPMailer(true);
				$mail->IsSMTP();
				$mail->SMTPDebug = 0; // enables SMTP debug information
				$mail->SMTPAuth = true; // enable SMTP authentication

// SMTP Email Server Information
$mail->Host = 'smtp.sendgrid.net'; // sets the SMTP server
$mail->Port = '587'; // Set the SMTP port
$mail->Username = 'saigonadventure'; // SMTP account username
$mail->Password = 'j-QE*F4cj4cmv6z'; // SMTP account password
//// SMTP Email Server Information

// $mail->AddAddress($info_s->email, $info_s->website_title.' Booking Form');
// $mail->AddAddress('tuananhnguyenhoang0410@gmail.com', $info_s->website_title.' Booking Form');

$mail->AddAddress($info_s->email, $info_s->website_title.' Booking Form: '.$info['email']);
$mail->AddReplyTo($info['email'], 'Reply to: ');
// $mail->AddAddress($info_s->email, $info_s->website_title.' Booking Form');
				//$mail->AddCC($info_s->email);
//$mail->AddCC('tuananhnguyenhoang0410@gmail.com');
$mail->SetFrom("no-reply@saigonadventure.com", $info_s->website_title.' Booking Form: '.$info['email']);
$mail->Subject = $info_s->website_title.' Booking Form: '.$info['email'];
$mail->MsgHTML($html);
$mail->Send();

				//Mail here

$this->session->set_userdata('book_tour[tour]', '');
$this->session->set_userdata('book_tour[payment][price]', '');
header('location:'.PATH_URL.str_replace("_","",$home_lang).'completed/'.$id);
}
}
$tour = $this->session->userdata('book_tour[tour]');
$setting = $this->model->getContent($this->setting, null, "phone, email, owner_address, facebook_url, google_plus, twitter_plus, youtube_url, fax, owner_company, address, latitude, longitude, images, price_plus, usd_to_vnd");
$price = 0;
$discount = 0;
$discount1 = 0;
foreach($tour as $key=>$to){

	$discount1 = $this->model->getContent($this->article, array('id' => $key), "title")->title;
	if($to['service'] == '1'){
		$discount1 = ($discount1+ $setting->price_plus)*$to['guest'];			
	}
	else{
		$discount1 *= $to['guest'];

		if ($key=='66')
		{
			if($to['guest']==1)
			{
				$discount1 = $to['guest']*170;
			}
			else if ($to['guest']==2)
			{
				$discount1 = $to['guest']*95;
			}
			else if ($to['guest']==3)
			{
				$discount1 = $to['guest']*75;
			}
			else if ($to['guest']==4)
			{
				$discount1 = $to['guest']*65;
			}
			else if ($to['guest']>=5)
			{
				$discount1 = $to['guest']*55;
			}


		}
		if ($key=='93')
		{
			if($to['guest']==1)
			{
				$discount1 = $to['guest']*190;
			}
			else if ($to['guest']==2)
			{
				$discount1 = $to['guest']*109;
			}
			else if ($to['guest']==3)
			{
				$discount1 = $to['guest']*89;
			}
			else if ($to['guest']==4)
			{
				$discount1 = $to['guest']*79;
			}
			else if ($to['guest']>=5)
			{
				$discount1 = $to['guest']*69;
			}

		}


		if ($key=='92')
		{
			if($to['guest']==1)
			{
				$discount1 = $to['guest']*123;
			}
			else if ($to['guest']==2)
			{
				$discount1 = $to['guest']*69;
			}
			else if ($to['guest']==3)
			{
				$discount1 = $to['guest']*55;
			}
			else if ($to['guest']==4)
			{
				$discount1 = $to['guest']*49;
			}
			else if ($to['guest']>=5)
			{
				$discount1 = $to['guest']*47;
			}

		}

		if ($key=='54')
		{

			if($to['guest']==1)
			{
				$discount1 = $to['guest']*85;
			}
			else if ($to['guest']==2)
			{
				$discount1 = $to['guest']*50;
			}
			else if ($to['guest']==3)
			{
				$discount1 = $to['guest']*40;
			}
			else if ($to['guest']==4)
			{
				$discount1 = $to['guest']*37;
			}
			else if ($to['guest']>=5)
			{
				$discount1 = $to['guest']*34;
			}

		}
		if ($key=='49')
		{
			if($to['guest']<=2)
			{
				$discount1 = 25;
			}
			else if ($to['guest']>=3 && $to['guest']<=5)
			{
				$discount1 = 35;
			}
			else if ($to['guest']>=6)
			{
				$discount1 = 60;
			}

		}
		if ($key=='69')
		{
			if($to['guest']==1)
			{
				$discount1 = $to['guest']*345;
			}
			else if ($to['guest']==2)
			{
				$discount1 = $to['guest']*195;
			}
			else if ($to['guest']==3)
			{
				$discount1 = $to['guest']*175;
			}
			else if ($to['guest']==4)
			{
				$discount1 = $to['guest']*155;
			}
			else if ($to['guest']>=5)
			{
				$discount1 = $to['guest']*145;
			}

		}
		if ($key=='96')
		{
			if($to['guest']==1)
			{
				$discount1 = $to['guest']*290;
			}
			else if ($to['guest']==2)
			{
				$discount1 = $to['guest']*165;
			}
			else if ($to['guest']==3)
			{
				$discount1 = $to['guest']*145;
			}
			else if ($to['guest']==4)
			{
				$discount1 = $to['guest']*125;
			}
			else if ($to['guest']>=5)
			{
				$discount1 = $to['guest']*115;
			}

		}

			if ($key=='157')
		{
			if($to['guest']==1)
			{
				$discount1 = $to['guest']*69;
			}
			else if ($to['guest']==2)
			{
				$discount1 = $to['guest']*39;
			}
			else if ($to['guest']==3)
			{
				$discount1 = $to['guest']*35;
			}
			else if ($to['guest']==4)
			{
				$discount1 = $to['guest']*29;
			}
			else if ($to['guest']>=5)
			{
				$discount1 = $to['guest']*27;
			}

		}


			if ($key=='158')
		{
			if($to['guest']==1)
			{
				$discount1 = $to['guest']*145;
			}
			else if ($to['guest']==2)
			{
				$discount1 = $to['guest']*85;
			}
			else if ($to['guest']==3)
			{
				$discount1 = $to['guest']*69;
			}
			else if ($to['guest']==4)
			{
				$discount1 = $to['guest']*60;
			}
			else if ($to['guest']>=5)
			{
				$discount1 = $to['guest']*53;
			}

		}

	}
	$discount += $discount1;

	// if($key=='49' || $key=='54' ||$key=='92' ||$key=='66' ||$key=='93')
	// {
	// 	$price = $discount*0.9;
	// }
	// else if($key=='46' || $key=='43' ||$key=='39' ||$key=='40' ||$key=='64')
	// {
	// 	$price = $discount*0.85;
	// }
	// else
	// 	{
	// 		$price = $discount;
	// 	}


}


// $price = $discount*0.85;
if(count($tour)>1){
	$price = $discount - ($discount*0.05);
}else{
	$price = $discount;
	
}

$this->session->set_userdata('book_tour[payment][price]',$price);
$data = array(
	'price' => $price,
	'discount' => $discount,
);

$this->template->write('title','Payment');
$this->template->write_view('content','FRONTEND/content/payment',$data);
$this->template->render();
}

	public function completed() {  // Xong Ori 17h 16.03.2016
		$home_lang = $this->session->userdata('home_lang');
		$diff_lang = $this->session->userdata('diff_lang');
		$data = array(
			'data' => '',
		);
		$this->template->write('title','Completed book tour');
		$this->template->write_view('content','FRONTEND/content/completed',$data);
		$this->template->render();
	}

	public function contact() {
		$home_lang = $this->session->userdata('home_lang');
		$diff_lang = $this->session->userdata('diff_lang');
		$menu_id = 8;
		$links = $this->model->getContent('category', array('id' => $menu_id), "links$diff_lang as links");
		$data = array(
			'banner' => $this->model->getListContent('article', "FIND_IN_SET(category_id, 40) > 0 AND status = 1 AND type = 'banner'",'order_by asc', null, null, "name$home_lang as name, content$home_lang as content, links$home_lang as links, images"),
			'result' => $this->model->getListContent($this->article, "FIND_IN_SET('".$menu_id."', category_id) > 0 AND status = 1 AND type = 'banner'", 'featured desc, order_by asc', null, 0, "id, name$home_lang as name, content$home_lang as content, images"),
			'aa' => $this->session->userdata('ori_contact'),
		);
		$setting = $this->model->getContent($this->category, array('id' => $menu_id), "name$home_lang as name, description, keywords");
		$this->template->write('menu_id',$menu_id);
		$this->template->write('links',$links->links);
		$this->template->write('title',$setting->name);
		$this->template->write('description',$setting->description);
		$this->template->write('keywords',$setting->keywords);
		$this->template->write_view('content','FRONTEND/content/contact',$data);
		$this->template->render();
	}

	public function tags($links) {
		$home_lang = $this->session->userdata('home_lang');
		$menu = $this->model->getContent($this->tags, array('links' => $links),'name');
		$data = array(
			'result' => $this->model->getListContent($this->article, "FIND_IN_SET('".$menu->name."', tags) > 0 AND status = 1 AND type = 'article'", 'featured desc, order_by asc', null, 0, "id, name$home_lang as name, links$home_lang as links, images, updated, category_id")
		);
		$this->template->write('title',"tags ".$menu->name);
		$this->template->write('description',"tags ".$menu->name);
		$this->template->write('keywords',"tags ".$menu->name);
		$this->template->write_view('content','FRONTEND/content/news',$data);
		$this->template->render();
	}

	public function saveComment() {
		$data = array(
			'name' => $this->input->post('author'),
			'email' => $this->input->post('email'),
			'content' => $this->input->post('comment'),
			'article_id' => $this->input->post('article_id'),
			'parent_id' => $this->input->post('comment_parent'),
			'created' => time()
		);
		if($this->model->saveContent($this->comment, $data)){
			header('location:'.$_SERVER['HTTP_REFERER'].'#comments');
		}
	}
}
