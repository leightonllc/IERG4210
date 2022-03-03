<?php
session_start();

echo '
         <table class="table table-borderless">
         <thead><tr><th scope="col">Product</th><th scope="col">Amount</th><th scope="col">Total</th></tr></thead>
         <tbody id="shoppingcarttable"></tbody>
         <tfoot id="shoppingcartfoot"></tfoot>
         </table>
      <script src="../lib/shoppinglist.js"></script>';
?>