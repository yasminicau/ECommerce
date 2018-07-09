<?php

require_once "pagseguro-php-sdk-master/vendor/autoload.php";

       
  
      
\PagSeguro\Library::initialize();
\PagSeguro\Library::cmsVersion()->setName("Nome")->setRelease("1.0.0");
\PagSeguro\Library::moduleVersion()->setName("Nome")->setRelease("1.0.0");
$itemID = 1;
         $itemDescription= "Minha descrição ";
         $itemAmount = 99.0;
         $itemQuantity= 1;
         $itemWeight =0;
         $idPedido=23432;
          $itemDescription2= "Meu segundo produto ";
         $itemAmount2 = 70.0;
         $itemQuantity2= 2;
       
try {
    //cria a sessão de pagamento
    $sessionCode = \PagSeguro\Services\Session::create(
        \PagSeguro\Configuration\Configure::getAccountCredentials()
             
    );
    
     $codeSessao = $sessionCode->getResult();
    //iniciando a requisição de pagamento
    $payment = new \PagSeguro\Domains\Requests\Payment();
    
    //add produtos
    $payment->addItems()->withParameters(
    '0001',
    $itemDescription,
    $itemQuantity,
    $itemAmount
);
   
    
    $payment->addItems()->withParameters(
    '0002',
    $itemDescription2,
    $itemQuantity2,
    $itemAmount2
);
   //moeda tipo 
  $payment->setCurrency("BRL");
 //para poder saber o status da compra  
  $payment->setReference($idPedido);
  //redirecionar depois da compra finalizada
  $payment->setRedirectUrl("http://localhost/Ecommerce/");
  
  //dados comprador
$payment->setSender()->setName('João Comprador');
$payment->setSender()->setEmail('email@comprador.com.br');
$payment->setSender()->setPhone()->withParameters(
    11,
    56273440
);


//frete
$payment->setShipping()->setCost()->withParameters(20.00);
$payment->setShipping()->setType()->withParameters(\PagSeguro\Enum\Shipping\Type::SEDEX);

//notificação que foi pago
$payment->addParameter()->withArray(['notificationURL', 'http://localhost/Ecommerce/index.php']);
$payment->setRedirectUrl("http://localhost/Ecommerce/");
$payment->setNotificationUrl("http://localhost/Ecommerce/index.php");

try {

    /**
     * @todo For checkout with application use:
     * \PagSeguro\Configuration\Configure::getApplicationCredentials()
     *  ->setAuthorizationCode("FD3AF1B214EC40F0B0A6745D041BF50D")
     */
    $result = $payment->register(
        \PagSeguro\Configuration\Configure::getAccountCredentials()
    );

      
     
       header ("Location:$result");
    
   /* echo "<h2>Criando requisi&ccedil;&atilde;o de pagamento</h2>"
        . "<p>URL do pagamento: <strong>$result</strong></p>"
        . "<p><a title=\"URL do pagamento\" href=\"$result\" target=\_blank\">Ir para URL do pagamento.</a></p>";*/
} catch (Exception $e) {
    die($e->getMessage());
}

} catch (Exception $e) {
    die($e->getMessage());
}
