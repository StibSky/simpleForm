<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" type="text/css"
          rel="stylesheet"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Order food & drinks</title>
</head>
<body>
<div class="alert alert-success" role="alert">
    <?php echo $okAlert ?>
    <br/>
    <?php echo $delivery ?>
</div>

<div class="container">
    <h1>Order food in restaurant "the Personal Ham Processors"</h1>
    <nav>
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link active" href="?food=1">Order food</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?food=0">Order drinks</a>
            </li>
        </ul>
    </nav>
    <form method="post">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="email">E-mail:</label>
                <input type="text" id="email" name="email" class="form-control"
                       value="<?php echo $_SESSION["email"] ?>"/>
                <p  <?php echo $bootstrapAlert?> > <?php echo $emailAlert ?>
                    <?php echo $emailFormat ?> </p>
            </div>
        </div>

        <fieldset>
            <legend>Address</legend>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="street">Street:</label>
                    <input type="text" name="street" id="street" class="form-control"
                           value="<?php echo $_SESSION["street"] ?> "/>
                    <p <?php echo $bootstrapAlert?>  > <?php echo $streetAlert ?>
                    </p>
                </div>
                <div class="form-group col-md-6">
                    <label for="streetnumber">Street number:</label>
                    <input type="text" id="streetnumber" name="streetnumber" class="form-control"
                           value="<?php echo isset($_POST['streetnumber']) ? $_POST['streetnumber'] : '' ?>">
                    <p  <?php echo $bootstrapAlert?> >  <?php echo $strnumAlert ?> <?php echo $nanStrnum ?>
                    </p>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="city">City:</label>
                    <input type="text" id="city" name="city" class="form-control"
                           value="<?php echo $_SESSION["city"] ?> "/>
                    <p  <?php echo $bootstrapAlert?> > <?php echo $cityAlert ?>
                    </p>
                </div>
                <div class="form-group col-md-6">
                    <label for="zipcode">Zipcode</label>
                    <input type="text" id="zipcode" name="zipcode" class="form-control"
                           value="<?php echo isset($_POST['zipcode']) ? $_POST['zipcode'] : '' ?>">
                    <p  <?php echo $bootstrapAlert?> >  <?php echo $zipAlert ?> <?php echo $nanZip ?> </p>
                </div>
            </div>
        </fieldset>

        <fieldset>
            <legend>Products</legend>
            <?php foreach ($products AS $i => $product): ?>
                <label>
                    <input type="checkbox" value="1" name="products[<?php echo $i ?>]"/> <?php echo $product['name'] ?>
                    -
                    &euro; <?php echo number_format($product['price'], 2) ?></label><br/>
            <?php endforeach; ?>
            <p  <?php echo $bootstrapAlert?> >  <?php echo $orderEmpty ?>
        </fieldset>

        <fieldset>
            <legend>Delivery</legend>
            <input type="checkbox" value="express" name="express">
            <label for="express"> Express Delivery (45 min)</label>
        </fieldset>
        <button type="submit" class="btn btn-primary">Order!</button>
    </form>

    <footer>You already ordered <strong>&euro; <?php echo (isset($totalPrice)) ? $totalPrice : '0' ?></strong> in food
        and drinks.
    </footer>
</div>

<style>
    footer {
        text-align: center;
    }
</style>


</body>
</html>