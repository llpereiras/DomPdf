<?php 

		App::import('Vendor', 'dompdf', array('file' => 'dompdf' . DS . 'dompdf_config.inc.php'));

		$html = 
		'<html><body>'. 
		'<p>Put your html here, or generate it with your favourite '. 
		'templating system.</p>'. 
		'</body></html>';

		$this->dompdf = new DOMPDF(); 
		$papersize = "legal"; 
		$orientation = 'landscape'; 
		$this->dompdf->load_html($html); 
		$this->dompdf->set_paper($papersize, $orientation); 
		$this->dompdf->render();

		$output = $this->dompdf->output(); 
		file_put_contents('Brochure.pdf', $output);

		echo "<script>window.location ='../Brochure.pdf';</script>"; // Gera na pasta webroot

		exit();
    
?>    
