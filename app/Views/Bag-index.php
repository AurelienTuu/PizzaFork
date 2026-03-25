<?= $this->extend('page.php') ?>
<?= $this->section('body') ?>

<a href="<?= '/' ?>" class="btn btn-secondary back-button" role="button" style="margin-top: 5%;">
    <i class="fas fa-arrow-left"></i> Retour à la boutique
</a>

<div class="card" style="margin-top: 5%;">


    <div class="card-header">
        <div class="col">
            <h4><?= $title ?></h4>
        </div>
    </div>
    <div class="card-body">
        <thead></thead>
        <table class="table table-hover table-striped">
            <?php foreach ($bag->contents() as $item): ?>
                <tr style="text-align: center;">
                    <td>
                        <img src="<?= '/img/' . $item['picture'] ?>" class="img-fluid rounded bag-thumb" alt="...">
                    </td>
                    <td>
                        <h5><?= $item['name'] ?></h5>
                    </td>
                    <td style="width: 5%;">
                        <a href="<?= '/bag/qty/Dec/' . $item['rowid'] ?>" class="btn btn-danger" role="button">
                            <i class="fas fa-minus"></i>
                        </a>
                    </td>
                    <td style="width: 10%;">
                        <h5><?= $bag->formatNumber($item['qty']) ?></h5>
                    </td>
                    <td style="width: 5%;">
                        <a href="<?= '/bag/qty/Inc/' . $item['rowid'] ?>" class="btn btn-success" role="button">
                            <i class="fas fa-plus"></i>
                        </a>
                    </td>
                    <td>
                        <h5 class="text-grey"><?= '&euro;' .
                            $bag->formatNumber($item['price']) ?></h5>
                    </td>
                    <td>
                        <a href="<?= '/bag/item/delete/' . $item['rowid'] ?>" class="btn btn-danger" role="button">
                            <i class="fa fa-trash"></i></a>
                    </td>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
    <div class="card-footer">
        <div id="paypal-button-container"></div>
        <p id="result-message"></p>


        <!-- Initialize the JS-SDK -->
        <script
            src="https://www.paypal.com/sdk/js?client-id=AQoTtpmnvGIFW7iWp1IrX6PFzTCt52f4zALSu8BhqnQ3mp_NFWoTbyjeHzlQq_DFrCPCZ0I9O3vIP8NK&buyer-country=FR&currency=EUR&components=buttons&enable-funding=venmo,card&disable-funding=paylater"
            data-sdk-integration-source="developer-studio"></script>
        <script>
            const paypalButtons = window.paypal.Buttons({
                style: {
                    shape: "pill",
                    layout: "vertical",
                    color: "gold",
                    label: "checkout",
                },

                async createOrder() {
                    try {
                        const response = await fetch("/api/orders", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                            },
                            // use the "body" param to optionally pass additional order information
                            // like product ids and quantities
                            body: JSON.stringify({
                                cart: [
                                    {
                                        id: "YOUR_PRODUCT_ID",
                                        quantity: "YOUR_PRODUCT_QUANTITY",
                                    },
                                ],
                            }),
                        });

                        const orderData = await response.json();

                        if (orderData.id) {
                            return orderData.id;
                        }
                        const errorDetail = orderData?.details?.[0];
                        const errorMessage = errorDetail
                            ? `${errorDetail.issue} ${errorDetail.description} (${orderData.debug_id})`
                            : JSON.stringify(orderData);

                        throw new Error(errorMessage);
                    } catch (error) {
                        console.error(error);
                        // resultMessage(`Could not initiate PayPal Checkout...<br><br>${error}`);
                    }
                },
                async onApprove(data, actions) {
                    try {
                        const response = await fetch(
                            `/api/orders/${data.orderID}/capture`,
                            {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/json",
                                },
                            }
                        );

                        const orderData = await response.json();
                        // Three cases to handle:
                        //   (1) Recoverable INSTRUMENT_DECLINED -> call actions.restart()
                        //   (2) Other non-recoverable errors -> Show a failure message
                        //   (3) Successful transaction -> Show confirmation or thank you message

                        const errorDetail = orderData?.details?.[0];

                        if (errorDetail?.issue === "INSTRUMENT_DECLINED") {
                            // (1) Recoverable INSTRUMENT_DECLINED -> call actions.restart()
                            // recoverable state, per
                            // https://developer.paypal.com/docs/checkout/standard/customize/handle-funding-failures/
                            return actions.restart();
                        } else if (errorDetail) {
                            // (2) Other non-recoverable errors -> Show a failure message
                            throw new Error(
                                `${errorDetail.description} (${orderData.debug_id})`
                            );
                        } else if (!orderData.purchase_units) {
                            throw new Error(JSON.stringify(orderData));
                        } else {
                            // (3) Successful transaction -> Show confirmation or thank you message
                            // Or go to another URL:  actions.redirect('thank_you.html');
                            const transaction =
                                orderData?.purchase_units?.[0]?.payments?.captures?.[0] ||
                                orderData?.purchase_units?.[0]?.payments
                                    ?.authorizations?.[0];
                            resultMessage(
                                `Transaction ${transaction.status}: ${transaction.id}<br>
          <br>See console for all available details`
                            );
                            console.log(
                                "Capture result",
                                orderData,
                                JSON.stringify(orderData, null, 2)
                            );
                        }
                    } catch (error) {
                        console.error(error);
                        resultMessage(
                            `Sorry, your transaction could not be processed...<br><br>${error}`
                        );
                    }
                },


            });
            paypalButtons.render("#paypal-button-container");


            // Example function to show a result to the user. Your site's UI library can be used instead.
            function resultMessage(message) {
                const container = document.querySelector("#result-message");
                container.innerHTML = message;
            }
        </script>
    </div>

</div>
<?= $this->endSection() ?>