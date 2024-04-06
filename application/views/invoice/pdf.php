<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    .itemdetails tr {
        border: 1px solid black;
        border-collapse: collapse;
    }
</style>
<body>

    <div class="">
        <table style="width: 100%;">
            <tr>
                <!-- <td rowspan="6"><img src="<?php echo base_url(); ?>images/Sansoftwares-logo-1.png" alt="logo"></td> -->
                <td style="width:20%" rowspan="6"></td>
                <td style=" font-size:large"><b> SAN Software Pvt Ltd </b></td>
            </tr>
            <tr>
                <td>419, 4th Floor, M3M Urbana, Sector 67</td>
            </tr>
            <tr>
                <td>Gurgaon, Haryana-122018</td>
            </tr>

        </table>
        <table width="100%" style="border:1px solid balck">
            <tr>
                <td><b>Client Detail</b></td>
                <td style="width:25%" rowspan="4"></td>
                <td><b>Invoice Date</b></td>
            </tr>
            <tr>
                <td><?php echo $data[0][0]['client_name']; ?></td>
                <td><?php echo date_format(new DateTime($data[0][0]['invoice_date']), "d/M/Y ");  ?></td>
            </tr>
            <tr>
                <td><?php echo $data[0][0]['client_phone']; ?></td>
            </tr>
            <tr>
                <td><?php echo $data[0][0]['client_email']; ?></td>
            </tr>
            <tr>
                <td><?php echo $data[0][0]['address']; ?> </td>
            </tr>
        </table>
        <table width="100%" style="border:1px solid black; margin-top:5px; " class="itemdetails">
            <tr>
                <td><b>Item Details</b></td>
            </tr>
            <tr>
                <td style="width: 25%;"><b>Sno</b> </td>
                <td><b>Item Name</b></td>
                <td style="text-align: right;"><b>Price</b></td>
                <td style="text-align: right;"><b>Quantity</b></td>
                <td style="text-align: right;"><b>Amount</b></td>
            </tr>
            <?php $Sno = 1;  ?>
            <?php foreach ($data as $value) {      ?>
                <tr>
                    <td><?php echo $Sno; ?></td>
                    <td><?php echo $value[0]['item_name']; ?></td>
                    <td align="right"><?php echo $value[0]['item_price']; ?></td>
                    <td style="text-align: right;"><?php echo $value[0]['item_qty']; ?></td>
                    <td style="text-align: right;"><?php echo  $value[0]['total_amount'];  ?></td>
                </tr>
            <?php $Sno++;
            }     ?>
        </table>

        <table style=" border:1px solid black;  width: 100%; margin-top: 2%;">
            <tr>
                <td><b>Total Amount</b></td>
                <td style="text-align:right"><?php echo $data[0][0]['total_amount'];   ?> </td>
            </tr>
        </table>
    </div>
</body>

</html>