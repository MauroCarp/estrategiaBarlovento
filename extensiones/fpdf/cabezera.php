<?php
$pdf = new FPDF('P','mm','A4');	
$pdf->AddPage();
$pdf->SetFillColor(0,0,0);
$pdf->SetTitle($cabezera);
$pdf->SetDisplayMode('fullpage', 'single');
$pdf->SetAutoPageBreak(1,1);
$pdf->Image('img/logo-negro-bloque.png', 140, 10,60 );
$pdf->SetFont('helvetica','B',14);
$pdf->Ln(4);
$pdf->MultiCell(130,9,utf8_decode($cabezera),0,'L');
$pdf->MultiCell(130,9,utf8_decode($perfil),0,'L');
$pdf->MultiCell(130,9,utf8_decode($destino),0,'L');
$pdf->Cell(130,8,$fecha,0,'L');
$pdf->Ln(8);
	
