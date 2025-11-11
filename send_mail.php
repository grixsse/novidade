<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = filter_var(trim($_POST["name"]), FILTER_SANITIZE_STRING);
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $phone = filter_var(trim($_POST["phone"]), FILTER_SANITIZE_STRING);
    $message = filter_var(trim($_POST["message"]), FILTER_SANITIZE_STRING);

    // Verificar se os campos estão preenchidos
    if (empty($name) || empty($email) || empty($phone) || empty($message)) {
        http_response_code(400);
        echo "Por favor, preencha todos os campos.";
        exit;
    }

    // Destinatário do e-mail (seu e-mail)
    $recipient = "seuemail@dominio.com"; 

    // Assunto do e-mail
    $subject = "Novo orçamento de $name";

    // Conteúdo do e-mail
    $email_content = "Nome: $name\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Telefone: $phone\n\n";
    $email_content .= "Mensagem:\n$message\n";

    // Cabeçalhos do e-mail
    $email_headers = "From: $name <$email>";

    // Enviar o e-mail
    if (mail($recipient, $subject, $email_content, $email_headers)) {
        http_response_code(200);
        echo "Obrigado! Seu orçamento foi enviado com sucesso.";
    } else {
        http_response_code(500);
        echo "Ops! Ocorreu um problema ao enviar seu orçamento. Tente novamente.";
    }
} else {
    http_response_code(403);
    echo "Envio de formulário não permitido.";
}
?>
