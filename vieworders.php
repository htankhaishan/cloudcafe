<?php
require_once('auth.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wings Cafe</title>
    <link href="style.css" rel="stylesheet" type="text/css" />
    <link href="src/facebox.css" rel="stylesheet" type="text/css" />
    <script src="lib/jquery.js" defer></script>
    <script src="src/facebox.js" defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            jQuery('a[rel*=facebox]').facebox({
                loadingImage: 'src/loading.gif',
                closeImage: 'src/closelabel.png'
            });
        });

        function validateForm() {
            const studentNum = document.forms["orderForm"]["num"].value.trim();
            const termsCheckbox = document.forms["orderForm"]["checkbox"];

            if (!studentNum) {
                alert("You must enter your student number.");
                return false;
            }

            if (!termsCheckbox.checked) {
                alert("Please agree to the terms and conditions.");
                return false;
            }

            return true;
        }

        function showCurrentTime() {
            const now = new Date();
            const hours = now.getHours();
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            document.getElementById('currentTime').value = `${hours}:${minutes}:${seconds}`;
            setTimeout(showCurrentTime, 1000);
        }
    </script>
</head>

<body onload="showCurrentTime()">
    <div id="container">
        <div id="header_section">
            <div style="float:right; margin-right:30px;">
                <?php
                require_once('connection.php');
                $id = $_SESSION['SESS_MEMBER_ID'];
                $query = $pdo->prepare("SELECT name, surname FROM members WHERE id = :id");
                $query->execute(['id' => $id]);
                $member = $query->fetch();
                echo htmlspecialchars($member['name'] . ' ' . $member['surname']);
                ?>
                &nbsp;<a href="logout.php" id="logout-button">Logout</a>
            </div>
        </div>

        <div id="menu_bg">
            <div id="menu">
                <ul>
                    <li style="float:left;">
                        <input id="currentTime" readonly style="border:0; font-size:25px; background-color:#000; color:#FF0000;" />
                    </li>
                </ul>
            </div>
        </div>

        <div id="content">
            <div id="content_left">
                <h2>Select From Menu Below</h2>
                <div class="view1">
                    <?php
                    $query = $pdo->query("SELECT * FROM products");
                    while ($product = $query->fetch()) {
                        echo "<div class='box'>
                                <a rel='facebox' href='portal.php?id=" . htmlspecialchars($product['product_id']) . "'>
                                    <img src='images/bgr/" . htmlspecialchars($product['product_photo']) . "' width='75' height='75' />
                                </a>
                                <div class='textbox'>" . htmlspecialchars($product['name']) . "</div>
                              </div>";
                    }
                    ?>
                </div>
            </div>

            <div id="content_right">
                <form method="post" action="confirm.php" name="orderForm" onsubmit="return validateForm()">
                    <input name="id" type="hidden" value="<?php echo $_SESSION['SESS_MEMBER_ID']; ?>" />
                    <input name="transactioncode" type="hidden" value="<?php echo $_SESSION['SESS_FIRST_NAME']; ?>" />
                    <h2>Order Details</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Total</th>
                                <th>Del</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = $pdo->prepare("SELECT * FROM orderditems WHERE transactioncode = :transactioncode");
                            $query->execute(['transactioncode' => $_SESSION['SESS_FIRST_NAME']]);
                            while ($order = $query->fetch()) {
                                echo "<tr>
                                        <td>" . htmlspecialchars($order['name']) . "</td>
                                        <td>" . htmlspecialchars($order['quantity']) . "</td>
                                        <td>" . htmlspecialchars($order['price']) . "</td>
                                        <td>" . htmlspecialchars($order['total']) . "</td>
                                        <td><a href='deleteorder.php?id=" . htmlspecialchars($order['id']) . "'>Cancel</a></td>
                                      </tr>";
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3">Grand Total:</td>
                                <td colspan="2">
                                    <?php
                                    $query = $pdo->prepare("SELECT SUM(total) as grandTotal FROM orderditems WHERE transactioncode = :transactioncode");
                                    $query->execute(['transactioncode' => $_SESSION['SESS_FIRST_NAME']]);
                                    $total = $query->fetchColumn();
                                    echo "<input type='text' readonly value='" . htmlspecialchars($total) . "' />";
                                    ?>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                    <div>
                        <label>Student Num: <input type="text" name="num" /></label>
                    </div>
                    <div>
                        <label>
                            <input type="checkbox" name="checkbox" /> I Agree to the <a rel="facebox" href="terms.php">Terms and Conditions</a>
                        </label>
                    </div>
                    <button type="submit">Confirm Order</button>
                </form>
            </div>
        </div>
    </div>

    <footer>
        <p>Copyright &copy; Wings Cafe 2024</p>
    </footer>
</body>

</html>
