
<link rel="stylesheet" href="https://summerclubfp17.com.br/app/layout/agenda/css/pay.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style>
    #form-checkout {
      display: flex;
      flex-direction: column;
      max-width: 600px;
    }

  </style>
<script src="https://sdk.mercadopago.com/js/v2"></script>
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">PIX </a></li>
    <li><a data-toggle="tab" href="#menu1">Cartão de crédito</a></li>
  </ul>

  <div class="tab-content" style="padding: 15px;">
    <div id="home" class="tab-pane fade in active">
      <h3>PIX</h3>
      <form action="" method="POST">
        <button class="btn btn-primary" name="gerar_pix">Gerar Pix <i class="fa fa-qrcode"></i></button>
      </form>
    </div>
    <div id="menu1" class="tab-pane fade">
    <h3>Cartão de crédito</h3>
        <form id="form-checkout">
            <div id="form-checkout__cardNumber" class="container"></div>
            <div id="form-checkout__expirationDate" class="container"></div>
            <div id="form-checkout__securityCode" class="container"></div>
            <input type="text" id="form-checkout__cardholderName" />
            <select id="form-checkout__issuer"></select>
            <select id="form-checkout__installments"></select>
            <select id="form-checkout__identificationType"></select>
            <input type="text" id="form-checkout__identificationNumber" />
            <input type="email" id="form-checkout__cardholderEmail" />
        
            <button type="submit" id="form-checkout__submit">Pagar</button>
            <progress value="0" class="progress-bar">Carregando...</progress>
        </form>
    </div>
  </div>


<script>
    const mp = new MercadoPago("APP_USR-3957588270666400-040711-218e7f777e3e2e2537a29153b1a7d439-213965040");
    
    
    const cardForm = mp.cardForm({
      amount: "100.5",
      iframe: true,
      form: {
        id: "form-checkout",
        cardNumber: {
          id: "form-checkout__cardNumber",
          placeholder: "Número do cartão",
        },
        expirationDate: {
          id: "form-checkout__expirationDate",
          placeholder: "MM/YY",
        },
        securityCode: {
          id: "form-checkout__securityCode",
          placeholder: "Código de segurança",
        },
        cardholderName: {
          id: "form-checkout__cardholderName",
          placeholder: "Titular do cartão",
        },
        issuer: {
          id: "form-checkout__issuer",
          placeholder: "Banco emissor",
        },
        installments: {
          id: "form-checkout__installments",
          placeholder: "Parcelas",
        },        
        identificationType: {
          id: "form-checkout__identificationType",
          placeholder: "Tipo de documento",
        },
        identificationNumber: {
          id: "form-checkout__identificationNumber",
          placeholder: "Número do documento",
        },
        cardholderEmail: {
          id: "form-checkout__cardholderEmail",
          placeholder: "E-mail",
        },
      },
      callbacks: {
        onFormMounted: error => {
          if (error) return console.warn("Form Mounted handling error: ", error);
          console.log("Form mounted");
        },
        onSubmit: event => {
          event.preventDefault();

          const {
            paymentMethodId: payment_method_id,
            issuerId: issuer_id,
            cardholderEmail: email,
            amount,
            token,
            installments,
            identificationNumber,
            identificationType,
          } = cardForm.getCardFormData();

          fetch("/process_payment", {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify({
              token,
              issuer_id,
              payment_method_id,
              transaction_amount: Number(amount),
              installments: Number(installments),
              description: "Descrição do produto",
              payer: {
                email,
                identification: {
                  type: identificationType,
                  number: identificationNumber,
                },
              },
            }),
          });
        },
        onFetching: (resource) => {
          console.log("Fetching resource: ", resource);

          // Animate progress bar
          const progressBar = document.querySelector(".progress-bar");
          progressBar.removeAttribute("value");

          return () => {
            progressBar.setAttribute("value", "0");
          };
        }
      },
    });

</script>


