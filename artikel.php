<?php class Artikel extends CI_Controller {

    function terbaru()    {
      $this->load->model('M_artikel');
	$data['query'] = $this->M_artikel->get10ArtikelTerbaru();
$data[‘title’]= ‘Artikel Terbaru’;
      $this->load->view('v_artikel', $data);
    }
}
