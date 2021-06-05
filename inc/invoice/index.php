<!DOCTYPE html>
<html lang="zxx">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>QR Code With PDF</title>           

    </head> 

    <body>

        <div style="width: 320px; margin-top: 50px;">

            <form action="pdfbuild.php" method="post">
                <input type="text" name="TotalAmount" placeholder="tk 0.00/-" required value="<?php if(isset($_POST['TotalAmount'])){ echo $_POST['TotalAmount'];} ?>"> <hr> <br>

                <input type="text" name="InvoiceNumber" placeholder="Invoice Number" required value="<?php if(isset($_POST['InvoiceNumber'])){ echo $_POST['InvoiceNumber'];} ?>"> <hr><br>

                <input type="submit" name="submit" value="Submit">
            </form>

            <!-- <table>
                <thead>
                    <tr>
                        <th>Test</th><th>Test02</th><th>Test03</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Text</td>
                        <td>Text 02</td>
                        <td>Text 03</td>
                    </tr>
                </tbody>
            </table> -->
        
        </div>        
    </body><!-- /body -->
</html><!-- /html -->