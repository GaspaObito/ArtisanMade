<!DOCTYPE html>
<html lang="en">
<!-- INICIO head -->
<?php include 'template/head.php'; ?>
<!-- FIN head -->
<body>
  <div id="paypal-button-container"></div>
  <script>
    paypal.Buttons({
      style: {
        color: 'blue',
        shape: 'pill',
        label: 'pay'
      },
      createOrder: function (data, actions) {
        return actions.order.create({
          purchase_units: [{
            amount: {
              value: 100
            }
          }]
        });
      },
      onApprove: function (data, actions) {
        actions.order.capture().then(function (detalles) {
          window.location.href = "completado.html"
        });
      },
      onCancel: function (data) {
        alert("Pago cancelado");
        console.log(data);
      }
    }).render('#paypal-button-container');
  </script>
</body>
</html>