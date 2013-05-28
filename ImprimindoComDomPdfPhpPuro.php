<html>
<head>
<title>Impressao de Solicitacao</title>
<META http-equiv=Content-Type content="text/html; charset=iso-8859-1">
<style>
.someborda {border-width:0;}
</style>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);
//-->
</script>
</head>
<body>

<?
$bodyy = "";
$n_solic  = $_REQUEST["n_solic"];
include "conecta.php";

$query = "SELECT * FROM solicitacao WHERE n_solic=$n_solic";

//$query = "SELECT * FROM solicitacao";   // 
$resultado = mysql_query($query,$conexao);
$qnt = mysql_num_rows($resultado);
//echo "<br>"."query = ".$query;
if ($qnt <= 0){ 
echo "<script>alert('Solicitacao nao encontrada');</script>";
echo "<script>window.opener='';</script>";
echo "<script>window.close();</script>";
}else{
//$solic_impre = "";
$bodyy = "";

echo "<center><br><br><br>Gerando Arquivo para Impress&atilde;o !<br><br><br><img src=../imagens/carregando3.gif>";

echo '<br><br><br><input name="voltar" type="button" id="voltar" value="Voltar" onClick=window.location="efet_solicitacao.php"></center>';


require_once("../lib_fpdf/dompdf/dompdf_config.inc.php");

while ($linha = mysql_fetch_array($resultado)){

$n_solic   	=   $linha['n_solic'] ;
$data			=   $linha['data'] ;
$empresa		=   $linha['empresa'] ;
	 $query = "SELECT * FROM clientes WHERE n_clientes = " . intval($empresa);
	  $cadcli = mysql_query($query,$conexao);
	  $cqnt = mysql_num_rows($cadcli);
	  if ($cqnt > 0){ 
	  	while ($clinha = mysql_fetch_array($cadcli)) {
	    	$empresa = $clinha['nome_cliente'];
	   	}
	   }
$solicitante 	=   $linha['solicitante'] ;
$departamento 	=   $linha['departamento'] ;
$telefone 		=   $linha['telefone'] ;
$ramal 			=   $linha['ramal'] ;
$mail 			=   $linha['mail'] ;
$ocorrencia 	=   $linha['ocorrencia'] ;
$caminho 		=   $linha['caminho'] ;
$esp_tec 		=   $linha['esp_tec'] ;
$h_previstas	=  	$linha['h_previstas'] ;
$dt_homologacao	=  	$linha['dt_homologacao'] ;
$dt_upgrade		=  	$linha['dt_upgrade'] ;
$dt_conclusao	=  	$linha['dt_conclusao'] ;
$status_s		=  	$linha['status_s'] ;

$melhoria		=  	$linha['melhoria'] ;
$preventiva		=  	$linha['preventiva'] ;
$corretiva		=  	$linha['corretiva'] ;
$projeto		=  	$linha['projeto'] ;
$dt_conclusao	=  	$linha['dt_conclusao'] ;
$obs			= 	$linha['obs'] ;
$causa			= 	$linha['causa'] ;
$g_fatura		=  	$linha['g_fatura'] ;
$responsavel	=  	$linha['responsavel'] ;
$dt_efet_homol	=  	$linha['dt_efet_homol'] ;
$homol_por		=  	$linha['homol_por'] ;
$homol_com		=  	$linha['homol_com'] ;

$eficaz			=  	$linha['eficaz'] ;
$dt_conf_efic	=  	$linha['dt_conf_efic'] ;

$req_obr		=  	$linha['req_obr'] ;
$resp_req_obr	=  	$linha['resp_req_obr'] ;
$qual_req		=  	$linha['qual_req'] ;

$space = "";

$bodyy .= '<html><body>
<img src=../imagens/logo_novo.gif width=170 height=85> <h3 align="center"> Solicitação à SOFTMED SISTEMAS Ltda.</h3>
<div align="left">

 <table width="600" border="1" bordercolor="#000000" align="right" style="margin:0 10 10 10;">
      <tr>
        <td width="180"><b>
		Solicita&ccedil;&atilde;o N&uacute;mero</b></td>
        <td width="380">'.  $space. $n_solic.'
        </td>
      </tr>
      <tr >
        <td ><b>
          Data</b></td>
        <td>'. $space. $data.'
          </td>
      </tr>
      <tr >
        <td ><b>Empresa</b></td>
        <td>'. $space. $empresa.'
        </td>
      </tr>
      <tr >
        <td  ><b>Solicitante</b></td><td>'. $space. $solicitante.'</td>
      </tr>
      <tr >
        <td  ><b>Departamento</b></td><td>'. $space. $departamento.'</td>
      </tr>
      <tr >
        <td  ><b>E-mail</b> </td>
        <td >'. $space. $mail.'
        </td>
      </tr>
      <tr >
          <td ><b>Telefone</b></td>
        <td >'. $space. $telefone.'
        </td>
      </tr>';
	  
	  if ($caminho != " /  /  /  /  /  /  /  /"){
	  
	 $bodyy .= '<tr >
        <td ><b>Caminho</b></td>
        <td >'. $space. $caminho.'
		</td>
		</tr>';
		}
     
	$bodyy .= '<tr >
        <td ><b>Ocorr&ecirc;ncia</b></td>
        <td >'. $space. $ocorrencia.' </td>
      </tr>
	  
	  <tr >
		   <td><b>Tipo de Ocorr&ecirc;ncia</b></td>
		   <td >';

			 // imprime campos melhoria, preventiva e corretiva que sao checkbox
		
		 if($melhoria == 1){ $bodyy .= "<img src='../okcheck.jpg' >  Melhorias ";
	   			  } else { $bodyy .= "<img src='../nocheck.jpg' >  Melhorias ";}

	  if($preventiva == 1){  $bodyy .=  "<img src='../okcheck.jpg' > Preventiva"; 
	   } else {  $bodyy .=  "<img src='../nocheck.jpg' > Preventiva"; }

	    if($corretiva == 1){  $bodyy .=  "<img src='../okcheck.jpg' >  Corrretiva";
		} else {  $bodyy .=  "<img src='../nocheck.jpg' >  Corrretiva"; }
		
		if($projeto == 1){  $bodyy .=  "<img src='../okcheck.jpg' >  Projeto";
		} else {  $bodyy .=  "<img src='../nocheck.jpg' >  Projeto"; }
				
		$bodyy .='
           </td>
    </tr>
      <tr >
		   <td  ><b>Causa</b></td>
		   <td >'. $space . $causa.'
		 </td>
    </tr>
	<tr >
	  <td colspan=2><b>Especifica&ccedil;&atilde;o T&eacute;cnica</b></td>
	  </tr>
	  </table>
	 
	  <div id="Layer1" style="position:absolute; top:0px; left:0px; margin-left:12px; width:95%; height:auto; z-index:1;border:1px solid;border-color:#000000;border-bottom-color:#000000;" >
	  '. $esp_tec.'
	  </div>

	  
	   <table width="600" border="1" bordercolor="#000000" align="right" style="margin:0 0 0 10;">
		 <tr>
        <td width="180"><b>Quantidade de Horas &nbsp;&nbsp;&nbsp;</b></td>
		   <td width="380" >'. $space.$h_previstas.'
           </td>
    </tr>
		 <tr >
		   <td  ><b>Data Prevista para Homologa&ccedil;&atilde;o</b></td>
		   <td >'. $space.$dt_homologacao.'
           </td>
    </tr>
		
		 <tr >
		   <td  ><b>Data Prevista para Up - Grade</b></td>
		   <td >'. $space.$dt_upgrade.'
           </td>
    </tr>
	
	 <tr >
		   <td  ><b>Data Efetiva de Homologa&ccedil;&atilde;o</b></td>
		   <td >'. $space.$dt_efet_homol.'
           </td>
    </tr>
	
	 <tr >
		   <td><b>Homologado Por</b></td>
		    <td >'. $space.$homol_por.'
           </td>
    </tr>
	
	 <tr >
		   <td><b>Homologado Com</b></td>
		   <td >'. $space.$homol_com.'
           </td>
    </tr>
	<tr >
		   <td><b>Data de Conclusão</b></td>
		   <td >'. $space.$dt_conclusao.'
           </td>
    </tr>
	<tr >
		   <td><b>Respons&aacute;vel</b></td>
		   <td >'. $space . $responsavel.'
           </td>
    </tr>
	
 	<tr >
		   <td  ><b>Observacao</b></td>
		   <td >'. $space . $obs.'
		 </td>
    </tr>
	  <tr >
		   <td  ><b>Nota Fiscal</b><td>'. $space . $g_fatura.' </td>
    </tr>
	
	<tr >
		   <td  ><b>Foi Eficaz </b><td>'. $space ; 
		   
		   if ($eficaz == 1){
		   $bodyy .= 'Sim </td></tr><tr ><td><b>Comprovado em </b><td>'. $space . $dt_conf_efic.'</td></tr>';
		   
		   }else { $bodyy .= "Não </td> </tr>";}
		   
		   $bodyy .= ' 
	
	<tr >
		   <td  ><b>Existe Requisito Obrigatório</b><td>'. $space ; 
		   
		   if ($req_obr == 1){
		   $bodyy .= 'Sim</td></tr>
		   <tr><td><b>Qual </b><td>'. $space . $qual_req.'</td></tr>
		   <tr><td><b>Responsável </b><td>'. $space . $resp_req_obr.'</td></tr>';

		   }else { $bodyy .= 'Não';}
		   
		   $bodyy .= ' 	
		 <tr >
		   <td  ><b>Status</b></td>
		   <td >'. $space .$status_s.'</td>
    </tr>
</table>
</div>';


} // Fecha while

         $dompdf = new DOMPDF(); 
         $dompdf ->load_html($bodyy); 
         $dompdf->render(); 
         $pdf = $dompdf->output(); 

         $nomepdf = date("d_m_Y").".pdf"; 
         $arquivo = "sol_".$n_solic."_".$nomepdf; 
         //salva o arquivo 
		 file_put_contents($arquivo,$pdf); 
         echo "<script>window.location ='" .$arquivo ."';</script>"; 
}
?>
</body>
</html>
