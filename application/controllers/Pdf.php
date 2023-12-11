<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pdf extends CI_Controller{
	function __construct() {
		parent::__construct();
		$this->load->model("general/LogicaGeneral", "logica");//la idea es que este archivo siempre esté ya que aquí se consultan cosas que son muy globales.
		$this->load->model("misMatrices/LogicaMisMatrices", "logicaMis");//aquí se debe llamar la lógica correspondiente al módulo que se esté haciendo.
		$this->load->model("crearMatriz/LogicaMatriz","logMatriz");
		$this->load->helper('language');//mantener siempre.
		$this->lang->load('spanish');//mantener siempre.
	}

	public function generarPDF(){
		if(validaInApp("web")) {
			// Obtener datos de la consulta POST
			$idNuevaMatriz  = $_GET["nuevaMatriz"];
			$idPeriodicidad = $_GET["idPeriocididad"];
			$idPerfil       = $_GET["idPerfil"];
			$idEmpresa      = $_GET["idEmpresa"];

	
			$infoNuevaMatriz = $this->logMatriz->infoNuevaMatriz($idNuevaMatriz);
			$periodicidadID = $this->logMatriz->rellPeriodicidad($idPeriodicidad);
			$nombreMatriz = $infoNuevaMatriz[0]["nombreNuevaMatriz"];
			// $nombrePeriodicidad = $periodicidadID[0]["nombreRel"];
			$infoMatrizRecurrentes = $this->logMatriz->infoMatrizRecurrentes($idNuevaMatriz);



			$fecha = date("Y-m-d H:i:s"); 
			// $fechaFormateada =  date("j \d\\e F \d\\e Y", strtotime($fecha));
			
			$acumuloRecurrentes = [];
			foreach($infoMatrizRecurrentes as $infoRmatriz){
				array_push($acumuloRecurrentes, $infoRmatriz["idMatrizRecurrente"]);
			}
			$consultoSi = $this->logMatriz->consultoSiDos($idPeriodicidad, $idEmpresa, $acumuloRecurrentes);

			$nonNullValues = array_filter($consultoSi, function ($value) {
				return $value !== null;
			});
			
			// Calcular el porcentaje total
			$totalPercentage = count($nonNullValues) > 0 ? array_sum($nonNullValues) / count($nonNullValues) : 0;
			$totalPercentageFormatted = number_format($totalPercentage, 2);

			

			// creo TCPDF
			$this->load->library('tcpdf/tcpdf');
			$pdf = new TCPDF('P', 'mm', 'LETTER', true, 'UTF-8', false);
			

			// set header and footer fonts
			$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
			$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
			// set default monospaced font
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
			// set margins
			$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
			$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

			$pdf->SetFillColor(255, 255, 255);
			$pdf->SetFont('helvetica', 'B', 10);
			$pdf->setPrintHeader(false);
			$pdf->AddPage();
			//backgroud del reporte
			$pdf->Image(base_url().'res/img/reporte-0001.jpg', 0, 0, 0, 100, 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
			// var_dump("aca");die();
			
			// $pdf->writeHTML('<img src="'.base_url().'res/img/reporte-0001.jpg" style="width: 1600px; top: -500px;">', true, false, true, false, '');
			
			$pdf->SetXY(80, 30);
			$pdf->SetTextColor(0, 0, 0);
			$pdf->writeHTMLCell(0, 0, '', '', '<p style="color:white;">'.formatoFecha($fecha).'</p>', 0, 1, false, true, 'R', false);
			$pdf->writeHTML('<br><br><br><br><br><br><p style="color:white;">Reporte de cumplimiento</p>', true, false, true, false, '');
			$pdf->writeHTML('<p style="color:white;">'.$nombreMatriz.'</p>', true, false, true, false, '');
			// $pdf->writeHTML('<p>Periodo: '.$nombrePeriodicidad.'</p>', true, false, true, false, '');
			$pdf->writeHTML('<p style="color:white;">Total, de cumplimiento'.' '.$totalPercentageFormatted. '%</p>', true, false, true, false, '');
			$htmlTable = '<br><br><br><br><br><br><br><br><br><table border="1" cellpadding="3" style="font-size:6px;width:550px;top:100px;">';
			$htmlTable .= '<tr style="background-color:#d9d9d9;">';
			$htmlTable .= '<td style="text-align:center;font-weight:bold" width="150px">Obligación</td>';
			$htmlTable .= '<td style="text-align:center;font-weight:bold" width="50px">Entidad</td>';
			$htmlTable .= '<td style="text-align:center;font-weight:bold" width="150px">Norma Aplicable</td>';
			$htmlTable .= '<td style="text-align:center;font-weight:bold" width="50px">Periodicidad</td>';
			$htmlTable .= '<td style="text-align:center;font-weight:bold" width="50px">Frecuencia</td>';
			$htmlTable .= '<td style="text-align:center;font-weight:bold" width="50px">Responsable</td>';
			$htmlTable .= '<td style="text-align:center;font-weight:bold" width="50px">Cumplimiento</td>';
			$htmlTable .= '</tr>';

			foreach ($infoMatrizRecurrentes as $info) {
				$htmlTable .= '<tr>';
					$htmlTable .= '<td style="text-align:justify;">'.$info["obligacion"].'</td>';
					$htmlTable .= '<td style="text-align:left;">'.$info["nombreEntidades"].'</td>';
					$htmlTable .= '<td style="text-align:justify;">'.$info["normatividad"].'</td>';
					$htmlTable .= '<td style="text-align:left;">'.$info["frecuencia"].'</td>';
					$htmlTable .= '<td style="text-align:left;">'.$info["nombreCuandoAplique"].'</td>';
					$htmlTable .= '<td style="text-align:left;">'.$info["nombrePerfil"].'</td>';
					$htmlTable .= '<td style="text-align:left;">';
					
					$idMatrizRecurrente = $info['idMatrizRecurrente'];
					$porcentaje = isset($consultoSi[$idMatrizRecurrente]) ? $consultoSi[$idMatrizRecurrente] : 0;
					$porcentajeFormateado = number_format($porcentaje, 2);
					
					$htmlTable .= '<span style="text-align:center; color: '.getColorPorcentaje($porcentaje).';">'.$porcentajeFormateado.'%</span>';
					$htmlTable .= '</td>';
				$htmlTable .= '</tr>';
			}
			$htmlTable .= '<tr>';
				$htmlTable .= '<td colspan="6" style="text-align:right;font-weight:bold;">Total Cumplimiento</td>';
				$htmlTable .= '<td style="text-align:center;font-weight:bold; background-color:#d9d9d9;color: '.getColorPorcentaje($porcentaje).';">'.$totalPercentageFormatted.'</td>';
			$htmlTable .= '</tr>';
				
			$htmlTable .= '</table>';
			$pdf->writeHTML($htmlTable, true, false, true, false, '');
				
				
			// Obtener el contenido del PDF como cadena
			$output = $pdf->Output('Reporte.pdf', 'S');

			// Configurar los encabezados HTTP para mostrar el PDF en una nueva pestaña
			header('Content-Type: application/pdf');
			header('Content-Disposition: inline; filename="Reporte_'.$nombreMatriz.'_'.formatoFecha($fecha).'.pdf"');
			header('Content-Length: ' . strlen($output));

			// Imprimir el contenido del PDF
			echo $output;

		} else {
			header('Location:'.base_url()."login");
		}
	}
		

}
?>
