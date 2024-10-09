<!-- app/views/invoices/view.php -->
<h2>Fatura Detayları</h2>

<p>Fatura No: <?php echo htmlspecialchars($invoice['id']); ?></p>
<p>Sipariş No: <?php echo htmlspecialchars($invoice['order_id']); ?></p>
<p>Tutar: <?php echo htmlspecialchars($invoice['total_amount']); ?> TL</p>
<p>Fatura Tarihi: <?php echo htmlspecialchars($invoice['invoice_date']); ?></p>

<a href="index.php?page=orders&action=history">Sipariş Geçmişine Dön</a>
