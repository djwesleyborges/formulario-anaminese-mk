<?php
// Removi os requires antigos do PHPMailer, pois agora usamos apenas o autoload do Composer
// require 'PHPMailer/src/PHPMailer.php';
// require 'PHPMailer/src/SMTP.php';
// require 'PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Carrega Composer autoload
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Recebe os dados do formulário
$nome_marca = $_POST['nome_marca'];
$instagram = $_POST['instagram'];
$produto = $_POST['produto'];
$proposito = $_POST['proposito'];
$perfil = $_POST['perfil'];
$impedimento = $_POST['impedimento'];
$diferencial = $_POST['diferencial'];
$sentimento = $_POST['sentimento'];
$superar = $_POST['superar'];
$maturidade = $_POST['maturidade'];
$tempo = $_POST['tempo'];
$posicionamento = $_POST['posicionamento'];
$imagem = $_POST['imagem'];
$objetivo = $_POST['objetivo'];
$investimento = $_POST['investimento'];
$investimento_mensal = $_POST['investimento_mensal'];
$trafego_pago = $_POST['trafego_pago'];
$valor_minimo = $_POST['valor_minimo'];
$processo = $_POST['processo'];
$urgencia = $_POST['urgencia'];
$motivo = $_POST['motivo'];

// Monta a mensagem em HTML
$mensagem = "
<h2>Formulário de Anamnese</h2>
<p><strong>Nome da marca:</strong> $nome_marca</p>
<p><strong>Instagram:</strong> $instagram</p>
<p><strong>Produto/serviço:</strong> $produto</p>
<p><strong>Propósito:</strong> $proposito</p>
<p><strong>Perfil:</strong> $perfil</p>
<p><strong>Impedimento:</strong> $impedimento</p>
<p><strong>Diferencial:</strong> $diferencial</p>
<p><strong>Sentimento ao aparecer no Instagram:</strong> $sentimento</p>
<p><strong>Disposição para superar:</strong> $superar</p>
<p><strong>Maturidade emocional:</strong> $maturidade</p>
<p><strong>Investimento de tempo:</strong> $tempo</p>
<p><strong>Posicionamento:</strong> $posicionamento</p>
<p><strong>Relação com imagem:</strong> $imagem</p>
<p><strong>Objetivo:</strong> $objetivo</p>
<p><strong>Investimento mensal:</strong> $investimento_mensal</p>
<p><strong>Tráfego pago:</strong> $trafego_pago</p>
<p><strong>Valor mínimo:</strong> $valor_minimo</p>
<p><strong>Processo de construção:</strong> $processo</p>
<p><strong>Urgência:</strong> $urgencia</p>
<p><strong>Motivo para ser escolhido:</strong> $motivo</p>
";

$mail = new PHPMailer(true);

try {
    // Configurações do servidor SMTP do Gmail
    $mail->isSMTP();
    $mail->Host = $_ENV['MAIL_HOST'];
    $mail->SMTPAuth = true;
    $mail->Username = $_ENV['MAIL_USERNAME'];
    $mail->Password = $_ENV['MAIL_PASSWORD'];
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Remetente e destinatário
    $mail->setFrom($_ENV['MAIL_FROM'], $_ENV['MAIL_FROM_NAME']);
    $mail->addAddress($_ENV['MAIL_TO'], 'Destinatário');

    // Conteúdo do e-mail
    $mail->isHTML(true);
    $mail->Subject = 'Novo formulário de anamnese submetido';
    $mail->Body    = $mensagem;

    $mail->send();
    echo "<script>location.href='sucesso.html'</script>";
} catch (Exception $e) {
    echo "<script>alert('Erro ao enviar o formulário. Tente novamente.')</script>";
}
?>
