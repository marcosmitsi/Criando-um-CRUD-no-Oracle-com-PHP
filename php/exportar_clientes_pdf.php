<?php
include_once('connect/conexao.php');
require_once('../fpdf/fpdf.php');

// Criar um novo PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 14);

// Título do relatório
$pdf->Cell(190, 10, 'Relatorio de Clientes',1,1,'C');
$pdf->Ln(10);

// Cabeçalhos da tabela
$pdf ->SetFont('Arial','B',12);
$pdf->Cell(10,10,'ID',1);
$pdf->Cell(80, 10, 'Nome', 1);
$pdf->Cell(75, 10, 'E-mail', 1);
$pdf->Cell(25, 10, 'Telefone', 1);
$pdf->Ln();


// Buscar dados do banco
$sql = "SELECT id, nome, email, telefone FROM clientes";
$stmt = oci_parse($conn, $sql);
oci_execute($stmt);

// Adicionar os clientes ao PDF
$pdf->SetFont('Arial', '', 12);
while ($row = oci_fetch_assoc($stmt)) {
    $pdf->Cell(10, 10, $row['ID'], 1);
    $pdf->Cell(80, 10, $row['NOME'], 1);
    $pdf->Cell(75, 10, $row['EMAIL'], 1);
    $pdf->Cell(25, 10, $row['TELEFONE'], 1);
    $pdf->Ln();
}

// Saída do PDF
$pdf->Output('D', 'clientes.pdf');
exit;
